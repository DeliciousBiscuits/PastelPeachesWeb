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
		<link rel="icon" href="../images/peach(2).png"/>
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
										<li><a href="../html/cart.html" class="icon solid fa-shopping-bag"><span class="label">Tote bag</span></a></li> 
									
									</ul>
								</header>

							<!-- Banner -->
								
								<section id="banner">
									<div class="content">            
										<header style="position: relative;left: 50%;margin-left:-50px;">
											<h2>Login<br /></h2>
										</header>
										<?php
											//start the new session
											session_start();
											//Read the email and the password
											$email= $_POST['email'];
											$password=$_POST['password'];
											if (($email==" ") || ($password==" ")) {
   												//Redirect user back to the login page
												header("Location: ../html/user_login.html");
												exit;
											}
											else{   
												//connect to server and select database
												require_once('conn_peachesdb.php');
												$password = md5($password);
												$password = mb_strimwidth($password, 0, 200);
												//Create a select query to select user details using the email and the password
												$query = "SELECT * from customer WHERE (email ='$email') AND (password = '$password');";
												
												$result = mysqli_query($link, $query) or die( "Invalid Customer ID or Password");

												//get the number of rows in the result set; should be 1 if a match
												if (mysqli_num_rows($result) == 1) {
   													//if authorized, get the values of firstname lastname, phone and email
													$row = $result->fetch_array();
													$firstname = $row['firstName'];
													$lastname = $row['lastName'];
													$username = $row['userName'];
													$email = $row['email'];
													$password = $row['password'];
													$phone = $row['phone'];
													$id = $row['customerId'];

													//save the values in session variables
													$_SESSION['firstname'] = $firstname;
													$_SESSION['lastname'] = $lastname;
													$_SESSION['username'] = $username;
													$_SESSION['phone'] = $phone;
													$_SESSION['email'] = $email;
													$_SESSION['password'] =$password;
													$_SESSION['customerId'] = $id;
													mysqli_close($link);
													echo"<h3> Login Successful!!! </h3>";
													echo '<ul class="actions row aln-center" style="margin-top:3em;">
														
															<li><a href="user_page.php" class="button">Proceed to Account Page</a></li>
                                        			</ul>';
												}
												else
												{
													//Redirect user back to the login page
													header("Location: ../html/user_login.html#");
													exit();
												}
											}
										?>

                                        
                               
								</div> 
								</section>
								<div class="content" style="text-align:center;display:block;">
									<img style="width:20em;" src="../Images/peaches(3).png">
								</div>
                                
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
												<li><a href="products_earring.php">Earrings</a></li>
												<li><a href="products_necklace.php">Necklaces</a></li>
												<li><a href="products_ring.php">Rings</a></li>
												<li><a href="products_choker.php">Choker</a></li>
											</ul>
										</li>
										<li>
											<span class="opener">Headwear</span>
											<ul>
												<li><a href="products_glasses.php">Glasses</a></li>
												<li><a href="products_hat.php">Hats</a></li>
											</ul>
										</li>
										<li><a href="../html/products_bag.html">Bags</a></li>
										<li><a href="products_gift.php">Novelty Gifts</a></li>
										<li><a href="../html/about.html">About</a></li>
										<li>
											<span class="opener">FAQs</span>
											<ul>
												<li><a href="../html/faqs.html#Shipping">Shipping / Delivery</a></li>
												<li><a href="../html/faqs.html#Payments">Payments</a></li>
												<li><a href="../html/faqs.html#Returns">Returns / Exchanges</a></li>
											</ul>
										</li>
										<li><p>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
</p></li>
									</ul>
								</nav>
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
