<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db_port = defined('DB_PORT') ? DB_PORT : 3306;
$dsn = 'mysql:host='.DB_HOST.';port='.(int) $db_port.';dbname='.DB_NAME.';charset=utf8mb4';

$db['default'] = array(
    'dsn'      => $dsn,
    'hostname' => DB_HOST,
    'port'     => (int) $db_port,
    'username' => DB_USER,
    'password' => DB_PASS,
    'database' => DB_NAME,
    'dbdriver' => 'pdo',
    'subdriver' => 'mysql',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'save_queries' => TRUE
);
