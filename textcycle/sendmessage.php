<?php 
session_start();
include ('db_connection.php');
$link=db_connect_inbox();

$receiver_id=$_POST["id"];
$sender_id=$_SESSION['id'];
$isbn=$_POST["isbn"];
$message=addslashes($_POST["message"]);
$time= date("m/d/y H:i:s",time());

$query_msg="INSERT INTO `messages` (`msg_id`, `message`, `read`, `time`) VALUES (NULL, '".$message."', '0', '".$time."');";
$result=mysql_query($query_msg,$link);
$msg_id=mysql_insert_id();
if(!$result) {
	echo("<p>Error performing query: " . mysql_error() . "</p>");
	exit();
}

$inbox="inbox_".$receiver_id;
$outbox="outbox_".$sender_id;

//------start process the receiver's inbox
$query_inbox_msg_ids="SELECT `msg_ids` FROM `".$inbox."` WHERE `from`='".$sender_id."' AND `isbn`='".$isbn."'";
$result_inbox_msg_ids=db_query($query_inbox_msg_ids,$link);
$result_inbox_msg_ids=db_result_to_array($result_inbox_msg_ids);

if (isset($result_inbox_msg_ids[0]["msg_ids"])) {
	//update new msg_ids if the record exists
	$msg_ids=$result_inbox_msg_ids[0]["msg_ids"];
	$msg_ids.=",".$msg_id;
	$query_update_inbox_msg_ids="UPDATE `".$inbox."` SET `msg_ids`='".$msg_ids."' WHERE `from`='".$sender_id."' AND `isbn`='".$isbn."'";
	$result=mysql_query($query_update_inbox_msg_ids,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>");
		exit();
	}
} else {
	//if it's first time conversation, create record
	$query_create_msg="INSERT INTO `".$inbox."` (`from`, `msg_ids`, `isbn`) VALUES ('".$sender_id."', '".$msg_id."', '".$isbn."')";
	$result=mysql_query($query_create_msg,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>");
		exit();
	}
}
//------end process the receiver's inbox

//------start process sender's outbox
$query_outbox_msg_ids="SELECT `msg_ids` FROM `".$outbox."` WHERE `to`='".$receiver_id."' AND `isbn`='".$isbn."'";
$result_outbox_msg_ids=db_query($query_outbox_msg_ids,$link);
$result_outbox_msg_ids=db_result_to_array($result_outbox_msg_ids);

if (isset($result_outbox_msg_ids[0]["msg_ids"])) {
	//update new msg_ids if the record exists
	$msg_ids=$result_outbox_msg_ids[0]["msg_ids"];
	$msg_ids.=",".$msg_id;
	$query_update_outbox_msg_ids="UPDATE `".$outbox."` SET `msg_ids`='".$msg_ids."' WHERE `to`='".$receiver_id."' AND `isbn`='".$isbn."'";
	$result=mysql_query($query_update_outbox_msg_ids,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>");
		exit();
	}
} else {
	//if it's first time conversation, create record
	$query_create_msg="INSERT INTO `".$outbox."` (`to`, `msg_ids`, `isbn`) VALUES ('".$receiver_id."', '".$msg_id."', '".$isbn."')";
	$result=mysql_query($query_create_msg,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>");
		exit();
	}
}
//------end process sender's outbox
echo 'true';
?>