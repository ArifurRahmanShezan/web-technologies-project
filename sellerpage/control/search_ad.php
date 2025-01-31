<?php
require '../model/db.php';

// Get the search query
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

$conn = new mysqli("localhost", "root", "", "user");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (empty($query)) {
    echo '<p>Please enter a search term.</p>';
    exit;
}
// Search ads
$stmt = $conn->prepare("SELECT pr_id, p_name, p_price, p_category, p_model FROM product WHERE p_name LIKE CONCAT('%', ?, '%') OR p_category LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("ss", $query, $query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <title>Search Results</title>
</head>
<body>

<div class="all_ads">
<?php
$response = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response .= '<a href="viewad.php?id=' . htmlspecialchars($row['pr_id']) . '" class="ad-card">';
        $response .= '    <div class="ad-image">';
        if (!empty($row["p_model"])) {
            $response .= '        <img src="' . htmlspecialchars($row["p_model"]) . '" alt="Ad Image">';
        } else {
            $response .= '        <img src="../images/placeholder.png" alt="No Image">';
        }
        $response .= '    </div>';
        $response .= '    <div class="ad-details">';
        $response .= '        <p class="ad-title">' . htmlspecialchars($row['p_name']) . '</p>';
        $response .= '        <p class="ad-price">Tk ' . number_format((float)$row['p_price']) . '</p>';
        $response .= '    </div>';
        $response .= '</a>';
    }
} else {
    $response = '<p>No ads found.</p>';
}

// Output the response
echo $response;

$stmt->close();
$conn->close();
?>
</div>

</body>
</html>
