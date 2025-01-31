<?php

session_start(); 

require '../model/db.php';


// Initialize variables
$message = [];

// Handle login form submission
if (isset($_POST['login'])) {
    // Retrieve and sanitize input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format.';
        echo 'Invalid email format.';
    }

    // Debug: Check if email and password are received properly
    error_log("Received email: $email, password: $pass");
if($_POST['user_type']==="customer"){


    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM `customer` WHERE c_email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        $message[] = 'SQL preparation failed: ' . mysqli_error($conn);
        echo 'SQL preparation failed: ' . mysqli_error($conn);
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result === false) {
        $message[] = 'Query execution failed: ' . mysqli_error($conn);
        echo 'Query execution failed: ' . mysqli_error($conn);
    }

    // Fetch user data
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Debug: Check if user exists
    if ($row) {
        error_log("User found: " . print_r($row, true));

        // Compare password directly
        if ($pass == $row['c_password']) {
            // Password is correct
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $row['c_id'];

            // Optionally, set the session expiration
            $_SESSION['login_time'] = time(); // Current time for expiration check
           
            // Set a cookie if "Remember Me" is checked
            if (isset($_POST['remember_me'])) {
                setcookie("user_email", $email, time() + (86400 * 30), "/", "", true, true); // Secure and HttpOnly flags
            } else {
                if (isset($_COOKIE['user_email'])) {
                    setcookie("user_email", "", time() - 3600, "/", "", true, true); // Delete cookie if "Remember Me" is unchecked
                }
            }

            // Debug: Check if cookie is set
            error_log("Cookie set for user email: $email");

        // Redirect to profile page
        header('Location: dashboard.php');
        exit;

        } else {
            // Invalid password
            echo 'Invalid email or password. Please try again.';
        }
    } else {
        // No user found with that email
        echo 'No user found with that email. Please register.';
    }
}
else if($_POST['user_type']==="seller"){
    $sql = "SELECT * FROM `seller` WHERE s_email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        $message[] = 'SQL preparation failed: ' . mysqli_error($conn);
        echo 'SQL preparation failed: ' . mysqli_error($conn);
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result === false) {
        $message[] = 'Query execution failed: ' . mysqli_error($conn);
        echo 'Query execution failed: ' . mysqli_error($conn);
    }

    // Fetch user data
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Debug: Check if user exists
    if ($row) {
        error_log("User found: " . print_r($row, true));

        // Compare password directly
        if ($pass == $row['s_password']) {
            // Password is correct
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $row['s_id'];

            // Optionally, set the session expiration
            $_SESSION['login_time'] = time(); // Current time for expiration check
           
            // Set a cookie if "Remember Me" is checked
            if (isset($_POST['remember_me'])) {
                setcookie("user_email", $email, time() + (86400 * 30), "/", "", true, true); // Secure and HttpOnly flags
            } else {
                if (isset($_COOKIE['user_email'])) {
                    setcookie("user_email", "", time() - 3600, "/", "", true, true); // Delete cookie if "Remember Me" is unchecked
                }
            }

            // Debug: Check if cookie is set
            error_log("Cookie set for user email: $email");

        // Redirect to profile page
        header('Location: ../sellerpage/view//profile.php');
        exit;

        } else {
            // Invalid password
            echo 'Invalid email or password. Please try again.';
        }
    } else {
        // No user found with that email
        echo 'No user found with that email. Please register.';
    }

}
else if($_POST['user_type']==="employee"){
    
}
else if($_POST['user_type']==="admin"){
    
}
}
?>

<!-- HTML Code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="form-container">
        <section class="form-container">
            <div class="title">
                <h1>Login Now</h1>
                <p>Login here if you're already a part of us!</p>
            </div>
            <form action="" method="post">
            <div class="input-field">
    <p>User Type</p>
    <select name="user_type" required>
        <option value="" disabled selected>Select your user type</option>
        <option value="customer">Customer</option>
        <option value="employee">Employee</option>
        <option value="seller">Seller</option>
        <option value="admin">Admin</option>
    </select>
</div>

                <div class="input-field">
                    <p>Email</p>
                    <input type="text" name="email" placeholder="Enter your email" maxlength="50" value="<?php echo isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : ''; ?>" required>
                </div>
                <div class="input-field">
                    <p>Password</p>
                    <input type="password" name="pass" placeholder="Enter the password" maxlength="50" required>
                    <a href="forget_password.php" style="display: block; margin-top: 10px; font-size: 0.800em; text-align: left;">Forgot Password?</a>
                </div>
                <input type="submit" name="login" value="Login">
                <div class="check-box">
                    <label>
                        <span>Remember Me</span>
                        <input type="checkbox" name="remember_me" <?php echo isset($_COOKIE['user_email']) ? 'checked' : ''; ?>>
                    </label>
                </div>
                <p style="margin-top: 20px;">Don't have an account? <u><a href="customer_registration.php">Register Now</a></u></p>
            </form>
        </section>
    </div>
</body>
</html>
