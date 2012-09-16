<?php 
include_once 'config.php';

mysql_connect(Config::$db['host'], Config::$db['user'], Config::$db['pass']);
mysql_select_db(Config::$db['database']);
?>