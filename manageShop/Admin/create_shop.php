
<?php 
session_start();
?>
<?php
include_once "../../dbconfig.php";
$users_id = $_SESSION["id"];
$catErr = "";
$sqll = "SELECT * FROM shop WHERE users_id =$users_id";
$resultt = mysqli_query($conn,$sqll) or die("Mysqli database error".mysqli_error($conn));
if(mysqli_num_rows($resultt)==0){
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
//var_dump($_SESSION); die();  
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
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
$nameErr =$descriptionErr=$addressErr = $imgErr ="";
$shopName =$description=$address = $user_id = "";
 
// Processing form data when form is submitted
if(isset($_POST["submit"])){
    // Validate Shop name
    if(empty($_POST["shopName"])){
        $nameErr = "Please enter your Shop name.";
    } else{
        $shopName = filterString($_POST["shopName"]);
        if($shopName == FALSE){
            $nameErr = "Please enter a valid Shop name.";
        }
    }
    
        // Validate Shop Address
        if(empty($_POST["address"])){
            $addressErr = "Please enter your Shop Address.";
        } else{
            $address = filterString($_POST["address"]);
            if($address == FALSE){
                $addressErr = "Please enter a valid Shop Address.";
            }
        }

         // Validate user Description
         if(empty($_POST["desc"])){
            $descriptionErr = "Please enter your Shop Description.";
        } else{
            $description = filterString($_POST["desc"]);
            if($description == FALSE){
                $descriptionErr = "Please enter a valid Shop Description.";
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
    if(empty($nameErr) && empty($descriptionErr) && empty($addressErr) && empty($imgErr)){
        //Add the person to database
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
         }
         
        
        // insert data
        $user_id = $_SESSION["id"];
        
        $sql = "INSERT INTO shop(users_id,name,photo,location,description)
        VALUES('".$user_id."','".$shopName."','".$imgg."','".$address."','".$description."')
        ";
        
        if ($conn->query($sql) === TRUE){
            
            // return to home page
       header("location:create_shop.php"); /* Redirect browser */
            exit();
           }
          else{
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        

        
    }
}else if(isset($_POST["submt"])){
$shopXY = $_POST["selectShop"];
$sql2 = "SELECT* FROM shop WHERE id = $shopXY";
    if($res =mysqli_query($conn,$sql2)){
        $roww =mysqli_fetch_array($res);
        $_SESSION["shopNam"]  = $roww["name"];
        $_SESSION["shop_id"] = $roww["id"];
        $_SESSION["shopPhoto"] = $roww["photo"];

}

header("location:dashboard.php"); /* Redirect browser */
exit();


}
?>




<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eSHOP </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../../manageUser/assets/img/eSHOP.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="../../manageUser/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/flaticon.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/slicknav.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/animate.min.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/themify-icons.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/slick.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/nice-select.css">
        <link rel="stylesheet" href="../../manageUser/assets/css/creaStyle.css">
        <style type="text/css">
        .error{ color: red; }
        .success{ color: green; }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="../index.php">eSHOP</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalog</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="shop.html">Shop</a>
                <a class="dropdown-item" href="product-single.html">Single Product</a>
                <a class="dropdown-item" href="cart.html">Cart</a>
                <a class="dropdown-item" href="checkout.html">Checkout</a>
              </div>
            </li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    
    <!--================login_part Area =================-->
    <section class="margin_reduce login_part section_padding  ">
    
        <div class="container">
            <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <?php 
                            if($catErr=="FALSE"){
                                echo "<label><h2>Create Your First Shop</h2></label>";
                            }else { ?>
                                <label><h2>Select Shop to enter</h2></label>
                                <form  method="post" enctype='multipart/form-data'>
                                    <select class="custom-select form-control-sm" name="selectShop">
                                    <?php
                                
                                                                
                                
                                
                                while($rec = mysqli_fetch_assoc($resultt)){
                                    $shop_id = $rec["id"];
                                    $shop_name = $rec["name"];
                                ?>
    
                                        <option value="<?php echo $shop_id;?>"><?php echo $shop_name; ?></option>
                                        <?php }?>  
                                    </select>
                                    <button type="submit" value="submit" name ="submt" class="btn_3 btn">
                                    Enter Now
                                        </button>
                                </form>
                            
                                <?php }?>
                            

                        </div>
                    </div>
                </div>

                    <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back  ! <br>
                                Create a new Shop</h3>
                                
                            <form class="row contact_form" action="create_shop.php" method="post" enctype='multipart/form-data'>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="shopName" name="shopName" value="<?php echo $shopName?>"
                                        placeholder="Name of the Shop">
                                        <span class="error"><?php echo $nameErr; ?></span>
                                </div>
                        
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="desc" name="desc" value="<?php echo $description?>"
                                        placeholder="Types of items being Sold in this Shop">
                                        <span class="error"><?php echo $descriptionErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address?>"
                                        placeholder="Location Eg Chinamwali, Zomba">
                                        <span class="error"><?php echo $addressErr; ?></span>
                                </div>
                                
                                <div class="col-md-12 form-group p_star">
                                    <input type="file" class="form-control"  name="file" required
                                        />
                                </div>
                                
                                    <button type="submit" value="submit" name ="submit" class="btn_3 btn">
                                        Creat Shop
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->
    <form class="row contact_form" action="create_shop.php" method="post" enctype='multipart/form-data'>
                                <div class="col-md-12 form-group p_star">
   <button type="submit" name="submmit"  class="btn_3 btn">SKIP</button>
   </div>
   </form>


</body>
    
</html>