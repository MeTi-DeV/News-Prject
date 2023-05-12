<?php

session_start();
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/News');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'project');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
// helpers
function protocol()
{
    return stripos(
        $_SERVER['SERVER_PROTOCOL'],
        'https'
    ) === true ? 'https://' : 'http://';
}
exit;
function currentDomain()
{
    return protocol() . $_SERVER['HTTP_HOST'];
}
function asset($src)
{
    $domain = trim(CURRENT_DOMAIN, '/');
    $src = $domain . '/' . trim($src . '/');
    return $src;
}
function url($url)
{
    $domain = trim(CURRENT_DOMAIN, '/');
    $url = $domain . '/' . trim($url . '/');
    return $url;
}
function currentUrl()
{
    return currentDomain() . $_SERVER['REQUEST_URI'];
}
?>