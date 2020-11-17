<?php
$res="";
    // Include config file
    include_once "../../dbconfig.php";
    if(isset($_POST["id"])){
$cat_id = $_POST["id"];


$sqlz = "SELECT subcategory.id,products.name FROM category JOIN subcategory ON category.id = subcategory.category_id JOIN products ON subcategory.id = products.subcategory_id
WHERE category.id=$cat_id";

$resultt = mysqli_query($conn,$sqlz);
if(mysqli_num_rows($resultt)!=0){
    $res = "Note You will delete all Subcategories and Products in this Category";

}else{
    $res = "false";
}
    }elseif(isset($_POST["id_sub"])){
        $subcat_id = $_POST["id_sub"];


$sqlzz = "SELECT subcategory.id,products.name FROM subcategory JOIN products ON subcategory.id = products.subcategory_id
WHERE subcategory.id=$subcat_id";

$resultt = mysqli_query($conn,$sqlzz);
if(mysqli_num_rows($resultt)!=0){
    $res = "Note You will delete all Products in this Category";

}else{
    $res = "false";
}
    }

echo $res;


?>