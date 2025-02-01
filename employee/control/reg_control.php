<?php
$hasError = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_REQUEST['name']) || empty($_REQUEST['name']) || !ctype_alpha(str_replace(' ', '', $_REQUEST['name']))) {
        echo "Name is required and can only contain alphabetic characters (no numbers, spaces, or special characters).<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['email']) && !filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['password']) && (empty($_REQUEST['password']) || strlen($_REQUEST['password']) < 6 || !preg_match('/[@#$&]/', $_REQUEST['password']))) {
        if (empty($_REQUEST['password'])) {
            echo "Password is required.<br>";
        } elseif (strlen($_REQUEST['password']) < 6) {
            echo "Password must be at least 6 characters long.<br>";
        } elseif (!preg_match('/[@#$&]/', $_REQUEST['password'])) {
            echo "Password must contain one of the special characters (@, #, $, or &).<br>";
        }
        $hasError = false;
    }

    if (isset($_REQUEST['confirm_password']) && $_REQUEST['confirm_password'] !== $_REQUEST['password']) {
        echo "Re-entered password does not match the original password.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['dob']) && (empty($_REQUEST['dob']) || !DateTime::createFromFormat('Y-m-d', $_REQUEST['dob']) || DateTime::createFromFormat('Y-m-d', $_REQUEST['dob']) > new DateTime())) {
        if (empty($_REQUEST['dob'])) {
            echo "Date of Birth is required.<br>";
        } elseif (!DateTime::createFromFormat('Y-m-d', $_REQUEST['dob'])) {
            echo "Date of Birth must be in the format YYYY-MM-DD.<br>";
        } elseif (DateTime::createFromFormat('Y-m-d', $_REQUEST['dob']) > new DateTime()) {
            echo "Date of Birth cannot be in the future.<br>";
        }
        $hasError = false;
    }

    if (isset($_REQUEST['phone']) && (empty($_REQUEST['phone']) || !ctype_digit($_REQUEST['phone']) || strlen($_REQUEST['phone']) != 11)) {
        if (empty($_REQUEST['phone'])) {
            echo "Phone Number is required.<br>";
        } elseif (!ctype_digit($_REQUEST['phone'])) {
            echo "Phone Number must contain only digits.<br>";
        } elseif (strlen($_REQUEST['phone']) != 11) {
            echo "Phone Number must be exactly 11 digits long.<br>";
        }
        $hasError = false;
    }

    if (!isset($_REQUEST['gender'])) {
        echo "Please select a gender.<br>";
        $hasError = false;
    }

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['profile_picture']['type'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "Profile Picture must be a JPEG, PNG, or GIF image.<br>";
            $hasError = false;
        }
    }

    if (isset($_REQUEST['address']) && !empty($_REQUEST['address']) && strlen($_REQUEST['address']) > 100) {
        echo "Address should be less than 100 characters.<br>";
        $hasError = false;
    }

    if (!isset($_REQUEST['education']) || empty($_REQUEST['education'])) {
        echo "Please select at least one educational qualification.<br>";
        $hasError = false;
    }

    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo "Document must be in PDF, DOC, DOCX, JPG, JPEG, or PNG format.<br>";
            $hasError = false;
        }
    }

    if (isset($_REQUEST['department']) && empty($_REQUEST['department'])) {
        echo "Please select a department.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['position']) && empty($_REQUEST['position'])) {
        echo "Position title is required.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['previous_job_title']) && strlen($_REQUEST['previous_job_title']) > 100) {
        echo "Previous Job Title must not exceed 100 characters.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['previous_company_name']) && strlen($_REQUEST['previous_company_name']) > 100) {
        echo "Previous Company Name must not exceed 100 characters.<br>";
        $hasError = false;
    }

    if (isset($_REQUEST['years_of_experience']) && (!is_numeric($_REQUEST['years_of_experience']) || $_REQUEST['years_of_experience'] < 0)) {
        echo "Years of Experience must be a valid number and cannot be negative.<br>";
        $hasError = false;
    }

    if ($hasError) {
        echo "All inputs are valid!<br>";

        $data = [
            "name" => $_REQUEST['name'],
            "email" => $_REQUEST['email'],
            "password" => $_REQUEST['password'],
            "dob" => $_REQUEST['dob'],
            "phone" => $_REQUEST['phone'],
            "gender" => $_REQUEST['gender'],
            "address" => $_REQUEST['address'],
            "education" => $_REQUEST['education'],
            "department" => $_REQUEST['department'],
            "position" => $_REQUEST['position'],
            "previous_job_title" => $_REQUEST['previous_job_title'],
            "previous_company_name" => $_REQUEST['previous_company_name'],
            "years_of_experience" => $_REQUEST['years_of_experience'],
        ];

        $json = json_encode($data);

        file_put_contents("../data/userdata.json", $json);
    }
}
?>
