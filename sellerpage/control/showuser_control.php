<?php
include '../model/db.php';

// Instantiate the database class
$mydb = new myDB();
$conobj = $mydb->opencon(); // Open the connection

// Fetch results from the table
$results = $mydb->showusers("user", $conobj); // Pass both table name and connection object

// Check if results have rows
if ($results->num_rows > 0) {
    foreach ($results as $data) {
        echo "ID: " . $data["s_id"] . "<br>";
        echo "Name: " . $data["s_name"] . "<br>";
        echo "Email: " . $data["s_email"] . "<br>";
        echo "Phone: " . $data["s_phone"] . "<br>";
        echo "Address: " . $data["s_address"] . "<br>";
        echo "Account Number: " . $data["s_bank_account_no"] . "<br><br>";
        
        // Add an edit button
        echo "<form action='../view/edituser.php' method='get'>";
        echo "<input type='hidden' name='s_id' value='" . $data["s_id"] . "'>";
        echo "<button type='submit'>Edit</button>";
        echo "</form><br>";
    }
} else {
    echo "No data found<br>";
}

$mydb->closeCon($conobj); // Close the connection
?>
