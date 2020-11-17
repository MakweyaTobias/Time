<?php
session_start();
if(!isset($_SESSION['email'])){
	header("location:../../manageUser/login.php");
}

include_once "../../dbconfig.php";
$shop_id = $_SESSION["shop_id"];
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
 
// Define variables and initialize with empty values
$nameErr =$descriptionErr =$nameErrr =$descriptionErrr = "";
$categoryName =$description= $cat =$namee=$descriptionn =  "";
 
// Processing form data when form is submitted
if(isset($_POST["submit"])){
   
    
    // Validate Shop name
    if(empty($_POST["categoryName"])){
        $nameErr = "Please enter Category name.";
    } else{
        $categoryName = filterString($_POST["categoryName"]);
        if($categoryName == FALSE){
            $nameErr = "Please enter a valid Shop name.";
        }
    }
    

         // Validate user Description
         if(empty($_POST["descc"])){
            $descriptionErr = "Please enter your Shop Description.";
        } else{
            $description = filterString($_POST["descc"]);
            if($description == FALSE){
                $descriptionErr = "Please enter a valid Shop Description.";
            }
        }
       
    
    
    // Check input errors before sending email
    if(empty($nameErr) && empty($descriptionErr)){
        //Add the Category to database
        
        
        

        
        
        $sql = "INSERT INTO category(shop_id,name,description)
        VALUES('".$shop_id."','".$categoryName."','".$description."')
        ";
        if ($conn->query($sql) === TRUE){
            header("Location:category.php");
        }
        
        

        
    }
}

