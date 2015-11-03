<?php

// Inialize session
session_start();

 if (!isset($_SESSION['email'])) {
	header('Location: index.php');
}

include ('db_connection.php');
$db=db_connect();

$id=$_SESSION['id'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$pic   = $_SESSION['picture'];
//---------start the process for the books I have
$query_have_isbn="SELECT havelist FROM profile WHERE (email = '" . mysql_real_escape_string($email) . "') ";
$result_have_isbn=db_query($query_have_isbn,$db);
$result_have_isbn=db_result_to_array($result_have_isbn);
$have_list=explode(",",$result_have_isbn[0]["havelist"]);

$query_have_books="SELECT * FROM booklist WHERE (";
$counter=0;
foreach ($have_list as $isbn) {
	if ($counter<(count($have_list)-1))
		$query_have_books.="isbn=".$isbn." or ";
	else
		$query_have_books.="isbn=".$isbn.")";
	$counter++;
}

if ($query_have_books=="SELECT * FROM booklist WHERE (isbn=)")
	$result_have_books="";
else {
	$result_have_books=db_query($query_have_books, $db);
	$result_have_books=db_result_to_array($result_have_books);
}
//the following is for debugging
//foreach ($result_have_books as $row) {
//	echo $row["title"];
//}
//-------end of the process for the books I have


//---------start the process for the books I need
$query_need_isbn="SELECT needlist FROM profile WHERE (email = '" . mysql_real_escape_string($email) . "') ";
$result_need_isbn=db_query($query_need_isbn,$db);
$result_need_isbn=db_result_to_array($result_need_isbn);
$need_list=explode(",",$result_need_isbn[0]["needlist"]);

$query_need_books="SELECT * FROM booklist WHERE (";
$counter=0;
foreach ($need_list as $isbn) {
	if ($counter<(count($need_list)-1))
		$query_need_books.="isbn=".$isbn." or ";
	else
		$query_need_books.="isbn=".$isbn.")";
	$counter++;
}

if ($query_need_books=="SELECT * FROM booklist WHERE (isbn=)")
	$result_need_books="";
else {
	$result_need_books=db_query($query_need_books, $db);
	$result_need_books=db_result_to_array($result_need_books);
}
//the following is for debugging
//foreach ($result_need_books as $row) {
//	echo $row["title"];
//}
//-------end of the process for the books I need


//-------start of the process for the books I can sell
include("match.php");
//-------end of the process for the books I can sell
?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/styles2.css" />

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

<script src="js/script.js" type="text/javascript"></script>
<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<!-- the jScrollPane script -->
<script type="text/javascript" src="js/jquery.jscrollpane.js"></script>
<!-- styles needed by jScrollPane -->
<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" />

<!--JavaScript for Pop-up view -->
<script type="text/javascript" src="js/popup.js"></script>

<!--CSS for Pop-up view -->
<link rel="stylesheet" href="css/popup.css">

<script type="text/javascript" src="js/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	




<script type="text/javascript">
        $(document).ready(function() {
        	 $("#loader").bind("ajaxSend", function() {
     	        $(this).show();
     	    }).bind("ajaxStop", function() {
     	        $(this).hide();
     	    }).bind("ajaxError", function() {
     	        $(this).hide();
     	    });
	     
            $(".add").click(function(e) {
                e.preventDefault();
                var element=$("#add_button");
                var offset=element.offset();
                $("fieldset#add_menu").toggle();
                $(".add").toggleClass("menu-open");
                $("fieldset#add_menu").offset({top:offset.top+30, left:offset.left});
                
            });

            $("fieldset#add_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.add").length==0) {
                    $(".add").removeClass("menu-open");
                    $("fieldset#add_menu").hide();
                }
            });  
				
				/*For Have List*/		
			 $(".addHave").click(function(e) {
                e.preventDefault();
                var element=$("#add_have_button");
                var offset=element.offset();
                $("fieldset#add_menu2").toggle();
                $(".addHave").toggleClass("menu2-open");
                $("fieldset#add_menu2").offset({top:offset.top+30, left:offset.left});
            });

            $("fieldset#add_menu2").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.addHave").length==0) {
                    $(".addHave").removeClass("menu2-open");
                    $("fieldset#add_menu2").hide();
                }
            });  
			/*
			$("#add").click(function(e) {
					var bname = $("#bookname").val();
					var bauthor = $("#author").val();
					var bisbn = $("#isbn").val();


					$('<tr><td>'+ bname + '</td></tr>').prependTo('#needbody');
					$('.scroll-pane').jScrollPane();
          			$.post("test.php", {name: bname, author: bauthor,
										isbn: bisbn});
			});*/
			
			/*
			$("#add2").click(function(e) {
					var bname = $("#bookname2").val();
					var bauthor = $("#author2").val();
					var bisbn = $("#isbn2").val();
					/*var swap = $("#swap").val();
					var b_rent = 0;
					var b_buy = 0;
					
					$("#rent:checked").each(function(){
						
						b_rent = 1;
					});
					$("#buy:checked").each(function(){
						
						b_buy = 1;
					});
					$('<tr><td>'+ bname + '</td></tr>').prependTo('#havebody');
					$('.scroll-pane2').jScrollPane();

					
          			$.post("test1.php", {name: bname, author: bauthor,
										isbn: bisbn, rent: b_rent,
										buy: b_buy});
			});*/

			$.ajax({
				type: "POST",
				url:"checkmail.php",
				data:"id="+<?php echo $_SESSION['id']?>,
				success: function(html){
					if(html=='fail'){
						alert("Inbox service temperorily unavailable.");
					}
					else {
						$("#unread").text(html+" Unread");
					}
				},
				beforeSend:function()
				{	
				}
			});
			
	});
	

