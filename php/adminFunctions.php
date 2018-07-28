<?php

 function createUser($name, $username, $password){
        global $conn;
        $np = array();
        $np[":name"] = $name;
        $np[":username"] = $username;
        $np[":pass"] = $password;
        $sql = "INSERT INTO users (id, name, invoice, username, password) VALUES (NULL, :name, 0, :username, SHA1(:pass))";
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
    };
    
    function addProduct($name, $desc, $price){
        global $conn;
        $sql = "INSERT INTO product (id, name, description, price) VALUES (NULL, :name, :desc, :price)";
        $np = array();
        $np[':name'] = $name;
        $np[':desc'] = $desc;
        $np[':price'] = $price;
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        print_r($records);
    }
    

?>