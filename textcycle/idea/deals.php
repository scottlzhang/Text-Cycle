<?php
session_start();

$email = $_SESSION['email'];


$db = mysql_connect("localhost","root");
if(!$db)
	die('Could not connect to MySql: '. mysql_error()); 
	
mysql_select_db("Books",$db);



$outcome = mysql_query("SELECT * FROM Books.bookList WHERE (user = '" . mysql_real_escape_string($email) . "') ",$db);

$outcome2 = mysql_query("SELECT * FROM Books.haveList WHERE (user = '" . mysql_real_escape_string($email) . "') ",$db);



if(!($outcome) ) {
		die ('Error: '.mysql_error());
 }
 
if(!($outcome2) ) {
		die ('Error: '.mysql_error());
 }
 
if(mysql_num_rows($outcome) >= 1) {

	$arrayList = mysql_fetch_array($outcome);

}

if(mysql_num_rows($outcome2) >= 1) {

	$arrayList2 = mysql_fetch_array($outcome2);

}

while($arrayList){
	
	$name = $arrayList['name'];
	$matches = mysql_query("SELECT * FROM Books.haveList WHERE (name = '" . mysql_real_escape_string($name) 
	 						."') and (user != '" . mysql_real_escape_string($email). "')",$db);
	
	//echo "<p>". $arrayList['name']. " has ". mysql_num_rows($matches). " matches </p>"; 
	
	$dealer = mysql_fetch_array($matches);
	
	while($dealer){
		
		echo "<p><a href = '#' data-reveal-id= 'myModal3' class='popup-link'>";
		echo "<img src='". $dealer['picture']. "' id = 'userpic' />";
		echo $dealer['fname']." ". $dealer['lname']. " has ". $arrayList['name'].".</a></p>";
		$dealer = mysql_fetch_array($matches);

	}

	$arrayList = mysql_fetch_array($outcome);
}

while($arrayList2){
	
	$name = $arrayList2['name'];
	$matches2 = mysql_query("SELECT * FROM Books.bookList WHERE (name = '" . mysql_real_escape_string($name) 
	 						."') and (user != '" . mysql_real_escape_string($email). "')",$db);
	
	//echo "<p>". $arrayList['name']. " has ". mysql_num_rows($matches). " matches </p>"; 
	
	$dealer2 = mysql_fetch_array($matches2);
	
	while($dealer2){
		
		echo "<p><img src='". $dealer2['picture']. "' id = 'userpic' />";
		echo $dealer2['fname']." ". $dealer2['lname']. " needs ". $arrayList2['name'].".</p>";
		$dealer2 = mysql_fetch_array($matches2);

	}

	$arrayList2 = mysql_fetch_array($outcome2);
}


?>