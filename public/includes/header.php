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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.min.css" type="text/css">
    <link rel="stylesheet" href="css/media.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
</head>
<header>
  <div class="logo">
    <img src="images/layoutImages/bw.png" alt="LOGO" >
  </div>
      <button class="drop-button">
      <i class="fa fa-bars"></i>
      </button>
  <nav>
  <ul id="menu">
    <li class="menu-items"><a href="index.php">Home</a></li>
    <li class="menu-items"><a href="shop.php">Shop</a></li>
    <li class="menu-items"><a href="checkout.php">Cart</a></li>
    <li class="menu-items"><a href="blog.php">Blog</a></li>
  </ul>
  </nav>
</header>
