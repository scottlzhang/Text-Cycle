<?php 
session_start();
include ('db_connection.php');
$link=db_connect_inbox();

$id=$_POST["id"];
//$id=1;
$counter=0;
$unread_position=array();
$inbox="inbox_".$id;
$query="SELECT * FROM ".$inbox;
$result=db_query($query,$link);
$result=db_result_to_array($result);
foreach ($result as $row) {
	$header_read=0;
	$query_msg="SELECT * FROM `messages` WHERE `msg_id` IN (".$row["msg_ids"].")";
	$result_msg=db_query($query_msg,$link);
	$result_msg=db_result_to_array($result_msg);
	foreach ($result_msg as $msg) {
		if ($msg["read"]==0) {
			$counter++;
			$header_read=1;
		}
	}
}

echo $counter;
?>