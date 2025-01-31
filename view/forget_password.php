<?php
include '../model/db.php';
session_start();

// Initialize variables
$message = [];


if (isset($_POST['submit'])) {
    // Retrieve and sanitize the email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    echo $email;

    // Check if the email exists for a customer in the database
    $sql = "SELECT * FROM `customer` WHERE c_email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) 
    {
        $_SESSION['email'] = $email;
        header('location:change_password.php');
    }
    else 
        echo "No account associated with this email. Please check your email address.";
    
}



?>

<!-- HTML Code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
    </style>
</head>
<body>
    <div class="form-container">
        <section class="form-container">
            <div class="title">
                <h1>Forgot Password</h1>
                <p>Follow the steps to reset your password.</p>
                
            </div>
            <form action=""method="POST">
            <input type="text" name="email" placeholder="enter your email">
            <input type="submit" name="submit" value="Submit">
            </form>
            

        </section>
    </div>
    
</body>
</html>