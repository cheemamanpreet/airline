<?php
// Function to calculate total price
function calculateTotalPrice($class, $quantity) {
    $ticketPrices = [
        "economy" => 200,
        "business" => 500,
        "first" => 1000
    ];

    if (isset($ticketPrices[$class])) {
        $pricePerTicket = $ticketPrices[$class];
        return $pricePerTicket * $quantity;
    } else {
        return 0; // Invalid ticket class
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedClass = $_POST["class"];
    $selectedQuantity = intval($POST["quantity" . $selectedClass]);
    
    // Calculate total price
    $totalPrice = calculateTotalPrice($selectedClass, $selectedQuantity);
    
    // Redirect to a confirmation page or do further processing
    header("Location: confirmation.php?class=$selectedClass&quantity=$selectedQuantity&total=$totalPrice");
    exit();
}
?>