</script>

<script type="text/javascript" id="sourcecode"> 
	$(function()
	{
			$('.scroll-pane').jScrollPane();
			$('.scroll-pane2').jScrollPane();

	});
</script> 

<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>

<script>
$(document).ready(function() {

	// Slide
	$("#menu1 > li > a.expanded + ul").slideToggle("medium");
	$("#menu1 > li > a").click(function() {
		$(this).toggleClass("expanded").toggleClass("collapsed").parent().find('> ul').slideToggle("medium");
	});
});
</script>

<style type="text/css">



</style>



</head>
<body>

<div id="loader" class="loader" style="display:none;">
<img id="img-loader" src="loader.gif" alt="Loading"/>
</div>
	
	
<div id="container">

<div id="toplogo">
<img src="logo.png"  />
</div>

<ul id="topbar">

<li>
<a href="inbox.php"><img id="inbox" src="css/images/Mail_Read.png" /></a>
<ul>
<li id="unread"></li>
</ul>
</li>

<li>
<?php echo "<img id = \"userpic\" src = '". $pic."'/>" ;?>
</li>

<li>
<?php echo "<strong float='left'><a href='userProfile.php'>".$fname." ".$lname."</a></strong>" ; ?>
</li>

<li><img src="menu_disclose.png" id="menu_disclose" />
	<ul>
		<li>
			<a href="editprofile.php">Edit profile</a>
		</li>
		<li id="signout">
			<a href="http://localhost/idea/logout.php">Sign Out</a>
		</li>
	</ul>
</li>
</ul>


<div id = "table">
<h2> My List</h2>

<div id = "addBook">
<div id="topnav" class="topnav"><label id="add_button"> What books do you need?</label> <a href="" class="add"><span>Add</span></a> </div>
  <fieldset id="add_menu">
  		<h1>Search by:</h1>
  	   <p>
        <label for="password">ISBN or Bookname</label>
        <input id="isbn" name="isbn" value="" title="isbn" tabindex="5" type="text">
      </p>
      <p align="center">
        <a href="#" data-reveal-id="add-section" class="popup-link"><input value="Search" tabindex="6" type="submit" onClick="searchBook(document.getElementById('isbn').value,0)"></a>
      </p>
    </form>
  </fieldset>
</div>


<div id="add-section" class="reveal-modal">
<a class='close-reveal-modal'>&#215</a>
</div>

<div id="headers">
	<table id="list">
    <thead>
		<tr><th align="center" id="t-header">I need</th></tr>
    </thead>
    </table>
    
    <table id="havelist" style="float:left;">
    <thead>
		<tr><th align="center" id="t-header">I have</th></tr>
    </thead>
    </table>
</div>


