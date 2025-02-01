<?php
session_start();
require '../../model/db.php';
$conn = (new myDB())->opencon();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("UPDATE employee SET e_name = ?, e_email = ?, e_phone = ? WHERE e_id = ?");
    $stmt->bind_param("sssi", $name, $email, $phone, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "name" => $name, "email" => $email, "phone" => $phone]);
        exit();
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update"]);
        exit();
    }
}

$conn->close();
?>
