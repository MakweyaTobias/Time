<?php 
   session_start();
   


?>

<?php
$priv_Pagerefer = $_SERVER['HTTP_REFERER'];

if(empty($priv_Pagerefer)){
    header("Location:../home.php");
}
include_once "../dbconfig.php";
 
// Define variables and initialize with empty values
$emailErr = $passwordErr = $messageErr = "";
$role = $email = $password = $subject = $photo = $message =$logInError= "";
$id =$name2 = $link = "";
$LogMe = ""; 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate user name
    if(empty($_POST["email"])){
        $emailErr = "Please enter your Email.";
    } else{
        $email = $_POST["email"];
        
    }
    
    // Validate password
    if(empty($_POST["password"])){
        $passwordErr = "Please enter your password.";     
    } else{
        $password =md5($_POST["password"]);
        
    }
    
    
    
    // Check input errors before sending email
    if(empty($nameErr) && empty($emailErr) && empty($messageErr)){
        // Check if person is registered
        $sql = "SELECT * FROM users WHERE email ='$email' AND password='$password'
        ";
        if($result =mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result)==0){
                $logInError = "Invalid username/password combination";
            }elseif(mysqli_num_rows($result) == 1){
            
                
                
                
                $row=mysqli_fetch_array($result);
                   $id=$row["id"];
                    $name2=$row["firstname"];
                    $email=$row["email"];
                    $role = $row["role"];
                    $photo =$row["photo"];


                    $_SESSION["name"]=$name2;
                    $_SESSION["id"]=$id;
                    $_SESSION["email"]=$email;
                    $_SESSION["image"] =$photo;
                    

                    
                
        //redirect to home page
        if($role == "admin"){
            $link = "../manageShop/Admin/create_shop.php";
        }elseif($role == "naive") {
            
            # code...
            if(isset($_SESSION["referer"])){
           
                $redir = $_SESSION["referer"];
                $link = $redir;
            }else{
                $link ="../home.php";
    
            }
        }

        
        
            
        
        header("Location:$link");

            } 
            //.....
            
        }
        //end of resurt
        
    

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
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="signup.php" class="btn_3">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3> 
                                <?php if(!isset($_SESSION["LogMe"])) { echo "Please Sign in now";}else{ echo  $_SESSION["LogMe"];}?>
                                
                                </h3>
                                <span class="error"><?php echo $logInError; ?></span>
                            <form class="row contact_form" action="login.php" method="post">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email?>"
                                        placeholder="Email">
                                        <span class="error"><?php echo $emailErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password?>"
                                        placeholder="Password">
                                        <span class="error"><?php echo $passwordErr; ?></span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div>
                                    <button type="submit" value="submit" class="btn_3 btn">
                                        log in
                                    </button>
                                    <a class="lost_pass" href="#">forget password?</a>
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