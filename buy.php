<?php
session_start(); // Start the session

// Database credentials
$servername = "localhost"; // Change this to your MySQL server hostname if it's different
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password if applicable
$database = "place"; // Change this to your MySQL database name

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if form is submitted and session variable is not set
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['form_submitted'])) {
    // Set session variable to indicate that form is submitted
    $_SESSION['form_submitted'] = true;

    // Retrieve form data
    $ticket = $_POST['ticket'];
    $quantity = $_POST['quantity'];
    $destination = $_POST['destination'];

    // Map ticket types to their corresponding values
    $ticket_values = array(
        "economy" => "Economy",
        "business" => "Business",
        "first class" => "First Class",
        "premium economy" => "Premium Economy",
    );

    // Check if the selected ticket type exists in the mapping
    if (array_key_exists($ticket, $ticket_values)) {
        // Get the value corresponding to the selected ticket type
        $ticket_value = $ticket_values[$ticket];

        // Prepare SQL statement to insert data into the 'order' table
        $sql = "INSERT INTO `order` (ticket, quantity, destination) VALUES (?, ?, ?)";

        // Prepare the SQL statement to avoid SQL injection
        $stmt = $con->prepare($sql);

        if ($stmt) {
            // Bind parameters to the prepared statement as strings
            $stmt->bind_param("sis", $ticket_value, $quantity, $destination);
            
            // Execute the prepared statement
            $result = $stmt->execute();

            if($result){
               // Data inserted successfully
               echo "Order placed successfully and the prize is $1000.";
            } else {
                echo "Error: " . $stmt->error; // Display error if execution fails
            }
            
            // Close statement
            $stmt->close();
        } else {
            echo "Error: " . $con->error; // Display error if preparing fails
        }
    } else {
        echo "Invalid ticket type selected.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="buy.css" />
    <title>Ticket Purchase</title>
</head>
<body>
    <h1>Buy Tickets</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="ticket">Ticket:</label>
        <select name="ticket" id="ticket">
            <option value=""></option>
            <option value="economy">Economy </option>
            <option value="business">Business</option>
            <option value="first class">First Class</option>
            <option value="premium economy">Premium Economy</option>
            <!-- Add more options as needed -->
        </select><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" value="1"><br><br>
        <label for="destination">Destination(AIRPORT NAME ):</label>
        <input type="text" name="destination" id="destination"><br><br>
        <input type="submit" value="Buy Ticket">
    </form>
</body>
</html>

<?php
// Close database connection
$con->close();

// Unset the session variable to allow form submission again
unset($_SESSION['form_submitted']);
?>
