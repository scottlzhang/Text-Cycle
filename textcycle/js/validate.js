function validation()
{
	if (document.getElementById("fname").value=="") {
		alert("Please enter your first name!");
		return false;
	} else if (document.getElementById("lname").value=="") {
		alert("Please enter your last name!");
		return false;
	} else if (document.getElementById("email").value=="") {
		alert("Please enter your email!");
		return false;
	} else if (document.getElementById("pwd").value=="") {
		alert("Please enter your password!");
		return false;
	} else if (document.getElementById("password").value=="") {
		alert("Please confirm your password!");
		return false;
	} else if (document.getElementById("password")!=document.getElementById("confirm")) {
		alert("Password confirmation failed!")
		return false;
	}
	return true;
}