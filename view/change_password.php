<?php
include '../model/db.php';  // Including the db.php file with the myDB class

session_start();

if (isset($_POST['submit'])) {
    // Retrieve and sanitize inputs
    $new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);

    // Instantiate the Database class
    $db = new myDB();

    // Open the database connection
    $connectionObject = $db->openCon();

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit();
    }

    // Check if session email exists
    if (!isset($_SESSION['email'])) {
        echo "Session expired. Please try again.";
        exit();
    }

    $email = $_SESSION['email'];

    // Retrieve user data from the database
    $select_user = $connectionObject->prepare("SELECT * FROM `customer` WHERE c_email = ?");
    $select_user->bind_param("s", $email);
    $select_user->execute();
    $result = $select_user->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify new password is not the same as the current password
        if ($new_password == $row['c_password']) {
            echo "New password cannot be the same as the old password. Please try again.";
            exit();
        }

        // Update the password in the database
        $update_password = $connectionObject->prepare("UPDATE `customer` SET c_password = ? WHERE c_email = ?");
        $update_password->bind_param("ss", $new_password, $email);
        $update_password->execute();

        // Clear session and redirect
        unset($_SESSION['email']);
        echo "Password updated successfully.";
        header('Location: ../view/login.php');
        exit();
    } else {
        echo "No user found. Please try again.";
        exit();
    }

    // Close the database connection
    $db->closeCon($connectionObject);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Reset Password</title>
</head>
<body class="change-pass">

    

    <form action="" method="POST">
    <h1>Enter your New Password</h1>
        <input type="password" name="new_password" placeholder="Enter New Password" >
        <input type="password" name="confirm_password" placeholder="Confirm New Password" >
        <input type="submit" name="submit" value="Submit">
    </form>

</body>
</html>
