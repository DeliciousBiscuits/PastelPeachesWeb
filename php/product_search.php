<?php
$q = $_POST['query'];

if ($q !== " "){
    session_start();
    $q = strtolower($q);   
    $query = "SELECT * FROM product WHERE `productName` LIKE CONCAT('%','$q','%') OR `description` LIKE CONCAT('%','$q','%');";
    $_SESSION['query'] = $query;
    //Redirect to the html page where it shows the result
    header("Location: ../html/products_search.html");
    exit();
}else{
    header("Location: ../html/products_search.html");
    exit();
}

?>