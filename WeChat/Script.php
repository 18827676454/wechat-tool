<?php



namespace WeChat;

use WeChat\Contracts\BasicWeChat;
use WeChat\Contracts\Tools;
use WeChat\Exceptions\InvalidResponseException;

/**
 * 微信前端支持
 * Class Script
 * @package WeChat
 */
class Script extends BasicWeChat
{

    /**
     * 删除JSAPI授权TICKET
     * @param string $type TICKET类型(wx_card|jsapi)
     * @param string $appid 强制指定有效APPID
     * @return void
     */
    public function delTicket($type = 'jsapi', $appid = null)
    {
        is_null($appid) && $appid = $this->config->get('appid');
        $cache_name = "{$appid}_ticket_{$type}";
        Tools::delCache($cache_name);
    }

    /**
     * 获取JSAPI_TICKET接口
     * @param string $type TICKET类型(wx_card|jsapi)
     * @param string $appid 强制指定有效APPID
     * @return string
     * @throws Exceptions\InvalidResponseException
     * @throws Exceptions\LocalCacheException
     */
    public function getTicket($type = 'jsapi', $appid = null)
    {
        is_null($appid) && $appid = $this->config->get('appid');
        $cache_name = "{$appid}_ticket_{$type}";
        $ticket = Tools::getCache($cache_name);
        if (empty($ticket)) {
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type={$type}";
            $this->registerApi($url, __FUNCTION__, func_get_args());
            $result = $this->httpGetForJson($url);
            if (empty($result['ticket'])) {
                throw new InvalidResponseException('Invalid Resoponse Ticket.', '0');
            }
            $ticket = $result['ticket'];
            Tools::setCache($cache_name, $ticket, 5000);
        }
        return $ticket;
    }

    /**
     * 获取JsApi使用签名
     * @param string $url 网页的URL
     * @param string $appid 用于多个appid时使用(可空)
     * @param string $ticket 强制指定ticket
     * @return array
     * @throws Exceptions\LocalCacheException
     * @throws InvalidResponseException
     */
    public function getJsSign($url, $appid = null, $ticket = null)
    {
        list($url,) = explode('#', $url);
        is_null($ticket) && $ticket = $this->getTicket('jsapi');
        is_null($appid) && $appid = $this->config->get('appid');
        $data = ["url" => $url, "timestamp" => '' . time(), "jsapi_ticket" => $ticket, "noncestr" => Tools::createNoncestr(16)];
        return [
            'debug'     => false,
            "appId"     => $appid,
            "nonceStr"  => $data['noncestr'],
            "timestamp" => $data['timestamp'],
            "signature" => $this->getSignature($data, 'sha1'),
            'jsApiList' => [
                'updateAppMessageShareData', 'updateTimelineShareData', 'onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone',
                'startRecord', 'stopRecord', 'onVoiceRecordEnd', 'playVoice', 'pauseVoice', 'stopVoice', 'onVoicePlayEnd', 'uploadVoice', 'downloadVoice',
                'chooseImage', 'previewImage', 'uploadImage', 'downloadImage', 'translateVoice', 'getNetworkType', 'openLocation', 'getLocation',
                'hideOptionMenu', 'showOptionMenu', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem',
                'closeWindow', 'scanQRCode', 'chooseWXPay', 'openProductSpecificView', 'addCard', 'chooseCard', 'openCard',
            ],
        ];
    }

    /**
     * 数据生成签名
     * @param array $data 签名数组
     * @param string $method 签名方法
     * @param array $params 签名参数
     * @return bool|string 签名值
     */
    protected function getSignature($data, $method = "sha1", $params = [])
    {
        ksort($data);
        if (!function_exists($method)) return false;
        foreach ($data as $k => $v) array_push($params, "{$k}={$v}");
        return $method(join('&', $params));
    }

    /**
     * 获取微信卡券签名
     * @param string $card_id
     * @param int    $timestamp
     * @param string $noncestr
     * @param string $appid
     *
     * @return array|bool
     * @throws Exceptions\LocalCacheException
     * @throws InvalidResponseException
     * @author : Randy_chen
     * @Date   : 2019/9/10
     * @Time   : 21:16
     */
    public function getCardSign($card_id = '', $timestamp = 0, $noncestr = '', $appid = '')
    {
        $api_ticket = $this->getTicket('wx_card');
        if (!$timestamp)
            $timestamp = time();
        if (!$noncestr)
            $noncestr = Tools::createNoncestr(16);
        $arrdata = [
            "api_ticket" => $api_ticket,
            "card_id"    => $card_id,
            "timestamp"  => $timestamp,
            "noncestr"   => $noncestr
        ];
        $sign = $this->getTicketSignature($arrdata);
        if (!$sign)
            return false;
        $signPackage = [
            "card_id"   => $card_id,
            "nonce_str" => $noncestr,
            "timestamp" => $timestamp,
            "signature" => $sign
        ];
        return $signPackage;
    }

    /**
     * 获取微信卡券签名
     * @param array $arrdata 签名数组
     * @param string $method 签名方法
     * @return boolean|string 签名值
     */
    public function getTicketSignature($arrdata, $method = "sha1")
    {
        if (!function_exists($method)) return false;
        $newArray = [];
        foreach ($arrdata as $key => $value) {
            array_push($newArray, (string) $value);
        }
        sort($newArray, SORT_STRING);
        return $method(implode($newArray));
    }
}