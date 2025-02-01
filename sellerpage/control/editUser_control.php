<?php
include '../model/db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Seller</title>
  <!-- Adjust the relative path as needed -->
  <link rel="stylesheet" type="text/css" href="../../../sellerpage/css/mystyle.css">
</head>
<body>
<div class="container">
  <?php
  // Check if 's_id' is provided in the URL
  if (isset($_GET['s_id'])) {
      $s_id = $_GET['s_id'];

      $mydb = new myDB();
      $conobj = $mydb->opencon(); // Open the database connection

      // Fetch seller details by ID
      $result = $mydb->getUsersByID("seller", $conobj, $s_id);

      if ($result->num_rows > 0) {
          $data = $result->fetch_assoc(); // Get the seller data
          
          // Display seller details in a form
          echo "<form action='' method='post'>";
          echo "<label>ID:</label>";
          echo "<input type='text' name='s_id' value='" . $data['s_id'] . "' readonly><br>";
          
          echo "<label>Name:</label>";
          echo "<input type='text' name='s_name' value='" . $data['s_name'] . "'><br>";
          
          echo "<label>Email:</label>";
          echo "<input type='email' name='s_email' value='" . $data['s_email'] . "'><br>";
          
          echo "<label>Phone:</label>";
          echo "<input type='text' name='s_phone' value='" . $data['s_phone'] . "'><br>";
          
          echo "<label>Address:</label>";
          echo "<input type='text' name='s_address' value='" . $data['s_address'] . "'><br>";
          
          echo "<label>Account Number:</label>";
          echo "<input type='text' name='s_bank_account_no' value='" . $data['s_bank_account_no'] . "'><br>";
          
          echo "<button type='submit' name='update'>Update</button>";
          echo "</form>";
      } else {
          echo "<p>No seller found with ID: $s_id</p>";
      }

      $mydb->closeCon($conobj); // Close the connection
  }

  // Handle form submission for updating seller details
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
          echo "<p>Failed to update seller details.</p>";
      }

      $mydb->closeCon($conobj);
  }
  ?>
</div>
</body>
</html>
