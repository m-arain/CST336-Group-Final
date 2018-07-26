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
    
    function createUser($name, $username, $password){
        global $conn;
        $np = array();
        $np[":name"] = $name;
        $np[":username"] = $username;
        $np[":pass"] = $password;
        $sql = "INSERT INTO users (id, name, invoice, username, password) VALUES (NULL, :name, 0, :username, SHA1(:pass))";
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
    };
    
    function addProduct($name, $desc, $price){
        global $conn;
        $sql = "INSERT INTO product (id, name, description, price) VALUES (NULL, :name, :desc, :price)";
        $np = array();
        $np[':name'] = $name;
        $np[':desc'] = $desc;
        $np[':price'] = $price;
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        print_r($records);
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
            print_r($records);
            return $records;
        }
    };
    
    function addCart($userid, $product){
        global $conn;
        $sql = "INSERT INTO cart (id, username, product) VALUES (NULL, :userid, :product)";
        $np = array();
        $np[':userid'] = $userid;
        $np[':product'] = $product;
        
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        print_r($records);
    }
    
    function getUsersCart($userid){
        
        global $conn;
        $sql = "SELECT users.username, product.name, product.description, product.price FROM cart
                inner join users on cart.username = users.id
                inner join product on cart.product = product.id
                where cart.username =:userid";
        $np[":userid"] = $userid;
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($records);
        $subtotal = 0;
        foreach($records as $record){
            $subtotal += $record['price'];
        }
        echo $subtotal;
        return [$records, $subtotal];
    }
    
    function removeItemCart($userid, $product){
        global $conn;
        $sql = "DELETE FROM cart WHERE username = :userid AND product = :product";
        $np[':userid'] = $userid;
        $np[':product'] = $product;
        $stmt = $conn->prepare($sql);
        $records = $stmt->execute($np);
        print_r($records);
    }
    
    
    
    
    
    
?>
