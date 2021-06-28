
<!DOCTYPE HTML>
<!--
	Developer: Kizzie Mae Martinez 
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="en">
	<head>
		<title>Pastel Peaches</title> 
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="icon" href="../images/peaches(1).png"/>
       	
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="../index.html" class="logo"><img id="peach" src="../images/peach(2).png" alt="website logo"><strong>Pastel Peaches</strong></a>
									<ul class="icons">
										<li><a href="https://twitter.com" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="https://facebook.com" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="https://instagram.com" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="user_validation.php" class="icon solid fa-user"><span class="label">User Account</span></a></li>
										<li><a href="cart_view.php" class="icon solid fa-shopping-bag"><span class="label">Tote bag</span></a></li> 
									
									</ul>
								</header>

							<!-- Banner -->
								
								<section id="banner">
									<div class="content">

										<header>
											<h2>Checkout / Payment<br /></h2>
										</header>
                                        <?php
                                            session_start();
                                            require_once('conn_peachesdb.php');
                                            //$query = "SELECT * FROM product WHERE productName=$name";
                                            //$result = mysqli_query($link,$query) or die("Database Error");
                                            //$row = $result->fetch_assoc();

                                            $status="";
                                            if (isset($_POST['action']) && $_POST['action']=='remove'){
                                                if(!empty($_SESSION["shopping_cart"])) {
                                                    foreach($_SESSION["shopping_cart"] as $key => $value) {
                                                        if($_POST['id'] == $key){
                                                            unset($_SESSION["shopping_cart"][$key]);
                                                            $status = "<div class='box' style='color:red;'>
                                                            Product is removed from your cart!</div>";
                                                        }
                                                        if(empty($_SESSION["shopping_cart"]))
                                                            unset($_SESSION["shopping_cart"]);
                                                    } 
                                                }
                                            }

                                            if (isset($_POST['action']) && $_POST['action']=="change"){
                                                foreach($_SESSION["shopping_cart"] as &$value){
                                                    if($value['id'] === $_POST['id']){
                                                        $value['qty'] = $_POST['qty'];
                                                        //$product['qty'] = $value['qty'];
                                                        break; // Stop the loop after we've found the product
                                                    }
                                                }

                                            }
                                            if (isset($_POST['action']) && $_POST['action']=="clear"){
                                                if(!empty($_SESSION["shopping_cart"])) {
                                                    foreach($_SESSION["shopping_cart"] as $key => $value) {
                                                        unset($_SESSION["shopping_cart"][$key]);
                                                        $status = "<div class='box' style='color:red;'>
                                                        Product is removed from your cart!</div>";
                                                        
                                                        if(empty($_SESSION["shopping_cart"])){
                                                            unset($_SESSION["shopping_cart"]);}
                                                    } 
                                                }

                                            }
                                        ?>
                                        <div id="cart" class="row">	
                                            <?php
                                            if(isset($_SESSION["shopping_cart"])){
											$subtotal = 0;
                                            $counter = 0;
                                            $total = 0;
                                            $shippingfee = 8.95;//Australian standard shippping fee
                                            $gsttax = 0.0909090909; //GST Rate:  10% or 1/11 of the amount of charge 
                                            $gst = 0; 
                                            ?>
                                            <div class="col-4 col-12-small table-wrapper">
                                                <table class="alt" >
                                                    <thead><tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                    </tr></thead>
                                                    <?php foreach ($_SESSION["shopping_cart"] as $product){ ?>
                                                    <tr><td><br/><img style="width:50px;height:50px;position:relative;left:5px;right:5px;margin-right:10px;" src="<?php echo $product['image']; ?>" />
                                                    <strong><?php echo $product['name']; ?><br /></strong>
                                                    </td>
                                                    
                                                    <td><?php 
                                                    $product['linetotal'] = ($product["price"]*$product['qty']);
                                                    echo number_format((float)$product['linetotal'], 2,'.',''); 
                                                    ?></td>
                                                   </tr>
                                                    <?php 
													$subtotal += ($product["price"]*$product['qty']); 
													$counter++;   
                                                    }   
                                                    $gst = round($subtotal * $gsttax,2); 
                                                    $total = $subtotal + $gst;                                               
                                                    ?>
                                                    </tbody><tfoot>
                                                    <tr><td><b>Subtotal: </b></td>
													<td><?php echo "$ ".$subtotal; ?></td><tr>
                                                    <tr><td><b>GST amount (10%): </b></td>
                                                    <td><?php echo "$ ".$gst; ?></td></tr>
                                                    <tr><td><b>Shipping: </b></td>
                                                    <td><?php echo "$ ".$shippingfee; ?></td></tr>
                                                    <tr><td><b>Total: </b></td>
                                                    <td><?php echo "$ ".$total; ?></td></tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        

												<?php 
												   $_SESSION['total'] = $total;
                                                } else{
                                                    echo "<h3>Your cart is empty!</h3>";
                                                }?>
                                                <!--Information div -->
                                                
                                                <div id="information" class='col-6 col-12-small'>
                                                    <header>
                                                        <h4>Information<br /></h4>
                                                    </header>
                                                        <form method="post" action="customer_info.php"  autocomplete="on">
                                                        <label for="fname"><i class="icon solid fa-user"></i> Full Name</label>
                                                            <input type="text" id="fname" name="fname" placeholder="John M. Doe">
                                                            <span id="errorfname"></span>
                                                            <label for="email"><i class="icon solid fa-envelope"></i> Email</label>
                                                            <input type="text" id="email" name="email" placeholder="john@example.com">
                                                            <span id="erroremail"></span>
                                                            <label for="phone"><i class="icon solid fa-phone"></i> Phone No</label>
                                                            <input type="text" id="phone" name="phone" placeholder="(000)-000-0000">
                                                            <span id="errorphone"></span>
                                                            <br />
                                                            <!--Billing Address / Shipping Address-->
                                                            <h4>Billing Address<br /></h4>
                                                            <label for="adr"><i class="icon solid fa-address-card-o"></i> Address</label>
                                                            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                                                            <span id="erroraddrs"></span>
                                                            <label for="city"><i class="icon solid fa-institution"></i> City</label>
                                                            <input type="text" id="city" name="city" placeholder="New York">
                                                            <span id="errorcity"></span>
                                                            <label for="state">State</label>
                                                            <input type="text" id="state" name="state" placeholder="NY">
                                                            <span id="errorstate"></span>
                                                            <label for="zip">Zip</label>
                                                            <input type="text" id="zip" name="zip" placeholder="10001">
                                                            <span id="errorpcode"></span>
                                                           
                                                            <input type="checkbox" checked="checked" name="sameadr"> <label>Shipping address same as billing</label>
                                                            <ul class="actions stacked">
                                                            <li><input type="submit" value="Submit" onClick="submitForm()" class='button primary fit'></li>
                                                            </ul> 
                                                        </form>
                                                </div>                                              
                                                
                                            </div>               
                                </div>
							</section>   
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="product_search.php">
										<input type="text" name="query" id="query" placeholder="Search" />
									</form>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="../index.html">Homepage</a></li>
										<li><a href="user_validation.php">Account</a></li>
										<li>
											<span class="opener">Jewellery</span>
											<ul>
												<li><a href="../html/products_earring.html">Earrings</a></li>
											<li><a href="../html/products_necklace.html">Necklaces</a></li>
											<li><a href="../html/products_ring.html">Rings</a></li>
											<li><a href="../html/products_choker.html">Choker</a></li>
											</ul>
										</li>
										<li>
											<span class="opener">Headwear</span>
											<ul>
												<li><a href="../html/products_glasses.html">Glasses</a></li>
												<li><a href="../html/products_hat.html">Hats</a></li>
											</ul>
										</li>
										<li><a href="../html/products_bag.html">Bags</a></li>
										<li><a href="../html/products_gift.html">Novelty Gifts</a></li>
										
										<!--<li>
											<span class="opener">FAQs</span>
											<ul>
												<li><a href="faqs.html#Shipping">Shipping / Delivery</a></li>
												<li><a href="faqs.html#Payments">Payments</a></li>
												<li><a href="faqs.html#Returns">Returns / Exchanges</a></li>
											</ul>
										</li>
												-->
										<li><p>
                                            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                                                <img style="border:0;width:88px;height:31px"
                                                    src="http://jigsaw.w3.org/css-validator/images/vcss"
                                                    alt="Valid CSS!" />
                                            </a>
                                        </p></li>
									</ul>
								</nav>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Get in touch</h2>
									</header>
									<p>Do you have any questions? Please get in touch with us at any time and we'll be happy to assist you</p>
									<ul class="contact">
										<li class="icon solid fa-envelope"><a href="#">pastelpeaches@gmail.com</a></li>
										<li class="icon solid fa-phone">(000) 000-0000</li>
										<li class="icon solid fa-home">1234 Somewhere Road #8254<br />
										Adelaide SA, TN 00000-0000</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; 2020 Copyright. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
            <script src="../assets/js/main.js"></script>
            <script src="../assets/js/formvalidation.js"></script>                                               

	</body>
</html>