<?php

try {

	// 1. 手动加载入口文件
	include "../include.php";

	// 2. 准备公众号配置参数
	$config = include "./config.php";

	// 3. 创建接口实例
	$wechat = new \WeMini\SubscribeMessage($config);

	// 4. 获取用户列表
	$data['touser'] = 'o-v8Q5bCunqPXC9I2niafOP_bNAY';
	$data['template_id'] = 'L2r0lkkptysbbgBEUAbXNeyETnbA47wkz-IEROaTKws';
	$data['page'] = 'pages/index/index';
	$data['data'] = [
		'thing2' =>[
			'value'=>'活动名称活动名称'
		],
		'thing4' =>[
			'value'=>'备注信息备注信息'
		],
		'date5' =>[
			'value'=> date('Y-m-d H:i:s')
		],
	];
	$data['miniprogram_state'] = 'developer';

	$data['lang'] = 'zh_CN';
	$result = $wechat->send($data);

	echo '<pre>';
	var_export($result);

} catch (Exception $e) {

	// 出错啦，处理下吧
	echo $e->getMessage() . PHP_EOL;

}