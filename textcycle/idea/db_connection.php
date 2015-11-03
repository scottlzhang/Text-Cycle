<?php

function db_connect() {
	
  $server="localhost";
  $username="root";
  $password="";
  $dbName="textcycle";

//GP localHost
//	$server="localhost:3306";
//	$username="root";
//	$password="";
 //   $dbName="snap";
	
	$link=mysql_connect($server, $username, $password) or die (mysql_error());
	
	if (!@mysql_select_db($dbName, $link)) {
	 echo "<p>There has been an error. This is the error message:</p>"; 
     echo "<p><strong>" . mysql_error() . "</strong></p>"; 
     echo "Please Contact Your Systems Administrator with the details"; 
     exit();
	}
	
	return $link;
}

function db_result_to_array($result) {
   $res_array = array();
   $count=0;

   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
     $res_array[$count] = $row;
     $count++;
   }

   return $res_array;
}


function db_query($query, $db)
	{
		$result = mysql_query($query, $db);
		if(!$result) {
			die("SQL_QUERY_ERR: Query failed.\nFull query: $query");
		}
		return $result;
	}
	
function inbox_select() {
	
  $server="localhost";
  $username="root";
  $password="";	
  $dbName="inbox";
 	
	$db_inbox=mysql_connect($server, $username, $password) or die (mysql_error());

	if (!@mysql_select_db($dbName, $db_inbox)) {
	 echo "<p>There has been an error. This is the error message:</p>"; 
     echo "<p><strong>" . mysql_error() . "</strong></p>"; 
     echo "Please Contact Your Systems Administrator with the details"; 
     exit();
	}
	
	return $db_inbox;
}

function db_connect_inbox() {
	
  $server="localhost";
  $username="root";
  $password="";	
  $dbName="inbox";
 	
	$db_inbox=mysql_connect($server, $username, $password) or die (mysql_error());

	if (!@mysql_select_db($dbName, $db_inbox)) {
	 echo "<p>There has been an error. This is the error message:</p>"; 
     echo "<p><strong>" . mysql_error() . "</strong></p>"; 
     echo "Please Contact Your Systems Administrator with the details"; 
     exit();
	}
	
	return $db_inbox;
}

?>