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

    public function insertData($name, $email,$phone, $address,$password,  $account_number,$connectionObject) {
        $sql = "INSERT INTO seller (s_name, s_email,s_phone, s_address, s_password,  s_bank_account_no) 
                VALUES ('$name', '$email', '$phone','$address','$password',  '$account_number')";
        if ($connectionObject->query($sql)) {
            return 1;
        } else {
            return 0;
        }
    }


    public function showusers($seller, $connectionObject) {
        $sql = "SELECT * FROM seller";
        $results = $connectionObject->query($sql);
        return $results;
    }
    function getUsersByID($seller, $connectionObject,$s_id){
        $sql="SELECT * FROM seller where s_id= $s_id";
        $results = $connectionObject->query($sql);
        return $results;
    }
    function updateUsers($seller, $connectionObject, $name, $email, $phone, $address, $account_number, $s_id)
    {
        $sql = "UPDATE $seller SET 
            s_name = '$name',
            s_email = '$email',
            s_phone = '$phone',
            s_address = '$address',
            s_bank_account_no = '$account_number' 
            WHERE s_id = $s_id";
        return $connectionObject->query($sql);
    }

    public function closeCon($connectionObject) {
        $connectionObject->close();
    }
}
?>
