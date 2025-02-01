<?php
require '../model/db.php';

$db = new myDB();
$conn = $db->opencon();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please provide a valid email address.";
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($_POST['dob'])) {
        $errors['dob'] = "Date of Birth is required.";
    }

    if (empty($_POST['phone']) || !preg_match("/^[0-9]{10,15}$/", $_POST['phone'])) {
        $errors['phone'] = "Phone number must contain only digits (10-15 characters).";
    }

    if (empty($_POST['gender'])) {
        $errors['gender'] = "Please select your gender.";
    }

    if (!empty($_FILES['profile_picture']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['profile_picture']['type'], $allowed_types)) {
            $errors['profile_picture'] = "Only JPEG, JPG, and PNG files are allowed for the profile picture.";
        }
    }

    if (empty($_POST['address'])) {
        $errors['address'] = "Address is required.";
    }

    
    if (empty($_POST['education'])) {
        $errors['education'] = "Please select at least one educational qualification.";
    }

    if (!empty($_FILES['document']['name'])) {
        $allowed_doc_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
        if (!in_array($_FILES['document']['type'], $allowed_doc_types)) {
            $errors['document'] = "Uploaded document must be a PDF, Word, or image file.";
        }
    }

    if (empty($_POST['department'])) {
        $errors['department'] = "Please select a department.";
    }

    if (!empty($_POST['years_of_experience']) && (!is_numeric($_POST['years_of_experience']) || $_POST['years_of_experience'] < 0)) {
        $errors['years_of_experience'] = "Years of experience must be a valid positive number.";
    }

    if (!empty($errors)) {
        echo "<h2>Validation Errors:</h2>";
        foreach ($errors as $field => $error) {
            echo "<p><strong>$field:</strong> $error</p>";
        }
    } else {
        $password = $_POST['password'];


        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $profile_picture = $_FILES['profile_picture']['name'];
            $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
            move_uploaded_file($profile_picture_tmp, 'uploads/' . $profile_picture);
        } else {
            $profile_picture = '';  
        }

        if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
            $document = $_FILES['document']['name'];
            $document_tmp = $_FILES['document']['tmp_name'];
            move_uploaded_file($document_tmp, 'uploads/' . $document);
        } else {
            $document = '';  
        }

        $sql = "INSERT INTO employee (e_name, e_password, e_email, e_dob, e_phone, e_gender, e_address, e_education, e_department, e_position, e_previous_job_title, e_previous_company_name, e_years_of_experience, e_profile_picture, e_document) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


        if ($stmt = $conn->prepare($sql)) {

            $education = implode(", ", $_POST['education']);


            $stmt->bind_param("ssssssssssssiss", 
                $_POST['name'], 
                $password, 
                $_POST['email'], 
                $_POST['dob'], 
                $_POST['phone'], 
                $_POST['gender'], 
                $_POST['address'], 
                $education,  
                $_POST['department'], 
                $_POST['position'], 
                $_POST['previous_job_title'], 
                $_POST['previous_company_name'], 
                $_POST['years_of_experience'], 
                $profile_picture, 
                $document
            );

            if ($stmt->execute()) {
                echo "<h2>Form submitted successfully!</h2>";
                echo "<p>Account created! <a href='../../view/login.php'>Login</a></p>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }
}

$conn->close();
?>
