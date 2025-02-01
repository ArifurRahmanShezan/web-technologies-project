<?php
require'../model/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hasError = [];
    $fname = trim($_POST["fname"] ?? "");
    $gender = $_POST["gender"] ?? null;
    $number = trim($_POST["num"] ?? "");
    $preadd = trim($_POST["adress"] ?? "");
    $dob = trim($_POST["dob"] ?? "");
    $email = trim($_POST["gml"] ?? "");
    $pass = $_POST["pass"] ?? "";
    $conpass = $_POST["cpass"] ?? "";
    if (strlen($fname) < 4) {
        $hasError[] = "Name should be at least 4 characters.";
    }

    if (empty($email)) {
        $hasError[] = "Email field is required.";
    } elseif (!preg_match("/@gmail\.com$/", $email)) {
        $hasError[] = "Email address must end with '@gmail.com'.";
    }

    if (empty($number)) {
        $hasError[] = "Phone number is required.";
    } elseif (!preg_match("/^\d+$/", $number)) {
        $hasError[] = "Phone number must contain only digits.";
    }

    if (empty($preadd)) {
        $hasError[] = "Present address is required.";
    }

    if (empty($dob)) {
        $hasError[] = "Date of birth is required.";
    }
    if (!isset($gender)) {
        $hasError[] = "Gender must be selected.";
    }

    if (empty($pass)) {
        $hasError[] = "Password is required.";
    } elseif (!preg_match("/[@$#!%*?&]/", $pass)) {
        $hasError[] = "Password must be at least 8 characters long and include at least one special character.";
    }

    if ($pass !== $conpass) {
        $hasError[] = "Passwords do not match.";
    }


    if (!empty($hasError)) {
        echo "<h2>Please correct the following hasError:</h2>";
        echo "<ul>";
        foreach ($hasError as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {

        $mydb=new myDB();
        $conObj=$mydb->openCon();
        $result=$mydb->insertData(
            $fname,
            $email,
            $pass,
            $gender,
            $number,
            $dob,
            $preadd,
            $conObj
        );
        if($result==1){
            header("Location:../view/login.php");

        }
        else{
            echo "Error";
        }
    }
}
?>