<?php 
class messageObject {
	private $user;
	private $friend;
	private $messages_array;
	
	public function getuser() {
		return $this->user;
	}
	public function getfriend() {
		return $this->friend;
	}
	public function getmessages_array() {
		return $this->messages_array;
	}
	
	public function setuser($a) {
		$this->user=$a;
	}
	public function setfriend($a) {
		$this->friend=$a;
	}
	public function setmessages_array($a) {
		$this->messages_array=$a;
	}

}

class person {
	private $fname;
	private $lname;
	private $id;

	public function getfname() {
		return $this->fname;
	}
	public function getlname() {
		return $this->lname;
	}
	public function getid() {
		return $this->id;
	}	
	public function setfname($a) {
		$this->fname = $a;
	}
	public function setlname($a) {
		$this->lname = $a;
	}
	public function setid($a) {
		$this->id = $a;
	}
}

class message{
	private $msg_body;
	private $timestamp;
	private $isbn;
	
	public function getmsg_body() {
		return $this->msg_body;
	}
	public function getmsgtime() {
		return $this->timestamp;
	}
	public function getisbn() {
		return $this->isbn;
	}
	public function setmsg_body($a) {
		$this->msg_body = $a;
	}
	
	public function settimestamp($a) {
		$this->timestamp = $a;
	}
	
	public function setisbn($a) {
		$this->isbn = $a;
	}
	
	public function gettitle() {
	$db=db_connect();
	$msg_select_query = "SELECT title FROM `booklist` WHERE `isbn` =".$this->getisbn();
	$result = db_query($msg_select_query, $db);
	$result = db_result_to_array($result);	
	
	return $result[0]["title"];
	
	}
		
}

//Retrieve messages

$msg_select_query = "SELECT DISTINCT `isbn` FROM `inbox` WHERE `from` ='".$id."'";
$result = db_query($msg_select_query, $db);
$result = db_result_to_array($result);  

$MessagesArray = array();
$count = 0;

