<?php
session_start();
if(!isset($_SESSION['email'])){
	header("location:../../manageUser/login.php");
}

include_once "../../dbconfig.php";
$shop_id = $_SESSION["shop_id"];

$users_id = $_SESSION["id"];
$catErr = "";
$sqlZ = "SELECT * FROM category WHERE shop_id =$shop_id";
$resultZ = mysqli_query($conn,$sqlZ) or die("Mysqli database error".mysqli_error($conn));
if(mysqli_num_rows($resultZ)==0){
    $catErr = "FALSE";
}

// Functions to filter user inputs
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
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}
function filterNumber($field){
    //Sanitize Number
    if(!filter_var($field,FILTER_VALIDATE_FLOAT===false)){
        return $field;
    }else{
        return FALSE;
    }

}
 
// Define variables and initialize with empty values
$nameErr =$descriptionErr = $priceErr =$imgErr ="";
$productsName =$description=$price = $sub_id =  "";
 
// Processing form data when form is submitted
if(isset($_POST["submit"])){
    if(empty($_POST["selectSUBCategory"]) || empty($_POST["selectCategory"])){
        echo "Hey"; die();
        $subErr = "Please enter Product name.";
    }
    else{
    //Validate subcategory
    if(!empty($_POST["selectSUBCategory"])){
        $sub_id = $_POST["selectSUBCategory"];
        
    }

    // Validate Shop name
    if(empty($_POST["productsName"])){
        $nameErr = "Please enter Product name.";
    } else{
        $productsName = filterString($_POST["productsName"]);
        if($productsName == FALSE){
            $nameErr = "Please enter a valid Product name.";
        }
    }
    

         // Validate user Description
         if(empty($_POST["descc"])){
            $descriptionErr = "Please enter your Product Description.";
        } else{
            $description = filterString($_POST["descc"]);
            if($description == FALSE){
                $descriptionErr = "Please enter a valid Product Description.";
            }
        }

        //Validate Price
        if(empty($_POST["price"])){
            $priceErr = "Please enter Price";
        }else{
            $price = filterNumber($_POST["price"]);
            if($price == FALSE){
                $priceErr = "Please enter a valid price.";
            }
        }
       
        if(isset($_FILES["file"])){
            $name = $_FILES["file"]["name"];
            $target_dir = "../../imagess/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
          
            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
          
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
           
               // Store image
                $imgg = $name;  
               // Upload file
               move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imgg);
          
            }else{
                $imgErr = "Please insert correct Image format";
            }
           } else {
               $imgErr = "Please insert Image";
           }
    
    // Check input errors before sending email
    if(empty($nameErr) && empty($descriptionErr) && empty($priceErr) && empty($imgErr)){
        //Add the Category to database
        
        
        
      $shop_id =$_SESSION["shop_id"];
        
        
        $sql = "INSERT INTO products(subcategory_id,shop_id,name,description,price,photo)
        VALUES('".$sub_id."','".$shop_id."','".$productsName."','".$description."','".$price."','".$imgg."')
        ";
        if ($conn->query($sql) === TRUE){
            header("Location:products.php");
        }
        
        

        
    }
}
}

