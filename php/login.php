<?php
    session_start();
    
    if(isset($_SESSION['username'])){
        header("Location:logout.php");
    }
?>
<!DOCTYPE html>
<html>
    <head></head>
    </head>
    
    <body style="text-align:center;">
        <form method="POST" action="auth.php">
            <label for="userinput">Username</label><br> <input id="userinput" type="text" class="form-control center-input" name="username"/><br>
            <label for="passinput">Password</label> <br> <input id="passinput" type="password" class="form-control center-input" name="password"/><br>
            <label for="admin">Admin</label> <input id="admin" type="checkbox" name="isAdmin"/><br/>
            <input type="submit" class="btn btn-primary" value="login"/>
            <?php
                
                if($_SESSION['incorrect']){
                    echo "<p class='lead' id='error' style='color:red;'>";
                    echo "<strong>Incorrect Username or Password!</strong></p>";
                }
            ?>
        </form>        
    </body>
</html>