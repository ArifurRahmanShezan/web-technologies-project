<?php
require '../model/db.php';
$mydb = new mydb();
$connectionObject = $mydb->openCon();

if (isset($_GET['pr_id']) && !empty($_GET['pr_id'])) {
    $pr_id = $_GET['pr_id'];
    $result = $mydb->showProductById($connectionObject, $pr_id);
} elseif (isset($_GET['p_name']) && !empty($_GET['p_name'])) {
    $p_name = $_GET['p_name'];
    $result = $mydb->showProductByName($connectionObject, $p_name);
} else {
    $result = $mydb->showProduct($connectionObject);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imagePath = "../product/" . $row["pr_id"] . ".jpg";
        echo "<div class='product-card'>
                <img src='$imagePath' alt='Product Image'>
                <h4>{$row['p_name']}</h4>
                <p><strong>Price:</strong> {$row['p_price']} USD</p>
                <p><strong>Category:</strong> {$row['p_category']}</p>
                <p><strong>Model:</strong> {$row['p_model']}</p>
                <a href='order.php?pr_id={$row['pr_id']}' class='buy-btn'>Buy</a>
            </div>";
    }
} else {
    echo "<p>No products found.</p>";
}
?>