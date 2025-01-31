<?php
session_start();
require '../model/db.php';

if (!isset($_SESSION["email"])) {
    header("Location: ../view/sellerpage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["Category"];
    $model = $_POST["Model"];
    $image = $_FILES["image"];
    $errors = [];

    // Validate required fields
    if (empty($title)) $errors[] = "Title is required.";
    if (empty($description)) $errors[] = "Description is required.";
    if (empty($price)) $errors[] = "Price is required.";
    if (empty($category)) $errors[] = "Category is required.";
    if (empty($model)) $errors[] = "Model is required.";
    if (empty($image["name"])) $errors[] = "Image is required.";

    // If no validation errors, proceed
    if (empty($errors)) {
        $conn = new mysqli("localhost", "root", "", "user");
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $s_id = 1; // $_SESSION["s_id"];
        
        // Insert product without image path first
        $query = "INSERT INTO product (s_id, p_name, p_price, p_category,p_model) VALUES (?, ?, ?, ?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isdss", $s_id, $title, $price, $category,$model);
        
        if ($stmt->execute()) {
            $last_inserted_id = $stmt->insert_id;
            
            // Get file extension
            $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
            $new_image_filename = $last_inserted_id . '.' . $imageFileType;
            $new_image_path = "../product/" . $new_image_filename;

            // Move the uploaded file
            if (move_uploaded_file($image["tmp_name"], $new_image_path)) {
                // Update product with the image path
                    echo "Ad posted successfully!";
                } 
             else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Error: " . $conn->error;
        }
        
        $stmt->close();
        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo "<p class='error-msg'>$error</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Post Ad</title>
    <link rel="stylesheet" type="text/css" href="/sellerpage/css/mystyle.css">
</head>
<body>
    <div class="post-ad-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Ad Title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" placeholder="Ad Description" rows="4" cols="30"></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="price" placeholder="Price"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><input type="text" name="Category" placeholder="Category"></td>
                </tr>
                <tr>
                    <td>Model:</td>
                    <td><input type="text" name="Model" placeholder="Model"></td>
                </tr>
                <tr>
                    <td>Upload Image:</td>
                    <td>  <input type="file" name="image" accept=".jpg, image/jpeg"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Post Ad" class="btn-post-ad"></td>
                </tr>
            </table>
        </form>
        <a href="profile.php" class="logout-btn">Back to Profile</a>
    </div>
</body>
</html>
