<?php include '/includes/header.php' ?>
<style>
</style>
<body>
      <?php
      $product = Products::find_product_by_id($_GET['product']);
      $image1 = substr($product->product_image, 3);
      $image2 = substr($product->product_image2, 3);
      $image3 = substr($product->product_image3, 3);
      $price = Products::format_price($product->product_price);
      $show_product = <<<SHOW_PRODUCT
      <div class="item-display">
        <div class="item-picture">
          <div class="magnify"><i class="fa fa-search-plus"></i></div>
          <img class="default-image" src="$image1"/>
          <img class="blow-up-image" src="$image1"/>
          <div class="item-thumbs"><img src="$image1" alt=""></div>
          <div class="item-thumbs"><img src="$image2" alt=""></div>
          <div class="item-thumbs" style="float: right;"><img src="$image2" alt=""></div>
        </div>
        <div class="item-details">
        <form action="cart.php" method="post">
          <input type="hidden" name="product_id" value="$product->product_id">
          <h1>$product->product_title</h1>
          <div class="option-selectors">
            <div class="quantity">
              <label>Quantity</label>
              <i class='qty-minus fa fa-minus-square'></i>
              <select class="qty-select" name="quantity">
                <option id="qty-counter" value="1">1</option>
              </select>
              <i class='qty-plus fa fa-plus-square'></i>
            </div>
            <div class="color-selector">
              <label>Color</label>
              <select class="" name="color">
                <option value="$product->color">$product->color</option>
                <option value="$product->color2">$product->color2</option>
                <option value="$product->color3">$product->color3</option>
                <option value="$product->color4">$product->color4</option>
                <option value="$product->color5">$product->color5</option>
                <option value="$product->color6">$product->color6</option>
              </select>
              <label>Size</label>
              <select class="" name="size">
                <option value="$product->size1">$product->size1</option>
                <option value="$product->size2">$product->size2</option>
                <option value="$product->size3">$product->size3</option>
              </select>
            </div>
            <div class="add">
              <h3>Price Each: $ $price</h3>
              <button class="btn-small" type="submit" name="add-to-cart" href="#">Add to Cart</button>
            </form>
            </div>
          </div>
          <div class="description"><pre>$product->product_description</pre></div>
        </div>
        
      </div>
SHOW_PRODUCT;
  echo $show_product;
      ?>
      <h1>Featured Flies</h1>
      <div class="newest-flies">
        <?php
          $newest_flies = Products::featured_products();
            foreach ($newest_flies as $fly) {
              $image1 = substr($fly->product_image, 3);
                $new_products = <<<PRODUCTS_IN_CATEGORY
                <div class="new-fly-thumbs" id="item-thumbnail">
                   <a href = "item.php?product=$fly->product_id">
                   <div class="thumbnail-content-container">
                    <img src="$image1" class="thumbnail-image">
                    <h3>$fly->product_title</h3>
                    <a href="item.php?product=$product->product_id"><button class="btn-small">
                    More Details...</button></a>
                    </div>
                </div></a>
PRODUCTS_IN_CATEGORY;
                echo $new_products;
        }
        ?>  
      </div>
</body>
<?php include "/includes/footer.php" ?>
