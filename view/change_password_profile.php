<?php
session_start();
require '../model/db.php';
// Assuming customer is logged in and session stores c_id
$c_id = $_SESSION['email'] ?? null;

if (!$c_id) {
    die("Unauthorized access. Please log in.");
}

// Fetch current password from the database
$sql = "SELECT c_password FROM customer WHERE c_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $c_id);
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
    } elseif ($current_password!== $customer['c_password']) {
        $errors[] = "Current password is incorrect.";
    }

    // Update password if no errors
    if (empty($errors)) {
        $update_sql = "UPDATE customer SET c_password=? WHERE c_id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_password, $c_id);

        if ($update_stmt->execute()) {
            $success = "Password updated successfully!";
            sleep(2);
            header("Location: profile.php");
        } else {
            $errors[] = "Error updating password.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
    <script src="../js/myscript.js"></script>
</head>
<body>

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

    <form method="POST" action="" onsubmit="return validatePasswords();">
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
