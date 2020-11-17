<?php
include_once "../dbconfig.php";
$sql = "SELECT id, name, image, description, address, website, facebook, gplus, twitter FROM cards";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $record = mysqli_fetch_assoc($resultset) ) {
?>
<div class="card hovercard >
<div class="cardheader">
<div class="avatar">
<img alt="" src="<?php echo $record['image']; ?>">
</div>
</div>
<div class="card-body info">
<div class="title">
<a href="#"><?php echo $record['name']; ?></a>
</div>
<div class="desc"> <a target="_blank" href="<?php echo $record['website']; ?>"><?php echo $record['website']; ?></a></div>
<div class="desc"><?php echo $record['description']; ?></div>
<div class="desc"><?php echo $record['address']; ?></div>
</div>
<div class="card-footer bottom">
<a class="btn btn-primary btn-twitter btn-sm" href="<?php echo $record['twitter']; ?>">
<i class="fa fa-twitter"></i>
</a>
<a class="btn btn-danger btn-sm" rel="publisher"
href="<?php echo $record['gplus']; ?>">
<i class="fa fa-google-plus"></i>
</a>
<a class="btn btn-primary btn-sm" rel="publisher"
href="<?php echo $record['facebook']; ?>">
<i class="fa fa-facebook"></i>
</a>
</div>
</div>
<?php } ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="images/eSHOP.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/elegant-icons.css" type="text/css">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
</body>
</html>

