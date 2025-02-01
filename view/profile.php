<?php
session_start();
require '../model/db.php';

// Create an instance of the myDB class
$db = new myDB();

// Open the database connection
$conn = $db->openCon();

// Get customer ID from session
$c_id = $_SESSION['email'] ?? null;

if (!$c_id) {
    die("Unauthorized access. Please log in.");
}

// Fetch customer data using the myDB class
$sql = "SELECT c_first_name, c_last_name, c_phone, c_email, c_street FROM customer WHERE c_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $c_id); // Bind the customer email
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    die("Customer not found.");
}

// Fetch order details
$order_sql = "SELECT amount, order_date, status FROM order_table WHERE c_id = (SELECT c_id FROM customer WHERE c_email = ?)";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("s", $c_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

// Handle form submission
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Basic validation
    if (empty($first_name) || empty($last_name)) {
        $errors[] = "First and Last Name are required.";
    }
    if (!preg_match("/^\d{10,15}$/", $phone)) {
        $errors[] = "Phone number must be 10-15 digits.";
    }
    if (empty($address)) {
        $errors[] = "Address cannot be empty.";  // Added address validation
    }

    // Update customer details if no errors
    if (empty($errors)) {
        // Use the myDB method to update customer details
        $update_sql = "UPDATE customer SET c_first_name=?, c_last_name=?, c_phone=?, c_street=? WHERE c_email=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssss", $first_name, $last_name, $phone, $address, $c_id);

        if ($update_stmt->execute()) {
            $success = "Profile updated successfully!";
            header("Location: dashboard.php");
            // Refresh customer data
            $customer = ['c_first_name' => $first_name, 'c_last_name' => $last_name, 'c_phone' => $phone, 'c_street' => $address];
        } else {
            $errors[] = "Error updating profile.";
        }
    }
}

// Close the database connection
$db->closeCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Customer Profile</title>
</head>
<body class="profile-data">

<div class="container-profile">
    <h2>Customer Profile</h2>
    <a class="backdash" href="dashboard.php">Back</a>
    <br>

    <?php if (!empty($errors)): ?>
        <div class="profile-error">
            <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="profile-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="profile-form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo ($customer['c_first_name']); ?>">
        </div>
        <div class="profile-form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo ($customer['c_last_name']); ?>">
        </div>
        <div class="profile-form-group">
            <label>Phone Number:</label>
            <input type="tel" name="phone" value="<?php echo ($customer['c_phone']); ?>">
        </div>
        <div class="profile-form-group">
            <label>Address:</label>
            <input type="text" name="address" value="<?php echo ($customer['c_street']); ?>">
        </div>
        <button type="submit" class="profile-submit">Update Profile</button>
        <div class="profile-change-password">
        <a href="change_password_profile.php">Change Password</a>
    </div>
    
    </form>

    <h2>Order History</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Date Ordered</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $order_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo ($order['amount']); ?></td>
                    <td><?php echo ($order['order_date']); ?></td>
                    <td><?php echo ($order['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
