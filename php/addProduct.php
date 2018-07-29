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
        <link href="../css/finalStyles.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body style="text-align:center;">
        <h1> Add Product </h1>
        <div id="bodyNav">
            <hr>
            <br /><br />
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
            <br/><br/><br/>
        </div>
    </body>
</html>