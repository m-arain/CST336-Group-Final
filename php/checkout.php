<?php
    
    include 'dbConnection.php';
    include 'userFunctions.php';
    session_start();
    include '../html/BSJQ.html';
    
    $conn = getDatabaseConnection();
    
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }else if($_SESSION['isAdmin']){
        echo "Admins are not allowed to shop. <a href='admin.php'>ADMIN</a>";
    }
    if(isset($_GET['checkout'])){
        checkout();
        echo "<br/><br/> <a href='../index.php'>HOME</a>";
    }
    
    
?>