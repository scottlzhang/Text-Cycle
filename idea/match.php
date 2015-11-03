<?php 
class book {
	private $isbn;
	private $title;
	private $edition;
	private $author;
	private $category;
	private $owners_array;
	private $ownerid;
	
	public function getisbn() {
		return $this->isbn;
	}
	public function gettitle() {
		return $this->title;
	}
	public function getedition() {
		return $this->edition;
	}
	public function getauthor() {
		return $this->author;
	}
	public function getcategory() {
		return $this->category;
	}
	public function getowners_array() {
		return $this->owners_array;
	}
	public function getownerid() {
		return $this->ownerid;
	}
	public function setisbn($a) {
		$this->isbn=$a;
	}
	public function settitle($a) {
		$this->title=$a;
	}
	public function setedition($a) {
		$this->edition=$a;
	}
	public function setauthor($a) {
		$this->author=$a;
	}
	public function setcategory($a) {
		$this->categor=$a;
	}
	public function setowners_array($a) {
		$this->owners_array=$a;
	}
	public function setownerid($a) {
		$this->ownerid=$a;
	}
}

class owner {
	private $id;
	private $email;
	private $fname;
	private $lname;
	private $picture;
	
	public function getid() {
		return $this->id;
	}
	public function getemail() {
		return $this->email;
	}
	public function getfname() {
		return $this->fname;
	}
	public function getlname() {
		return $this->lname;
	}
	public function getpicture() {
		return $this->picture;
	}
	public function setemail($a) {
		$this->email=$a;
	}
	public function setfname($a) {
		$this->fname=$a;
	}
	public function setlname($a) {
		$this->lname=$a;
	}
	public function setpicture($a) {
		$this->picture=$a;
	}
	public function setid($a) {
		$this->id=$a;
	}
}

//-------start of the process for finding books I can buy
$isbnlist="";
$counter=0;
foreach ($need_list as $isbn) {
	if ($counter<(count($need_list)-1))
		$isbnlist.="isbn=".$isbn." or ";
	else
		$isbnlist.="isbn=".$isbn;
	$counter++;
}
if ($isbnlist!="isbn=") {
	$query_book_buy="SELECT * FROM booklist WHERE (".$isbnlist.") AND (owners != '')";
	$result_book_buy=db_query($query_book_buy, $db);
	$result_book_buy=db_result_to_array($result_book_buy);
} else
	$result_book_buy="";

if ($result_book_buy=="") {
	$book_buy="";
} else{
$book_buy=array();
foreach ($result_book_buy as $row) {
	$book=new book();
	$book->setisbn($row["isbn"]);
	$book->settitle($row["title"]);
	$book->setedition($row["edition"]);
	$book->setauthor($row["author"]);
	$book->setcategory($row["category"]);
	$owners_id=$row["owners"];
	$id_list=explode(",",$owners_id);
	$idlist="";
	$counter=0;
	foreach ($id_list as $id) {
		if ($counter<(count($id_list)-1))
			$idlist.="id=".$id." or ";
		else
			$idlist.="id=".$id;
		$counter++;
	}
	$query_owners="SELECT * FROM profile WHERE (".$idlist.")";
	$result_owners=db_query($query_owners, $db);
	$result_owners=db_result_to_array($result_owners);
	$owners_array=array();
	foreach ($result_owners as $row) {
		$owner=new owner();
		$owner->setemail($row["email"]);
		$owner->setfname($row["fname"]);
		$owner->setlname($row["lname"]);
		$owner->setpicture($row["picture"]);
		$owner->setid($row["id"]);
		array_push($owners_array,$owner);
	}
	$book->setowners_array($owners_array);
	array_push($book_buy,$book);
}
}
//-------end of the process for finding books I can buy


//-------start of the process for finding books I can sell
$isbnlist="";
$counter=0;
foreach ($have_list as $isbn) {
	if ($counter<(count($have_list)-1))
		$isbnlist.="isbn=".$isbn." or ";
	else
		$isbnlist.="isbn=".$isbn;
	$counter++;
}
if ($isbnlist!="isbn=") {
	$query_book_sell="SELECT * FROM booklist WHERE (".$isbnlist.") AND (needs != '')";
	$result_book_sell=db_query($query_book_sell, $db);
	$result_book_sell=db_result_to_array($result_book_sell);
} else
	$result_book_sell="";

if ($result_book_sell=="") {
	$book_sell="";
} else {
$book_sell=array();
foreach ($result_book_sell as $row) {
	$book=new book();
	$book->setisbn($row["isbn"]);
	$book->settitle($row["title"]);
	$book->setedition($row["edition"]);
	$book->setauthor($row["author"]);
	$book->setcategory($row["category"]);
	$owners_id=$row["needs"];
	$id_list=explode(",",$owners_id);
	$idlist="";
	$counter=0;
	foreach ($id_list as $id) {
		if ($counter<(count($id_list)-1))
			$idlist.="id=".$id." or ";
		else
			$idlist.="id=".$id;
		$counter++;
	}
	$query_owners="SELECT * FROM profile WHERE (".$idlist.")";
	$result_owners=db_query($query_owners, $db);
	$result_owners=db_result_to_array($result_owners);
	$owners_array=array();
	foreach ($result_owners as $row) {
		$owner=new owner();
		$owner->setemail($row["email"]);
		$owner->setfname($row["fname"]);
		$owner->setlname($row["lname"]);
		$owner->setpicture($row["picture"]);
		$owner->setid($row["id"]);
		array_push($owners_array,$owner);
	}
	$book->setowners_array($owners_array);
	array_push($book_sell,$book);
}
}
//-------end of the process for finding books I can sell
?>