if(isset($_POST['contactFrmSubmit']) && !empty($_POST['name']) && (!filter_var($_POST['name'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['message'])){
    
    // Submitted form data
    $namee   = $_POST['name'];

    $descriptionn= $_POST['message'];
    $cat_id = $_POST['id'];
$shopP_id =$_SESSION["shop_id"];
 

 
        //Add the Subcategory to database
        
        
        
 
        
        
        $sqll = "INSERT INTO subcategory(category_id,description,name,shop_id)
        VALUES('".$cat_id."','".$descriptionn."','".$namee."','".$shopP_id."')
        ";
        if ($conn->query($sqll) === TRUE){
            $status = 'ok';
        }else{
            $status = 'err';
        }
        
        
        echo $status;die;
        
    
     
    
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
    <!-- Modal Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/ionicons.min.css">
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
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="bootstrap/js/Jquery.js"></script>
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
                            <!--SHOP LOGO HERE--><img src="plugins/images/admin-logo-dark.png" alt="home"
                                class="light-logo" />
                        </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                            <!--This is dark logo text--><img src="plugins/images/admin-text.png" alt="home"
                                class="dark-logo" />
                            <!--This is light logo text--><img src="<?php echo'../../imagess/'.$_SESSION["shopPhoto"]; ?>" alt="user-img" width="70" class="img-circle">
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
                        <div class="dropdown"><a class="profile-pic" href="#"> <img src="<?php echo'../../imagess/'.$_SESSION["image"]; ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $_SESSION["name"]; ?></b></a>
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
                <button class="btn-xs open-close hidden-md hidden-lg">Close</button>
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
                        <h4 class="page-title">Profile page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank"
                            class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade
                            to Pro</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Profile Page</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">
                            

<h3 class="text-success text-center">All Categories</h3>



                            <div class=" panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                            
                                $catErr = "";
                                $sql = "SELECT* FROM category WHERE shop_id=$shop_id";
                                $result = mysqli_query($conn,$sql) or die("Mysqli database error".mysqli_error($conn));
                                if(mysqli_num_rows($result)==0){
                                    $catErr = "You Have No Categories";
                                }else{
                                while($rec = mysqli_fetch_assoc($result)){
                                    $cat = $rec["id"];
                                    
                                   
                                ?>
                                <div class=" panel panel-default">
                                    <div class="panel-headingg" role="tab" id="headingOne">
                                        <h4 class="show_this panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target='#<?php echo $cat; ?>'  href="#collapseOne" aria-expanded="false"  aria-controls='<?php echo $cat; ?>'><?php echo $rec["name"]?>
                                        
                                        </a>
                                        
                                        </h4>
                                    </div>
                                    <div class="show_me" style="display:none !important">
                                    <a value='<?php echo $cat; ?>'  class="btn btn-success btn-xs update_cat" style="font-size:12px;">update category</a>
                                                    <a value='<?php echo $cat; ?>'  class="btn btn-danger btn-xs delete_cat" style="font-size:12px;">delete category</a> </div>
                                    <div id='<?php echo $cat; ?>' class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class=" panel-body">
                                            <h4 class="controll text-info text-center">Subcategories</h4> 
                                            

                                            <?php
                            $cut = $cat;
                            
                            $subcatErr = "";
                            $sqll = "SELECT* FROM subcategory WHERE category_id=$cut";
                            $resultt = mysqli_query($conn,$sqll) or die("Mysqli database error".mysqli_error($conn));
                            if(mysqli_num_rows($resultt)==0){
                                $subcatErr = "You Have No Subcategories";
                            }else{
                            while($recc = mysqli_fetch_assoc($resultt)){
                                $subcat = $recc["id"];
                                
                            ?>

                                            <ul>
                                                <li><a href="#"></a><?php echo $recc["name"]?></li>
                                                
                                                    <a  value='<?php echo $subcat; ?>' class="btn btn-primary btn-xs update_sub" style="font-size:12px;">update</a>
                                                    <a value='<?php echo $subcat; ?>'  class="btn btn-danger btn-xs delete_sub" style="font-size:12px;">delete</a>



                                                
                                            </ul>
                                            <?php }}?>
                                            <h5 class="text-danger text-center"><?php echo $subcatErr; ?></h5>
                                            <hr>
                                            
                                            <button data-toggle = "modal" class="button1 btn btn-success" style="font-size:12px;" id="<?php echo$cat ?>"  data-target = "#signupModal">Add subcategory</button>
                                        
                                        </div>
                                    </div>
                                </div>
                                <?php }}?>
                                    
                                <h5 class="text-danger text-center"><?php echo $catErr; ?></h5>
                             </div>


                            









                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">
                        <form class="row contact_form" action="category.php" method="post" enctype='multipart/form-data'>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $categoryName?>"
                                        placeholder="Category Name">
                                        <span class="error"><?php echo $nameErr; ?></span>
                                </div>
                        
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="descc" name="descc" value="<?php echo $description?>"
                                        placeholder="Category Description">
                                        <span class="error"><?php echo $descriptionErr; ?></span>
                                </div>
                            
                                
                                    <button type="submit" value="submit" name ="submit" class="btn_3 btn">
                                        Creat Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   
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
 

<!-- Modal for addding subcategory -->
<div class = "modal fade" id = "signupModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog ">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Fill Detail here
            </h4>
            <form method="post" action="category.php" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         <div class = "modal-body">
           Subcategory Name: <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Enter subcategory name"  value="<?php echo $namee ?>"/>
           <span class="error" id="show"></span>
         </div>
         
         <div class = "modal-body">
            Description : <input type="text" class="form-control" id="txt_desc" placeholder="Enter description"  <?php echo $descriptionn ?>/>
            <span class="error"><?php echo $descriptionErrr; ?></span>
         </div>
         
         <div class = "modal-footer">
            
            
            <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->



<!-- Modal for deleting Category  -->
<div class = "modal fade"  id = "deleteModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   <div class = "modal-dialog " style="max-width:340px !important">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title error" id = "myModalLabel">
               Do you want to delete this Category?
            </h4>
            <span class="error" id="warn"></span>
            <form method="post" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         
         
        
         
         <div class = "modal-footer">
            
            <input type = "button" class = "btn btn-primary" id="delete_c" value="DELETE" name="modal-delete">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               CANCEL
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal for deleting SubCategory  -->
<div class = "modal fade"  id = "deleteModalSub" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   <div class = "modal-dialog " style="max-width:340px !important">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title error" id = "myModalLabel">
               Do you want to delete this SubCategory?
            </h4>
            <span class="error" id="warnsub"></span>
            <form method="post" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         
         
        
         
         <div class = "modal-footer">
            
            <input type = "button" class = "btn btn-primary" id="delete_s" value="DELETE" name="modal-delete">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               CANCEL
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal for updating category -->
<div class = "modal fade" id = "updateModalCat" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog ">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Update Details here
            </h4>
            <form method="post" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         <div class = "modal-body">
         <label class="input-group-text" for="me">Name</label>
                                    <input type="text" class="form-control" id="nm" name="productsName" value=""
                                        >
                                        

         </div>
         
         <div class = "modal-body">
         <label class="input-group-text" for="me">Description</label>
                                    <input type="text" class="form-control" id="ds" name="descc" value=""
                                        >
         </div>
         <div class = "modal-footer">
            
            <input type = "button" class = "btn btn-primary" value="UPDATE" id="modal-update" onclick="submitContactFormm()" name="modal-update">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->


<!-- Modal for updating Subcategory -->
<div class = "modal fade" id = "updateModalSubCat" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog ">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Update Details here
            </h4>
            <form method="post" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         <div class = "modal-body">
         <label class="input-group-text" for="me">Name</label>
                                    <input type="text" class="form-control" id="nameee" name="productsName" value=""
                                        >
                                        

         </div>
         
         <div class = "modal-body">
         <label class="input-group-text" for="me">Description</label>
                                    <input type="text" class="form-control" id="disss" name="descc" value=""
                                        >
         </div>
         <div class = "modal-footer">
            
            <input type = "button" class = "btn btn-primary" value="UPDATE" id="modal-update" onclick="submitContacttFormm()" name="modal-update">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->


<script type="text/javascript">
var id_update ="";
var id_subUpdate ="";
$(function(){
    $(".delete_cat").on("click",function(){
    var id_delete =$(this).attr("value");

    $.ajax({
                  url:"search_child.php",
                  method: "post",
                  data: {
                      id: id_delete
                  },
                  success:function(data){
                      if(data !="false"){
                      document.getElementById("warn").innerHTML = data;
                      }
                      
                      
                      
                      $("#deleteModal").modal("show");
                  }
              })
    
    
    $("#delete_c").on("click",function(){
    $.ajax({
        url:"delete_category.php",
        method: "post",
        data: {
            id: id_delete
        },
        success:function(msg){
                
            if(msg == 'ok'){
                location.reload();
            }else{
                $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                alert("Failed to delete");
                location.reload();
            }
            
        }
    });
    });
    
});

$(".delete_sub").on("click",function(){
    var sub_delete =$(this).attr("value");

    $.ajax({
                  url:"search_child.php",
                  method: "post",
                  data: {
                      id_sub: sub_delete
                  },
                  success:function(data){
                      if(data !="false"){
                      document.getElementById("warnsub").innerHTML = data;
                      }
                      
                      
                      
                      $("#deleteModalSub").modal("show");
                      
                  }
              })
    
    
    $("#delete_s").on("click",function(){
    $.ajax({
        url:"delete_subcategory.php",
        method: "post",
        data: {
            id_sub: sub_delete
        },
        success:function(msg){
                
            if(msg == 'ok'){
                location.reload();
            }else{
                $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                alert("Failed to delete");
                location.reload();
            }
            
        }
    });
    });
    
});



$(".update_cat").on("click",function(){
                    id_update =$(this).attr("value");

                    $.ajax({
                  url:"view_modal.php",
                  method: "post",
                  data: {
                      cat_id: id_update
                  },
                  success:function(data){
                      var x =JSON.parse(data);
                      
                      
                      
                      $("#nm").attr("value",x.name);
                      $("#ds").attr("value",x.description);
                      
                      
                      $("#updateModalCat").modal("show");
                  }
              })
                });

                $(".update_sub").on("click",function(){
                    id_subUpdate =$(this).attr("value");

                    $.ajax({
                  url:"view_modal.php",
                  method: "post",
                  data: {
                      subcat_id: id_subUpdate
                  },
                  success:function(data){
                      var z =JSON.parse(data);
                      
                      
                      
                      $("#nameee").attr("value",z.name);
                      $("#disss").attr("value",z.description);
                      
                      
                      $("#updateModalSubCat").modal("show");
                  }
              })
                });

});

function submitContactFormm(){
    

    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var nameup = $("#nm").val();
    var dsup = $("#ds").val();
    
    if(nameup.trim() == '' ){
        alert('Please enter Category name.');
        $('#nm').focus();
        return false;
    }else if(dsup.trim() == '' ){
        alert('Please Category Description.');
        $('#ds').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'update_category.php',
            data: {
                      idup: id_update,
                      name: nameup,
                      descr:dsup,
                      
                  },
            beforeSend: function () {
                $('#modal-update').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                
                if(msg == 'ok'){
                    location.reload();
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                    console.log(id_update);
                }
                $('#modal-update').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
    }

    function submitContacttFormm(){
    

    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var nameu = $("#nameee").val();
    var dsu = $("#disss").val();
    
    if(nameu.trim() == '' ){
        alert('Please enter SubCategory name.');
        $('#nameee').focus();
        return false;
    }else if(dsu.trim() == '' ){
        alert('Please SubCategory Description.');
        $('#disss').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'update_subcategory.php',
            data: {
                      idu: id_subUpdate,
                      nam: nameu,
                      desc:dsu,
                      
                  },
            beforeSend: function () {
                $('#modal-update').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                
                if(msg == 'ok'){
                    location.reload();
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                    console.log(id_subUpdate);
                }
                $('#modal-update').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
    }



</script>
</body>

</html>