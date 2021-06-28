<?php


include_once("conn_peachesdb.php"); 
$q = $_REQUEST['q'];
switch ($q){
    case 'earrings':
        $query = "SELECT * FROM product WHERE categoryId='01'";
        break;
    case 'necklaces':
        $query = "SELECT * FROM product WHERE categoryId='02'";
    break;
    case 'rings':
        $query = "SELECT * FROM product WHERE categoryId='03'";
    break;
    case 'chokers':
        $query = "SELECT * FROM product WHERE categoryId='04'";
    break;
    case 'glasses':
        $query = "SELECT * FROM product WHERE categoryId='05'";
    break;
    case 'hats':
        $query = "SELECT * FROM product WHERE categoryId='06'";
    break;
    case 'bags':
        $query = "SELECT * FROM product WHERE categoryId='07'";
    break;
    case 'gifts':
        $query = "SELECT * FROM product WHERE categoryId='08'";
    break;
    default:
        echo "request invalid";        
    break;
}

//Execute the SQL statement
$result = mysqli_query($link, $query);
                                            
//Loop through the result set and display each record 
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<div class='col-4 col-12-medium' style='text-align:center;'>
        <a class='posts article image fit'><img src=".$row['image']." alt=".$row['productName']." /></a>
        <h3>".$row['productName']." $".number_format((float)$row['price'], 2,'.','')."</h3>";
    echo "<ul style='display:inline-block;' class='actions'><li>
    <form method='post' action='../php/cart_add.php'>
    <input type='hidden' name='id' value=".$row["productId"]." />
    <input onClick='addToCart(this.id)' type='submit' id=".$row['productName']." class='button' value='Add to Cart'/>
    </form></li></ul></div>";
}
if (mysqli_num_rows($result) == 1) {
//if authorized, get the values of firstname lastname, phone and email
$row = $result->fetch_array();
$firstname = $row['firstName'];
$lastname = $row['lastName'];
$username = $row['userName'];
$email = $row['email'];
$password = $row['password'];
$phone = $row['phone'];
 
//save the values in session variables
$_SESSION['firstname'] = $firstname;
$_SESSION['lastname'] = $lastname;
$_SESSION['username'] = $username;
$_SESSION['phone'] = $phone;
$_SESSION['email'] = $email;
$_SESSION['password'] =$password;

}
//Display number of records
echo "Number of records: ".mysqli_num_rows($result);
mysqli_close($link);

?>