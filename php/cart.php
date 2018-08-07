<?php
    
    include 'dbConnection.php';
    include 'userFunctions.php';
    session_start();
    include '../html/BSJQ.html';
    
    $conn = getDatabaseConnection();
    
    
    
    echo '<link href="../css/finalStyles.css" rel="stylesheet" type="text/css" />';
    echo '<div id="cartIndex">';
    
    
    
    
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }else if($_SESSION['isAdmin']){
         echo "<h1>".$_SESSION["username"].", you're an admin, no shopping!</h1>";
         echo "<a href='admin.php'>ADMIN HOME</a>";
    }else{
        $userId = $_SESSION['userId'];
        
    
        if(isset($_GET['rmCart'])){
            echo "Removing item from cart";
            $result = removeItemCart($_GET['cartId']);
            if($result > 0){
                echo "<h2> Successfully removed product from cart.</h2>";
            }else{
                echo "<h2> Unsuccessfully removed product from cart.</h2>";
            }
        }else if(isset($_GET['addCart'])){
            echo $_GET['quantity'];
            $record = addCart($userId, $_GET['productId'], $_GET['quantity']);
            if($record > 0){
                echo "Added to cart!<br/><br/>";
            }else{
                echo "Failed adding to cart!<br/><br/>";
            }
            header("Location: cart.php");
        }else if(isset($_GET['updateCart'])){
            global $conn;
            echo "Updating cart...";
            $cartId = $_GET['cartId'];
            $updateQuantity = $_GET['updateQuantity'];
            $userId = $_SESSION['userId'];

            $sql = "UPDATE cart SET quantity = :quantity WHERE username = :username AND id = :id";
            $np[':quantity'] = $updateQuantity;
            $np[':username'] = $userId;
            $np[':id'] = $cartId;
            
            $stmt = $conn->prepare($sql);
            $results = $stmt->execute($np);
            if($results>0){
                echo "Update successful";
            }else{
                echo "Update unsuccessful";
            }
        }
        
        $data = getUsersCart($userId);
        $cartItems = $data[0];
        $cartSubtotal = $data[1];
        
        //Added html for cart.php display
        echo '<div id= "utilNav">';
        
        $tax = 0.08;
        $shipping = 5.00;
        echo "<h1>".$_SESSION["username"]."'s cart!</h1>";
        
        echo '</div>';
        echo '<div id="bodyNav">';
        echo '<br /><br />';
        
        printCartItem($cartItems);
        if($cartSubtotal > 0){
            $total = plusSHH($cartSubtotal, $tax, $shipping);
            echo "Tax: 8% Shipping: $$shipping";
            echo "<h3>Total: $$total</h3>";
            printCheckout();
        }
        
         echo "<br/><br/> <a href='../index.php'>HOME</a>";
        echo "</div>";
        echo "</div>";
        //
    }
    
?>