<?php
session_start();
require '../model/db.php';

if (!isset($_SESSION["email"])) {
    header("Location: ../view/sellerpage.php");
    exit();
}

// Get the ad ID from the URL
$id = isset($_GET["id"]) ? (int)$_GET["id"] : null;

if ($id === null) {
    echo "Invalid ad ID.";
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "user");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch ad details from the database
$stmt = $conn->prepare("SELECT p_name, p_price, p_category, p_model, s_id FROM product WHERE pr_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Ad not found.";
    exit();
}

$ad = $result->fetch_assoc();
$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($ad["p_name"]); ?></title>
    <link rel="stylesheet" type="text/css" href="../../../sellerpage/css/mystyle.css">
</head>
<body>

    <div class="ad-container">
        <div class="ad-image">
            <?php if (!empty($ad["p_model"])): ?>
                <img src="<?php echo '../../../sellerpage/product/' . htmlspecialchars($_GET['id']) . '.jpg'; ?>" alt="Ad Image">
            <?php else: ?>
                <img src="../images/placeholder.png" alt="No Image Available">
            <?php endif; ?>
        </div>
        <h1 class="ad-title"><?php echo htmlspecialchars($ad["p_name"]); ?></h1>
        <p class="ad-info">Category: <?php echo htmlspecialchars($ad["p_category"]); ?></p>
        <p class="ad-price">Tk <?php echo number_format((float)$ad["p_price"]); ?></p>
        <div class="ad-description">
            <h2>Description</h2>
        </div>
        <a href="all_ads.php" class="back-link">Back to All Ads</a>
    </div>
  
</body>
</html>
