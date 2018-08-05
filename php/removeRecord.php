<?php
    include 'dbConnection.php';
    include 'adminFunctions.php';
    session_start();
    $conn = getDatabaseConnection();
    
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    if(isset($_GET['showPurchaseHistory'])){
       printPurchaseHistory(getPurchaseHistory());
    }else if(isset($_GET['rmPurchaseHistory'])){
        $rmId = $_GET['rmId'];
        echo "removing $rmId <br/>";
        $result = removePurchaseHistory($rmId);
        echo "Removed $result records";
    }
?>