<div id = "haveBook">
<div id="topnav" class="topnav"> <label id="add_have_button">What books do you have?</label> <a href="" class="addHave"><span>Add</span></a> </div>


	<fieldset id="add_menu2">
      <p>
      <h1>Search by:</h1>
        <label for="password">ISBN or Bookname</label>
        <input id="isbn2" name="isbn2" value="" title="isbn2" tabindex="5" type="text">
      </p>
      <p align="center">
        <a href="#" data-reveal-id="add-section" class="popup-link"><input value="Search" tabindex="6" type="submit" onClick="searchBook(document.getElementById('isbn2').value,1)"></a>
      </p>
    </form>
  </fieldset>
</div>
    
    
<div class = "scroll-pane">
	<table id="needItems">
    <tbody id ="needbody" >

    <?php
	//Traverses $result_need_books to display each book title	
		if($result_need_books){
			foreach ($result_need_books as $row) {
                           echo "<tr><td onClick=
\"bookInfoPopup('".$row["isbn"]."','".addslashes($row["title"])."','".addslashes($row["author"])."','".addslashes($row["picture"])."','".$_SESSION['id']."')\" >
						   	<a href = '#' data-reveal-id='generic_test' class='popup-link'>"
									.$row["title"]."</a></td></tr>";	
									}
		}
	?>
    </tbody>
	</table>
</div>

<div id="generic_test" class="reveal-modal">
</div>
    <?php
	/*
	//Creates pop-up window for each book with div id as isbn number
		if($result_need_books){	
			foreach ($result_need_books as $row) {
                           echo "<div id ='" .$row["isbn"]. "'class='reveal-modal'>
						   		<img src='".$row["picture"]."' class = 'bookimg' />
						   		<h3>". $row["title"]."</h3>
								<p>By ".$row["author"]."</p>
								<p>ISBN: ".$row["isbn"]."</p>
								<a class='close-reveal-modal'>&#215;</a>
							<input type='button' value='remove from list'
							 onClick='removeBook(".$_SESSION['id'].",".$row["isbn"].",".'1'.")'/>

								</div>";	}
		}*/
	?>

    
<div class = "scroll-pane2">
	<table id="haveItems">
    <tbody id ="havebody" >
   
    <?php
	//Traverses $result_have_books to display each book title
		if($result_have_books){
			foreach ($result_have_books as $row) {
					$owners_=$row["owners"];
					$ownerslist=explode(",",$owners_);
					foreach ($ownerslist as $i) {
						$t=explode("[",$i);
						$owner_id=$t[0];
						if($owner_id==$_SESSION["id"]) {
							$price=$t[1];
							break;
						}
					}
			
 echo "<tr><td onClick= \"bookInfoPopup('".$row["isbn"]."','".addslashes($row["title"])."','".addslashes($row["author"])."','".addslashes($row["picture"])."','".$_SESSION['id']."','".$price."')\" >
<a href = '#' data-reveal-id='generic_test' class=''>".$row["title"]."</a></td></tr>";			
					}
		}
	?> 
    
    </tbody>
	</table>
</div>

    <?php
	//Creates pop-up window for each book with div id as isbn number
		/*if($result_have_books){	
			foreach ($result_have_books as $row) {
					$owners_=$row["owners"];
					$ownerslist=explode(",",$owners_);
					foreach ($ownerslist as $i) {
						$t=explode("[",$i);
						$owner_id=$t[0];
						if($owner_id==$_SESSION["id"]) {
							$price=$t[1];
							break;
						}
					}
                           echo "<div id ='" .$row["isbn"]. "'class='reveal-modal'>
						   		<img src='".$row["picture"]."' class = 'bookimg' />
						   		<h3>". $row["title"]."</h3>
								<p>By ".$row["author"]."</p>
								<p>ISBN: ".$row["isbn"]."</p>
								<p>Price: ".$price." dollars</p>
								<a class='close-reveal-modal'>&#215;</a>
							<input type='button' value='remove from list'
							 onClick='removeBook(".$_SESSION['id'].",".$row["isbn"].",".'0'.")'/>								</div>";	
							 }	
		}*/
	?>
