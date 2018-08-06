<?php
    function getDatabaseConnection($dbname = "store"){
        $host ="localhost";
        $username = "root";
        $password = "";
        
    if  (strpos($_SERVER[HTTP_HOST], herokuapp) !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
        $dbCon = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbCon -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbCon;
    }
    
   
    function getProducts(){
        global $conn;
        
        if(isset($_GET['searchForm'])){
     
             $namedParameters = array();
             
             $sql = "SELECT * FROM product WHERE 1=1";
             if(!empty($_GET['product'])){
                 $sql .= " AND name LIKE :productName";
                 $namedParameters[":productName"] = "%". $_GET['product'] ."%";
             }
             
            //  if(!empty($_GET['category'])){
            //      $sql .= " AND catId = :categoryId";
            //      $namedParameters[":categoryId"] = $_GET['category'];
            //  }
             
             if(!empty($_GET['desc'])){
                 $sql .= " AND description LIKE :desc ";
                 $namedParameters[":desc"] = "%".$_GET['desc']."%";
             }
             
             if(!empty($_GET['priceFrom'])){
                 $sql .= " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] = $_GET['priceFrom'];
             }
             
             if(!empty($_GET['priceTo'])){
                 $sql .= " AND price <= :priceTo";
                 $namedParameters[":priceTo"] = $_GET['priceTo'];
             }
             
             if(isset($_GET['orderBy'])){
                 if($_GET['orderBy'] == "price"){
                     $sql .= " ORDER BY price";
                 }else{
                     $sql .= " ORDER BY name";
                 }
             }
             $stmt = $conn->prepare($sql);
            $stmt->execute($namedParameters);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $records;
        }
    }
    
     function printItemSummary($results){
        if($results){
            foreach($results as $result){
                echo "<br/><h2>".$result['name']." ".$result['description']." $".
                    $result['price']." ".$result['category']." QTY".$result['quantity']."</h2>";
            }   
        }else{
            echo "No items to display.";
        }
    }
    
    function printCartItem($results){
        if($results){
            foreach($results as $result){
            
                echo "<form>";
                    echo '<strong>';
                    echo $result['name']." ".$result['price']." ".$result['category'];
                    echo '</strong>';
                    echo "QTY <input type='number' name='updateQuantity' value='".$result['quantity']."' class=''/>"; 
                    echo "<input type='submit' name='updateCart' value='Update Quantity' class='btn btn-info'/>";  
                    echo "<input type='submit' name='rmCart' value='Remove' class='btn btn-danger'/>";  
                    echo "<input type='hidden' name='cartId' value='".$result['id']."' />";
                echo "</form>";
            }   
        }else{
            echo "No items to display.";
        }
    }
    
    function printListItem($results){
        if($results){
            foreach($results as $result){
                echo "<form action='php/cart.php'>";
                 echo $result['name']." ".$result['description']." ".$result['price'];
                    echo " QTY <input type='number' name='quantity' style='text-align:center;' value='1'/>";  
                    echo "<input type='hidden' name='productId' value='".$result['id']."' />";
                    echo "<input type='submit' name='addCart' value='Add to Cart' class='btn btn-info'/>";
                echo "</form>";
            }   
        }else{
            echo "No items to display.";
        }
    }
    
    function printPurchaseHistory($results){
        if($results){
            foreach($results as $result){
                echo $result['invoice']." ".$result['username']." ".$result['name']." ".$result['quantity']." ".$result['subtotal'];
                echo "<form>";
                    echo "<input type='hidden' name='rmId' value='". $result['phId'] ."' />";
                    echo "<input type='submit' name='rmPurchaseHistory' value='Remove' class='btn btn-danger'/>";
                echo "</form>";
            }
        }else{
            echo "No results to display.";
        }
    }
    
   
    
    
    
    
    
    
?>
