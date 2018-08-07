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
    include '../html/BSJQ.html';
    session_start();
    $conn = getDatabaseConnection();
    
    // Auth
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    function checkSelected($a, $b){
        echo ($a == $b)? "selected":"";
    }
    
    //Display products with update and remove button
    function displayProducts(){
        global $conn;
        $sql = "SELECT * FROM product";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($results as $result){
            echo "<div style='display:inline-flex;'>";
            echo $result['name'] .
            "<form>
                <input type='hidden' name='updateId' value='".$result['id']."' />
                <input type='submit' name='updateProduct' value='Update'/>
            </form>";
            
            echo "<button id='rmBtn".$result['id']."'>Remove</button>";
            
            echo "</div><br/>";
            
            echo "<script>
                    $('#rmBtn".$result['id']."').on('click', function (e){
                        console.log(e.target.id.substring(5));
                        if(window.confirm('Are you sure you want to delete?')){
                            $.get('updateProduct.php?removeProduct=1&updateId=".$result['id']."', function (data, res){
                                console.log(data, status);
                                window.location.href = 'updateProduct.php';       
                            });
                        }
                    });
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
                Category <select name='category'>";
                            echo "<option value=''>Choose</option>";
                            echo "<option value='1'";
                                echo ($results['category']==1)?"selected":"";
                                echo ">Cat1</option>";
                            echo "<option value='2'";
                                echo ($results['category']==2)?"selected":"";
                                echo ">Cat2</option>";
                            echo "<option value='3'";
                                echo ($results['category']==3)?"selected":"";
                                echo ">Cat3</option>";
                        echo "</select><br/>
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
