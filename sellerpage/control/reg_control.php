<?php
session_start();
require '../model/db.php';



$nameError = $emailError = $phoneError = $businessTypeError = $passwordError = $genderError = $photoError = "";
$hasError = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $gender = $_REQUEST['gender'] ?? null;
    $password = $_REQUEST['password'];
    $re_password = $_REQUEST['re_password'];
    $business_name = $_REQUEST['business_name'];
    $citizenship = $_REQUEST['citizenship'];
    $business_type = $_REQUEST['business_type'];
    $tax_id = $_REQUEST['tax_id'];
    $account_holder = $_REQUEST['account_holder'];
    $account_number = $_REQUEST['account_number'];
    $credit_card = $_REQUEST['credit_card'];
    $payment_methods = $_REQUEST['payment_method'] ?? [];

    // Name validation
    if (empty($name) || strlen($name) < 4) {
        $nameError = "Name should be at least 4 characters.";
        $hasError++;
    }

    // Email validation
    if (empty($email) || 
        !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email)) {
        $emailError = "Valid email address is required.";
        $hasError++;
    }

    // Phone validation
    if (empty($phone) || !preg_match('/^[0-9]+$/', $phone)) {
        $phoneError = "Phone number must contain only numbers.";
        $hasError++;
    }

    // Gender validation
    if (empty($gender)) {
        $genderError = "Please select a gender.";
        $hasError++;
    }

    // Password validation
    if (empty($password) || empty($re_password) || $password !== $re_password) {
        $passwordError = "Passwords do not match or are empty.";
        $hasError++;
    }

    // Business type validation
    if (empty($business_type)) {
        $businessTypeError = "Business type is required.";
        $hasError++;
    }


    if ($hasError > 0) {
        echo "Please correct the errors and try again.<br>";
        echo $nameError . "<br>" . $emailError . "<br>" . $phoneError . "<br>" . $genderError . "<br>" . $passwordError . "<br>" . $businessTypeError . "<br>" . $photoError;
     }
     $mydb = new mydb();
     $connobj=$mydb ->openCon();
     $results= $mydb->insertData  (//"../uploads/".$_FILES["images"]["name"],
     $_REQUEST["name"],$_REQUEST["email"],$_REQUEST["phone"],$_REQUEST["address"],$_REQUEST["password"],$_REQUEST["account_number"],/*"user"*/$connobj);

     if($results==1){
        echo"sucess";
     }
     else{
        echo"failed to store";
     }

     $tableName = "seller"; // Define the table name
        $myDB = new myDB();
        $connectionObject = $myDB->openCon();

        //$results = $myDB->insertData($name, $email, $phone,$address,$password, $account_number, $connectionObject);
        $myDB->closeCon($connectionObject);

    // else {
    //     $data = [
    //         "name" => $name,
    //         "email" => $email,
    //         "phone" => $phone,
    //         "address" => $address,
    //         "gender" => $gender,
    //         "business_name" => $business_name,
    //         "citizenship" => $citizenship,
    //         "business_type" => $business_type,
    //         "tax_id" => $tax_id,
    //         "account_holder" => $account_holder,
    //         "account_number" => $account_number,
    //         "credit_card" => $credit_card,
    //         "payment_methods" => $payment_methods,
    //     ];
    //     // $json = json_encode($data);

        // if (file_put_contents("../data/userdata.json", $json)) {
        //     echo "All data successfully input and saved.";
        // } else {
        //     echo "Failed to save data.";
        // }
        $_SESSION["name"]=$_REQUEST["name"];
        $_SESSION["password"]=$_REQUEST ["password"];

        header("Location: ../view/profile.php");


    }
?>
