<?php



// 配置缓存处理函数
//\WeChat\Contracts\Tools::$cache_callable = [
//    'set' => function ($name, $value, $expired = 360) {
//        var_dump(func_get_args());
//    },
//    'get' => function ($name) {
//        var_dump(func_get_args());
//    },
//    'del' => function ($name) {
//        var_dump(func_get_args());
//    },
//    'put' => function ($name) {
//        var_dump(func_get_args());
//    },
//];

return [
    'token'          => 'test',
    'appid'          => 'wx59e45029b386e6c9',
    'appsecret'      => '08a407776cfe7830d5f546184955acd5',
    'encodingaeskey' => 'BJIUzE0gqlWy0GxfPp4J1oPTBmOrNDIGPNav1YFH5Z5',
    // 配置商户支付参数
    'mch_id'         => "1332187001",
    'mch_key'        => 'A82DC5BD1F3359081049C568D8502BC5',
    // 配置商户支付双向证书目录 （p12 | key,cert 二选一，两者都配置时p12优先）
    'ssl_p12'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.p12',
    // 'ssl_key'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_key.pem',
    // 'ssl_cer'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.pem',
    // 配置缓存目录，需要拥有写权限
    'cache_path'     => '',
];