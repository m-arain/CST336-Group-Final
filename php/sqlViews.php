<?php
    include 'dbConnection.php';
    include '../html/BSJQ.html';
    session_start();
    $conn = getDatabaseConnection();
    
    // Auth
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    $sql = "SELECT * FROM ";
    
    if(isset($_GET['customerCartTotal'])){
        $sql .= "All_Users_Cart_Total";
    }else if(isset($_GET['AvgCost'])){
        $sql .= "Product_Pice_Average";
    }else if(isset($_GET['purchaseHistory'])){
        $sql .= "Purchase_History group by username, invoice";
    }
    
    echo $sql;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    print_r($results);

?>