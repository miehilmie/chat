<?php 
function res($string)
{
	if(get_magic_quotes_gpc() == true) {
		stripslashes($string);
	}
	return mysql_real_escape_string($string);
}
?>