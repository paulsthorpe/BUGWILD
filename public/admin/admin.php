<?php include "../../resources/templates/header.php"; ?>
<div id="wrapper">
<?php include "../../resources/templates/side-nav.php"; ?>
<div id="page-wrapper">

<?php
   //check if admin user is logged in, if not redirect to home page
   if(!isset($_SESSION['user'])){
       header("Location: login.php");
   }


?>




<?php

if(isset($_GET['source'])){
  $source = $_GET['source'];
} else {
  $source = "";
}
//include template based on get request to help organize admin pages
switch ($source) {

  case "add_products";
  include "../../resources/templates/add_product.php";
  break;

  case "sort_orders";
  include "../../resources/templates/sort_orders.php";
  break;

  case "order";
  include "../../resources/templates/order.php";
  break;

  case "view_all_products";
  include "../../resources/templates/all_products.php";
  break;

  case "categories";
  include "../../resources/templates/categories.php";
  break;

  case "dashboard";
  include "../../resources/templates/dashboard.php";
  break;

  case "users";
  include "../../resources/templates/users.php";
  break;

  case "edit_product";
  include "../../resources/templates/edit_product.php";
  break;

  case "blog_categories";
  include "../../resources/templates/blog_categories.php";
  break;

  case "add_post";
  include "../../resources/templates/add_post.php";
  break;

  case "all_posts";
  include "../../resources/templates/all_posts.php";
  break;

  case "edit_post";
  include "../../resources/templates/edit_post.php";
  break;

  default:
  include "../../resources/templates/dashboard.php";
  break;
}
?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
