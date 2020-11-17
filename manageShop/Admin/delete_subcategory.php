<?php
$res="";
    // Include config file
    include_once "../../dbconfig.php";
$subcat_id = $_POST["id_sub"];

$sqld = "DELETE FROM products WHERE subcategory_id=$subcat_id";



if(mysqli_query($conn,$sqld)){
    $sql = "DELETE FROM subcategory WHERE id=$subcat_id";
    if(mysqli_query($conn,$sql)){
        $res = "ok";
    }else{
        $res = "not";
    }
    }

echo $res;


?>