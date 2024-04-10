


<?php
// Database credentials
$servername = "localhost"; // Change this to your MySQL server hostname if it's different
$username = "root"; // Change this to your MySQL username
$password = "your_password"; // Change this to your MySQL password
$database = "place"; // Change this to your MySQL database name

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo "Connected successfully"; // You can remove this line after testing the connection
}
?>
