<?php
session_start();
require '../../model/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../../../view/login.php");
    exit;
}

if(isset($_POST['add_employee'])){
    header ("Location: ../../view/emp.php");
  
    exit;
}if(isset($_POST['logout'])){
    header ("Location: ../../../view/login.php");
    exit;
}
$conn = (new myDB())->opencon();

$stmt = $conn->prepare("SELECT * FROM employee WHERE e_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../css/mystyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Welcome, <span id="userName"><?php echo ($user['e_name']); ?></span>!</h1>
    <p>Your email: <span id="userEmail"><?php echo ($user['e_email']); ?></span></p>
    <p>Your phone: <span id="userPhone"><?php echo ($user['e_phone']); ?></span></p>
    <p>Your department: <?php echo ($user['e_department']); ?></p>
    
    <form action="products.php" method="get">
        <button type="submit">Products</button>
    </form>

    <h3>Update Your Information</h3>
    <form id="updateForm">
        <input type="hidden" name="action" value="update">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo ($user['e_name']); ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo ($user['e_email']); ?>" required><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo ($user['e_phone']); ?>" required><br>
        <input type="submit" value="Update Information">
    </form>

    <p id="responseMessage"></p>

    <h3>Delete Your Account</h3>
    <form method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
        <input type="hidden" name="action" value="delete">
        <input type="submit" value="Delete Account">
    </form>

    
    <form method ="POST">
    <input type="submit" name="add_employee"value="Add Employee">
    </form>
        
    <form action="" method="POST">
        <button type="submit" name="logout">LOGOUT</button>
    </form>

    <script>
    $(document).ready(function() {
        $("#updateForm").submit(function(e) {
            e.preventDefault(); 

            $.ajax({
                url: "../control/ajax_update.php",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === "success") {
                        $("#userName").text(response.name);
                        $("#userEmail").text(response.email);
                        $("#userPhone").text(response.phone);
                        $("#responseMessage").html("<p style='color:green;'>Updated successfully!</p>");
                    } else if (response.status === "success"){
                        $("#responseMessage").html("<p style='color:red;'>Error updating information.</p>");
                    }
                }
            });
        });
    });
    </script>
</body>
</html>
