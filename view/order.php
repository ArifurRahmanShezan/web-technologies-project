<?php
session_start();
require '../model/db.php';

// Check if the user is logged in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance of the myDB class
    $db = new myDB();
    
    // Get the customer ID from session
    $c_id = $_SESSION['id'];  // Customer ID from session
    $pr_id = $_POST['pr_id'];  // Product ID from POST request
    $quantity = $_POST['quantity'];
    $card_number = $_POST['card_number'];
    
    // Initialize the order status
    $status = "Pending";
    
    // Open the database connection
    $conn = $db->openCon();
    
    // Get the product price
    $sql = "SELECT p_price FROM product WHERE pr_id = '$pr_id'";
    $result = $conn->query($sql);
    $total_price = 0;

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $p_price = $row['p_price'];  // Fetch product price
        // Calculate total price
        $total_price = $quantity * $p_price;
    } else {
        echo "Product not found.";
    }

    // Insert order into the database
    $sql = "INSERT INTO order_table (c_id, pr_id, quantity, card_number, amount, status) 
            VALUES ('$c_id', '$pr_id', '$quantity', '$card_number', '$total_price', '$status')";

    if ($conn->query($sql)) {
        echo "<script>alert('Payment Successful! Your order is placed.');</script>";
        header("Location: ../view/dashboard.php");
    } else {
        echo "<script>alert('Error placing order: " . $conn->error . "');</script>";
    }

    // Close the database connection
    $db->closeCon($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Payment</title>
    
</head>
<body class="orders">

<div class="payment-container">
    <h2>Payment</h2>
    <form method="POST" action="">
        <input type="hidden" name="pr_id" value="1"> <!-- Replace with dynamic product ID -->
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" class="form-input" required min="1">

        <h3>Card Details</h3>
        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" class="form-input" required>

        <label for="exp_date">Expiry Date (MM/YY):</label>
        <input type="text" name="exp_date" class="form-input" required>

        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" class="form-input" required>

        <button type="submit" name="order" class="form-btn">Complete Payment</button>
    </form>
</div>

</body>
</html>
