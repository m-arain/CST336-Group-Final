<?php
    include 'dbConnection.php';
    include '../html/BSJQ.html';
    session_start();
    $conn = getDatabaseConnection();
    
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    if(isset($_GET['submit'])){
        $np = array(
            ":name" => $_GET['name'],
            ":desc" => $_GET['desc'],
            ":price" => $_GET['price'],
            ":category" => $_GET['category'],
            );
        $sql = "INSERT INTO product (name, description, price, category) 
                VALUES (:name, :desc, :price, :category)";
        
        $stmt = $conn->prepare($sql);
        $results = $stmt->execute($np);
        if($results == 1){
            echo "product added successfuly";
        }
    }
    
    
?>


<!DOCTYPE html>
<html>
    <body style="text-align:center;">
        <h1> Add Product </h1>
        <div id="bodyNav">
            <hr>
            <br /><br />
            <form >
                Item Name<input type="text" name="name"/>
                Item Desc<input type="text" name="desc"/>
                Item price<input type="number" name="price" step="0.01"/>
                Item Category<select name="category">
                    <option value="">Choose</option>
                    <option value="1">Parts</option>
                    <option value="1.2">Monitor</option>
                    <option value="1.3">Power Supply</option>
                    <option value="1.4">Cases</option>
                    <option value="1.5">Motherboard</option>
                    <option value="1.6">Graphics Card</option>
                    <option value="1.7">CPU</option>
                    <option value="2">Accessories</option>
                    <option value="2.2">Keyboards</option>
                    <option value="2.3">Mice</option>
                </select>
                
                <input type="submit" name="submit" value="Submit"/>
            </form>
            <br/><a href='admin.php'>Admin</a>
            <br/><br/><br/>
        </div>
    </body>
</html>