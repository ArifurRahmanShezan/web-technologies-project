<?php
session_start();
if(!isset($_SESSION["first_name"])){
    header("Location: ../view/customer_registration.php");
}

require '../model/db.php';

$mydb = new mydb();
$connectionObject = $mydb->openCon();

// Initialize $result to null
$result = null;

// Handle button clicks
if (isset($_GET['view_all'])) {
    // Fetch all products
    $result = $mydb->showProduct($connectionObject);
} elseif (isset($_GET['view_by_id']) && !empty($_GET['pr_id'])) {
    // View by Product ID
    $pr_id = $_GET['pr_id'];
    $result = $mydb->showProductById($connectionObject, $pr_id);
} elseif (isset($_GET['view_by_name']) && !empty($_GET['p_name'])) {
    // View by Product Name
    $p_name = $_GET['p_name'];
    $result = $mydb->showProductByName($connectionObject, $p_name);
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Product Dashboard</title>
        <link rel="stylesheet" href="../css/mystyle.css">
    </head>
    <body>
        <h1>Welcome, <?php echo $_SESSION["first_name"]; ?>!</h1>
        <a href="../control/sessionout.php">Log Out</a>
        <h2>Product Records</h2>

        <!-- Form to view products -->
        <form method="GET">
            <button name="view_all">View All Products</button><br><br>
            
            <!-- View by Product ID -->
            <label for="pr_id">View by Product ID:</label>
            <input type="text" name="pr_id" id="pr_id">
            <button name="view_by_id">View Product by ID</button><br><br>

            <!-- View by Product Name -->
            <label for="p_name">View by Product Name:</label>
            <input type="text" name="p_name" id="p_name">
            <button name="view_by_name">View Product by Name</button><br><br>
        </form>

        <!-- Display product records -->
        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Model</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['pr_id']; ?></td>
                            <td><?php echo $row['p_name']; ?></td>
                            <td><?php echo $row['p_price']; ?></td>
                            <td><?php echo $row['p_category']; ?></td>
                            <td><?php echo $row['p_model']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No product records found.</p>
        <?php endif; ?>
    </body>
</html>
