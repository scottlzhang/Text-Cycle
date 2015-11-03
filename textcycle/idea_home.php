<?php

 session_start();
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" type="text/css" href="styles.css" />

<script src="jquery.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {
                e.preventDefault();
                $("fieldset#signin_menu").toggle();
                $(".signin").toggleClass("menu-open");
            });

            $("fieldset#signin_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.signin").length==0) {
                    $(".signin").removeClass("menu-open");
                    $("fieldset#signin_menu").hide();
                }
            });            

        });
</script>

<script type="text/javascript">
        $(document).ready(function() {

            $(".signup").click(function(e) {
                e.preventDefault();
                $("fieldset#signup_menu").toggle();
                $(".signup").toggleClass("menu-open");
            });

            $("fieldset#signup_menu").mouseup(function() {
                return false
            });
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.signup").length==0) {
                    $(".signup").removeClass("menu-open");
                    $("fieldset#signup_menu").hide();
                }
            });            

        });
</script>

<title>Idea-Home</title>
</head>

<body>

<div id = "container">

<div id = "logo">
<img src="logo.png"  />
</div>


<div id = "login">


<div id="topnav" class="topnav"> Have an account? <a href="login" class="signin"><span>Sign in</span></a> </div>
  <fieldset id="signin_menu">
    <form method="post" id="signin" action = "" enctype="multipart/form-data">
    <?php
 
		$email = $_POST["email"];
		$password = md5($_POST["pwd"]);
		
		if (!isset($_POST['signin'])) { 
		// if page is not submitted to itself echo the form

	?>
    
      <p>
      <label for="username">E-mail</label>
      <input id="username" name="email" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="pwd" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="signin_submit" name="signin" value="Sign in" tabindex="6" type="submit">
        <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
        <label for="remember">Remember me</label>
      </p>
      <p class="forgot"> <a href="#" id="resend_password_link">Forgot your password?</a> </p>
      <p class="forgot-username"> <a id=forgot_username_link href="#">Forgot your username?</a> </p>
 
 <?php
	}
	
  else{
 
	//session_start();

	$db = mysql_connect("localhost","root");
	if(!$db)
		die('Could not connect to MySql: '. mysql_error()); 
	
	mysql_select_db("UserProfiles",$db);




	$result = mysql_query("SELECT * FROM UserProfiles.profiles WHERE (email = '" . mysql_real_escape_string($email) . "') and (password = '" . 		mysql_real_escape_string($password) . "')",$db);

	if(!($result) ) {
		die ('Error: '.mysql_error());
	 }
 
	if (mysql_num_rows($result) == 1) {

	$array = mysql_fetch_array($result);

	$_SESSION['email'] = $array['email'];
	$_SESSION['fname'] = $array['fName'];
	$_SESSION['lname'] = $array['Lname'];
	$_SESSION['picture'] = $array['picture'];

	header('Location: userProfile.php');


/*
if($array){
		echo "<img src = \"". $array["picture"]."\"/> <br/> <br/>" ;
		echo "<strong>First Name: </strong>" .$array["fName"]."<br/>" ;
		echo "<strong>Last Name: </strong>". $array["Lname"]."<br/>" ;
		echo "<strong>e-mail: </strong>". $array["email"]."<br/>" ;
		}*/


	}
	else{
		header('Location: idea_home.html');

	} 
  }
/*
if (mysql_num_rows($result) == 1) {

echo "User found";

}
else
	echo "Not Found";
	//header('Location: login.html'); */

?>


    </form>
  </fieldset>
</div>




<div id="register">
<div id="topnav" class="signupnav"><a href="login" class="signup"><span>Sign up</span></a> </div>
  <fieldset id="signup_menu">
    <form method="post" id="signup" action = "http://localhost/idea/newuser.php" enctype="multipart/form-data">
      <p>
      <label for="username">First Name</label>
      <input id="username" name="fname" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
      <label for="username">Last Name</label>
      <input id="username" name="lname" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
      <label for="username">E-mail</label>
      <input id="username" name="email" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
      <label for="username">Picture</label>
      <input id="username" name="file" value="" title="username" tabindex="4" type="file">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="pwd" value="" title="password" tabindex="5" type="password">
      </p>
      <p>
        <label for="password">Confirm Password</label>
        <input id="password" name="password" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="signin_submit" value="Sign up" tabindex="6" type="submit">
      </p>

    </form>
  </fieldset>
</div>

<div id = "video">
<img src="video.png"  />
</div>

</div>

  <div id="footer">
		  <p class="footer-text">Copyright 2011 - Go Hard Inc</p>
	</div>

</body>
</html>
