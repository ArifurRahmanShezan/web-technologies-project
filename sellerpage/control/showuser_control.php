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
            echo "<div class='user-container'>";
            echo "<div class='user-details'>";
            echo "<p class='user-title'>User ID: " . $data["s_id"] . "</p>";
            echo "<p>Name: " . $data["s_name"] . "</p>";
            echo "<p>Email: " . $data["s_email"] . "</p>";
            echo "<p>Phone: " . $data["s_phone"] . "</p>";
            echo "<p>Address: " . $data["s_address"] . "</p>";
            echo "<p>Account Number: " . $data["s_bank_account_no"] . "</p>";
            echo "</div>";

            // Add an edit button
            echo "<form action='../view/edituser.php' method='get'>";
            echo "<input type='hidden' name='s_id' value='" . $data["s_id"] . "'>";
            echo "<button type='submit' class='edit-button'>Edit</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No data found</p>";
    }

    $mydb->closeCon($conobj); // Close the connection
    ?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/sellerpage/css/mystyle.css">
</head>
    <body>
</body>
        </html>
