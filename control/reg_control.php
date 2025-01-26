<?php
require '../model/db.php';
session_start();

$hasError = true;

// Initialize variables
$firstName = $lastName = $email = $password = $phone = $dob = $gender = $street = $city = $postalCode = $country = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (isset($_REQUEST['first_name']) && strlen($_REQUEST['first_name']) <= 40) {
        $firstName = $_REQUEST['first_name'];
    } else {
        echo '<p id="error">First Name should be a maximum of 40 characters.</p><br>';
        $hasError = false;
    }

    // Validate last name
    if (isset($_REQUEST['last_name']) && strlen($_REQUEST['last_name']) <= 40) {
        $lastName = $_REQUEST['last_name'];
    } else {
        echo '<p id="error">Last Name should be a maximum of 40 characters.</p><br>';
        $hasError = false;
    }

    // Validate email
    if (isset($_REQUEST['email']) && filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_REQUEST['email'];
    } else {
        echo '<p id="error">Invalid email format.</p><br>';
        $hasError = false;
    }

    // Validate password
    if (isset($_REQUEST['password']) && strlen($_REQUEST['password']) >= 6 && preg_match('/[a-z]/', $_REQUEST['password'])) {
        $password = $_REQUEST['password'];
    } else {
        echo '<p id="error">Password must be at least 6 characters long and contain at least one lowercase letter.</p><br>';
        $hasError = false;
    }

    // Validate phone
    if (isset($_REQUEST['phone']) && preg_match('/^0[0-9]{10}$/', $_REQUEST['phone'])) {
        $phone = $_REQUEST['phone'];
    } else {
        echo '<p id="error">Phone number must start with 0 and be exactly 11 digits.</p><br>';
        $hasError = false;
    }

    // Validate date of birth
    if (isset($_REQUEST['dob'])) {
        $dob = $_REQUEST['dob'];
    } else {
        echo '<p id="error">Please provide your date of birth.</p><br>';
        $hasError = false;
    }

    // Validate gender
    if (isset($_REQUEST['gender'])) {
        $gender = $_REQUEST['gender'];
    } else {
        echo '<p id="error">Please select a gender.</p><br>';
        $hasError = false;
    }

    // Address details
    $street = $_REQUEST['street'] ?? "";
    $city = $_REQUEST['city'] ?? "";
    $postalCode = $_REQUEST['postal_code'] ?? "";
    $country = $_REQUEST['country'] ?? "";

    if ($hasError) {
        //echo "All inputs are valid!<br>";

        // $data = [
        //     "first_name" => $_REQUEST['first_name'],
        //     "last_name" => $_REQUEST['last_name'],
        //     "email" => $_REQUEST['email'],
        //     "phone" => $_REQUEST['phone'],
        //     "dob" => $_REQUEST['dob'],
        //     "gender" => $_REQUEST['gender'],
        //     "password" => $_REQUEST['password'],
        //     "street" => $_REQUEST['street'],
        //     "city" => $_REQUEST['city'],
        //     "postal_code" => $_REQUEST['postal_code'],
        //     "country" => $_REQUEST['country']
        // ];

        // $filePath = "../data/userdata.json";
        
        // if (file_exists($filePath) && filesize($filePath) > 0) {
        //     $existingData = json_decode(file_get_contents($filePath), true);
        //     if (!is_array($existingData)) {
        //         $existingData = [];
        //     }
        // } else {
        //     $existingData = [];
        // }

        // $existingData[] = $data;

        // $json = json_encode($existingData);

        // if (file_put_contents($filePath, $json)) {
        //     echo "User data successfully saved.<br>";
        // } else {
        //     echo "Failed to save user data.<br>";
        // }

        $mydb= new mydb();
        $connectionObject=$mydb->openCon();
        $result=$mydb->insertData($connectionObject, $firstName, $lastName, $phone,$email, $password, $street);
        if($result==1){
            echo"Success";
        }
        else{
            echo"failed to store";
        }
        $_SESSION["first_name"]=$_REQUEST['first_name'];
        $_SESSION["password"]=$_REQUEST["password"];
        header("Location: ../view/login.php");
    }
}
?>