<div id = "deals">
<h2> My Deals</h2>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Buy</a></li>
		<li><a href="#tabs-2">Sell</a></li>
		<li><a href="#tabs-3">Swap</a></li>
	</ul>
	<div id="tabs-1">
	<?php
	//Gets list of books to buy from database
    if($book_buy){
		foreach($book_buy as $items){
			$temp = $items->getowners_array();
			echo "<ul id= 'menu1' class= 'example_menu'>
					<li><a class='collapsed'>".$items->gettitle()."(".count($temp).")</a>
						<ul class='subitems'>";
						foreach($temp as $owners){
				          echo"<li><a href = '#' data-reveal-id='".$items->getisbn().$owners->getid()
				            ."' class='popup-link'>".
									$owners->getfname()." ".$owners->getlname()."</a></li>";
						}
						echo "</ul>
					</li>
				</ul>";
		}
	}
	else{
		echo "Sorry you have no matches";
	}
	?>
	</div>
	<div id="tabs-2">
	
	<?php
	//Gets list of books to sell from database
    if($book_sell){
		foreach($book_sell as $items){
			$temp = $items->getowners_array();
			echo "<ul id= 'menu1' class= 'example_menu'>
					<li><a class='collapsed'>".$items->gettitle()."(".count($temp).")</a>
						<ul class='subitems'>";
						foreach($temp as $owners){
							echo"<li><a href = '#' data-reveal-id='".$items->getisbn().$owners->getid()
				            ."' class='popup-link'>".$owners->getfname()." ".$owners->getlname()."</a></li>";
						}
						echo "</ul>
					</li>
				</ul>";
		}
	}
	else{
		echo "Sorry you have no matches";
	}
	?>
	</div>
	<div id="tabs-3">
	
    <ul id="menu1" class="example_menu">
		<li><a class="collapsed">Section A</a>
			<ul class="subitems">
				<li><a href="#">Link A-A</a></li>
				<li><a href="#">Link A-B</a></li>
				<li><a href="#">Link A-C</a></li>
				<li><a href="#">Link A-D</a></li>
			</ul>
		</li>
      </ul>
	</div>
</div>
    
<?php
	//Creates pop-up window for each buy deal
				
	if($book_buy){
		foreach($book_buy as $items){
			$temp = $items->getowners_array();
						foreach($temp as $owners){
							echo "<div id ='".$items->getisbn().$owners->getid()."' class='reveal-modal'>
						   		<img src='".$row["picture"]."' class = 'bookimg' />
								  <h1>".$items->gettitle()."</h1>
						   		  <h3>".$owners->getfname()." ".$owners->getlname()."</h3>
								  <h4>".$owners->getemail()."</h4>
								  <textarea rows='10' cols='30' name='message' id='".$items->getisbn().$owners->getid()."text' placeholder='Enter message'></textarea>
								  </br>
								  <p class='msgstatus'><p>
								  <input class='send' value='submit' type='button' onClick='sendmsg(".$items->getisbn().",".$owners->getid().")'/>
								 <a class='close-reveal-modal'>&#215;</a>
								</div>";

						}
						echo "</ul>
					</li>
				</ul>";
		}
	}
				
	?>
<?php
	//Creates pop-up window for each sell deal
				
	if($book_sell){
		foreach($book_sell as $items){
			$temp = $items->getowners_array();
						foreach($temp as $owners){
							echo "<div id ='".$items->getisbn().$owners->getid()."' class='reveal-modal'>
						   		<img src='".$row["picture"]."' class = 'bookimg' />
								  <h1>".$items->gettitle()."</h1>
						   		  <h3>".$owners->getfname()." ".$owners->getlname()."</h3>
								  <h4>".$owners->getemail()."</h4>
								  <form>
								  <textarea rows='10' cols='30' name='message' id='".$items->getisbn().$owners->getid()."text' placeholder='Enter message'></textarea>
								  </br>
								  <p class='msgstatus'><p>
								  <input class='send' value='submit' type='button' onClick='sendmsg(".$items->getisbn().",".$owners->getid().")'/>
								  </form>
								 <a class='close-reveal-modal'>&#215;</a>
								</div>";

						}
						echo "</ul>
					</li>
				</ul>";
		}
	}
				
	?>


				
</div> 

</div>
  
<div id="footer">
		  <p class="footer-text">Copyright 2011 - Go Hard Inc</p>
</div>

</div>


</body>
</html>