<?php

require __DIR__ . '/INSTAGRAM.php';
require __DIR__ . '/config.php';

$file = __DIR__ . '/access_token.php';

if (is_file($file)) {
	require $file;
}

$insta = new INSTAGRAM($client_id, $client_secret, $redirect_uri);

$insta->setUserId($user_id);
$insta->setLongTermAccessToken($access_token);

$mtime = filemtime($file);

// 파일생성시간이 30일 이상 경과됐으면 access token refresh_access_token
if ($mtime < strtotime('-30 days', time())) {
	$insta->setUserId($user_id);
	$insta->refreshAccessToken();
	$insta->saveAccessToken(__DIR__);
}
