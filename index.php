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
                    <input type="text" class="form-control" name="query" id="searchBar" placeholder="Search...">
                    <input type="submit" value="Submit" class="btn btn-default">
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