<?php
    ///////////////////////////////////
    ///
    ///     File lifecycle
    ///
    ///////////////////////////////////
    
    //ISSUE: SCRIPT FOR CONFIRM NEEDS TIME TO LOAD, ELSE CLICKING REMOVE WILL INSTANTLY REMOVE WITHOUT WARNING
    
    // First, check if admin is logged in via session 'isAdmin'
    // Second, check for form submission
        // 1. removeProduct -> (product list button) confirm dialog, then delete query to DB
        // 1. updateProduct -> (product list button) opens up pre filled form for a given updateId
        // 1. removeForm -> This form will submit to update the product in DB
    // If no form is submitted and admin is logged in, a list of products will be displayed
    
    include 'dbConnection.php';
    session_start();
    $conn = getDatabaseConnection();
    
    // Auth
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    //Display products with update and remove button
    function displayProducts(){
        global $conn;
        $sql = "SELECT * FROM product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($results as $result){
            echo $result['name'] .
            "<form>
                <input type='hidden' name='updateId' value='".$result['id']."' />
                <input type='submit' name='updateProduct' value='Update'/>
                <input type='submit' name='removeProduct' value='Remove' id='removeBtn'/>
            </form>";
            
            echo "<script>
                    removeBtn = document.getElementById('removeBtn');                
                    removeBtn.onclick = function(e){
                        if(!window.confirm('Are you sure you want to remove this product?')){
                            e.preventDefault();    
                        }
                    };
                </script>";
        }
    }
    
    //Remove product
    if(isset($_GET['removeProduct'])){
       $sql = "DELETE FROM product where id = :id";
       $np[':id'] = $_GET['updateId'];
       $stmt = $conn->prepare($sql);
       $result = $stmt->execute($np);
       echo "$result product(s) removed.";
    }//print update form
    else if(isset($_GET['updateProduct'])){
        //query database and echo prefilled form
        echo "Pre filled Form<br/>";
        $sql = "SELECT * FROM product WHERE id = ".$_GET['updateId'];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($results);
        echo "<form>
                Name <input type='text' name='name' value='".$results['name']."' /><br/>
                Description <textarea name='desc' rows=2 cols=15 >".$results['description']."</textarea><br/>
                price <input type='number' name='price' value='".$results['price']."' /><br/>
                Category <select name='category'>
                            <option value=''>Choose</option>
                            <option value='1'>Cat1</option>
                            <option value='2'>Cat2</option>
                            <option value='3'>Cat3</option>
                        </select><br/>
                <input type='hidden' name='updateId' value='".$results['id']."'/>
                <input type='submit' name='updateForm' value='Update Product'/>
            </form> ";
    }//Process Form
    else if(isset($_GET['updateForm'])){
        echo "Updting Product!!!!<br/>";
        print_r($_GET);
        
        //sql to update product
        
        $sql = "UPDATE product SET name=:name, description = :description, price = :price, category = :category WHERE id = :updateId";
        $np = array(
                ":name" => $_GET['name'],
                ":description" => $_GET['desc'],
                ":price" => $_GET['price'],
                ":category" => $_GET['category'],
                ":updateId" => $_GET['updateId']
            );
            
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($np);
        
        if($result > 0){
            echo "<br/>Update Successful <br/>";
            echo "Updated $result record(s)<br/>";
            echo "<br/><a href='admin.php'>Admin</a>";
        }else{
            echo "<br/>Update Unsuccessful<br/>";
            echo "<br/><a href='updateProduct.php'>Retry</a>";
        }
    }// Display product list
    else{
        displayProducts();    
    }
    
?>
