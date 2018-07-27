<?php
    include 'dbConnection.php';
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
    <head>
        
    </head>
    <body>
        <form >
            Item Name<input type="text" name="name"/>
            Item Desc<input type="text" name="desc"/>
            Item price<input type="number" name="price"/>
            Item Category<select name="category">
                <option value="">Choose</option>
                <option value="1">Cat1</option>
                <option value="2">Cat2</option>
                <option value="3">Cat3</option>
            </select>
            
            <input type="submit" name="submit" value="Submit"/>
        </form>
        <br/><a href='admin.php'>Admin</a>
    </body>
</html>