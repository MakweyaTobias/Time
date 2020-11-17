<?php
    // Include config file
    include_once "../../dbconfig.php";
$product_id = $_POST["id"];

$sql = "DELETE FROM products WHERE id=$product_id";
if(mysqli_query($conn,$sql)){
 echo "Record successfully deleted !";
}


?>