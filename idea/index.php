<?php

 session_start();
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" type="text/css" href="css/styles.css" />

<script src="js/jquery.js" type="text/javascript"></script>
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

            $("#login_button").click(function() {
				username=$("#username").val();
				password=$("#password").val();
				$.ajax({
					type: "POST",
					url:"login.php",
					data:"username="+username+"&password="+password,
					success: function(html){
						if(html=='true')
							window.location ="userProfile.php";
						else {
							document.getElementById("status").innerHTML='<font size="2.5" face="arial" color="red">Wrong email or password!';
							return false;
						}
					},
					beforeSend:function()
					{
						document.getElementById("status").innerHTML="Please wait...";
					}
				});

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

            $("#signup_button").click(function() {
				fname=$("#fname").val();
				lname=$("#lname").val();
				email=$("#email").val();
				pswd=$("#pswd").val();
				cpswd=$("#cpswd").val();
			
				if(!fname){
					$("#fname_label").css('color', 'red');
					$("#signup_status").text("Empty fields");
					//$("#signup_status").toggle();

						//return false;
				}
				else{
					$("#fname_label").css('color', '#789');
					//$("#signup_status").toggle();

				}
				if(!lname){
					$("#lname_label").css('color', 'red');
					$("#signup_status").text("Empty fields");
					//$("#signup_status").toggle();

						//return false;
				}
				else{
					$("#lname_label").css('color', '#789');
					//$("#signup_status").toggle();
				}
				if(!email){
					$("#email_label").css('color', 'red');
					$("#signup_status").text("Empty fields");
					//$("#signup_status").toggle();

						//return false;
				}
				else{
					$("#email_label").css('color', '#789');
					//$("#signup_status").toggle();
				}
	
				
			if(pswd != cpswd){
					$("#pswd_label").css('color', 'red');
					$("#cpswd_label").css('color', 'red');
					$("#signup_status").text("Passwords don't match");
					//$("#signup_status").toggle();

					return false;

			}
			else{
					$("#pswd_label").css('color', '#789');
					$("#cpswd_label").css('color', '#789');
			}
			
			if(fname && lname && email){
				fname=$("#fname").val();
				lname=$("#lname").val();
				email=$("#email").val();
				//picture=$("#picture").val();
				

				$.ajax({
					type: "POST",
					url:"newuser.php",
					data:"fname="+fname+"&lname="+lname+"&email="+email+"&pswd="+pswd+"&cpswd="+cpswd,
					success: function(html){
						window.location ="userProfile.php";
					},
					cache: false,
					beforeSend:function()
					{
						document.getElementById("status").innerHTML="Please wait...";
					}
				});
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

<div id="topnav" class="topnav"> Have an account? <a href="#login" class="signin"><span>Sign in</span></a> </div>
  <fieldset id="signin_menu">
    <form method="post" id="signin" enctype="multipart/form-data">    
      <p>
      <label for="username">E-mail</label>
      <input id="username" name="email" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="pwd" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="login_button" name="signin" value="Sign in" tabindex="6" type="button">
        <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
        <label for="remember">Remember me</label>
        <p id="status"></p>
      </p>
      <p class="forgot"> <a href="#" id="resend_password_link">Forgot your password?</a> </p>
      <p class="forgot-username"> <a id=forgot_username_link href="#">Forgot your username?</a> </p>

    </form>
  </fieldset>
</div>




<div id="register">
<div id="topnav" class="signupnav"><a href="login" class="signup"><span>Sign up</span></a> </div>
  <fieldset id="signup_menu">
    <form method="post" id="signup"   enctype="multipart/form-data">
      <p>
      <label for="fname" id="fname_label">First Name</label>
      <input id="fname" name="fname" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
      <label for="lname" id="lname_label">Last Name</label>
      <input id="lname" name="lname" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
      <label for="email" id="email_label">E-mail</label>
      <input id="email" name="email" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
      <label for="picture">Picture</label>
      <input id="picture" name="file" value="" title="username" tabindex="4" type="file">
      </p>
      <p>
        <label for="pswd" id="pswd_label">Password</label>
        <input id="pswd" name="pwd" value="" title="password" tabindex="5" type="password">
      </p>
      <p>
        <label for="cpswd" id="cpswd_label">Confirm Password</label>
        <input id="cpswd" name="password" value="" title="password" tabindex="5" type="password">
      </p>
      
      <p id="signup_status" class="error_msg"></p>

      <p class="remember">
        <input id="signup_button" value="Sign up" tabindex="6" type="button">
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
