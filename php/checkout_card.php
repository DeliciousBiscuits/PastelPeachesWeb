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
    <link rel="icon" href="../images/peaches(1).png" />
    <script>
        function showPaypal() {
            var p = document.getElementById("paypalDiv");
            var c = document.getElementById("cardDiv");
            if (p.style.display === "none") {
                p.style.display = "block";
                c.style.display = "none";
            } else {
                p.style.display = "none";
            }
        }

        function showCard() {
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

                        <div class="row">
                            <?php

                            session_start();
                            //Capture the user inputs from the form
                            $cname = $_POST['cname']; //Read card name 
                            $cnum = $_POST['cnum']; //Read card number
                            $cnum = intval($cnum);
                            $creditcard = $_POST['creditcard']; //Read credit card type 
                            $cvv = $_POST['cvv']; //Read ccv
                            $cvv = intval($cvv);
                            $month = $_POST['month']; //Read expiry month
                            $year = $_POST['year']; //Read expiry year
                            

                            //validate needed information
                            if ($_SESSION['customerId'] == " ") {
                                echo "<p>Required customer account! Please Try Again!</p>";
                                echo '<ul class="actions" style="margin-top:3em;"><li><a href="../html/user_validation.html" class="button">Go Back</a></li></ul>';
                            } elseif (($cname == "") or ($cnum == "") or ($creditcard == "") or ($cvv == "") or ($month == "")  or ($year == "")) {
                                //Error message to the user
                                echo "<p>Required fields missing! Please Try Again!</p>";
                                echo '<ul class="actions" style="margin-top:3em;"><li><a href="javascript:history.go(-1)" class="button">Go Back</a></li></ul>';
                            } elseif (!(is_numeric($cnum)) or !(is_numeric($cvv))) {
                                //Error message to the user
                                echo "<p>Missing numbers! Please Try Again!</p>";
                                echo '<ul class="actions" style="margin-top:3em;"><li><a href="../html/user_signup.html" class="button">Go Back</a></li></ul>';
                            } else {
                                //Connect to the server and add a new record 
                                require_once('conn_peachesdb.php');
                                $cname = md5($cname);
                                $cnum = md5($cnum);
                                $cvv = md5($cvv);
                                //$key = "sdfsf";
                                //$cvv = crypt($cvv, $key);
                                $datenow = date("Y-m-d");
                                $total = $_SESSION['total']; ///get total amount
                                $customer = $_SESSION['customerId'];

                                //Define the insert query
                                $query = "INSERT INTO `order`(`customerId`,`dateCreated`,`status`,`orderTotal`) VALUES('$customer','$datenow','$details','New','$total')";
                                //echo $query;
                                //Run the query
                                mysqli_query($link, $query) or die("Unable to insert the record");

                                //save the values in session variables
                                $_SESSION['customerId'] = $customer;
                                $_SESSION['cname'] = $cname;
                                $_SESSION['cnum'] = $cnum;
                                $_SESSION['credit$creditcard'] = $creditcard;
                                $_SESSION['month'] = $month;
                                $_SESSION['year'] = $year;
                                $_SESSION['cvv'] = $cvv;

                                mysqli_close($link);
                                //Sent a thank you to the user
                                $message = "A great big thank you for shopping with us, at Pastel Peaches. <br />We love our customers dearly, and your feedback is so helpful for us to hear<br/>";

                                echo "<h3>$message</h3>";
                                echo '<ul class="actions row aln-center" style="margin-top:3em;"><li><a href="account_page.php" class="button">Proceed</a></li></ul>';
                            }
                            ?>

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
                        
                        <li>
                            <span class="opener">FAQs</span>
                            <ul>
                                <li><a href="faqs.html#Shipping">Shipping / Delivery</a></li>
                                <li><a href="faqs.html#Payments">Payments</a></li>
                                <li><a href="faqs.html#Returns">Returns / Exchanges</a></li>
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