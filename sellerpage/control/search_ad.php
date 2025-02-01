<?php
require '../model/db.php';

$search = $_POST['search'] ?? ''; // Get the search term if available, otherwise an empty string

$conn = new mysqli("localhost", "root", "", "user");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If there is a search term, filter ads based on the name; otherwise, get all ads
if ($search) {
    $sql = "SELECT pr_id, p_name, p_price FROM product WHERE p_name LIKE ? OR p_model LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchParam = "%$search%";
    $stmt->bind_param("ss", $searchParam,$searchParam);
} else {
    // Get all ads if no search term is provided
    $sql = "SELECT pr_id, p_name, p_price FROM product";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($ad = $result->fetch_assoc()) {
        echo '<a href="viewad.php?id='.$ad['pr_id'].'" class="ad-card">';
        echo '<div class="ad-details">';
        echo '<img src="' . '../../../sellerpage/product/' . htmlspecialchars($ad['pr_id']) . '.jpg" alt="Ad Image">';
        echo '<p class="ad-title">'.htmlspecialchars($ad["p_name"]).'</p>';
        echo '<p class="ad-price">Tk '.number_format((float)$ad["p_price"]).'</p>';
        echo '</div></a>';
    }
} else {
    echo "<p>No ads found.</p>";
}

$conn->close();
?>