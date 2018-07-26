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
    <body>
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