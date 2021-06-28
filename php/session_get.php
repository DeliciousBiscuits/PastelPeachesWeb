<?php 
session_start();
echo session_id();
if (isset($_SESSION['email']) && isset($_SESSION['password'])){
    //Read the values from the session variables 
    echo "<br />Your account is: ";
    echo "<ul><li>".$_SESSION['firstname']."</li>
    <li>".$_SESSION['lastname']."</li></ul>";
    
   
    //Remove a session variable
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    //Distroy the session 
    session_destroy();
}
else 
{
    echo "<br />Please go back and set the session variables";
}
?>