<?php
	session_start();
	//Distroy the session
	if (isset($_SESSION['email'])){
		unset($_SESSION['email']);
		session_destroy();
		header("Location: ../html/user_login.html");
		//Redirect user back to the login page
		exit;
	}
	
?>