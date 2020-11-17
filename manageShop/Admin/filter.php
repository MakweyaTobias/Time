<?php
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}

function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
} 
$nameErrr ="";
    if(empty($_POST["name"])){
        $nameErrr = "Please enter Subcategory name.";
    } else{
        
        $namee = filterName($_POST["name"]);
        if($namee == FALSE){
            $nameErrr = "Please enter a valid Subcategory name.";
        }
    }
   echo $nameErrr;

?>