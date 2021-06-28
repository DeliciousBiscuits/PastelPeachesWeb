<?php
session_start();
require_once('conn_peachesdb.php');
$status="";
//$_POST['name'] = $_REQUEST['q'];
if (isset($_POST['id']) && $_POST['id']!=""){
$id = $_POST['id'];

$query = "SELECT * FROM product WHERE productId=$id";
//echo $query;
$result = mysqli_query($link,$query) or die("Database Error");

	if(mysqli_num_rows($result) == 1){
		$row = $result->fetch_assoc();
		$name = $row['productName'];
		$id = $row['productId'];	
		$price = $row['price'];
		$image = $row['image'];
		$qty = 1;

		$cartArray = array(
		$id=>array(
		'name'=>$name,
		'id'=>$id,
		'price'=>$price,
		'qty'=>$qty,
		'image'=>$image)
		);
	}

	if(empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        echo $status = "<div class='box'>Product is added to your cart!</div>";
    }else{
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if(in_array($id,$array_keys)) {
    	$status = "<div class='box' style='color:red;'>
    	Product is already added to your cart!</div>"; 
        } else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
        	$status = "<div class='box'>Product is added to your cart!</div>";
        }
 
	}
	mysqli_close($link);
	header("Location: cart_view.php");
	exit();
}else{
	header("Location: index.html");
	exit();
}

/*
//Start the session
session_start();
include 'cart.php';

//get the item_id and the quantity
$item_name=$_REQUEST['q'];
$item_name = urldecode($item_name);
$cart = new Cart();
$counter=0;


//Check whether there is a active session
if (isset($_SESSION['counter'])){
	//Read from session for the counter and the cart
	// store number of items in the shopping cart
	$counter = $_SESSION['counter'];
	$cart = unserialize($_SESSION['cart']);
}  
else {
	//Otherwise set a session for the counter and the cart
	$_SESSION['counter'] = 0;
	$_SESSION['cart'] = "";
}

if (!isset($_REQUEST['q']))
{
  	header("Location: ../html/products_bag.php");
   exit;
}
else
{
	//connect to server and select database
	require_once('conn_peachesdb.php');
	//Create a select query to retrive the selected product 		
	$query="SELECT productId, price from product WHERE (productName = $item_name)";
	echo $query;
    //Run the mysql query
	$result= mysqli_query($link, $query) or die("Database Error");
	
    //If there is a matching recored select item_name, price
	if(mysqli_num_rows($result) == 1){
		$row = $result->fetch_assoc();

		$item_id = $row['productId'];
		$price = $row['price'];
		$qty = 1;

		//$currentQty = $_SESSION['cart'][$item_name]['qty']+1; //Incrementing the product qty in cart
        //$_SESSION['cart'][$item_name] =array('qty'=>$currentQty,'name'=>$row['productName'],'image'=>$row['image'],'price'=>$row['price']);
        //$product='';
		//add items to the cart
		$new_item = new Item($item_id, $item_name, $qty, $price);
		$cart->add_item($new_item);
		
		//update the counter
		$_SESSION['counter'] = $counter + 1;
		//Convert the cart to  a text object and store in a session
		$_SESSION['cart'] = serialize($cart);
		header("Location: ../html/cart.html");
    	mysqli_close($link);
    }
    else
    {
		//Redirect to back to the product page\
		
		header("Location: ../html/products_hats.html");
		exit;
	}
	
}*/

?>