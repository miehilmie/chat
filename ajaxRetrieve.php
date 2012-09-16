<?php
	//continue loop until message received
$sleepTime = 1; //Seconds
$data = 0;
$timeout = 0;
$time = $_GET['timestamp'];
//Query database for data
while(!$data and $timeout < 30 and !connection_aborted()){
	include 'database.php';
	$sql = "SELECT * FROM `messages` WHERE UNIX_TIMESTAMP(`time_created`) > {$time}";
	$result = mysql_query($sql);
	$data = mysql_num_rows($result);
    if(!$data){
        //No new messages on the chat
        flush();
        //Wait for new Messages
        sleep($sleepTime);
        $timeout++;          
    }else{
    	$obj = new stdClass();
    	$obj->obj = array();
    	while ($row = mysql_fetch_assoc($result))
    	{
    		$obj->sql = $sql;
	    	$obj->obj[] = array("user" => $row['posted_by'], "message" => $row['message']);
    	}
	    $obj->timestamp = time();
        echo json_encode($obj);
    }
}
?>