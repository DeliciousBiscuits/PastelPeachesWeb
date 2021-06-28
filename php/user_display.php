 <?php
//Needs change

// Connect to the database using connection script
include_once("conn_contactdb.php");
// Create the SQL statemnet
$query = "SELECT * FROM contacts";
// execute the SQL statement
$result = mysqli_query($link,$query);
// Read the records from the array
echo "<p><b>Database Output</b></p>";
// Loop through the result set and display each record
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    // try it with print_r($row);
    echo $row['first']."<br />".$row['last']."<br />".$row['phone']
    ."<br />".$row['mobile']."<br />".$row['fax']."<br />".$row['email']
    ."<br />".$record['web']."<br />";
}
// Display number of records 
echo "Number of records: ".mysqli_num_rows($result);
mysqli_close($link);
?>