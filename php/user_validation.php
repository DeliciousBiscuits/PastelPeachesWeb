<?php
session_start();
//Start the session
if (($_SESSION['email'] ==" ") || ($_SESSION['password'] ==" ")){
    //Redirect user back to the login page
    header("Location: ../html/user_login.html");
    exit;
}
else{
    if (isset($_SESSION['email']) || isset($_SESSION['password']))
    {
       
	//Read the values from the session	
        header("Location: user_page.php");
        exit;
    }
    else
    {
    //redirect back to login form if not authorized
    header("Location: ../html/user_login.html");
    exit;
    }
}
?>
