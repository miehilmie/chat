<?php
define('BASE_PATH', dirname(__FILE__).'/');

session_start();
include_once BASE_PATH.'tool/crypto.php';
include_once BASE_PATH.'tool/string.php';
include_once BASE_PATH.'database.php';
if(isset($_POST['username'], $_POST['password']) ||
	isset($_COOKIE['u'], $_COOKIE['p'])) {

	if(isset($_COOKIE['u'], $_COOKIE['p'])) {
		$username = $_COOKIE['u'];
		$password = $_COOKIE['p'];
	}else{
		$username = res($_POST['username']);
		$password = crypt_pass($_POST['password']);
	}

	$result = mysql_query("SELECT COUNT(*) FROM `user` WHERE `username`='$username' AND `password`='$password'");
	$count = mysql_result($result,0);
	mysql_close();

	if($count == 1) {
		setcookie('u', $username, time() + 6000000);
		setcookie('p', $password, time() + 6000000);
		$_SESSION['user'] = $username;
		$_SESSION['logged_in'] = 1;
	}
}

if(isset($_SESSION['logged_in'])) {
	include_once 'logged.index.php';
}
else
{
	include_once 'n_logged.index.php';
}
?>
