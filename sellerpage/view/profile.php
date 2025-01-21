<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: ../view/sellerpage.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seller Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
</head>
<body>
            
             <a href="sellerpage.php" class="logout-btn">Log Out</a>
           
               <div class="profile-container">
             <div class="welcome-message">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</h1>
            <p>We’re glad to have you here.</p>
        </div>
       
        <div class="profile-actions">
            <a href="all_ads.php" class="btn-ads">All Ads</a>
            <a href="post_ad.php" class="btn-post-ad">POST FREE AD</a>
        </div>
    </div>
    <div class="plogo-container">
                <img src="../images/file.png" alt="AutoFleet Logo" class="plogo">
            </div>
</body>
</html>
