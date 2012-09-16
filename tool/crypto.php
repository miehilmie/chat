<?php 
include_once BASE_PATH.'config.php';
function crypt_pass($pass)
{
	return sha1(Config::$salted.$pass);
}
?>