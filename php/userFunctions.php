<?php
    function addCart($userid, $product, $quantity){
        global $conn;
        $sql = "INSERT INTO cart (id, username, product, quantity) VALUES (NULL, :userid, :product, :quantity)";
        $np = array();
        $np[':userid'] = $userid;
        $np[':product'] = $product;
        $np[':quantity'] = $quantity;
        
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        return $records;
    }
    
    function getUsersCart($userid){
        
        global $conn;
        $sql = "SELECT users.username, product.name, product.description, product.price, cart.quantity, cart.id, product.id as productId FROM cart
                inner join users on cart.username = users.id
                inner join product on cart.product = product.id
                where cart.username =:userid";
        $np[":userid"] = $userid;
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $subtotal = 0;
        if($record){
            foreach($records as $record){
                $subtotal += $record['price']*$record['quantity'];
            }
            return [$records, $subtotal];
        }
        return [false, 0];
        
    }
    
    function removeItemCart($cartItemId){
        global $conn;
        $sql = "DELETE FROM cart WHERE id = :id";
        $np[':id'] = $cartItemId;
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        //print_r($records);
        return $records;
    }
    
    
    
    function printCheckout(){
        //Print form with hidden values and submit=checkout
        echo "<form action='checkout.php'>
                    <input type='submit' name='checkout' value='Checkout'/>
            </form>";
    }
    
    function getUserCurrentInvoice($userId){
        global $conn;
        $sql = "SELECT invoice FROM users WHERE id = :id";
        $np['id'] = $userId;
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "INVOCIE: ";
        print_r($record);
        return $record;
    }
    
    function removeCartItems(){
        global $conn;
        $sql = "DELETE FROM cart WHERE username = :username";
        $np[':username'] = $_SESSION['userId'];
        
        $stmt = $conn->prepare($sql);
        $reults = $stmt->execute($np);
        return $results;
    }
    
    
    function updateUserInvoice($currentInvoiceNumber){
        global $conn;
        $sql = "UPDATE users SET invoice = :invoice WHERE id = :id";
        $np[':invoice'] = $currentInvoiceNumber+1;
        $np[':id'] = $_SESSION['userId'];
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($np);
        return $result;
     }
    
    function checkout(){
        global $conn;
        $cartInfo = getUsersCart($_SESSION['userId']);
        $cartItems = $cartInfo[0];
        $cartSubtotal = $cartInfo[1];
        
        if($cartItems){
             $index = 0;
            $sql = "INSERT INTO purchaseHistory (invoice, username, product, quantity)
            VALUES";
            $np['invoice'] = getUserCurrentInvoice($_SESSION['userId'])['invoice'];
            $np['username'] = $_SESSION['userId'];
            foreach($cartItems as $item){
                $sql .= "(:invoice, :username, :product$index, :quantity$index),";
                $np[":product$index"] = $item['productId'];
                $np["quantity$index"] = $item['quantity'];
            }
            $sql = substr($sql, 0, -1);
            
            $stmt = $conn->prepare($sql);
            $results = $stmt->execute($np);
            echo "INSERTED $results";
            
            if(removeCartItems() > 0){
                echo "Removed items";
            }else{
                    echo "Removed zero items.";
            }
            
            if(updateUserInvoice($np['invoice']) > 0){
                echo "Update Successful";
            }else{
                echo "Update Unsuccessful";
            }
        }else{
            echo "No items in cart to checkout";
        }
       
        
    }
    
  
?>