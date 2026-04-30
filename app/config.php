<?php

$mysqlUrl = getenv('MYSQL_URL');

if ($mysqlUrl) {
    $db = parse_url($mysqlUrl);

    define('DB_HOST', $db['host'] ?? getenv('MYSQLHOST') ?: '127.0.0.1');
    define('DB_USER', $db['user'] ?? getenv('MYSQLUSER') ?: 'root');
    define('DB_PASS', isset($db['pass']) ? urldecode($db['pass']) : (getenv('MYSQLPASSWORD') ?: ''));
    define('DB_NAME', isset($db['path']) ? ltrim($db['path'], '/') : (getenv('MYSQLDATABASE') ?: 'railway'));
    define('DB_PORT', $db['port'] ?? getenv('MYSQLPORT') ?: 3306);
} else {
    define('DB_HOST', getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: '127.0.0.1');
    define('DB_USER', getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: getenv('MYSQLPASSWORD') ?: '');
    define('DB_NAME', getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'railway');
    define('DB_PORT', getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: 3306);
}

define('TIMEZONE', getenv('TIMEZONE') ?: 'America/El_Salvador');
define('ENCRYPTION_KEY', getenv('ENCRYPTION_KEY') ?: '202dd507882ef55dbbc23f7e84dcfc8d');
