<?php

class myDB {
    public function opencon() {
        $DBHost = "localhost";
        $DBuser = "root";
        $DBpassword = "";
        $DBname = "user";

        $connectionObject = new mysqli($DBHost, $DBuser, $DBpassword, $DBname);

        if ($connectionObject->connect_error) {
            die("Connection failed: " . $connectionObject->connect_error);
        }
        return $connectionObject;
    }

    public function insertEmployee($name, $email, $phone, $address, $password, $department, $connectionObject) {
         $stmt = $connectionObject->prepare("INSERT INTO employee (e_name, e_email, e_phone, e_address, e_password, e_department) 
         VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $phone, $address, $password, $department);

        if ($stmt->execute()) {
            return 1;
        } else {
            error_log("Error executing insertEmployee: " . $stmt->error);
            return 0; 
        }
    }

    public function showEmployees($connectionObject) {
        $sql = "SELECT * FROM employee";
        return $connectionObject->query($sql);
    }

    public function getEmployeeByID($connectionObject, $e_id) {
        $stmt = $connectionObject->prepare("SELECT * FROM employee WHERE e_id = ?");
        $stmt->bind_param("i", $e_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateEmployee($connectionObject, $name, $email, $phone, $address, $department, $e_id) {
        $stmt = $connectionObject->prepare("UPDATE employee SET 
         e_name = ?, e_email = ?, e_phone = ?, e_address = ?, e_department = ? 
        WHERE e_id = ?");
        $stmt->bind_param("sssssi", $name, $email, $phone, $address, $department, $e_id);
        return $stmt->execute();
    }

    public function deleteEmployee($connectionObject, $e_id) {
        $stmt = $connectionObject->prepare("DELETE FROM employee WHERE e_id = ?");
        $stmt->bind_param("i", $e_id);
        return $stmt->execute();
    }

    public function closeCon($connectionObject) {
        $connectionObject->close();
    }
}
?>
