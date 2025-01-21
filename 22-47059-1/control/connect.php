<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to create an employee
function createEmployee($conn, $name, $email, $position) {
    $sql = "INSERT INTO employees (name, email, position) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $position);

    if ($stmt->execute()) {
        echo "New employee created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Function to read all employees
function readEmployees($conn) {
    $sql = "SELECT id, name, email, position FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Email</th><th>Position</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["position"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found.";
    }
}

// Function to update an employee
function updateEmployee($conn, $id, $name, $email, $position) {
    $sql = "UPDATE employees SET name = ?, email = ?, position = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $position, $id);

    if ($stmt->execute()) {
        echo "Employee updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Function to delete an employee
function deleteEmployee($conn, $id) {
    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Employee deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Example usage (Uncomment as needed)
// createEmployee($conn, "John Doe", "john.doe@example.com", "Developer");
// readEmployees($conn);
// updateEmployee($conn, 1, "Jane Doe", "jane.doe@example.com", "Manager");
// deleteEmployee($conn, 1);

$conn->close();
?>
