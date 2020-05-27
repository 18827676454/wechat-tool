<?php
/*
 +----------------------------------------------------------------------
 + Title        : Goods 控制器
 + Author       : Randy_chen
 + Version      : V1.0.0.1
 + Initial-Time : 2020/5/27 13:22
 + Last-time    : 2020/5/27 13:22+ 86187
 + Desc         : Goods
 +----------------------------------------------------------------------
*/


namespace WeMini;


use WeChat\Contracts\BasicWeChat;
use WeChat\Exceptions\InvalidResponseException;
use WeChat\Exceptions\LocalCacheException;

class Goods extends BasicWeChat {

//-1：系统错误
//1003：商品id不存在
//47001：入参格式不符合规范
//200002:入参错误
//300001：禁止创建/更新商品（如：商品创建功能被封禁）
//300002：名称长度不符合规则
//300003：价格输入不合规（如：现价比原价大、传入价格非数字等）
//300004：商品名称存在违规违法内容
//300005：商品图片存在违规违法内容
//300006：图片上传失败（如：mediaID过期）
//300007：线上小程序版本不存在该链接
//300008：添加商品失败
//300009：商品审核撤回失败
//300010：商品审核状态不对（如：商品审核中）
//300011：操作非法（API不允许操作非API创建的商品）
//300012：没有提审额度（每天500次提审额度）
//300013：提审失败
//300014：审核中，无法删除（非零代表失败）
//300017：商品未提审
//300021：商品添加成功，提审失败
//300022：此房间号不存在
//300024：商品不存在
//300025：商品审核未通过
//300026：房间商品数量已经满额
//300027：导入商品失败

	/**
	 * 商品添加并提审
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"goodsInfo":{"coverImgUrl":"ZuYVNKk9sMP1X4m7FXdcDCKra251KDZTjS502UTV7gwalgLZXcrOhG6oNYX6c7AR","name":"TIT茶杯","priceType":1,"price":"111","price2":"","url":"pages/index/index"}}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:23
	 */
	public function add($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/add?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 *撤回审核
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example  {"auditId":525022184,"goodsId":9}
	 * @author   : Randy_chen
	 * @Date     : 2020/5/27
	 * @Time     : 13:24
	 */
	public function resetAudit($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/resetaudit?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 *重新提交审核
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"goodsId":9}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:27
	 */
	public function audit($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/audit?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 * 删除商品 调用此接口，可删除【小程序直播】商品库中的商品，删除后直播间上架的该商品也将被同步删除，不可恢复；
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"goodsId":9}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:28
	 */
	public function delete($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/delete?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 * 更新商品  调用此接口可以更新商品信息，审核通过的商品仅允许更新价格类型与价格，审核中的商品不允许更新，未审核的商品允许更新所有字段， 只传入需要更新的字段。
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"goodsInfo":{//需要更新哪个字段就传入哪个字段，goodsId必传"coverImgUrl":"ZuYVNKk9sMP1X4m7FXdcDCKra251KDZTjS502UTV7gwalgLZXcrOhG6oNYX6c7AR","name":"TIT茶杯","priceType":1,"price":"1111","price2":"","url":"pages/index/index","goodsId":9}}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:29
	 */
	public function update($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/update?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 * 获取商品状态
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"goods_ids":[1]}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:31
	 */
	public function getGoodsWareHouse($data) {
		$url = 'https://api.weixin.qq.com/wxa/business/getgoodswarehouse?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 * 获取商品列表
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @author : Randy_chen
	 * @Date   : 2020/5/27
	 * @Time   : 13:33
	 */
	public function getAppRoved($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/getapproved?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}

	/**
	 * 往指定直播间导入已入库商品
	 *
	 * @param $data
	 *
	 * @return array
	 * @throws InvalidResponseException
	 * @throws LocalCacheException
	 * @example {"ids":[9,11],"roomId":223}
	 * @author  : Randy_chen
	 * @Date    : 2020/5/27
	 * @Time    : 13:34
	 */
	public function addGoods($data) {
		$url = 'https://api.weixin.qq.com/wxaapi/broadcast/room/addgoods?access_token=ACCESS_TOKEN';
		$this->registerApi($url, __FUNCTION__, func_get_args());
		return $this->callPostApi($url, $data, true);
	}
}