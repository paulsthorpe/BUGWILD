<?php require_once('../resources/php/initialize.php'); ?>
<?php
   //check if admin user is logged in, if not redirect to home page
   if(!isset($_SESSION['user'])){
       header("Location: login.php");
   }


?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="stylesheet" href="css/homeStyles.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>
</head>
<div class="page-wrapper">
  <div class="logo">
    <img src="images/layoutImages/bw.png" alt="LOGO" >
  </div>
  <div class="logo-caption">
    <h1 class="home_header">Custom Flies, Tied To Order From</h1>
    <h1 class="home_header">BugWild Fly Co.</h1>
    <a href="about.php"><button id="learn-more" class="btn-large">
    Learn More...
    </button></a>
    <a href="shop.php"><button id="shop" class="btn-large">Shop</button></a>
  </div>

  <div class="background">
    <img src="images/layoutImages/river.jpg" alt="" >
  </div>
  <div class="color">
  </div>
  <div class="top">
    <button class="nav-button">
      <i class="fa fa-bars"></i>
    </button>
  </div>
  <nav>
 
  <ul id="home-nav">
    <li><a class="nav-tags" href="index.php">Home</a></li>
    <li><a class="nav-tags" href="shop.php">Shop</a></li>
    <li><a class="nav-tags" href="checkout.php">Cart</a></li>
    <li><a class="nav-tags" href="blog.php">Blog</a></li>
  </ul>
  </nav>

  <!-- <div class="content-wrapper">

  
  <div class="content container-fluid">
    <div class="featured-flies row">
      <h1>Featured Flies</h1>
      <div class="col-sm-1">

      </div>
  <div class="col-sm-3" id="item-thumbnail">
     <a href = "item.php?product=$product->product_id">
     <div class="thumbnail-content-container">
      <img src="images/product_images/craycray.jpg" class="thumbnail-image">
      <h5>Title</h5>
    <button id="learn-more" class="btn-small">
    More Details...
    </button>
      </div>
  </div></a>
  <div class="col-sm-3" id="item-thumbnail">
     <a href = "item.php?product=$product->product_id">
     <div class="thumbnail-content-container">
      <img src="images/product_images/craycray.jpg" class="thumbnail-image">
      <h5>Title</h5>
      <h6>$4.56</h6>
      </div>
  </div></a>
  <div class="col-sm-3" id="item-thumbnail">
     <a href = "item.php?product=$product->product_id">
     <div class="thumbnail-content-container">
      <img src="images/product_images/craycray.jpg" class="thumbnail-image">
      <h5>Title</h5>
      <h6>$4.56</h6>
      </div>
  </div></a>
  </div>
  <h1> Latest Blog Post </h1>
  </div>


</div>
</div> -->
