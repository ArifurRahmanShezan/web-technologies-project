<?php
session_start();
require '../model/db.php';

$db = new myDB();
$conn = $db->openCon();

// Assuming customer is logged in and session stores c_id
$c_id = $_SESSION['email'] ?? null;

if (!$c_id) {
    die("Unauthorized access. Please log in.");
}

// Fetch current password from the database using OOP approach
$sql = "SELECT c_password FROM customer WHERE c_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $c_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    die("Customer not found.");
}

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    } elseif ($new_password !== $confirm_password) {
        $errors[] = "New password and confirm password do not match.";
    } elseif ($current_password === $new_password) {
        $errors[] = "New password must be different from the current password.";
    } elseif ($current_password !== $customer['c_password']) {
        $errors[] = "Current password is incorrect.";
    }

    // Update password if no errors
    if (empty($errors)) {
        $update_sql = "UPDATE customer SET c_password=? WHERE c_email=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $c_id);

        if ($update_stmt->execute()) {
            $success = "Password updated successfully!";
            sleep(2);
            header("Location: profile.php");
        } else {
            $errors[] = "Error updating password.";
        }
    }
}

$db->closeCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Change Password</title>
    
    
    <script src="../js/myscript.js"></script>
</head>
<body class="change-pass-profile">
    

<div class="container">
    <h2>Change Password</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="" id="changePasswordForm">
        <div class="form-group">
            <label>Current Password:</label>
            <input type="password" name="current_password" required>
        </div>
        <div class="form-group">
            <label>New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label>Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div id="error_message" class="error"></div>
        <button type="submit">Update Password</button>
        <a href="profile.php">Back</a>
    </form>
</div>


</body>
</html>
