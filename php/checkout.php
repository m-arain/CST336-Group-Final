<?php
    
    include 'dbConnection.php';
    include 'userFunctions.php';
    session_start();
    include '../html/BSJQ.html';
    
    $conn = getDatabaseConnection();
    
    //Added html for checkout.php display
    echo '<div id= "utilNav">';
    echo '<h2> Checkout </h2>';
    echo '</div>';
    echo '<link href="../css/finalStyles.css" rel="stylesheet" type="text/css" />';
    echo '<div id="bodyNav">';
     
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }else if($_SESSION['isAdmin']){
        echo "Admins are not allowed to shop. <a href='admin.php'>ADMIN</a>";
    }
    if(isset($_GET['checkout'])){
        $cartData = checkout();
        if($cartData[0]){
            echo "<h1>Thank you for shopping with us!</h1>";
            printItemSummary($cartData[0]);
            echo "<h2>Total: $".plusSHH($cartData[1], 0.08, 5.00)."</h2>";
        }
        echo "<br/><br/> <a href='../index.php'>HOME</a>";  
        echo "</div>";
     //
    }
    
    
?>