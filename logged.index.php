<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
	<title>Chat</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery.js"></script>	
	<script type="text/javascript" src="js/jquery-longpoll.js"></script>	
</head>
<body>
<div id="toppanel"><span>Welcome <?php echo $_SESSION['user']; ?>!</span><a href="logout.php">Logout</a></div>
<!-- Display -->
<div id="content">
	<div id="postArea">
		<!-- Post -->
		<form id="postChat">
			<label>Messages</label>
			<input style="width:350px" type="text" maxlength="255" id="iMessage" name="message" />
			<input type="submit" value="post message" />
		</form>
	</div>
	<div id="chatArea"></div>

</div>
<div id="onlineuser"></div>

</body>
</html>
