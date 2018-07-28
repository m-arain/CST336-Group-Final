<?php

    session_start();
    if($_SESSION['isAdmin']){
        echo "ADMIN LOGGED IN";
        
    }else{
        echo "You're not logged in";
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
    <body id ="adminBody" style="text-align:center;">
        <h1> Admin Home </h1>
        <button id="addProduct">Add Product</button>
        <button id="updateProduct">Update Product</button>
        <script type="text/javascript" >
            document.getElementById('addProduct').onclick = function (){
                location.href = "addProduct.php";
            };
            
            document.getElementById('updateProduct').onclick = function (){
                location.href = "updateProduct.php";
            };
        </script>
    </body>
</html>