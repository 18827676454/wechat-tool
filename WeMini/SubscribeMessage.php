<?php
/*
 +----------------------------------------------------------------------
 + Title        : SubscribeMessage 控制器
 + Author       : Randy_chen
 + Version      : V1.0.0.1
 + Initial-Time : 2020/7/24 15:30
 + Last-time    : 2020/7/24 15:30+ 86187
 + Desc         : SubscribeMessage
 +----------------------------------------------------------------------
*/
declare(strict_types=1);

namespace WeMini;


use WeChat\Contracts\BasicWeChat;
use WeChat\Exceptions\InvalidResponseException;
use WeChat\Exceptions\LocalCacheException;

class SubscribeMessage extends BasicWeChat {
	/**
	 * 组合模板并添加至帐号下的个人模板库
	 *
	 * @param array $data
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:07
	 */
	public function addTemplate(array $data) {
		$url = 'https://api.weixin.qq.com/wxaapi/newtmpl/addtemplate?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true, true);
	}

	/**
	 * 删除帐号下的个人模板
	 *
	 * @param array $data
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:07
	 */
	public function delTemplate(array $data) {
		$url = 'https://api.weixin.qq.com/wxaapi/newtmpl/deltemplate?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true, true);
	}

	/**
	 * 获取小程序账号的类目
	 *
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:07
	 */
	public function getCategory() {
		$url = 'https://api.weixin.qq.com/wxaapi/newtmpl/getcategory?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callGetApi($url);
	}

	/**
	 * 获取模板标题下的关键词列表
	 *
	 * @param string $tid
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:07
	 */
	public function getPubTemplateKeyWordsById(string $tid) {
		$url = "https://api.weixin.qq.com/wxaapi/newtmpl/getpubtemplatekeywords?tid={$tid}&access_token=ACCESS_TOKEN";
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callGetApi($url);
	}

	/**
	 * 获取帐号所属类目下的公共模板标题
	 *
	 * @param string $ids
	 * @param int    $start
	 * @param int    $end
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:07
	 */
	public function getPubTemplateTitleList(string $ids, int $start, int $end) {
		$url = "https://api.weixin.qq.com/wxaapi/newtmpl/getpubtemplatetitles?ids={$ids}&start={$start}&end={$end}&access_token=ACCESS_TOKEN";
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callGetApi($url);
	}

	/**
	 * 获取当前帐号下的个人模板列表
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"errcode":0,"errmsg":"ok","data":[{"priTmplId":"9Aw5ZV1j9xdWTFEkqCpZ7mIBbSC34khK55OtzUPl0rU","title":"报名结果通知","content":"会议时间:{{date2.DATA}}\n会议地点:{{thing1.DATA}}\n","example":"会议时间:2016年8月8日\n会议地点:TIT会议室\n","type":2}]}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:07
	 */
	public function getTemplateList() {
		$url = 'https://api.weixin.qq.com/wxaapi/newtmpl/gettemplate?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callGetApi($url);
	}


	/**
	 * 发送订阅消息
	 *
	 * @param array $data
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"touser":"OPENID","template_id":"TEMPLATE_ID","page":"index","miniprogram_state":"developer","lang":"zh_CN","data":{"number01":{"value":"339208499"},"date01":{"value":"2015年01月05日"},"site01":{"value":"TIT创意园"},"site02":{"value":"广州市新港中路397号"}}}
	 * @example
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:07
	 */
	public function send(array $data) {
		$url = 'https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

}