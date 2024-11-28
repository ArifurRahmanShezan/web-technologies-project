<?php
session_start();
$hasError = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_REQUEST['first_name']) && strlen($_REQUEST['first_name']) > 40) {
        echo "First Name should be a maximum of 40 characters.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['last_name']) && strlen($_REQUEST['last_name']) > 40) {
        echo "Last Name should be a maximum of 40 characters.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['password']) && (strlen($_REQUEST['password']) < 6 || !preg_match('/[a-z]/', $_REQUEST['password']))) {
        echo "Password must be at least 6 characters long and contain at least one lowercase letter.<br>";
        $hasError = false;
    }

    if (!isset($_REQUEST['gender'])) {
        echo "Please select a gender.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['phone']) && !preg_match('/^0[0-9]{10}$/', $_REQUEST['phone'])) {
        echo "Phone number must start with 0 and be exactly 11 digits.<br>";
        $hasError = false;
    }

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
        
        $_SESSION["first_name"]=$_REQUEST['first_name'];
        $_SESSION["password"]=$_REQUEST["password"];
        header("Location: ../view/profile.php");
    }
}
?>
