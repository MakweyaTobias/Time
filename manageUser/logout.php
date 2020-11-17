<?php
$link ="";
    $priv_Pagereferer = $_SERVER['HTTP_REFERER'];
    if(empty($priv_Pagereferer)){
        $link = "../home.php";
    }
elseif($priv_Pagereferer == "http://localhost/eSHOP/manageUser/login.php"){
        $link = "../home.php";
    }
    else{
        $link = $priv_Pagereferer;
    }

    session_start();
    session_unset();
    session_destroy();
    header("location:$link");

?>