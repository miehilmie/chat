<?php
session_start();
define('BASE_PATH', dirname(__FILE__).'/');

include_once BASE_PATH.'database.php';
include_once BASE_PATH.'tool/string.php';

if(isset($_SESSION['logged_in'])) {
	$user = $_SESSION['user'];
	$message = res($_POST['message']);
	$message = htmlentities($message);
	$result = mysql_query("INSERT INTO `messages`(`message`, `posted_by`) VALUES ('$message', '$user')");
	die();
}
?>