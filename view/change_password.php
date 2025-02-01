<?php
include '../model/db.php';  // Including the db.php file with the myDB class

session_start();

// Initialize error messages
$new_password_error = '';
$confirm_password_error = '';

// Flag to indicate if the form is valid
$form_valid = true;

if (isset($_POST['submit'])) {
    // Retrieve and sanitize inputs
    $new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);

    // Validate that passwords are not empty
    if (empty($new_password) || empty($confirm_password)) {
        $new_password_error = "Both password fields are required. Please fill in both fields.";
        $form_valid = false;
    }

    // Validate password length
    if (strlen($new_password) < 6) {
        $new_password_error = "Password must be at least 6 characters long.";
        $form_valid = false;
    }

    // Validate password strength (optional, can be adjusted based on requirements)
    if (!preg_match("/[A-Z]/", $new_password)) {
        $new_password_error = "Password must contain at least one uppercase letter.";
        $form_valid = false;
    }
    if (!preg_match("/[a-z]/", $new_password)) {
        $new_password_error = "Password must contain at least one lowercase letter.";
        $form_valid = false;
    }
    if (!preg_match("/[0-9]/", $new_password)) {
        $new_password_error = "Password must contain at least one number.";
        $form_valid = false;
    }

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match. Please try again.";
        $form_valid = false;
    }

    // If the form is valid, proceed to update the password
    if ($form_valid) {
        // Instantiate the Database class
        $db = new myDB();

        // Open the database connection
        $connectionObject = $db->openCon();

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
                $new_password_error = "New password cannot be the same as the old password. Please try again.";
                $form_valid = false;
            } else {
                // Update the password in the database
                $update_password = $connectionObject->prepare("UPDATE `customer` SET c_password = ? WHERE c_email = ?");
                $update_password->bind_param("ss", $new_password, $email);
                $update_password->execute();

                // Clear session and redirect
                unset($_SESSION['email']);
                echo "Password updated successfully.";
                header('Location: ../view/login.php');
                exit();
            }
        } else {
            echo "No user found. Please try again.";
            exit();
        }

        // Close the database connection
        $db->closeCon($connectionObject);
    }
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
        
        <input type="password" name="new_password" placeholder="Enter New Password" value="<?php echo isset($new_password) ? $new_password : ''; ?>">
        <?php if ($new_password_error) { echo '<p class="error-message">' . $new_password_error . '</p>'; } ?>

        <input type="password" name="confirm_password" placeholder="Confirm New Password" value="<?php echo isset($confirm_password) ? $confirm_password : ''; ?>">
        <?php if ($confirm_password_error) { echo '<p class="error-message">' . $confirm_password_error . '</p>'; } ?>

        <input type="submit" name="submit" value="Submit">
        <a href="forget_password.php">Back</a>
    </form>

</body>
</html>
