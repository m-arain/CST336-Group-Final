<?php

    include 'php/dbConnection.php';
        //getDatabaseConnection
        //getProducts
    include 'php/userFunctions.php';
        //addCart
        //removeItemCart
        //getUsersCart
    session_start();
    $conn = getDatabaseConnection();
    $isLoggedIn = isset($_SESSION['username']);
    
    //Testing functions
    //createUser("Chrisasdasdasd Andaya", "candaya", "wow");
    //addProduct("second Pro", "Da two fer two", 299.89);
    //getProducts(); checks if form is set first, already being clled below form
    //addCart(1,2);
    //getUsersCart(1);
    //removeItemCart(1,2);

?>


<!DOCTYPE html>
<html>
    
    <head>
        <title> Computer Shop</title>
        <link href="css/finalStyles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    <body>
        
        <div id= "utilNav">
        
            <br/> <br/> 
        
            <button class = 'btn btn-primary' id="login-button" onclick="location.href='php/login.php'" name ="login"><?php echo ($isLoggedIn)?"Log Out":"Log In" ?></button>
            <!-- Add a Cart Button that aligns with the login button -->   
            <button type="button" class="btn btn-default btn" id="shoppingCart">
              <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
            </button>
        
            <br />
            
                
        </div>
        
        
        <div id="bodyNav">

            <hr>
            <div class="image">
                 <img id="logo" src="img/ICS_CompuTown.jpg" alt="logo"> 
            </div>
            <div class="wrapper">

                
                <div id="indexForm" class="form">
                    <form>
                        <h2>Search</h2>
                        Product <input type="text" name="product"/>
                        <!--Description <input type="text" name="desc"/>-->
                        <br/>
                        <!--<h2>Category</h2>-->
                        <!--    <select name="category" class="selectmenu">-->
                        <!--        <option value="">Select One</option>-->
                        <!--    </select>-->
                        <br/>
                        <h2>Price</h2> 
                        <span class="pricefromto">From <input type="text" name="priceFrom"/></span>
                        
                        <span class="pricefromto">To   <input type="text" name="priceTo" /></span><br/>
                               
                        <br/>
                        <h3>Order by</h3>
                        <br/>
                        <input type="radio" name="orderBy" value="name" /><span>Name</span>
                        &nbsp;&nbsp;
                        <input type="radio" name="orderBy" value="price" /><span>Price</span>
                        <br/><br/>
                        <input type="submit" name="searchForm" class="btn btn-primary"value="SEARCH"/>    
                    </form>
                </div>
            </div>

            <div id="searched-products">
                <hr>
                <br /><br />
                    <?php printListItem(getProducts()); ?>
                <br /><br />
                <hr>
            </div>
          
            
        </div>
        
        
        
        <footer>
            CST 336. 2018&copy; Infinite Cascade Solutions <br />
            <strong>DISCLAIMER:</strong> The Information on this webpage is
            used for academic purposes only! <br /><br />
            <img id="csumb" src="img/csumb.png" alt="CSUMB" width="100">
        
        </footer>  
        <br />
        <br />
        
        <script type="text/javascript" >
            $('#shoppingCart').on('click', function (){
                window.location.href = 'php/cart.php';
            });
        </script>
    </body>
</html>