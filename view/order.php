<?php
session_start();
require '../model/db.php';

$errors = [
    "quantity" => "",
    "card_number" => "",
    "exp_date" => "",
    "cvv" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new myDB();
    
    $c_id = $_SESSION['id'];  
    $pr_id = $_POST['pr_id'];  
    $quantity = $_POST['quantity'];
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];
    
    $status = "Pending";
    $hasError = false;

    // PHP Validation
    if (!is_numeric($quantity) || $quantity < 1) {
        $errors["quantity"] = "Invalid quantity.";
        $hasError = true;
    }

    if (!preg_match("/^\d{13,19}$/", $card_number)) {
        $errors["card_number"] = "Invalid card number. It must be between 13 and 19 digits.";
        $hasError = true;
    }

    if (!preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $exp_date)) {
        $errors["exp_date"] = "Invalid expiry date format. Use MM/YY.";
        $hasError = true;
    }

    if (!preg_match("/^\d{3,4}$/", $cvv)) {
        $errors["cvv"] = "Invalid CVV. It must be 3 or 4 digits.";
        $hasError = true;
    }

    if (!$hasError) {
        $conn = $db->openCon();
        
        $stmt = $conn->prepare("SELECT p_price FROM product WHERE pr_id = ?");
        $stmt->bind_param("i", $pr_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_price = 0;

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $p_price = $row['p_price'];
            $total_price = $quantity * $p_price;
        } else {
            $errors["quantity"] = "Product not found.";
            $hasError = true;
        }
        $stmt->close();

        if (!$hasError) {
            $stmt = $conn->prepare("INSERT INTO order_table (c_id, pr_id, quantity, card_number, amount, status) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiisis", $c_id, $pr_id, $quantity, $card_number, $total_price, $status);

            if ($stmt->execute()) {
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                $errors["quantity"] = "Error placing order: " . $conn->error;
            }
            $stmt->close();
        }

        $db->closeCon($conn);
    }
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
        <input type="number" name="quantity" class="form-input" value="<?php echo isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : ''; ?>">
        <div class="error-message"><?php echo $errors["quantity"]; ?></div>

        <h3>Card Details</h3>
        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" class="form-input" value="<?php echo isset($_POST['card_number']) ? htmlspecialchars($_POST['card_number']) : ''; ?>">
        <div class="error-message"><?php echo $errors["card_number"]; ?></div>

        <label for="exp_date">Expiry Date (MM/YY):</label>
        <input type="text" name="exp_date" class="form-input" value="<?php echo isset($_POST['exp_date']) ? htmlspecialchars($_POST['exp_date']) : ''; ?>">
        <div class="error-message"><?php echo $errors["exp_date"]; ?></div>

        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" class="form-input" value="<?php echo isset($_POST['cvv']) ? htmlspecialchars($_POST['cvv']) : ''; ?>">
        <div class="error-message"><?php echo $errors["cvv"]; ?></div>

        <button type="submit" name="order" class="form-btn">Complete Payment</button>
        <a href="dashboard.php">Back</a>
    </form>
</div>

</body>
</html>
