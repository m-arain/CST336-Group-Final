<?php
    include "dbConnection.php";
    session_start();
    $conn = getDatabaseConnection();
    
    $np = array();
    
    $np[":username"] =  $_POST["username"];
    $np[":password"] = sha1($_POST['password']);
    
    //assume login is for normal user
    $isAdmin = false;
    
    //If user selected to log in as admin set table to admin, else users
    if(isset($_POST['isAdmin'])){
        $table = "admin";
        $isAdmin = true;
    }else{
        $table = "users";
    }
    
    $sql = "SELECT * FROM $table WHERE username = :username AND password = :password";
    echo $sql;
    print_r($np);
    
    // Execute sql on correct table with username and password 
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If no record, assume incorrect
    // Else, check if admin was selected, and if so its successful
        // Therefore, set session varible isAdmin
    if(empty($record)){
        $_SESSION['incorrect'] =true;
        header("Location:login.php");
    }else{
        $_SESSION["incorrect"] = false;
        if($isAdmin){
            $_SESSION["username"] = $record['name'];
            $_SESSION['userId'] = $record['id'];
            $_SESSION['isAdmin'] = true;
            header("Location:admin.php");
        }else{
            $_SESSION["username"] = $record['name'];
            $_SESSION['userId'] = $record['id'];
            header("Location:../index.php");
        }
    }
?>