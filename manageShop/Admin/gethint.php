<?php
  session_start();
?>
<?php
include_once "../../dbconfig.php";
$er = "FALSE";
$z = $_REQUEST["q"];
$sql = "SELECT* FROM subcategory WHERE category_id=$z";
$result = mysqli_query($conn,$sql) or die("Connection Error".mysqli_error($conn));

if(mysqli_num_rows($result)>0){
  while($ted=mysqli_fetch_assoc($result)){
    echo '<option ' .'value="'.$ted['id'].'"'  .'>'.$ted["name"].       '</option>';

  }
}else{
  echo $er;
}

// Output "no suggestion" if no hint was foun
?>
