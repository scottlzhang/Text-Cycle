<?php

// Inialize session
session_start();

 if (!isset($_SESSION['email'])) {
	header('Location: index.php');
}

if (isset($_SESSION["update"])) {
if ($_SESSION["update"]==1) {
	echo "<script>alert('Profile updated!');</script>";
	$_SESSION["update"]=0;
}
}

$id	= $_SESSION['id'];
$email = $_SESSION['email'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$pic   = $_SESSION['picture'];

//include ('db_connection.php');
//$db=db_connect();
?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>TextCycle - Inbox</title>
<link rel="stylesheet" href="css/editprofile.css" />

<script src="js/script.js" type="text/javascript"></script>

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<!-- the jScrollPane script -->
<script type="text/javascript" src="js/jquery.jscrollpane.js"></script>
<!-- styles needed by jScrollPane -->
<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>

<script type="text/javascript">
function check_edit() {
	if (document.getElementById("fname").value=="") {
		alert("Please enter your first name!");
		return false;
	}
	else if (document.getElementById("lname").value=="") {
		alert("Please enter your last name!");
		return false;
	}
	else if (document.getElementById("confirm").value!=document.getElementById("confirm_pwd").value) {
		alert("Please check your password confirmation");
		return false;
	}
}

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
				<?php
				$p=rand();
				 echo "<img id = \"userpic\" src = \"". $pic."_t?".$p."\"/>" ;?>
			</li>
			<li>
				<?php echo "<strong float='left'><a href='userProfile.php'>".$fname." ".$lname."</a></strong>" ; ?>
			</li>
			<li><a href="inbox.php">
				<img id="inbox_img" src="css/images/Mail_Read.png" />
				</a>
			</li>
			<li id="signout">
				<a href="logout.php">Sign Out</a>
			</li>

	 	</ul>
	</div>

	<div id = "profileinfo">
    
    	<h2>Edit Profile</h2>
    	<form name="editprofile" method="post" action="updateprofile.php" enctype="multipart/form-data" onsubmit="return check_edit()">
    	<p>First Name:</p>
    	<input id="fname" name="fname" value="<?php echo $fname;?>"type="text"/>
    	<p>Last Name:</p>
    	<input id="lname" name="lname" value="<?php echo $lname;?>" type="text"/>
    	<p>New Password:</p>
    	<input id="pwd" name="pwd" type="password"/><br />
    	<p>Confirm Password:</p>
    	<input id="confirm_pwd" name="confirm_pwd" type="password"/><br />
    	<p>Picture:</p>
    	<?php
		echo "<img src = '". $pic."?".$p."' />";
	?>
	<br/>
    	<input type="file" name="file" id="file" /> <br/>
    	<input name="submit" type="submit" value="Update"/>
    	<input name="cancel" value="Cancel" type="button" onClick="window.location='userProfile.php'"/>
    	</form>
	</div>
  
	<div id="footer">
		  <p class="footer-text">Copyright 2011 - Go Hard Inc</p>
	</div>

</div>


</body>

</html>