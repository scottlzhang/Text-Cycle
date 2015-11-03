<?php
include ('db_connection.php');
$link=db_connect();

$button=$_POST["button"];
$id=$_POST["id"];
$type=$_POST["officerType"];
$pin=$_POST["officerPIN"];
$name=$_POST["officerName"];
$status=$_POST["officerStatus"];

if ($button=="Delete Officer") {
	$query="DELETE FROM `Officer` WHERE `Officer_ID`='".$id."'";
	$result=mysql_query($query,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>"); 
		exit();
	} else {
		echo ("<script> opener.location.reload(); self.close();</script>");
	}
} else if($button=="Save") {
	$query="UPDATE `Officer` SET `OfficerType`='".$type."', `Officer_PIN`='".$pin."', `Officer_Name`='".$name."', `OfficerStatusFlag`='".$status."' WHERE `Officer_ID`='".$id."'";
	$result=mysql_query($query,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>"); 
		exit();
	} else {
		echo ("<script> opener.location.reload(); self.close();</script>");
	}
} else if ($button=="Add") {
	$query="INSERT INTO `Officer` (`Officer_ID`, `OfficerType`, `Officer_PIN`, `Officer_Name`, `OfficerStatusFlag`) VALUES ('".$id."', '".$type."', '".$pin."', '".$name."', '1')";
	
	$result=mysql_query($query,$link);
	if(!$result) {
		echo("<p>Error performing query: " . mysql_error() . "</p>"); 
		exit();
	} else {
		echo ("<script> opener.location.reload(); self.close();</script>");
	}
	
}

?>