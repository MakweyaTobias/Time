
<?php
include_once "../dbconfig.php";
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
$firstnameErr =$lastnameErr = $emailErr = $passwordErr =$addressErr = $imgErr ="";
$firstname =$lastname = $email  =$password =$passwordd=$address = "";
 
// Processing form data when form is submitted
if(isset($_POST["submit"])){
    // Validate user Firstname
    if(empty($_POST["firstname"])){
        $firstnameErr = "Please enter your Firstname.";
    } else{
        $firstname = filterName($_POST["firstname"]);
        if($firstname == FALSE){
            $firstnameErr = "Please enter a valid Firstname.";
        }
    }
    // Validate user Lastname
    if(empty($_POST["lastname"])){
        $lastnameErr = "Please enter your Lastname.";
    } else{
        $lastname = filterName($_POST["lastname"]);
        if($lastname == FALSE){
            $lastnameErr = "Please enter a valid Lastname.";
        }
    }
        // Validate user Address
        if(empty($_POST["address"])){
            $addressErr = "Please enter your Address.";
        } else{
            $address = filterString($_POST["address"]);
            if($address == FALSE){
                $addressErr = "Please enter a valid Address.";
            }
        }
    
    // Validate email address
    if(empty($_POST["email"])){
        $emailErr = "Please enter your email address.";     
    } else{
        $email = filterEmail($_POST["email"]);
        if($email == FALSE){
            $emailErr = "Please enter a valid email address.";
        }
    }
    
    // Validate password
    if(empty($_POST["password"])){
        $passwordErr = "Please enter your password";
    } else{
        $password = filterString($_POST["password"]);
        if($password == FALSE){
            $passwordErr = "Please enter a valid password";
        }
        $passwordd = md5($password);
    }
   if(isset($_FILES["file"])){
    $name = $_FILES["file"]["name"];
    $target_dir = "../imagess/";
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
    if(empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($passwordErr) && empty($addressErr) && empty($imgErr)){
        //Add the person to database
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
         }
         
        
        // insert data
        $sql = "INSERT INTO users(email,password,firstname,lastname,address,photo)
        VALUES('".$email."','".$passwordd."','".$firstname."','".$lastname."','".$address."','".$imgg."')
        ";
        
        if ($conn->query($sql) === TRUE){
            // return to home page
       header("location:login.php"); /* Redirect browser */
            exit();
           }
          else{
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        

        
    }
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
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/eSHOP.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
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
                            <h2>Already Have an Account?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="login.php" class="btn_3">Log In Here</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign Up now</h3>
                                
                            <form class="row contact_form" action="signup.php" method="post" enctype='multipart/form-data'>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname?>"
                                        placeholder="Firstname">
                                        <span class="error"><?php echo $firstnameErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname?>"
                                        placeholder="Lastname">
                                        <span class="error"><?php echo $lastnameErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email?>"
                                        placeholder="Email">
                                        <span class="error"><?php echo $emailErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address?>"
                                        placeholder="Address Eg Chinamwali, Zomba">
                                        <span class="error"><?php echo $addressErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password?>"
                                        placeholder="Password">
                                        <span class="error"><?php echo $passwordErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="file" class="form-control"  name="file" required 
                                        />
                                </div>
                                
                                    <button type="submit" value="submit" name ="submit" class="btn_3 btn">
                                        Sign Up
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

    


</body>
    
</html>