foreach($result as $row){
	
	$msg_select_query = "SELECT DISTINCT  `to` FROM `inbox` WHERE (`from` ='".$id."')and(`isbn` = '".$row["isbn"]."')";
	$stage1 = db_query($msg_select_query, $db);
	$stage1 = db_result_to_array($stage1);

if(stage1){

	foreach($stage1 as $sameisbn){
	//echo "from: ".$id."to: ".$sameisbn["to"]."for isbn: ".$row["isbn"];

		$msg_select_query = "SELECT * FROM `inbox` WHERE (`from` ='".$id."')and (`to` = '".$sameisbn["to"]."') 
		and (`isbn` = '".$row["isbn"]."')";

		$distinct = db_query($msg_select_query, $db);
		$distinct = db_result_to_array($distinct);	

		$user = new person();
		$user->setid($id);
		$user->setfname($fname);
		$user->setlname($lname);
		
		$msgObj = new messageObject();
		$msgObj->setuser($user);
	
		$msg_select_query = "SELECT * FROM `profile` WHERE `id` ='".$sameisbn["to"]."'";
		$result = db_query($msg_select_query, $db);
		$result = db_result_to_array($result);
	
		$friend = new person();
		$friend->setid($row);
		$friend->setfname($result[0]["fname"]);
		$friend->setlname($result[0]["lname"]);
	
		$msgObj->setfriend($friend);
		
		//echo "User: ".$user->getfname()." Friend: ".$friend->getfname();
		
		$msg_array = array();
		$index = 0;
if($distinct){
	foreach($distinct as $msgItem){
		$message = new message();
		$message->setmsg_body($msgItem["message"]);
		$message->settimestamp($msgItem["time"]);
		$message->setisbn($msgItem["isbn"]);
		
		array_push($msg_array,$message);
		//$msg_array[$index] =  $message;
		$index++;
		//$temp = $msg_array[0];		
		//echo " Messages: ".$temp->getmsg_body();

		//echo " Messages: ".$message->getmsg_body();

	}
}
		$msg_select_query = "SELECT * FROM `inbox` WHERE (`from` ='".$id."')and (`to` = '".$sameisbn."') 
		and (`isbn` = '".$row."')";
		$distinct = db_query($msg_select_query, $db);
		$distinct = db_result_to_array($distinct);	
		
if($distinct){
	foreach($distinct as $msgItem){
		$message = new message();
		$message->setmsg_body($msgItem["message"]);
		$message->settimestamp($msgItem["time"]);
		$message->setisbn($msgItem["isbn"]);
		
		array_push($msg_array,$message);
		//$msg_array[$index] =  $message;
		$index++;
		//$temp = $msg_array[0];		
		//echo " Messages: ".$temp->getmsg_body();

		//echo " Messages: ".$message->getmsg_body();

	}
}
	$msgObj->setmessages_array($msg_array);
	$MessagesArray[$count] = $msgObj;
	
	$count++;

	}
 }
}
/*
	$msgObj = $MessagesArray[0];
	$friend = $msgObj->getfriend();
	$user = $msgObj->getuser();
	$msg = $msgObj->getmessages_array();

	echo "From: ".$user->getfname()." To: ".$friend->getfname()." BookIsbn: ".$msg[1]->getisbn().
	"Title: ".$msg[1]->gettitle(). " Message: ".$msg[1]->getmsg_body();
/*

	$user = new person();
	$user->setid($id);
	$user->setfname($fname);
	$user->setlname($lname);
	
	$msgObj = new messageObject();
	$msgObj->setuser($user);
	
	$msg_select_query = "SELECT * FROM `profile` WHERE `id` ='".$row["to"]."'";
	$result = db_query($msg_select_query, $db);
	$result = db_result_to_array($result);
	
	$friend = new person();
	$friend->setid($row);
	$friend->setfname($result[0]["fname"]);
	$friend->setlname($result[0]["lname"]);
	
	$msgObj->setfriend($friend);
	

	echo "From: ".$user->getfname()." To: ".$friend->getfname();

	
	$msg_select_query = "SELECT * FROM `inbox` WHERE (`from` ='".$row["to"]."') and (`to` ='".$id."')";
	$result = db_query($msg_select_query, $db);
	$result = db_result_to_array($result);
	
	$msg_array = array();
	$index = 0;
if($result){
	foreach($result as $msgItem){
		$message = new message();
		$message->setmsg_body($msgItem["message"]);
		$message->settimestamp($msgItem["time"]);
		$message->setisbn($msgItem["isbn"]);
		
		array_push($msg_array,$message);
		$msg_array[$index] =  $message;
		$index++;
		$temp = $msg_array[0];		
		echo " Messages: ".$temp->getmsg_body();

		echo " Messages: ".$message->getmsg_body();

	}
}
	
	
	$msg_select_query = "SELECT * FROM `inbox` WHERE (`from` ='".$id."') and (`to` ='".$row["to"]."')";
	$result = db_query($msg_select_query, $db);
	$result = db_result_to_array($result);
	
if($result){
	foreach($result as $msgItem){
		$message = new message();
		$message->setmsg_body($msgItem["message"]);
		$message->settimestamp($msgItem["time"]);
		$message->setisbn($msgItem["isbn"]);

		array_push($msg_array,$message);
		$msg_array[$index] =  $message;
		$index++;
		$temp = $msg_array[1];		
	}
}

echo " Messages: ".$message->getmsg_body();
	
	friend = $msgObj->getfriend();
	$user = $msgObj->getuser();
	$msgObj->getmessages_array();
	$msg = $msg_array[0];

	$msgObj->setmessages_array($msg_array);
	$MessagesArray[$count] = $msgObj;
	
	$count++;
}
	
	$msgObj = $MessagesArray[0];
	$friend = $msgObj->getfriend();
	$user = $msgObj->getuser();
	$msg = $msgObj->getmessages_array();

	$i = 0;
	$temp = $msg[i];
	$temp->setmsg_body("bla bla bla");
	echo "From: ".$user->getfname()." To: ".$friend->getfname()." Message: ".$msg[0]->getisbn().
	"Title: ".$msg[0]->gettitle();*/