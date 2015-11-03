<?php

 session_start();
 include ('db_connection.php');
 
 $db = db_connect();


 $fname = $_POST["fname"];
 $lname = $_POST["lname"];
 $email = $_POST["email"];
 $pwd   = $_POST["pswd"];
 
 /*
 if($_FILES["file"]["error"] > 0){
	//echo "Error: ".$_FILES["file"]["error"]. "<br/>" ;
	$pic = "../upload/silhouette.png";

}
else
  {
 //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  //echo "Type: " . $_FILES["file"]["type"] . "<br />";
  //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  //echo "Stored in: " . $_FILES["file"]["tmp_name"];
  
  $pic = "../upload/" . $_FILES["file"]["name"];
 
 if(file_exists("../upload/". $_FILES["file"]["name"])){
	 //echo $pic . "already exists";
 }
 else{
	move_uploaded_file($_FILES["file"]["tmp_name"],$pic );
	//echo "File uploaded!!! YES!!!";
 }
	
	
 }*/
  

$sql_insert = "INSERT INTO `profile` (fname, lname, email, password)
VALUES
('".mysql_real_escape_string($fname)."','".mysql_real_escape_string($lname)."
	','".mysql_real_escape_string($email)."','".mysql_real_escape_string($pwd)."')";

$valid = db_query($sql_insert, $db);

$id = mysql_insert_id();

mysql_close($db);
$inbox = inbox_select();


$sql_inbox = "CREATE TABLE inbox_".$id." (`from` int, `msg_ids` varchar(500), `isbn` varchar(30))";
$valid = db_query($sql_inbox, $inbox);

$sql_outbox = "CREATE TABLE outbox_".$id." (`from` int, `msg_ids` varchar(500), `isbn` varchar(30))";
$valid = db_query($sql_outbox, $inbox);

$_SESSION['email'] = $email;
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['picture'] = "empty";
$_SESSION['id'] = $id;

mysql_close($inbox);

	//header('Location: userProfile.php');

	
/*	

if(!mysql_query($sql,$db)) {
	echo "<br/>";
	die ('Error: '.mysql_error());
}

else{
*/

	
	//header('Location: userProfile.php');
//}
?>

