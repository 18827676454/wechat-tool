<?php

try {

	// 1. 手动加载入口文件
	include "../include.php";

	// 2. 准备公众号配置参数
	$config = include "./config.php";

	// 3. 创建接口实例
	$wechat = new \WeMini\SubscribeMessage($config);

	// 4. 获取用户列表
	$result = $wechat->getTemplateList();

	echo '<pre>';
	var_export($result);

} catch (Exception $e) {

	// 出错啦，处理下吧
	echo $e->getMessage() . PHP_EOL;

}