<?php
    session_start();
    
    if(isset($_SESSION['username'])){
        header("Location:logout.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Log In </title>
        <link href="../css/finalStyles.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    </head>
    
    <body id="logInBody" style="text-align:center;">
        <h1> Log In </h1>
        <div id="logMeIn">
            <hr>
            <br /><br />
            
            <form method="POST" action="auth.php">
                <label for="userinput">Username</label><br> <input id="userinput" type="text" class="form-control center-input" name="username"/><br>
                <label for="passinput">Password</label> <br> <input id="passinput" type="password" class="form-control center-input" name="password"/><br>
                <label for="admin">Admin</label> <input id="admin" type="checkbox" name="isAdmin"/><br/>
                <input type="submit" class="btn btn-primary" value="login"/>
                <br /><br />
                <?php
                    
                    if($_SESSION['incorrect']){
                        echo "<p class='lead' id='error' style='color:red;'>";
                        echo "<strong>Incorrect Username or Password!</strong></p>";
                    }
                ?>
            </form>
            
            <br />
            <hr>
        </div>
         <footer>
            CST 336. 2018&copy; Walker <br />
            <strong>DISCLAIMER:</strong> The Information on this webpage is
            used for academic purposes only! <br /><br />
            <img id="csumb" src="../img/csumb.png" alt="CSUMB" width="100">
        
        </footer>  
    </body>
</html>