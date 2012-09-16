<?php
define('BASE_PATH', dirname(__FILE__).'/');
include_once BASE_PATH.'config.php';
session_start();
session_unset();
session_destroy();
setcookie('u', '', time() - 1);
setcookie('p', '', time() - 1);
header('location: '.Config::$baseurl);
?>
