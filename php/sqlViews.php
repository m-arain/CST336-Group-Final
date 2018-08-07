<?php
    include 'dbConnection.php';
    include '../html/BSJQ.html';
    session_start();
    $conn = getDatabaseConnection();
    
    ////////////////////////////////
    //
    //   Query View from DB and then Display Results
    //
    ////////////////////////////////
    
    
    
    
    // Auth
    if(!$_SESSION['isAdmin']){
        header("Location: login.php");
    }
    
    $sql = "SELECT";
    
    // Query View
    if(isset($_GET['customerCartTotal'])){
        $sql .= " * FROM All_Users_Cart_Total";
    }else if(isset($_GET['AvgCost'])){
        $sql .= "* FROM Product_Pice_Average";
    }else if(isset($_GET['purchaseHistory'])){
        $sql .= " *, count(1) as 'totalItems', sum(subtotal) as 'total'  FROM Purchase_History group by username, invoice";
    }
  
    // Execute Query
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    // Display Results
    if(isset($_GET['customerCartTotal'])){
        echo "<h1>User's Cart total</h1>";
        foreach($results as $result){
            echo "<span class='field'> User:</span> ". $result['username'].
                 "<span class='field'> Total:</span> $".$result['total']."<br/>";   
        }
    }else if(isset($_GET['AvgCost'])){
        echo "<h1>Average Product Price per Category</h1>";
        foreach($results as $result){
            echo "<span class='field'> Category:</span> ". $result['category'].
                 "<span class='field'> Number of Products:</span> ".$result['Number of Products'],
                 "<span class='field'> Avg price of Products:</span> $".round($result['AVG Price'],2)
                 ."<br/>";   
        }
    }else if(isset($_GET['purchaseHistory'])){
        printPurchaseHistory($results, false, true);
    }
    
    
    //Link to Admin Home Page
    echo "<br/><a href='admin.php'>ADMIN HOME</a><br/>";
    

?>