<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Show Users</title>
  <!-- Adjust the relative path as needed -->
 <link rel="stylesheet" type="text/css" href="../../sellerpage/css/showuser.css">
</head>
<body>
<div class="container">
  <?php
  include '../model/db.php';
  
  // Instantiate the database class
  $mydb = new myDB();
  $conobj = $mydb->opencon(); // Open the connection
  
  // Fetch results from the table (change "user" to your actual table name if needed)
  $results = $mydb->showusers("user", $conobj);
  
  if ($results->num_rows > 0) {
      foreach ($results as $data) {
          echo "<div class='user'>";
          echo "<p>ID: " . $data["s_id"] . "</p>";
          echo "<p>Name: " . $data["s_name"] . "</p>";
          echo "<p>Email: " . $data["s_email"] . "</p>";
          echo "<p>Phone: " . $data["s_phone"] . "</p>";
          echo "<p>Address: " . $data["s_address"] . "</p>";
          echo "<p>Account Number: " . $data["s_bank_account_no"] . "</p>";
          
          // Edit button form
          echo "<form action='../view/edituser.php' method='get'>";
          echo "<input type='hidden' name='s_id' value='" . $data["s_id"] . "'>";
          echo "<button type='submit'>Edit</button>";
          echo "</form>";
          echo "</div>";
      }
  } else {
      echo "<p>No data found</p>";
  }
  
  $mydb->closeCon($conobj); // Close the connection
  ?>
</div>
</body>
</html>
