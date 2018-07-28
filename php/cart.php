<?php
    
    include 'dbConnection.php';
    include 'userFunctions.php';
    session_start();
    include '../html/BSJQ.html';
    
    $conn = getDatabaseConnection();
    
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    
    $userId = $_SESSION['userId'];
    
    if(isset($_GET['rmCart'])){
        echo "Removing item from cart";
        $result = removeItemCart($_GET['productId']);
        if($result > 0){
            echo "<h2> Successfully removed product from cart.</h2>";
        }else{
            echo "<h2> Unsuccessfully removed product from cart.</h2>";
        }
    }else if(isset($_GET['addCart'])){
        
        $productId = $_GET['productId'];
        $record = addCart($userId, $productId);
        if($record > 0){
            echo "Added to cart!<br/><br/>";
        }else{
            echo "Failed adding to cart!<br/><br/>";
        }
    }
    
    $data = getUsersCart($userId);
    $cartItems = $data[0];
    $cartSubtotal = $data[1];
    $tax = 0.08;
    $shipping = 5.00;
    print_r($_SESSION);
    echo "<h1>".$_SESSION["username"]."'s cart!</h1>";
    
    printListItem($cartItems, false);
    
    $total = $cartSubtotal + $shipping + round($cartSubtotal*$tax, 2);
    echo "Total: $$total";
?>