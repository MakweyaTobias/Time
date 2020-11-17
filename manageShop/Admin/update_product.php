<?php    // Include config file
    include_once "../../dbconfig.php";

if(isset($_POST["id"])){
    $product_id = $_POST["id"];

$sql = "SELECT* FROM products WHERE id=$product_id";
$result =mysqli_fetch_assoc($conn->query($sql)) or die("Database Connection Error".mysqli_error());
 echo json_encode($result);
}elseif(isset($_POST["idup"])){
    
    $respo ="";
    $prod_id = $_POST["idup"];
    $name = $_POST["name"];
    $desc = $_POST["descr"];
    $pric = $_POST["pric"];
    $sqll = "UPDATE products SET name='$name',description='$desc',price='$pric' WHERE id='$prod_id'";
    if(mysqli_query($conn,$sqll)){
$respo = "ok";
    }else{
        $respo ="not";
    }
     echo $respo;  
}


?>