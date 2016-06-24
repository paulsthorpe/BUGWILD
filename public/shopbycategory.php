<?php include '/includes/header.php' ?>
<?php 
if(isset($_GET['cat_id'])){
  $id = $_GET['cat_id'];
  $cat = Categories::find_product_cat_by_id($id);
  $category_name = $cat->cat_title;
} else {
  $category_name = "The Shop";
}
?>
<body>
  <h1 style="font-size: 5em; margin-top: 75px;"><?php echo $category_name ?></h1>
   <div class="col-lg-12 product-display">
    <div class="col-lg-1">
    </div>
    <div class="product_categories col-lg-2">
      <h1>Product Categories</h1>
        <ul class="side-nav">
          <?php
          $categories = Categories::find_all_product_categories();
          foreach($categories as $category){
            $category_links = <<<CAT_LINKS
              <li><a href="shopbycategory.php?cat_id=$category->cat_id">$category->cat_title</a></li>
CAT_LINKS;
            echo $category_links;
          }
           ?>
        </ul>
    </div>
    <div class="products-container col-lg-9">
                <?php
if(isset($_GET['cat_id'])){
      $products_in_category = Products::find_products_by_category_id($_GET['cat_id']);
      foreach ($products_in_category as $product) {
            $image1 = substr($product->product_image, 3);
              $products_in_category = <<<PRODUCTS_IN_CATEGORY
              <div class="col-sm-3" id="item-thumbnail">
                 <a href = "item.php?product=$product->product_id">
                 <div class="thumbnail-content-container">
                  <img src="$image1" class="thumbnail-image">
                  <h5>$product->product_title</h5>
                  <h6>$ $product->product_price</h6>
                  </div>
              </div></a>
PRODUCTS_IN_CATEGORY;
          echo $products_in_category;
      }
} else {
  echo "There are currently no Products in this Category";
}
        ?>
    </div>
    </div>
</body>
<?php include "/includes/footer.php" ?>