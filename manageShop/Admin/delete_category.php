<?php
$res="";
    // Include config file
    include_once "../../dbconfig.php";
$cat_id = $_POST["id"];


$sqlz = "SELECT subcategory.id FROM category JOIN subcategory ON category.id = subcategory.category_id
WHERE category.id=$cat_id";

$resultt = mysqli_query($conn,$sqlz);
if(mysqli_num_rows($resultt)!=0){
    while($rec=mysqli_fetch_assoc($resultt)){
      $id =  $rec["id"];
        $sqld = "DELETE FROM products WHERE subcategory_id=$id";
        mysqli_query($conn,$sqld);
    }

}

$sqll = "DELETE FROM subcategory WHERE category_id=$cat_id";
if(mysqli_query($conn,$sqll)){
    $sql = "DELETE FROM category WHERE id=$cat_id";
if(mysqli_query($conn,$sql)){
 $res = "ok";
}else{
    $res ="not";
}

}

echo $res;


?>