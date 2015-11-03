<?php
session_start();
$id=$_SESSION['id'];

//$id="2";
include ("db_connection.php");
$db=db_connect_inbox();

class convo{
	public $partner;
	public $partner_name;
	public $isbn;
	public $book_detail;
	public $income_msgs;
	public $outgo_msgs;
	public $dialog;
}

class message{
	public $id;
	public $body;
	public $read;
	public $time;
	public $direction;
}

class detail {
	public $isbn;
	public $title;
	public $edition;
	public $author;
}

$inbox="inbox_".$id;
$outbox="outbox_".$id;

$query_inbox_headers="SELECT * FROM `".$inbox."`";
$result_inbox_headers=db_query($query_inbox_headers,$db);
$result_inbox_headers=db_result_to_array($result_inbox_headers);

$conversation=array();
foreach ($result_inbox_headers as $row) {
	$convo=new convo();
	$convo->partner=$row["from"];
	$convo->isbn=$row["isbn"];
	//$convo->book_detail=get_book_detail($row["isbn"]);
	//get msg ids from inbox, for a conversation
	$inbox_msg_ids=$row["msg_ids"];
	//get msg ids from outbox, for a conversation
	$query_ids_outbox="SELECT `msg_ids` FROM `".$outbox."` WHERE (`to`='".$row["from"]."' AND `isbn`='".$row["isbn"]."')";
	$result_ids_outbox=db_query($query_ids_outbox,$db);
	$result_ids_outbox=db_result_to_array($result_ids_outbox);
	if (isset($result_ids_outbox[0]["msg_ids"]))
		$outbox_msg_ids=$result_ids_outbox[0]["msg_ids"];
	else
		$outbox_msg_ids="";
	//process messages
	//inbox messages
	
	$income=array();
	$query_inbox_msgs="SELECT * FROM `messages` WHERE `msg_id` IN (".$inbox_msg_ids.")";
	$result_inbox_msgs=db_query($query_inbox_msgs,$db);
	$result_inbox_msgs=db_result_to_array($result_inbox_msgs);
	foreach ($result_inbox_msgs as $row) {
		$msg=new message();
		$msg->id=$row["msg_id"];
		$msg->body=$row["message"];
		$msg->read=$row["read"];
		$msg->time=$row["time"];
		$msg->direction=0;
		array_push($income,$msg);
	}
	$convo->income_msgs=$income;
	//outbox messages
	if ($outbox_msg_ids=="")
		$outgo="";
	else {
		$outgo=array();
		$query_outbox_msgs="SELECT * FROM `messages` WHERE `msg_id` IN (".$outbox_msg_ids.")";
		$result_outbox_msgs=db_query($query_outbox_msgs,$db);
		$result_outbox_msgs=db_result_to_array($result_outbox_msgs);
		foreach ($result_outbox_msgs as $row) {
			$msg=new message();
			$msg->id=$row["msg_id"];
			$msg->body=$row["message"];
			$msg->read=$row["read"];
			$msg->time=$row["time"];
			$msg->direction=1;
			array_push($outgo,$msg);
		}
		$convo->outgo_msgs=$outgo;
	}
	
	if ($outgo=="") {
		$convo->dialog=$convo->income_msgs;
		//echo "hi";
		//echo $convo->dialog[0]->body;
		//echo $convo->income_msgs[0];
	}
	else{
	//merge sort the outgo_msgs and income_msgs
	$messages=array();
	$i1=0;//index for $income_msgs
	$i2=0;//index for $outgo_msgs
	while ($i1<count($convo->income_msgs) || $i2<count($convo->outgo_msgs)) {
		
		if ($i1>=count($convo->income_msgs)){
			array_push($messages, $convo->outgo_msgs[$i2]);
			$i2++;
		}
		else if ($i2>=count($convo->outgo_msgs)){
			array_push($messages, $convo->income_msgs[$i1]);
			$i1++;
		}
		else if ($convo->income_msgs[$i1]->id<$convo->outgo_msgs[$i2]->id) {
			array_push($messages, $convo->income_msgs[$i1]);
			$i1++;
		} else {
			array_push($messages, $convo->outgo_msgs[$i2]);
			$i2++;
		}
	}
	$convo->dialog=$messages;
	}
	
	array_push($conversation,$convo);
}

//process the sent messages that are not replied
$inbox_keys=array();
$query_inbox_key="SELECT `from`,`isbn` FROM `".$inbox."`";
$result_inbox_key=db_query($query_inbox_key,$db);
$result_inbox_key=db_result_to_array($result_inbox_key);
foreach ($result_inbox_key as $row) {
	$t=$row["from"].".".$row["isbn"];
	array_push($inbox_keys,$t);
}
$outbox_keys=array();
$query_outbox_key="SELECT `to`,`isbn` FROM `".$outbox."`";
$result_outbox_key=db_query($query_outbox_key,$db);
$result_outbox_key=db_result_to_array($result_outbox_key);
foreach ($result_outbox_key as $row) {
	$t=$row["to"].".".$row["isbn"];
	array_push($outbox_keys,$t);
}
$sent_msg_index=array_diff($outbox_keys,$inbox_keys);

//if (empty($sent_msg_index))
///	echo "null";
//else
//	print_r($sent_msg_index);

foreach ($sent_msg_index as $row) {
	$convo=new convo();
	$item=explode(".",$row);
	$convo->partner=$item[0];
	$convo->isbn=$item[1];
	//$convo->book_detail=get_book_detail($item[1]);
	$query_msg_id="SELECT `msg_ids` FROM ".$outbox." WHERE `to`='".$item[0]."' AND `isbn`='".$item[1]."'";
	$result_msg_id=db_query($query_msg_id,$db);
	$result_msg_id=db_result_to_array($result_msg_id);
	$msg_ids=$result_msg_id[0]["msg_ids"];
	$query_msgs="SELECT * FROM `messages` WHERE `msg_id` IN (".$msg_ids.")";
	$result_msgs=db_query($query_msgs,$db);
	$result_msg=db_result_to_array($result_msgs);
	$messages=array();
	foreach ($result_msg as $message) {
		$msg=new message();
		$msg->id=$message["msg_id"];
		$msg->body=$message["message"];
		$msg->read=$message["read"];
		$msg->time=$message["time"];
		$msg->direction=1;
		array_push($messages,$msg);
	}
	$convo->dialog=$messages;
	array_push($conversation, $convo);
}

mysql_close($db);

$link=db_connect();

for ($i=0; $i<count($conversation); $i++) {
	$isbn=$conversation[$i]->isbn;
	$id=$conversation[$i]->partner;
	$conversation[$i]->book_detail=get_book_detail($isbn,$link);
	$conversation[$i]->partner_name=get_partner_name($id,$link);
}

function get_book_detail($isbn,$link) {
	$query="SELECT * FROM `booklist` WHERE `isbn`='".$isbn."'";
	$result=db_query($query,$link);
	$result=db_result_to_array($result);
	$detail=new detail();
	foreach ($result as $row) {
		$detail->isbn=$isbn;
		$detail->title=$row["title"];
		$detail->edition=$row["edition"];
		$detail->author=$row["author"];
	}
	return $detail;
}

function get_partner_name($id,$link) {
	$query="SELECT `fname`,`lname` FROM `profile` WHERE `id`='".$id."'";
	$result=db_query($query,$link);
	$result=db_result_to_array($result);
	$name=$result[0]["fname"]." ".$result[0]["lname"];
	return $name;
}
?>