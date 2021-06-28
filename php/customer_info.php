
<?php
//Capture the user inputs from the form
$fname = $_POST['fname']; //Read fULL name from the form
$email = $_POST['email']; //Read email from the form
$phone = $_POST['phone']; //Read tel. no. from the form 

//Validate user inputs
if (($fname == "")  or ($email == "") or ($phone == "")) {
    //Error message to the user
    echo "<p>Required fields missing! Please Try Again!</p>";
    echo '<ul class="actions" style="margin-top:3em;">
			<li><a href="../html/user_signup.html" class="button">Go Back</a></li>
             /ul>';
} elseif (!(strstr($email, "@")) or !(strstr($email, "."))) {
    //Error message to the user
    echo "<p>Missing email components! Please Try Again!</p>";
    echo '<ul class="actions" style="margin-top:3em;">
			<li><a href="../html/user_signup.html" class="button">Go Back</a></li>
            </ul>';

} elseif (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $phone)) {
    //Error message to the user
    echo "<p>Your phone number only needs numbers! Please Try Again!</p>";
    echo '<ul class="actions" style="margin-top:3em;">
			<li><a href="../html/user_signup.html" class="button">Go Back</a></li>
			</ul>';
} else {
    //Connect to the server and add a new record 
    require_once('conn_peachesdb.php');

    $query = "SELECT * FROM customer WHERE CONCAT(firstName, ' ', lastName) LIKE '%$fname%';";
    echo $query;
    //Run the query
    $result = mysqli_query($link, $query) or die("Unable to get the record");
    
    if (mysqli_num_rows($result) == 1) {
        //if authorized, get the values of firstname lastname, phone and email
     $row = $result->fetch_array();
     $firstname = $row['firstName'];
     $lastname = $row['lastName'];
     $id = $row['customerId'];

    session_start();
    //save the values in session variables
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['fname'] = $fname;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['customerId'] = $id;
    
    mysqli_close($link);
    echo "<h3 style='position: relative;left: 50%;margin-left:-130px;'>Registered Successfully!!!! </h3>";
    header("Location:checkout_payment.php");
    exit();
    }
}
?>