<?php

	session_start();
	//database connection
	include ('db_connection.php');
 	$db = db_connect();

	//retrieve values from Ajax Post

	$book_isbn = $_POST["isbn"];
	$book_title = $_POST["title"];
	$book_author = $_POST["author"];
	$book_picture_url = $_POST["picture"];
	$book_category = $_POST["category"];
	$list = $_POST["list"];
	$id = $_SESSION["id"];
	$price="300";
	

	//echo $id;
	$list_array = array(0 => "needs", 1=> "owners");
	$type_array = array(0 => "needlist", 1=> "havelist");
	
	//echo $list;

   //Check if book is already in booklist(yet to do)
   //Get book from booklist using isbn
   $sql_select = "SELECT * FROM booklist WHERE isbn ='".$book_isbn."'";
   $existing_book = db_query($sql_select, $db);
   
   $existing_book  = db_result_to_array($existing_book);


   //if book exists
   if($existing_book){
	   //echo "Book exists <br/>";
	   //echo $existing_book[0]["title"]."<br/>";
	  
	   //get list of book owners
	   $owners_string = $existing_book[0][$list_array[$list]];
	   //if owners already exist, concatenate user id
	   if($owners_string){
		   $owners_array = explode(",",$owners_string);
		   foreach ($owners_array as $row) {
		   		$_id=explode("[",$row);
		   		$user=$_id[0];
		   		if ($user==$id)
		   			die("You already have book");
		   }
		   if ($list==1)
		   		$owners_string = $owners_string.",".$id."[".$price;
		   else
		   		$owners_string = $owners_string.",".$id;
		   //if(array_search($id,$owners_array)==false){
		   //		$owners_string = $owners_string.",".$id;
		//	 } else
			// 	die("You already have book");
	   }
	   //else add new user id if no owner exists
	   else{
	   		if ($list==1)
	   			$owner_string=$id."[".$price;
	   		else
	   			$owners_string = $id;
	   }

	   //update owner field in table
	   //echo $owners_string."<br/>";
	   
	   $sql_update = "UPDATE booklist SET ".$list_array[$list]."='".$owners_string."' 
	   					WHERE isbn='".$book_isbn."'";

	   $updated_book = db_query($sql_update, $db);

	   
	   
   }
   
   else{
 

   //Insert new book
	$sql_insert = "INSERT INTO `booklist` (isbn,title,author,picture,category)
			VALUES
			 ('".mysql_real_escape_string($book_isbn)."','"
				.mysql_real_escape_string($book_title)."','"
				.mysql_real_escape_string($book_author)."','"
				.mysql_real_escape_string($book_picture_url)."','"
				.mysql_real_escape_string($book_category)."')";

	$valid = db_query($sql_insert, $db);
	
	//add user as first owner of book
	if ($list==1)
		$sql_update = "UPDATE booklist SET ".$list_array[$list]."='".$id."[".$price."' 
	   					WHERE isbn='".$book_isbn."'";
	else
		$sql_update = "UPDATE booklist SET ".$list_array[$list]."='".$id."'
		WHERE isbn='".$book_isbn."'";

	$updated_book = db_query($sql_update, $db);

	
   }
   //update user profile, select user from profile
   $sql_select = "SELECT * FROM profile WHERE id ='".$id."'";
   $user = db_query($sql_select, $db); 
   $user  = db_result_to_array($user);
   //get havelist string
   $havelist_string = $user[0][$type_array[$list]];
   //if havelist is already occupied, concatenate isbn to havelist
   if($havelist_string){
	   $havelist_string = $havelist_string.",".$book_isbn;
	   $sql_update = "UPDATE profile SET ".$type_array[$list]."='".$havelist_string."' 
	   					WHERE id='".$id."'";
   }
   //else add new isbn to havelist
   else{
	   $sql_update = "UPDATE profile SET ".$type_array[$list]."='".$book_isbn."' 
	   					WHERE id='".$id."'";	
   }
						
   $updated_profile = db_query($sql_update, $db);
   
   echo "true";

?>