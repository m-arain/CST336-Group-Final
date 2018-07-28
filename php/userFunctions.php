<?php
    function addCart($userid, $product){
        global $conn;
        $sql = "INSERT INTO cart (id, username, product) VALUES (NULL, :userid, :product)";
        $np = array();
        $np[':userid'] = $userid;
        $np[':product'] = $product;
        
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        return $records;
    }
    
    function getUsersCart($userid){
        
        global $conn;
        $sql = "SELECT users.username, product.name, product.description, product.price, cart.id FROM cart
                inner join users on cart.username = users.id
                inner join product on cart.product = product.id
                where cart.username =:userid";
        $np[":userid"] = $userid;
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($records);
        $subtotal = 0;
        foreach($records as $record){
            $subtotal += $record['price'];
        }
        //echo $subtotal;
        return [$records, $subtotal];
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
    
?>