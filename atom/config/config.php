<?php
define('DEBUG', true);
define('DEFAULT_CONTROLLER', 'Home');//default controller if there isn't one defined in the url
define('DEFAULT_LAYOUT', 'default');//if no layout is set in the controller use this layout;
define('SITE_TITLE', 'Dail MVC Framework');//if no site title is set;
define('MENU_BRAND', 'DAIL'); //Brand text in menu
define('PROOT', '/atom/'); // set this to '/' for a live server
define('DB_NAME', 'dail'); //database name
define('DB_USER', 'root');//database user
define('DB_PASSWORD', '');//database password
define('DB_HOST', '127.0.0.1');// database host use IP address
define('CURRENT_USER_SESSION_NAME', 'oKlwQcSasfREfdSDAads');//session name for logged in User
define('REMEMBER_ME_COOKIE_NAME', 'asd1QWzxc321SDsaFAS');//cookie name for logged in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 604800);//time in seconds for remember me cookie (7 days)
define('ACCESS_RESTRICTED', 'Restricted');//controller name for the restricted redirect

