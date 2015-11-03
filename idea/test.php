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
 
 
   
 $db = mysql_connect("localhost","root");
if(!$db)
	die('Could not connect to MySql: '. mysql_error()); 
	
mysql_select_db("Books",$db);

$sql = "INSERT INTO Books.bookList (fname, lname, picture, user, name, author, isbn)
VALUES
('$fname','$lname','$pic','$email', '$name','$author','$isbn' )";

if(!mysql_query($sql,$db)) {
	die ('Error: '.mysql_error());
}

?>

