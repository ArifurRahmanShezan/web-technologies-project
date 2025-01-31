<?php

session_start();
if (!isset($_SESSION["email"])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit;
}

require '../model/db.php';
$mydb = new mydb();
$connectionObject = $mydb->openCon();

// Fetch all products by default
$result = $mydb->showProduct($connectionObject);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/style.css">
    <title>Product Dashboard</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/myscript.js"></script>
</head>
<body class="dashboard-page">
    <h1>Welcome, <?php echo $_SESSION["email"]; ?>!</h1>
    <a href="../control/sessionout.php">Log Out</a>
    <a href="profile.php">Profile</a>
    <h2>Products</h2>

    <form class="products">
        <button name="view_all"id="searchAll">View All Products</button><br><br>
        <label for="pr_id">View by Product ID:</label>
        <input type="text" name="pr_id" id="pr_id">
        <button id="searchById">View Product by ID</button><br><br>

        <label for="p_name">View by Product Name:</label>
        <input type="text" name="p_name" id="p_name">
        <button id="searchByName">View Product by Name</button><br><br>
    </form>

    <h2>Product List</h2>
    <div class="container" id="productList">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = "../sellerpage//product/" . $row["pr_id"] . ".jpg";
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
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</body>
</html>