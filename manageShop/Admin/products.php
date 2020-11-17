<?php
session_start();
?>
<?php 
include_once "../../dbconfig.php";
$Erro ="";
$cat_id = $subcategory_id  = "";

if(isset($_POST["btn_product"])){
    
        $shop_id =$_SESSION["shop_id"];
        $sql = "SELECT* FROM category WHERE shop_id=$shop_id";
$result =mysqli_query($conn,$sql) or die("Mysqli database error".mysqli_error($conn));
if(mysqli_num_rows($result)==0){
    $Erro = "Create atleast one CATEGORY !";
}else{
    $sql5 = "SELECT* FROM subcategory WHERE shop_id=$shop_id";
    $resultP =mysqli_query($conn,$sql5) or die("Mysqli database error".mysqli_error($conn));
    if(mysqli_num_rows($resultP)==0){
        $Erro = "Create atleast one SUBCATEGORY !";
    }
}

}
if(isset($_POST["btn_product"]) && empty($Erro)){
 header("Location:createProduct.php");
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
                    <div class="col-sm-12">
                        <div class="white-box">
                            


                        <h3 class="error"><?php echo $Erro; ?></h3>
                        <div class="page-header clearfix">
                        
                        <h2 class="pull-left">Products Details</h2>
                        <form action="products.php" method="post" enctype='multipart/form-data'>
                        <button href="createProduct.php" class="btn btn-success  pull-right ml-2" name="btn_product">Add Product</button>
                        </form>
                    </div>
                    <div style="overflow-x:auto;">

                    <?php
                    // Include config file
                    include_once "../../dbconfig.php";
                    $shopId =$_SESSION["shop_id"];
                    // Attempt select query execution
                    $sql = "SELECT * FROM products WHERE shop_id =$shopId";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class=' table table-bordered table-striped'id='table_refresh'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Product ID</th>";
                                        echo "<th>Product Name</th>";
                                        echo "<th> Product Description</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>"."K" . $row['price'] . "</td>";
                                        echo "<td>";
                                            echo "<a class='view_me' id='". $row['id']."'   title='View Record'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a class='update_me' id='". $row['id']."' title='Update Record' ><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a class='delete_me' id='". $row['id']."' title='Delete Record'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No Products were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);  
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>



                </div>











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
    <script src="bootstrap/dist/js/bootstrap.js"></script>
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
    <script type="text/javascript">
function submitContactForm(){
    

    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var nameup = $("#nm").val();
    var dsup = $("#ds").val();
    var prup = $("#pr").val();
    
    if(nameup.trim() == '' ){
        alert('Please enter Product name.');
        $('#nm').focus();
        return false;
    }else if(dsup.trim() == '' ){
        alert('Please Product Description.');
        $('#ds').focus();
        return false;
    }else if(prup.trim() == '' ){
        alert('Please Product Price.');
        $('#pr').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'update_product.php',
            data: {
                      idup: id_update,
                      name: nameup,
                      descr:dsup,
                      pric:prup
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




    var id_update;
   
        $(document).ready(function(){
          

            $(".view_me").on("click",function(){
                var id_me = $(this).attr("id");
                
                
              //  
              $.ajax({
                  url:"view_modal.php",
                  method: "post",
                  data: {
                      id: id_me
                  },
                  success:function(data){
                      var x =JSON.parse(data);
                      
                      var image ="../../imagess/"+x.photo;
                      
                      $("#image").attr("src",image);
                      document.getElementById("descr").innerHTML =x.description;
                      document.getElementById("name_p").innerHTML =x.name;
                      document.getElementById("price").innerHTML ="K"+x.price;
                      $("#signupModal").modal("show");
                  }
              })
                
            }) ;

            $(".delete_me").on("click",function(){
                    var id_delete =$(this).attr("id");
                    $("#deleteModal").modal("show");
                    $("#delete_p").on("click",function(){
                    $.ajax({
                        url:"delete_product.php",
                        method: "post",
                        data: {
                            id: id_delete
                        },
                        success:function(data){
                        
                       location.reload();
                        }
                    });
                    });
                    
                });

                

                $(".update_me").on("click",function(){
                    id_update =$(this).attr("id");

                    $.ajax({
                  url:"view_modal.php",
                  method: "post",
                  data: {
                      id: id_update
                  },
                  success:function(data){
                      var x =JSON.parse(data);
                      
                      
                      
                      $("#nm").attr("value",x.name);
                      $("#ds").attr("value",x.description);
                      $("#pr").attr("value",x.price);
                      
                      $("#updateModal").modal("show");
                  }
              })
                });

  


                
        });
    </script>


    <!-- Modal for product discription -->
<div class = "modal fade" id = "signupModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog ">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Product Details
            </h4>
            <form method="post" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         
         
         <div class = "modal-body">
             <div class="clearFlix">
         <img class="im" id="image" style="border-radius: 5px;width:100%;max-width:200px;margin-right:15px" src="" alt="Colorlib Template">
         <span>Name:<h2 id="name_p"></h2></span>
         
         <span>Description:</span>
<p id="descr"></p>
<span>Subcategory:</span>
<h3 id="sub"></h3>
<span>Price:</span>
<p id="price"></p>
  
                </div>
         </div>
         
         <div class = "modal-footer">
            
            
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->





    <!-- Modal for DELETE -->
    <div class = "modal fade"  id = "deleteModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   <div class = "modal-dialog " style="max-width:340px !important">
      <div class = " modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title error" id = "myModalLabel">
               Do you want to delete this product?
            </h4>
            <form method="post" class="input-group form-signin" enctype="multipart/form-data">
         </div>
         
         
        
         
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-primary" id="delete_p" value="DELETE" name="modal-delete">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               CANCEL
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Modal for updating Product -->
<div class = "modal fade" id = "updateModal" tabindex = "-1" role = "dialog" 
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
         <div class="modal-body">
         <label class="input-group-text" for="me">Price</label>
                                    <input type="number" class="form-control" id="pr" name="price" value=""
                                        >
         </div>

         
         <div class = "modal-footer">
            
            <input type = "button" class = "btn btn-primary" value="UPDATE" id="modal-update" onclick="submitContactForm()" name="modal-update">
			 <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->


    
</body>

</html>