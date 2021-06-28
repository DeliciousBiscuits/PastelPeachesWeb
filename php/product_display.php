<?php
     session_start();     

    if ($_SESSION['query']==" "){
        //send an invalid search message 
        echo "Sorry, We can't find what you're looking for :("; 
    }
    else{
        if (isset($_SESSION['query']))
        {
            //connect to the database
            include_once("conn_peachesdb.php");
            $query = $_SESSION['query'];
            
            $result = mysqli_query($link, $query) or die( "Sorry, We can't find what you're looking for :(");
            if (!$result || mysqli_num_rows($result) == 0){
                
                echo "Sorry, We can't find what you're looking for :(";
            }else{ 
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
            }
            //Display number of records
            echo "Number of records: ".mysqli_num_rows($result);
            mysqli_close($link);
       
        }
        else
        {
        //send an invalid search message 
        echo "Sorry, We can't find what you're looking for :(";
        }

    }
?>
       
    

