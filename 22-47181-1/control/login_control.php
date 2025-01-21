<?php
session_start();
require_once "../model/db.php"; // Adjust the path to where myDB.php is located

// Initialize error message variables
$usernameError = "";
$passwordError = "";
$errorMessage = "";
echo "Hello";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = 0;

    // Retrieve form data
    $username = $_REQUEST["useremail"];
    $password = $_REQUEST["userpass"];

    // Validate Username
    if (empty($username)) {
        $usernameError = "Please enter a username";
        $hasError++;
    }

    // Validate Password
    if (empty($password)) {
        $passwordError = "Please enter a password";
        $hasError++;
    }

    // If no errors, check login credentials
    if ($hasError == 0) {
        // Create an instance of the database class
        $mydb = new myDB();
        $conobj = $mydb->openCon();

        // Check login credentials
        $result = $mydb->isUsernameExists($conobj, $username);
        
        if($result){
            header("location: ../view/Home.php");
        } else {
            $usernameError = "Invalid username";
        }

        // Close the database connection
        $mydb->closeCon($conobj);
    }

    // Display error messages
    if (!empty($usernameError)) {
        echo $usernameError . "<br>";
    }
    if (!empty($passwordError)) {
        echo $passwordError . "<br>";
    }
    if (!empty($errorMessage)) {
        echo $errorMessage . "<br>";
    }
}
?>