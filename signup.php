<?php 
	
	include ('db_connection.php');
	$db=db_connect();
	
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$email=$_POST["email"];
	$password=$_POST["pwd"];
	
	$query_check="SELECT email FROM profile WHERE email='".mysql_real_escape_string($email)."'";
	$result=db_query($query_check,$db);
	
	if (mysql_num_rows($result) == 1) {
		
	} else {
		
		$query_new="INSERT INTO `textcycle`.`profile` (`id`, `email`, `password`, `fname`, `lname`, `picture`, `havelist`, `needlist`) VALUES (NULL, '".$email."', '".$password."', '".$fname."', '".$lname."', '', '', '')";
		$result=db_query($query_new, $db);
		if(!$result) {
			echo("<p>Error performing query: " . mysql_error() . "</p>");
			exit();
		} else {
			echo ("<script> opener.location.reload(); self.close();</script>");
		}
		
	}
	
?>