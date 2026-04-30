<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db_port = defined('DB_PORT') ? DB_PORT : 3306;

$db['default'] = array(
	'dsn'      => '',
	'hostname' => DB_HOST,
	'port'     => (int) $db_port,
	'username' => DB_USER,
	'password' => DB_PASS,
	'database' => DB_NAME,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8mb4',
	'dbcollat' => 'utf8mb4_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
