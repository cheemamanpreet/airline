<?php

include 'connect.php';

if(isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM buy WHERE id=$id"; 
    $result = mysqli_query($con, $sql);
    if($result) {
       // echo "Deleted successfully"; 
       header('location:display.php');
    } else {
        die("Connection failed: " . $con->connect_error);
    }
}

?>