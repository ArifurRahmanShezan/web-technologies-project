<?php
session_start();

if (!isset($_SESSION["email"])) {
//    header("Location: ../view/sellerpage.php");
    echo "check";
    exit();
}

require '../model/db.php';

$myDB = new myDB();
$connectionObject = $myDB->openCon();

// Fetch user data from the database
$name = $_SESSION["email"];
$sql = "SELECT * FROM seller WHERE s_email = '$name'";
$result = $connectionObject->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user data found.";
    exit();
}

$myDB->closeCon($connectionObject);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seller Profile</title>
    <link rel="stylesheet" type="text/css" href="../../../sellerpage/css/mystyle.css">

</head>
<body>  
    
             <a href="../../../view/login.php" class="llogout-btn">Log Out</a>
             
           
               <div class="profile-container">
             <div class="welcome-message">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["email"]); ?>!</h1>
            <p>We’re glad to have you here.</p>
        </div>
       
        <div class="profile-actions">
            <a href="all_ads.php" class="btn-ads">All ADs</a>
            <a href="post_ad.php" class="btn-post-ad">POST FREE AD</a>
            <a href ="../../view/showusers.php"class="btn-post-ad">UPDATE USERs</a>
        </div>
    </div>
    <div class="profile-container">
        <!-- Left side: Profile details -->
        <div class="profile-details">
            <h2>Profile Details</h2>
            <table>
                <tr>
                    <td>Name:</td>
                    <td><?php echo htmlspecialchars($user['s_name']); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo htmlspecialchars($user['s_email']); ?></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><?php echo htmlspecialchars($user['s_phone']); ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo htmlspecialchars($user['s_address']); ?></td>
                </tr>
                <tr>
                    <td>Bank Account No:</td>
                    <td><?php echo htmlspecialchars($user['s_bank_account_no']); ?></td>
                </tr>
            </table>
        </div>
    <div class="plogo-container">
                <img src="../../../sellerpage/images/file.png" alt="AutoFleet Logo" class="plogo">
            </div>
         
</body>
</html>
