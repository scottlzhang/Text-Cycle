<?php

session_start();
include ('db_connection.php');
$email=$_POST["username"];
$password=$_POST["password"];
//$password=md5($_POST["password"]);

$db=db_connect();

//$result = mysql_query("SELECT * FROM profiles WHERE (email = '" . mysql_real_escape_string($email) . "') and (password = '" . mysql_real_escape_string($password) . "')",$db);

$query="SELECT * FROM profile WHERE (email = '" . mysql_real_escape_string($email) . "') and (password = '" . mysql_real_escape_string($password) . "')";

$result=db_query($query,$db);

if (mysql_num_rows($result) == 1) {

	$array = mysql_fetch_array($result);
	
	$_SESSION['id'] = $array['id'];
	$_SESSION['email'] = $array['email'];
	$_SESSION['fname'] = $array['fname'];
	$_SESSION['lname'] = $array['lname'];
	$_SESSION['picture'] = $array['picture'];
	
	echo 'true';
	//header('Location: userProfile.php');
}
else{
	echo 'false';
	///header('Location: invalid_login.html');

} 

?>
