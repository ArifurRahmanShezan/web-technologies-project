<?php
include '../model/db.php';

if (isset($_GET['s_id'])) { // Check if 's_id' is set in the URL
    $s_id = $_GET['s_id'];

    $mydb = new myDB();
    $conobj = $mydb->opencon(); // Open the connection

    // Fetch user details by ID
    $result = $mydb->getUsersByID("seller", $conobj, $s_id);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Fetch the user data

        // Display user details in a form
        echo "<form action='' method='post'>";
        echo "ID: <input type='text' name='s_id' value='" . $data['s_id'] . "' readonly><br>";
        echo "Name: <input type='text' name='s_name' value='" . $data['s_name'] . "'><br>";
        echo "Email: <input type='email' name='s_email' value='" . $data['s_email'] . "'><br>";
        echo "Phone: <input type='text' name='s_phone' value='" . $data['s_phone'] . "'><br>";
        echo "Address: <input type='text' name='s_address' value='" . $data['s_address'] . "'><br>";
        echo "Account Number: <input type='text' name='s_bank_account_no' value='" . $data['s_bank_account_no'] . "'><br>";
        echo "<button type='submit' name='update'>Update</button>";
        echo "</form>";
    } else {
        echo "No user found with ID: $s_id";
    }

    $mydb->closeCon($conobj); // Close the connection
}

// Handle form submission for updating user details
if (isset($_POST['update'])) {
    $s_id = $_POST['s_id'];
    $name = $_POST['s_name'];
    $email = $_POST['s_email'];
    $phone = $_POST['s_phone'];
    $address = $_POST['s_address'];
    $account_number = $_POST['s_bank_account_no'];

    $mydb = new myDB();
    $conobj = $mydb->opencon();
    $updateResult = $mydb->updateUsers("seller", $conobj, $name, $email, $phone, $address, $account_number, $s_id);

    if ($updateResult) {
        header("Location: ../view/showusers.php");
        exit();
    } else {
        echo "Failed to update user details.";
    }

    $mydb->closeCon($conobj);
}
?>
