<?php
// Assuming you already have a database connection established

// Include your database connection file
include 'connect2.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ticket = $_POST['ticket'];
    $quantity = $_POST['quantity'];
    $destination = $_POST['destination'];

    // Prepare SQL statement to insert data into the 'order' table
    $sql = "INSERT INTO `order` (ticket, quantity, destination) VALUES (?, ?, ?)";

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Bind parameters to the prepared statement as strings
        $stmt->bind_param("sis", $ticket, $quantity, $destination);
        
        // Execute the prepared statement
        $result = $stmt->execute();

        if($result){
           // Data inserted successfully
           echo "Order placed successfully.";
        } else {
            echo "Error: " . $stmt->error; // Display error if execution fails
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Error: " . $con->error; // Display error if preparing fails
    }

    // Close database connection
    $con->close();
}
?>
