<?php

class myDB {
    
    //open connection

    function openCon() {
        $DBHost = "localhost";
        $DBuser = "root";
        $DBpassword = "";
        $DBname = "user";

        $connectionObject = new mysqli($DBHost, $DBuser, $DBpassword, $DBname);

       //object oriented code to check connection
        if ($connectionObject->connect_error) {
            die("Connection failed: " . $connectionObject->connect_error);
        }
        

        return $connectionObject;
    }   


    // Insert data into the database
    function insertData($connectionObject,$fname,$lname,$phone,$email,$password,$street) {
        // // Check if username already exists
        // if ($this->isUsernameExists($connectionObject, $fname)) {
        //     return 0; // Username already exists
        // }

        $sql = "INSERT INTO `customer`(`c_first_name`, `c_last_name`, `c_phone`, `c_email`, `c_password`, `c_street`) VALUES ('$fname','$lname','$phone','$email','$password','$street')";
              
        // Execute the query
        if ($connectionObject->query($sql)) {
            return 1; // Success
        } else {
            return 0; // Failure
        }
    }
    //show product details
    function showProduct($connectionObject){
        
        $sql = "SELECT `pr_id`, `p_name`, `p_price`, `p_category`, `p_model` FROM `product`";
        // Execute the query
        $result = $connectionObject->query($sql);
        $stmt=$connectionObject->prepare($sql);

        $stmt->execute();
        // Check if query was successful and return the result set
        // if ($result) {
        //     return $result; // Return the result set if successful
        // } else {
        //     return null; // Return null if the query fails
        // }
        return $stmt->get_result();
    }
    function showProductById($connectionObject, $pr_id) {
        $sql = "SELECT `pr_id`, `p_name`, `p_price`, `p_category`, `p_model` FROM `product` WHERE `pr_id` = ?";
        $stmt = $connectionObject->prepare($sql);
        $stmt->bind_param("i", $pr_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    function showProductByName($connectionObject, $p_name) {
        $sql = "SELECT `pr_id`, `p_name`, `p_price`, `p_category`, `p_model` FROM `product` WHERE `p_name` LIKE ? LIMIT 10";
        $stmt = $connectionObject->prepare($sql);
        $p_name_like = "%" . $p_name . "%"; // For partial matching
        $stmt->bind_param("s", $p_name_like);
        $stmt->execute();
        return $stmt->get_result();
    }





    //insert data into the database admin table
    // function insertAdminData($connectionObject,$fullname,$username,$email,$nid,$phone,$dob,$gender,$present_address,$permanent_address,$password,$repassword,$userType) {
    //     // Check if username already exists
    //     if ($this->isUsernameExists($connectionObject, $username)) {
    //         return 0; // Username already exists
    //     }

    //     $sql = "INSERT INTO admin (fullname, username, email, nid, phone, dob,gender, present_address, permanent_address, password, repassword, userType)
    //     VALUES ('$fullname', '$username', '$email', '$nid', '$phone', '$dob', '$gender', '$present_address', '$permanent_address', '$password', '$repassword', '$userType')";

    //     // Execute the query
    //     if ($connectionObject->query($sql)) {
    //         return 1; // Success
    //     } else {
    //         return 0; // Failure
    //     }
    // }





    

    //put the username and password, userType in user table in the database
    function insertUser($connectionObject, $username, $password,$email,$userType) {
        // Check if username already exists
        if ($this->isUsernameExists($connectionObject, $username)) {
            return 0; // Username already exists
        }

        $sql = "INSERT INTO users (username, password,email,userType) 
        VALUES ('$username', '$password','$email','$userType')";
              
        // Execute the query
        if ($connectionObject->query($sql)) {
            return 1; // Success
        } else {
            return 0; // Failure
        }
    }




    //  //getUserByUsername
    //  function getUserByUsername($connectionObject, $username) {
    //     $sql = "SELECT * FROM users WHERE username = '$username'";
    //     $result = $connectionObject->query($sql);
    //     return $result->fetch_assoc();
    // }
    

  


    // //isUsernameExists
    // function isUsernameExists($connectionObject,$username) {
    //     $sql = "SELECT * FROM users WHERE username = '$username'";
    //     $result = $connectionObject->query($sql);
    //     return $result->num_rows > 0;
    // }

   

    // //updateUserPassword
    // function updateUserPassword($connectionObject, $username, $newPassword) {
    //     $sql = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
    //     $connectionObject->query($sql);
    // }
    // //updateUserEmail
    // function updateUserEmail($connectionObject, $username, $newEmail) {
    //     $sql = "UPDATE users SET email = '$newEmail' WHERE username = '$username'";
    //     $connectionObject->query($sql);
    // }


    // //post job
    // function postJob($connectionObject, $client_id, $title, $description, $job_type, $payment) {
    //     $sql = "INSERT INTO jobs (client_id, title, description, job_type, payment) 
    //     VALUES ('$client_id', '$title', '$description', '$job_type', '$payment')";
              
    //     // Execute the query
    //     if ($connectionObject->query($sql)) {
    //         return 1; // Success
    //     } else {
    //         return 0; // Failure
    //     }
    // }

    // // Function to fetch jobs
    // function ViewJobs($conn, $client_id) {
    //     $sql = "SELECT * FROM jobs WHERE client_id = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("i", $client_id);
    //     $stmt->execute();
    //      return $stmt->get_result();

    // }
    
    

    
    // Close connection
    function closeCon($connectionObject) {
        $connectionObject->close();
    }
}

?>