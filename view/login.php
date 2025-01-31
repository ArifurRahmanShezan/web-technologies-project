<?php
session_start();

require '../model/db.php';

// Initialize the database class
$db = new myDB();

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

    if ($_POST['user_type'] === "customer") {
        // Open connection using OOP approach
        $conn = $db->openCon();

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM `customer` WHERE c_email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $message[] = 'SQL preparation failed: ' . $conn->error;
            echo 'SQL preparation failed: ' . $conn->error;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch user data
        $row = $result->fetch_assoc();

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

        // Close connection
        $db->closeCon($conn);
    } else if ($_POST['user_type'] === "seller") {
        // Handle seller login (not implemented)
    } else if ($_POST['user_type'] === "employee") {
        // Handle employee login (not implemented)
    } else if ($_POST['user_type'] === "admin") {
        // Handle admin login (not implemented)
    }
}
?>

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
                    <a href="forget_password.php">Forgot Password?</a>
                </div>

                <input type="submit" name="login" value="Login">

                <div class="check-box">
                    <label>
                        <span>Remember Me</span>
                        <input type="checkbox" name="remember_me" <?php echo isset($_COOKIE['user_email']) ? 'checked' : ''; ?>>
                    </label>
                </div>

                <p>Don't have an account? <u><a href="customer_registration.php">Register Now</a></u></p>
            </form>
        </section>
    </div>
</body>
</html>
