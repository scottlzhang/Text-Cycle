<?php

// Inialize session
session_start();

 if (!isset($_SESSION['email'])) {
	header('Location: index.php');
}

$id	= $_SESSION['id'];
$email = $_SESSION['email'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$pic   = $_SESSION['picture'];

//include ('db_connection.php');
//$db=db_connect();

include("inbox_backend.php");

?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>TextCycle - Inbox</title>
<link rel="stylesheet" href="new_plugin.css" />

<script src="js/script.js" type="text/javascript"></script>

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

<!-- the jScrollPane script -->
<script type="text/javascript" src="js/jquery.jscrollpane.js"></script>
<!-- styles needed by jScrollPane -->
<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>



<script type="text/javascript" >
  	//alert("hey love");

	$(document).ready(function() {
			$('scroll-pane').jScrollPane();
			//$('.scroll-pane2').jScrollPane();

			$(".row").click(function(e) {
				var a = $(e.currentTarget).attr("id");
				//alert("in here");
				//$(".scroll-pane2").css('display', 'none');
				//$("#d"+a).toggle();
				//$('.scroll-pane2').jScrollPane();

				//alert(a);
				$(".selected").removeClass("selected");
				$("#"+a).addClass("selected");
	   			//$("#detail").text("Hey soul sister");
			});
			
		//Ajax for detail div
		//var obj =$('.scroll-pane2');
		//while(str){
			//var str = obj[1].attr('id');
			//alert(str);
			//str = $('.scroll-pane2').attr('id');

		//}
		/*
		 $.ajax({
			type: "POST",
			url:"loadmessages.php",
			data:"isbn="+isbn+"&partner="+id,
			success: function(html){
				if(html=='true'){
					alert("Updated!");

				}
				else {
					alert(html);
				}
			}
		});*/

	});
</script>

<script type="text/javascript" id="sourcecode"> 
	$(function()
	{
			$('.scroll-pane').jScrollPane();
			//$('.scroll-pane2').jScrollPane();



	});
</script> 




</head>


<body>
<div id="container">

<div id="toplogo">
<img id="logo" src="logo.png"  />
</div>

<div id="topbar">
<ul>

<li>
<?php echo "<img id = \"userpic\" src = \"". $pic."\"/>" ;?>
</li>

<li>
<?php echo "<strong float='left'><a href='userProfile.php'>".$fname." ".$lname."</a></strong>" ; ?>
</li>

<li><a href="inbox.php">
<img id="inbox_img" src="css/images/Mail_Read.png" />
</a>
</li>

<li id="signout">
<a href="http://localhost/idea/logout.php">Sign Out</a>
</li>

</ul>
</div>

<div id = "table">
<h2 id="header"> Inbox</h2>

<div class ="scroll-pane">

<table id="inbox">
<?php
$counter = 1;
 	foreach($conversation as $row){
		$last_index = count($row->dialog) - 1;
		foreach($row->dialog as $msgs){
			if(!($msgs->read)&&!($msgs->direction)){
				break;
			}
			else{
				continue;
			}	
	
		}
		if($msgs->read || $msgs->direction){
		echo "<tr><td class='row' id='".$counter."' 
				onClick='showdetail(".$row->partner.",".$row->isbn.",".$counter.",".'0'.")'>
			  <img src='silhouette.png' />				
			 <h4 class='title'>".$row->book_detail->title."</h4>";
		}
		else{
		echo "<tr><td class='row' id='".$counter."' 
				onClick='showdetail(".$row->partner.",".$row->isbn.",".$counter.",".'1'.")'>
			  <img src='silhouette.png' />
			<h4 class='unread'>".$row->book_detail->title."</h4>";
		}

			
		echo "<p id='name'>".$row->partner_name."</p>
			  <p id='timestamp'>".$row->dialog[$last_index]->time."</p>
			  </td>
			  </tr>";
		$counter++;
			
	}
  
 ?>

</table>
</div>

<div class='scroll-pane2'>
</div>
<?php
$counter = 1;
		//foreach($conversation as $row){
			//$msgindex = 0;
			//echo "<div class='scroll-pane2' id='d".$counter."'> ";

			//echo "</div>";
		//$counter++;
			
	//}
  

?>

</div>
  
<div id="footer">
		  <p class="footer-text">Copyright 2011 - Go Hard Inc</p>
</div>

</div>


</body>
</html>