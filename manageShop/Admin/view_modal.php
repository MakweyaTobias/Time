<?php
    // Include config file
    include_once "../../dbconfig.php";

    if(isset($_POST["id"])){
$product_id = $_POST["id"];

$sql = "SELECT* FROM products WHERE id=$product_id";
$result =mysqli_fetch_assoc($conn->query($sql)) or die("Database Connection Error".mysqli_error());
 echo json_encode($result);

    }elseif(isset($_POST["cat_id"])){
        $cat_id = $_POST["cat_id"];

$sql = "SELECT* FROM category WHERE id=$cat_id";
$result =mysqli_fetch_assoc($conn->query($sql)) or die("Database Connection Error".mysqli_error());
 echo json_encode($result);

    }elseif(isset($_POST["subcat_id"])){
        $subcat_id = $_POST["subcat_id"];

$sqlx = "SELECT* FROM subcategory WHERE id=$subcat_id";
$resultx =mysqli_fetch_assoc($conn->query($sqlx)) or die("Database Connection Error".mysqli_error());
 echo json_encode($resultx);

    }
?>