<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head></head>
    </head>
    
    <body style="text-align:center;">
        <form method="POST" action="auth.php">
            Username:<br> <input type="text" class="form-control center-input" name="username"/><br>
            Password:<br> <input type="password" class="form-control center-input" name="password"/><br>
            
            <input type="submit" class="btn btn-primary" value="Submit"/>
            <?php
                
                if($_SESSION['incorrect']){
                    echo "<p class='lead' id='error' style='color:red;'>";
                    echo "<strong>Incorrect Username or Password!</strong></p>";
                }
            ?>
        </form>        
    </body>
</html>