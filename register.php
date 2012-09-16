<?php 
define('BASE_PATH', dirname(__FILE__).'/');

include_once 'database.php';
include_once 'tool/string.php';
include_once 'tool/crypto.php';
$errormsg = array();
if(isset($_POST['register'])) {
	if($_POST['password'] != $_POST['repassword']) {
		$errormsg[] = 'Password and re-enter must the same';
	}
	if(strlen($_POST['username']) < 5) {
		$errormsg[] = 'Minimum character for username is 5 characters';
	}
	if(strlen($_POST['password']) < 5) {
		$errormsg[] = 'Minimum character for password is 5 characters';
	}

	if(empty($errormsg))
	{
		$username = res($_POST['username']);
		$password = res($_POST['password']);
		$password = crypt_pass($password);
		$sql = "INSERT INTO `user` (`username`, `password`) VALUES ('{$username}','{$password}')";
		$result = mysql_query($sql);
		if(!$result)
		{
			$errormsg[] = "Cannot insert to database. Username may already exist!";
		}
		else
		{
			$errormsg[]	= "Registration successful";
		}
	}
}
?>
<!doctype html>
<html>
<head>
	<title>Register an account!</title>
	<style>
	#content {
		text-align: center;
	}
	</style>
</head>
<body>
<div id="content">
<span class="errormsg">
<?php 
foreach ($errormsg as $key) {
	echo $key . '<br />';
}
?></span>

<form method="post" action="register.php">
<label>Username:</label><input type="text" maxlength="50" name="username" /><br />
<label>Password:</label><input type="password" name="password" /><br />
<label>Re-Password:</label><input type="password" name="repassword" /><br />
<input type="submit" value="register" name="register">
</form>
<a href="<?php echo Config::$baseurl; ?>">Back to Index</a>
</div>
</body>
</html>
