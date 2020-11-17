<?php    // Include config file
    include_once "../../dbconfig.php";

    
    $respo ="";
    $subcat_id = $_POST["idu"];
    $name = $_POST["nam"];
    $desc = $_POST["desc"];
    $sqll = "UPDATE subcategory SET name='$name',description='$desc' WHERE id='$subcat_id'";
    if(mysqli_query($conn,$sqll)){
$respo = "ok";
    }else{
        $respo ="not";
    }
     echo $respo;  



?>