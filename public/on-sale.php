<?php include '/includes/header.php' ?>
<body>
  <h1 style="font-size: 5em; margin-top: 75px;">On Sale</h1>
   <div class="container-fluid product-display">
   <div class="row">
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
          <li><a href="on-sale.php">On Sale</a></li>
        </ul>
    </div>
    <div class="products-container col-lg-9">
      <?php
        $all_products = Products::products_on_sale();
          foreach($all_products as $product){
            $image1 = substr($product->product_image, 3);
            $display_all_products= <<<ALL_PRODUCTS
              <div class="col-lg-3" id="item-thumbnail">
               <div class="thumbnail-content-container">
                <div class="thumbnail-image">
                <img src="$image1">
                </div>
                <h2>$product->product_title</h2>
                <a href="item.php?product=$product->product_id"><button class="btn-small">
                More Details...</button></a>
                </div>
              </div>
ALL_PRODUCTS;
              echo $display_all_products;
      }
      ?>
    </div>
    </div>
    </div>
</body>
<?php include "/includes/footer.php" ?>
