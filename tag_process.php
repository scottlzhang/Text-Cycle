<?php 
session_start();
include ('db_connection.php');
$link=db_connect_inbox();
$partner=$_POST["partner"];
$isbn=$_POST["isbn"];
$sender_id=$_SESSION['id'];

$inbox="inbox_".$sender_id;
$query_msg_ids="SELECT `msg_ids` FROM ".$inbox." WHERE (`from`='".$partner."' AND `isbn`='".$isbn."')";
$result_msg_ids=db_query($query_msg_ids,$link);
$result_msg_ids=db_result_to_array($result_msg_ids);
$msg_ids=$result_msg_ids[0]["msg_ids"];

$query="UPDATE `messages` SET `read`=1 WHERE `msg_id` IN (".$msg_ids.")";
$result=db_query($query,$link);
if(!$result) {
	echo("<p>Error performing query: " . mysql_error() . "</p>");
	exit();
}

echo "true";

?>