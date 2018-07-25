<?php

    include 'php/dbConnection.php';
    $conn = getDatabaseConnection();
    
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
         <form> 
            <input type="submit" class = 'btn btn-primary' id="login-button" name ="login" value="Admin Login"/>
            <!-- Add a Cart Button that aligns with the login button -->   
            <button type="button" class="btn btn-default btn">
              <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
            </button>
         </form> 
            <h1> ICS Electronics </h1>
        </div>
        
        
        <div id="bodyNav">
            
           
            
            <hr>
            <div class="wrapper">
                
                <div class="image">
                    <img id="logo" src="img/logoREPLACE.png" alt="logo"> 
                </div>
                
                <div class="form">
                    <form>
                        <h2>Product</h2> <input type="text" name="product" placeholder="name"/>
                        <br/><br/>
                        <h2>Description</h2> <input type="text" name="desc" />
                        <br/><br/>
                        <!--<h2>Category</h2>-->
                        <!--    <select name="category" class="selectmenu">-->
                        <!--        <option value="">Select One</option>-->
                        <!--    </select>-->
                        <br/><br/>
                        <h2>Price</h2> 
                        <h3>From <input type="text" name="priceFrom" class="textinput"/></h3>
                        <h3>To   <input type="text" name="priceTo" class="textinput"/></h3>
                               
                        <br/>
                        <h2>Order by</h2>
                        <br/>
                        <input type="radio" name="orderBy" value="name" class="radioinput"/><span>Name</span>
                        &nbsp;&nbsp;
                        <input type="radio" name="orderBy" value="price" /><span>Price</span>
                        <br/><br/>
                        <input type="submit" name="searchForm" class="btn btn-primary"value="SEARCH"/>    
                    </form>
                </div>
            </div>
            
            
            <div id="item-of-the-day">
                <hr>
                <br /><br />
                <h2> Item of the Day</h2>
                <br /><br />
            </div>
            
            
            <div id="searched-products">
                <hr>
                <br /><br />
                <h2>Products Found:</h2>
                <h3> (this is where our searched products will appear) </h2>
                    <?php getProducts(); ?>
                <br /><br />
                <hr>
            </div>
          
            
        </div>
        
        
        
        <footer>
            CST 336. 2018&copy; Walker <br />
            <strong>DISCLAIMER:</strong> The Information on this webpage is
            used for academic purposes only! <br /><br />
            <img id="csumb" src="img/csumb.png" alt="CSUMB" width="100">
        
        </footer>  
        <br />
        <br />
    </body>
</html>