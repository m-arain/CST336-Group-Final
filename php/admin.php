<?php
    include '../html/BSJQ.html';
    session_start();
    if($_SESSION['isAdmin']){
        echo "ADMIN LOGGED IN";
        
    }else{
        echo "You're not logged in";
    }

?>



<!DOCTYPE html>
<html>
    <body id ="adminBody" style="text-align:center;">
        <h1> Admin Home </h1>
        <button id="addProduct">Add Product</button>
        <button id="updateProduct">Update Product</button>
        
        <form action="sqlViews.php">
            <input type="submit" name="customerCartTotal" value="Customer Cart Total"/>
            <input type="submit" name="AvgCost" value="Averge Product Cost"/>
            <input type="submit" name="purchaseHistory" value="Purchase History"/>
        </form>
        
        
        
        <script type="text/javascript" >
            document.getElementById('addProduct').onclick = function (){
                location.href = "addProduct.php";CST336-Group-Final/php/admin.php
            };
            
            document.getElementById('updateProduct').onclick = function (){
                location.href = "updateProduct.php";
            };
        </script>
    </body>
</html>