<?php
// Database credentials
$host = "localhost"; // Change this if your host is different
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "j_market"; // Replace with your database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/* else {
    echo "Connected successfully";
}
 */
// Optional: Uncomment to confirm connection
// echo "Connected successfully";
?>
