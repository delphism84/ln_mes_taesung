<?php
/**
 * DB 상수 정의만 수행 (비밀은 config/db.secret.php 또는 MES_DB_* 환경 변수).
 * 웹에서 /config/ 직접 요청은 .htaccess / nginx 로 차단할 것.
 */
if (defined('DB_HOST')) {
	return;
}

$secretPath = __DIR__ . '/db.secret.php';
if (is_readable($secretPath)) {
	$c = require $secretPath;
	if (!is_array($c)) {
		die('Invalid config/db.secret.php (must return array)');
	}
} else {
	$c = array(
		'host' => getenv('MES_DB_HOST') ? getenv('MES_DB_HOST') : '',
		'name' => getenv('MES_DB_NAME') ? getenv('MES_DB_NAME') : '',
		'user' => getenv('MES_DB_USER') ? getenv('MES_DB_USER') : '',
		'password' => getenv('MES_DB_PASSWORD') ? getenv('MES_DB_PASSWORD') : '',
	);
}

foreach (array('host' => 'DB_HOST', 'name' => 'DB_NAME', 'user' => 'DB_USER', 'password' => 'DB_PASSWORD') as $k => $const) {
	$v = isset($c[$k]) ? $c[$k] : '';
	if ($v === '' || $v === false || $v === null) {
		die('DB not configured: add config/db.secret.php (see db.secret.example.php) or set MES_DB_HOST, MES_DB_NAME, MES_DB_USER, MES_DB_PASSWORD');
	}
	define($const, $v);
}