?>















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/Mystyle.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <style type="text/css">
        .error{ color: red; }
        .success{ color: green; }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText ==="FALSE"){
                    document.getElementById("txtHintNo").innerHTML = "Sorry !! you cannot add to this CATEGORY. create atleast one SUBCATEGORY before Proceeding !";
                }
                else{
                document.getElementById("txtHint").innerHTML = this.responseText;
                document.getElementById("txtHintNo").innerHTML ="";
                }
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="dashboard.html">
                        <!-- Logo icon image, you can use font-icon also --><b>
                            <!--This is dark logo icon--><img src="plugins/images/admin-logo.png" alt="home"
                                class="dark-logo" />
                            <!--This is light logo icon--><img src="plugins/images/admin-logo-dark.png" alt="home"
                                class="light-logo" />
                        </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                            <!--This is dark logo text--><img src="plugins/images/admin-text.png" alt="home"
                                class="dark-logo" />
                            <!--This is light logo text--><img src="plugins/images/admin-text-dark.png" alt="home"
                                class="light-logo" />
                        </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i
                                    class="fa fa-search"></i></a> </form>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="dropdown"><a class="profile-pic" href="#"> <img src="plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">Steave</b></a>
                    <div class="dropdown-contentt">
                    <a class='btn btn-success btn-sm' href='../../manageUser/logout.php'>Log out</a>
                    </div>
                    </div>
                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                            class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="dashboard.php" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                                aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="category.php" class="waves-effect"><i class="fa fa-user fa-fw"
                                aria-hidden="true"></i>Categories</a>
                    </li>
                    <li>
                        <a href="products.php" class="waves-effect"><i class="fa fa-table fa-fw"
                                aria-hidden="true"></i>Products</a>
                    </li>
                    <li>
                        <a href="fontawesome.html" class="waves-effect"><i class="fa fa-font fa-fw"
                                aria-hidden="true"></i>Icons</a>
                    </li>
                    <li>
                        <a href="map-google.html" class="waves-effect"><i class="fa fa-globe fa-fw"
                                aria-hidden="true"></i>Google Map</a>
                    </li>
                    <li>
                        <a href="blank.html" class="waves-effect"><i class="fa fa-columns fa-fw"
                                aria-hidden="true"></i>Blank Page</a>
                    </li>
                    <li>
                        <a href="404.html" class="waves-effect"><i class="fa fa-info-circle fa-fw"
                                aria-hidden="true"></i>Error 404</a>
                    </li>
                </ul>
                <div class="center p-20">
                    <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank"
                        class="btn btn-danger btn-block waves-effect waves-light">Upgrade to Pro</a>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Basic Table</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank"
                            class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade
                            to Pro

                        </a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Basic Table</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
            
                <div class="row">
                    <div class=" col-md-6">
                        <div class="white-box">
                        <div class="page-header">
                        <h2>Create Products</h2>
                    </div>
                    <form class="row contact_form" action="createProduct.php" method="post" enctype='multipart/form-data'>
                                <div class="col-md-12 form-group p_star">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="me">Category</label>
                                        
                                    </div>
                                <select required class="custom-select form-control" name="selectCategory" id="me"   onchange="showHint(this.value)">
                                <span class="error"><?php echo $subErr; ?></span>
                                <option selected>Select Category...</option>
                                <?php
                                
                                                                
                                
                                
                                while($recc = mysqli_fetch_assoc($resultZ)){
                                    $cattt_id = $recc["id"];
                                    $cat_name = $recc["name"];
                                    
                                ?>  
                                    <option required class="text-success" value="<?php echo $cattt_id;?>"><?php echo $recc["name"]; ?></option>
                                    <?php }?>
                                </select>
                                    
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <div class="input-group-prepend">
                                    <p><h3 class="error" id="txtHintNo"></h3></p>
                                        <label class="input-group-text" for="me">SubCategory</label>
                                    </div>
                                <select class="custom-select form-control" id="txtHint" name="selectSUBCategory" id="me">
                                    
                                    
                                </select>
                                    
                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label class="input-group-text" for="me">Name</label>
                                    <input type="text" class="form-control" id="productsName" name="productsName" value="<?php echo $productsName?>"
                                        placeholder="Product Name">
                                        <span class="error"><?php echo $nameErr; ?></span>
                                </div>
                        
                                <div class="col-md-12 form-group p_star">
                                <label class="input-group-text" for="me">Description</label>
                                    <input type="text" class="form-control" id="descc" name="descc" value="<?php echo $description?>"
                                        placeholder="Product Description">
                                        <span class="error"><?php echo $descriptionErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label class="input-group-text" for="me">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $price?>"
                                        placeholder="Price">
                                        <span class="error"><?php echo $priceErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                <label class="input-group-text" for="me">Photo</label>
                                    <input type="file" class="form-control"  name="file" required
                                        />
                                        <span class="error"><?php echo $imgErr; ?></span>
                                </div>
                            
                                
                                    <button type="submit" value="submit" name ="submit" class="btn btn-primary">
                                        Creat Product
                                    </button>
                                    <a href="products.php" class="btn btn-default">Cancel</a>
                                </div>
                            </form> 
                    



                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>


    

</body>

</html>