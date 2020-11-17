<?php    // Include config file
    include_once "../../dbconfig.php";

    
    $respo ="";
    $cat_id = $_POST["idup"];
    $name = $_POST["name"];
    $desc = $_POST["descr"];
    $sqll = "UPDATE category SET name='$name',description='$desc' WHERE id='$cat_id'";
    if(mysqli_query($conn,$sqll)){
$respo = "ok";
    }else{
        $respo ="not";
    }
     echo $respo;  



?>