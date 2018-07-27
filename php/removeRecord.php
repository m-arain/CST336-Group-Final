<?php
    include 'dbConnection.php';
    session_start();
    $conn = getDatabaseConnection();
    
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    
    
    
    
    
?>