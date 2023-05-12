<?php

session_start();
define('BASE_PATH', __DIR__);
define('CURRENT_DOMAIN', currentDomain() . '/News');
define('DISPLAY_ERROR', true);
define('DB_HOST', 'localhost');
define('DB_NAME', 'project');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

?>