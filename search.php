<?php
include_once "dbconfig.php";
$foundnum ="";
$search = $_POST["search_engin"];
$button = $_POST["submit_search"];

$search_exploded = explode(" ",$search);
$x =0;
foreach( $search_exploded as $search_each ) {
    $x++;
    $construct = " ";
    if( $x == 1 ){
           $construct .= "name LIKE '%$search_each%' OR description LIKE '%$search_each%' ";
    }
    else{
           $construct .= "AND name LIKE '%$search_each%' OR description LIKE '%$search_each%' ";
    }
}
$constructt = " SELECT * FROM category WHERE $construct ";


if($run = mysqli_query($conn,$constructt)){
    

    $foundnum = mysqli_num_rows($run);
    

}
 
                    if ($foundnum == 0){
                           echo "Sorry, there are no matching result for <b> $search </b>. </br> </br> 1. Try more general words. for example: If you want to search 'how to create a website' then use general keyword like 'create' 'website' </br> 2. Try different words with similar  meaning </br> 3. Please check your spelling";
                    } 
                    else {
                           echo "$foundnum results found !<p>";
 
                           while( $runrows = mysqli_fetch_assoc( $run ) ) {
                                  $title = $runrows ['name'];
                                  $desc = $runrows ['description'];
                                  $url = $runrows ['shop_id'];
 
                                  echo "<a href='$url'> <b> $title </b> </a> <br> $desc <br> <a href='$url'> $url </a> <p>";
 
                           }
                    }
 
             
       

?>