<?php
    include 'dbConnection.php';
    include 'adminFunctions.php';
    include '../html/BSJQ.html';
    session_start();
    $conn = getDatabaseConnection();
    
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    if(isset($_GET['showPurchaseHistory'])){
       printPurchaseHistory(getPurchaseHistory(), true);
    }else if(isset($_GET['rmPurchaseHistory'])){
        $rmId = $_GET['rmId'];
        echo "removing $rmId <br/>";
        $result = removePurchaseHistory($rmId);
        echo "Removed $result records";
    }
?>