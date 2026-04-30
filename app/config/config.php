<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$baseUrl = getenv('APP_URL');
if (!$baseUrl) {
    $scheme = 'http';
    if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
        $scheme = 'https';
    }
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    $baseUrl = $scheme.'://'.$host.'/';
}
$config['base_url'] = rtrim($baseUrl, '/').'/';
$config['index_page'] = '';
$config['uri_protocol'] = 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language'] = 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = TRUE;
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 1;
$config['log_path'] = APPPATH.'logs/';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = APPPATH.'cache/';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = ENCRYPTION_KEY;

$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'codexx3_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = sys_get_temp_dir();
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

$config['cookie_prefix'] = '';
$config['cookie_domain'] = '';
$config['cookie_path'] = '/';
$config['cookie_secure'] = FALSE;
$config['cookie_httponly'] = TRUE;
$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = TRUE;

$config['csrf_protection'] = TRUE;
$requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$csrfSkip = array('/add_funds/stripe','/add_funds/two_checkout','/add_funds/unsuccess','/add_funds/perfectmoney','add_funds/paytm/complete','add_funds/razorpay/complete','add_funds/freekassa/complete','add_funds/payumoney/complete','add_funds/paywant/complete','add_funds/mercadopago/create_payment','cashmaal_ipn','_ipn','complete','unitpay_ipn','gbprimepay_ipn','api/v1','/mail');
foreach ($csrfSkip as $needle) {
    if (stripos($requestUri, $needle) !== FALSE) {
        $config['csrf_protection'] = FALSE;
        break;
    }
}
$config['csrf_token_name'] = 'token';
$config['csrf_cookie_name'] = 'token';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = FALSE;
$config['csrf_exclude_uris'] = array();

$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
