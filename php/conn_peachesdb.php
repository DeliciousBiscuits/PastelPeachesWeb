<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "peachesdb";
//connect to the server
$link = @mysqli_connect($server, $user, $pass, $database)
        or die("SQL Error ");
?>