<?php
// Modify this line according to your MySQL configuration
$con = new mysqli('localhost', 'root', '', 'tickets');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo "welocome";
}
?>