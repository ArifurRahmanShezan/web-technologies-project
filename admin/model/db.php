<?php

class myDB
{

    function openCon()
    {
        $DBHost = "localhost:3306";
        $DBUser = "root";
        $DBPassword = "";
        $DBName = "database";
        $connectionObject = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);
        return $connectionObject;
    }

    function insertData($fname,$email,$pass,$gender,$number,$dob,$preadd, $connectionObject)
    {
        $sql = "INSERT INTO users(name,email,pass) 
        VALUES('$fname','$email','$pass')";
        if ($connectionObject->query($sql)) {
            return 1;
        } else {
            return 0;
        }
    }
    function isUsernameExists($connectionObject,$username) {
        $sql = "SELECT * FROM users WHERE email = '$username'";
        $result = $connectionObject->query($sql);
        return $result->num_rows > 0;
    }

    function closecon($connectionObject)
    {
        $connectionObject->close();
    }
}