<?php
session_start();
include ('resize.php');
include ('db_connection.php');
$id=$_SESSION["id"];
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$password=$_POST["pwd"];
$db = db_connect();

if ($fname==$_SESSION["fname"] && $lname==$_SESSION["lname"] && $password=="") {
	$result= "no change";
}
else if ($password==""){
	$query="UPDATE `profile` SET `fname`='".$fname."', `lname`='".$lname."' WHERE `id`=".$id;
	$result=db_query($query, $db);
}
else {
	$query="UPDATE `profile` SET `fname`='".$fname."', `lname`='".$lname."', `password`='".$password."' WHERE `id`=".$id;
	$result=db_query($query, $db);
}

if(!$result) {
	echo("<p>Error performing query: " . mysql_error() . "</p>");
	exit();
}

$_SESSION["fname"]=$fname;
$_SESSION["lname"]=$lname;


if ($_FILES["file"]["name"]==null || $_FILES["file"]["name"]=="") {
	//echo "no file upload";
	$_SESSION["update"]=1;
	header( 'Location: editProfile.php' ) ;
}
else {
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
      $picture_name="upload/".$id;
      $picture_thumb_name=$picture_name."_t";
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $picture_name);
      $image=new SimpleImage();
      $image->load($picture_name);
      $image->resizeToWidth(180);
      $image->save($picture_name);
      $image->resizeToWidth(30);
      $image->save($picture_thumb_name);
      //echo "done";
      
      $query_img="UPDATE `profile` SET `picture`='".$picture_name."' WHERE `id`=".$id;
      $result_img=db_query($query_img, $db);
      if(!$result_img) {
      	echo("<p>Error performing query: " . mysql_error() . "</p>");
      	exit();
      }
      
      header( 'Location: editProfile.php' ) ;
      //
    }
  }
else
  {
  echo "Invalid image file! Click <a href='editprofile.php'>here</a> to go back";
  }
}
?>