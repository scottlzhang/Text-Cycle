<?php

include ('db_connection.php');
$db=db_connect(); 
$id=$_POST["id"];
$isbn=$_POST["isbn"];
$list=$_POST["list"];

if ($list==0) {
	$listtype="havelist";
	$ownership="owners";
}
else {
	$listtype="needlist";
	$ownership="needs";
}

$query_profile_list="SELECT `".$listtype."` FROM `profile` WHERE `id`=".$id;
$result_profile_list=db_query($query_profile_list,$db);
$result_profile_list=db_result_to_array($result_profile_list);
$list=$result_profile_list[0][$listtype];
$new_list=remove_item($list,$isbn);

$query_update_list="UPDATE `profile` SET `".$listtype."`='".$new_list."' WHERE `id`=".$id;
$result_update_list=db_query($query_update_list,$db);
if(!$result_update_list) {
	echo("<p>Error performing query: " . mysql_error() . "</p>");
	exit();
}

$query_book_list="SELECT `".$ownership."` FROM `booklist` WHERE `isbn`='".$isbn."'";
$result_book_list=db_query($query_book_list,$db);
$result_book_list=db_result_to_array($result_book_list);
$id_list=$result_book_list[0][$ownership];
if ($list==1)
	$new_id_list=remove_item($id_list,$id);
else
	$new_id_list=remove_item_owner($id_list,$id);

$query_update_id_list="UPDATE `booklist` SET `".$ownership."`='".$new_id_list."' WHERE `isbn`='".$isbn."'";
$result_update_id_list=db_query($query_update_id_list,$db);
if(!$result_update_id_list) {
	echo("<p>Error performing query: " . mysql_error() . "</p>");
	exit();
}

echo "true";

function remove_item($l, $item) {
	$list1=explode(",",$l);
	$newlist="";
	foreach ($list1 as $row) {
		if ($row!=$item)
				$newlist.=$row.",";
	}
	if ($newlist!="")
		return substr($newlist,0,-1);
	else
		return "";
}

function remove_item_owner($l, $item) {
	$list1=explode(",",$l);
	$newlist="";
	foreach ($list1 as $row) {
		$row_=explode("[",$row);
		$_row=$row_[0];
		if ($_row!=$item)
			$newlist=$row.",";
	}
	if ($newlist!="")
		return substr($newlist,0,-1);
	else
		return "";
	
}
?>