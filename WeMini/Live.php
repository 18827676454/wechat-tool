<?php
/*
 +----------------------------------------------------------------------
 + Title        : Live 控制器
 + Author       : Randy_chen
 + Version      : V1.0.0.1
 + Initial-Time : 2020/5/27 13:05
 + Last-time    : 2020/5/27 13:05+ 86187
 + Desc         : Live
 +----------------------------------------------------------------------
*/
declare(strict_types=1);


namespace WeMini;


use WeChat\Contracts\BasicWeChat;
use WeChat\Contracts\Tools;
use WeChat\Exceptions\InvalidResponseException;
use WeChat\Exceptions\LocalCacheException;

class Live extends BasicWeChat {
//
	/**
	 * 获取直播间列表
	 *
	 * @param int $start 起始拉取房间，start = 0 表示从第 1 个房间开始拉取
	 * @param int $limit 每次拉取的个数上限，不要设置过大，建议 100 以内
	 *
	 * @return array|bool|mixed|string
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:07
	 */
	public function getLiveInfo(int $start = 0, int $limit = 10) {
		$url = 'https://api.weixin.qq.com/wxa/business/getliveinfo?access_token=ACCESS_TOKEN';
		$data = [
			'start' => $start,
			'limit' => $limit
		];
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 * 获取回放源视频
	 *
	 * @param string $action  获取回放
	 * @param int    $room_id 直播间   id
	 * @param int    $start   起始拉取视频，start =   0   表示从第    1   个视频片段开始拉取
	 * @param int    $limit   每次拉取的个数上限，不要设置过大，建议  100 以内
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:16
	 */
	public function getPlayback(int $room_id, int $start, int $limit, string $action = 'get_replay') {
		$url = 'https://api.weixin.qq.com/wxa/business/getliveinfo?access_token=ACCESS_TOKEN';
		$data = [
			'action'  => $action,
			'room_id' => $room_id,
			'start'   => $start,
			'limit'   => $limit
		];
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example
	 * {
	 * "name" : "测试直播间" //房间名字
	 * "coverImg": "xxxxxx" //填写mediaID，直播间背景图，图片规则：建议像素800*640，大小不超过1M，mediaID获取参考：https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/New_temporary_materials.html）
	 * "startTime": 1588237130 // 直播计划开始时间，1.开播时间需在当前时间10min后，2.开始时间不能在6个月后
	 * "endTime": 1588237130  //直播计划结束时间，1.开播时间和结束时间间隔不得短于30min，不得超过24小时
	 * "anchorName": "test1" // 主播昵称
	 * "anchorWechat":"test1" //主播微信号，需通过实名认证，否则将报错
	 * "anchorImg":"xxx" //填写mediaID，直播间分享图，图片规则：建议像素1080*1920，大小不超过2M，mediaID获取参考：https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/New_temporary_materials.html）
	 * "type":1 //直播类型，1：推流，0：手机直播
	 * "screenType":0 //1：横屏，0：竖屏，自动根据实际视频分辨率调整
	 * "closeLike":0 //1：关闭点赞 0：开启点赞 ，关闭后无法开启
	 * "closeGoods":0 //1：关闭货架 0：打开货架，关闭后无法开启
	 * "closeComment":0 //1：关闭评论 0：打开评论，关闭后无法开启
	 * }
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:20
	 */
	public function create($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/room/create?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true, true);
	}
}