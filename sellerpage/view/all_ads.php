<?php
session_start();
require '../model/db.php';

if (!isset($_SESSION["email"])) {
    header("Location: ../view/sellerpage.php");
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "user");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch ads from the database
$sql = "SELECT pr_id, p_name, p_price FROM product";
$result = $conn->query($sql);

$ads = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Ads</title>
    <link rel="stylesheet" type="text/css" href="../../../sellerpage/css/mystyle.css">

</head>
<body>

<div class="all-ads-container">
<div class="header-container">
    <h4>All Ads</h4>
    <input type="text" id="search" onkeyup="searchAd()" placeholder="Search ads...">
</div>
<div id="ad-results"></div> <!-- Search results -->
    <?php if (!empty($ads)): ?>
        <?php foreach ($ads as $ad): ?>
            <a href="viewad.php?id=<?php echo $ad['pr_id']; ?>" class="ad-card">
                <div class="ad-image">
                    <?php 
                    // Find image file by searching for known extensions
                    $imagePath = "../product/" . $ad['pr_id'];
                    $extensions = ['jpg', 'jpeg', 'png', 'gif']; 
                    $imageFile = "";
                    foreach ($extensions as $ext) {
                        if (file_exists("$imagePath.$ext")) {
                            $imageFile = "$imagePath.$ext";
                            break;
                        }
                    }
                    ?>
                   <img src="<?php echo '../../../sellerpage/product/' . htmlspecialchars($ad['pr_id']) . '.jpg'; ?>" alt="Ad Image">

                </div>
                <div class="ad-details">
                    <p class="ad-title"><?php echo htmlspecialchars($ad["p_name"]); ?></p>
                    <p class="ad-price">Tk <?php echo number_format((float)$ad["p_price"]); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No ads available.</p>
    <?php endif; ?>
    <a href="profile.php" class="logout-btn">Back to Profile</a>
</div>
<script src="../sellerpage/js/myjs.js"></script>
</body>
</html>