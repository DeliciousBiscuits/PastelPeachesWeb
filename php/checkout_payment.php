
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
        <script>
            
			function showPaypal(){
                var p = document.getElementById("paypalDiv");
                var c = document.getElementById("cardDiv");
                if (p.style.display === "none") {
                    p.style.display = "block";
                    c.style.display = "none";
                    //AJAX REQ
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4  && this.status == 200) {
                            document.getElementById('paypalDiv').innerHTML = this.responseText;
                        } 
                    }
                    xmlhttp.open("GET","paypal_test.php",true);
                    xmlhttp.send();
                } else {
                    p.style.display = "none";
                }
            }
            function showCard(){
                var p = document.getElementById("paypalDiv");
                var c = document.getElementById("cardDiv");
                if (c.style.display === "none") {
                    c.style.display = "block";
                    p.style.display = "none";
                } else {
                    c.style.display = "none";
                }
            }

           
            
		</script>		
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
                                            $fname = $_SESSION['fname'];
                                            $cust = $_SESSION['customerId'];
                                            $_SESSION['customerId'] = $cust;
                                            
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
                                                    $products = array();
                                                   $_SESSION['total'] = $total;
                                                   array_push($products,$product['name']);
                                                   
                                                } else{
                                                    echo "<h3>Your cart is empty!</h3>";
                                                }
                                                $_SESSION['products'] = implode(', ',$products);
                                                ?>
                                            
                                                
                                                    <!-- Paypal API -->
                                                <div class="col-7 col-12-small">
                                                    <!-- Payment methods -->
                                                
                                                    <header>
                                                        <h4>Payment<br /></h4>
                                                        <h3>Hello <?php echo $fname;?>! Please select a payment method<br /></h3>
                                                        <h5>Customer No:<?php echo $cust;?><br /></h5>
                                                    </header>
                                                    <ul class="actions stacked">
                                                        <li><input id='paypal' value='Paypal' type="button" class='button primary fit' onClick="showPaypal()"></li>
                                                        <li><input id='card' value='Debit / Credit Card' type="button" class='button primary fit'  onClick="showCard()"></li>
                                                    </ul>     
                                                
                                                
                                                    <div id="paypalDiv" class='col-6 col-12-small box' style="display:none;">
                                                        
                                                    </div>
                                                   
                                                    <div id="cardDiv" class='col-6 col-12-small box' style="display:none;">
                                                    
                                                        <h3>Pay By Card</h3>
                                                        <div>
                                                        <i class="icon brands fa-cc-visa" style="color:navy;"></i>
                                                        <i class="icon brands fa-cc-amex" style="color:blue;"></i>
                                                        <i class="icon brands fa-cc-mastercard" style="color:red;"></i>
                                                        <i class="icon brands fa-cc-discover" style="color:orange;"></i>
                                                        </div>
                                                        <form action="checkout_card.php" method="post" autocomplete="on">
                                                            <!--Name on Card -->
                                                            <p><label>Name on Card:</label> <input type="text" id="cname" name="cname"size="20" value="" onfocus="inputOnFocus(this)" onchange="onForm(this)" placeholder="John More Doe"/></p>
                                                            <span id="errorcname"></span>
                                                             <!--Textbox for card number-->   
                                                             <p><label>card number</label> <input type="text" id="cnum" name="cnum" size="20" value="" onfocus="inputOnFocus(this)"  onchange="onForm(this)" placeholder="1111-2222-3333-4444"/></p>
                                                            <span id="errorcnum"></span>
                                                            <!--Drop down list for the credit card-->
                                                            <label>credit card</label>
                                                            <select id="creditcard" name="creditcard" name="payment type" onfocus="inputOnFocus(this)"  onchange="onForm(this)">
                                                                <option value="0">Select a payment type </option>
                                                                <option value="commbank">Commonwealth Bank</option> 
                                                                <option value="westpac">Westpac</option> 
                                                                <option value="anz">ANZ</option> 
                                                                <option value="nab">NAB</option>
                                                                <option value="citi">Citi</option>
                                                                <option value="latitude">Latitude Financial Services</option>
                                                                <option value="coleswes">Coles and Wesfarmers</option>
                                                                <option value="americanexp">American Express</option> 
                                                                </select>
                                                                <br />
                                                                <span id="errorcred"></span> 
                                                            <!--Textbox for CCV-->
                                                            <label>CCV</label> <input type="text" name="cvv" id="cvv" size="20" value="" onfocus="inputOnFocus(this)"  onchange="onForm(this)" placeholder="352"/></p>
                                                            <span id="errorccv"></span>

                                                            <label>Expiry MM/YY</label> 
                                                            <!--Drop down list for month-->
                                                            <select id="month" name="month" value="" onfocus="inputOnFocus(this)" onchange="onForm(this)"  style="width:100px;"></select>
                                                            <!--Drop down list for year-->
                                                            <select id="year" name="year" value="" onfocus="inputOnFocus(this)" onchange="onForm(this)"  style="width:100px;"></select></p>
                                                            <span id="errordate"></span>
                                                        
                                                       <input type="submit" value="Submit" class='button primary fit'>    
                                                       </form>
                                                    </div>   
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