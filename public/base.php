<?php

$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

define('APP_HOST', $http_type . $_SERVER['HTTP_HOST']);  # http://127.0.0.1:8080

define('APP_URL', substr($_SERVER['SCRIPT_NAME'], 0, -10)); # /home/wwwroot/www.test.com

define('APP_DIR', __DIR__ ); // windows: E:\home\wwwroot\api.seqier.com  linux:/home/wwwroot/api.seqier.com  //同系统ROOT_PATH

define('APP_THEME', 'senqia');

define('APP_SALT', 'd5fe8db2d5cef93ab0f895e29ba4dd70');

define('APP_PATH', __DIR__ . '/../application/');

require __DIR__ . '/../thinkphp/base.php';
