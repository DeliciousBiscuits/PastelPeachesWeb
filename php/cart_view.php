
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
		<!--<script>
			//AJAX REQ
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4  && this.status == 200) {
					document.getElementById('cart').innerHTML = this.responseText;
				} 
			}       
			xmlhttp.open("GET","../php/cart_view.php",true);
			xmlhttp.send();
		</script>-->		
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
											<h2>Shopping Cart<br /></h2>
										</header>
                                        <?php
                                            session_start();
                                            require_once('conn_peachesdb.php');
                                         

                                            $status="";
                                            if (isset($_POST['action']) && $_POST['action']=='remove'){
                                                if(!empty($_SESSION["shopping_cart"])) {
                                                    foreach($_SESSION["shopping_cart"] as $key => $value) {
                                                        if($_POST['id'] == $key){
                                                            unset($_SESSION["shopping_cart"][$key]);
                                                      
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
                                                        $product['qty'] = $value['qty'];
                                                        break; // Stop the loop after we've found the product
                                                    }
                                                }

                                            }
                                            if (isset($_POST['action']) && $_POST['action']=="clear"){
                                                if(!empty($_SESSION["shopping_cart"])) {
                                                    foreach($_SESSION["shopping_cart"] as $key => $value) {
                                                        unset($_SESSION["shopping_cart"][$key]);
                                                  
                                                        
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
											?>
											<!--Shopping Cart Items Table-->
                                            <div class="col-6 col-12-small table-wrapper">
                                                <table  class="alttwo">
                                                    <thead><tr>
                                                        <th>Product</th><th></th>
                                                        <th>Price</th><th>Quantity</th>
                                                    </tr></thead>
                                                    <?php foreach ($_SESSION["shopping_cart"] as $product){ ?>
                                                    <tr><td><br/><img style="width:115px;height:110px;position:relative;left:5px;right:5px;" src="<?php echo $product['image']; ?>" /></td>
                                                    <td><strong><?php echo $product['name']; ?><br /></strong>
                                                        <form method='post' action=''>
                                                        <input type='hidden' name='id' value="<?php echo $product['id'];?>" />
                                                        <input type='hidden' name='action' value='remove'/>
                                                        <br /><br />
                                                        <h6><input type='submit' value='remove'></h6>
                                                        </form></td>
                                                    <td><?php echo number_format((float)$product['price'], 2,'.',''); ?></td>
                                                    <td><form method='post' action=''>
                                                    <input type='hidden' name='id' value="<?php echo $product['id'];?>" />
                                                    <input type='hidden' name='action' value='change'/>
                                                    <select name='qty' class='quantity' onChange=this.form.submit()>               
                                                        <option <?php if($product['qty']==1) echo "selected ";?>value="1">1</option>
                                                        <option <?php if($product['qty']==2) echo "selected ";?>value="2">2</option>
                                                        <option <?php if($product['qty']==3) echo "selected ";?>value="3">3</option>
                                                        <option <?php if($product['qty']==4) echo "selected ";?>value="4">4</option>
                                                        <option <?php if($product['qty']==5) echo "selected ";?>value="5">5</option> 
                                                    </select>
                                                    </form>
                                                    </td></tr>
													<?php 
													$subtotal += ($product["price"]*$product['qty']); 
													$counter++;   
                                                    }
                                                    ?>
                                                    </tbody><tfoot><tr>
													<td colspan=3>
															<ul class="actions small">
															<li><input onclick="history.go(-1);" type="button" value='Go back' class="button small"></li>
                                                   			<li><form method='post' action=''><input type='hidden' name='action' value='clear'/>
															<input type='submit' value='clear cart' class="butt	on small"></form></li>
														</ul></td>
													<td><?php echo "$ ".$subtotal; $_SESSION['subtotal'] = $subtotal; ?></td><tr></tfoot>
													</table></div>
													<!--Shopping Cart Subtotal and Checkout button-->
                                                    <div class='col-6 col-12-small'>
                                                        <h2>Subtotal: <?php echo $subtotal; ?> AUD</h2>
                                                            <ul class='actions fit' style='margin-top:1em;'><li><form method="post" action="checkout.php">
															<input  name='checkout' value='Checkout' type="submit" class='button primary fit'>
															</form></li></ul>
                                                        <h5>before taxes and shipping costs</h5>
                                                    </div>
                                                    
												   <?php 
												   
                                                } else{
                                                    echo "<h3>Your cart is empty!</h3>";
                                                }?>
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

	</body>
</html>