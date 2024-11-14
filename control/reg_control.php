<?php
if (isset($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
    if (strlen($first_name) > 40) {
        echo "First Name should be a maximum of 40 characters.<br>";
    }
}

if (isset($_POST['last_name'])) {
    $last_name = $_POST['last_name'];
    if (strlen($last_name) > 40) {
        echo "Last Name should be a maximum of 40 characters.<br>";
    }
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if (strlen($password) < 6 || !preg_match('/[a-z]/', $password)) {
        echo "Password must be at least 6 characters long and contain at least one lowercase letter.<br>";
    }
}
if (isset($_POST['confirm_password'])) {
    $confirm_password = $_POST['confirm_password'];
    if ($confirm_password !== $_POST['password']) {
        echo "Re-entered password does not match the original password.<br>";
    }
}

if (!isset($_POST['gender'])) {
    echo "Please select a gender.<br>";
}

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    if (!preg_match('/^0[0-9]{10}$/', $phone)) {
        echo "Phone number must start with 0 and be exactly 11 digits.<br>";
    }
}

if (isset($_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['gender'], $_POST['phone']) &&
    strlen($_POST['first_name']) <= 40 && strlen($_POST['last_name']) <= 40 &&
    strlen($_POST['password']) >= 6 && preg_match('/[a-z]/', $_POST['password']) &&
    preg_match('/^0[0-9]{10}$/', $_POST['phone'])) {
    echo "All inputs are valid!<br>";
}
?>
