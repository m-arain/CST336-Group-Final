<?php
    include 'dbConnection.php';
    session_start();
    $conn = getDatabaseConnection();
    
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    function displayProducts(){
        global $conn;
        $sql = "SELECT * FROM product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($results as $result){
            echo $result['name'] .
            "<form><input type='hidden' name='updateId' value='".$result['id']."' /><input type='submit' name='updateProduct' value='Update'/></form>";
        }
    }
    
    
    if(isset($_GET['updateProduct'])){
        //query database and echo prefilled form
        echo "Pre filled Form";
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
    }else if(isset($_GET['updateForm'])){
        echo "Updting Product!!!!";
        print_r($_GET);
        
        //sql to update product
        
        
        
        
    }else{
        displayProducts();    
    }
    
?>
