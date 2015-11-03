<?php

// Inialize session
session_start();

$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$pic   = $_SESSION['picture'];

 $name = $_POST["name"];
 $author = $_POST["author"];
 $isbn = $_POST["isbn"];
 
 $rent = $_POST["rent"];
 $buy =  $_POST["buy"];
 
 /*if($swap == "swap")
    $swap = 1;	
  else
	$swap = 0;*/
/* 
 if($rent == 1)
    $rentval = 1;	
  else
	$rentval = 0;
	
  if($buy == 1)
    $buyval = 1;	
  else
	$buyval = 0;*/
   
 $db = mysql_connect("localhost","root");
if(!$db)
	die('Could not connect to MySql: '. mysql_error()); 
	
mysql_select_db("Books",$db);

$sql = "INSERT INTO Books.haveList (fname, lname, user, picture, name, author, isbn, rent, buy)
		VALUES('$fname','$lname','$email','$pic','$name','$author','$isbn','$rent','$buy')";

if(!mysql_query($sql,$db)) {
	die ('Error: '.mysql_error());
}

?>

