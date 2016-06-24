<?php

session_start();

//HELPER FUNCTIONS
function query($sql) {
  global $connection;
  return mysqli_query($connection, $sql);
}

function escape_string($string){
  global $connection;
  return mysqli_real_escape_string($connection, $string);
}

function line_break(){
  echo "<br> </br>";
}

function redirect($location){
    header("Location: $location ");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//HOME
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_most_recent_post(){
  $query = query("SELECT * FROM blog ORDER BY post_date DESC LIMIT 0, 1 ");

  while ($row = mysqli_fetch_assoc($query)){
    extract($row);
  $display_most_recent_post = <<< DISPLAY_MOST_RECENT_POST
  <div class="post-container">
      <img src='{$post_image}'>
      <a href="post.php?post_id=$post_id"><h2>$post_title</h2></a>
      <h3>$post_date</h3>
      <h3>CATEGORIES</h3>
      <p>$post_content</p>
</div>
DISPLAY_MOST_RECENT_POST;
echo $display_most_recent_post;
}
}

function get_newest_products(){
  $query = query("SELECT * FROM products ORDER BY product_id DESC LIMIT 0, 3 ");

  while($row = mysqli_fetch_assoc($query)){
    extract($row);
    $display_newest_products= <<<NEWEST_PRODUCTS
    <div class="col-sm-3" id="item-thumbnail">
       <a href = "item.php?product=$product_id">
       <div class="thumbnail-content-container">
        <img src="$product_image" class="thumbnail-image">
        <h5>$product_title</h5>
        <h6>$ $product_price</h6>
        </div>
    </div></a>
NEWEST_PRODUCTS;
echo $display_newest_products;
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SHOP
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Display all products uncategorized in the shop home page
function display_all_products() {
  $query = query("SELECT * FROM products");

  while ($row = mysqli_fetch_assoc($query)){
    extract($row);
    $display_all_products= <<<ALL_PRODUCTS
    <div class="col-sm-3" id="item-thumbnail">
       <a href = "item.php?product=$product_id">
       <div class="thumbnail-content-container">
        <img src="$product_image" class="thumbnail-image">
        <h5>$product_title</h5>
        <h6>$ $product_price</h6>
        </div>
    </div></a>
ALL_PRODUCTS;
echo $display_all_products;
  }
}

function display_product_by_category() {

  $category_id = $_GET['cat_id'];
  $query = query("SELECT * FROM products WHERE product_category_id = $category_id ");

  while ($row = mysqli_fetch_assoc($query)){
    extract($row);
    $display_products_by_category= <<<CATEGORIZED_PRODUCTS
    <div class="col-sm-3" id="item-thumbnail">
       <a href = "item.php?product=$product_id">
       <div class="thumbnail-content-container">
        <img src="$product_image" class="thumbnail-image">
        <h5>$product_title</h5>
        <h6>$ $product_price</h6>
        </div>
    </div></a>
CATEGORIZED_PRODUCTS;
echo $display_products_by_category;

  }
}

/////SIDE NAV////////

//Display product categories in main shop page
function get_categories(){
  $query = query("SELECT * FROM categories");

  while($row = mysqli_fetch_array($query)){
    extract($row);
    $category_links = <<<CAT_LINKS
      <li><a href="shopbycategory.php?cat_id=$cat_id">$cat_title</a></li>
CAT_LINKS;
    echo $category_links;
  }
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ITEM
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Generate product details page based on product id
function display_individual_product(){
  if(isset($_GET['product'])){
    $item_id = $_GET['product'];
  }

  $query = query("SELECT * FROM products WHERE product_id = $item_id ");

  if($query){
    while($row = mysqli_fetch_assoc($query)){
      extract($row);
      $show_product = <<<SHOW_PRODUCT
      <div class="product-display-box">
        <img src="$product_image">
        <h2>$product_title</h2>
        <p>$product_description</p>
        <h3>Price Each: $ $product_price</h3>
        <label>Quantity</label>
        <select class="" name="quantity">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <a href="cart.php?add=$product_id"><button class="btn btn-default" type="submit" name="add-to-cart" href="#">Add to Cart</button></a>
      </div>
SHOW_PRODUCT;
  echo $show_product;
    }
  }

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//BLOG
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Make category title available by category id
function relate_category($post_category_id) {

  $query = query("SELECT * FROM post_categories WHERE blog_cat_id = $post_category_id ");
  while($row = mysqli_fetch_assoc($query)){
    extract($row);
    return $blog_cat_title;
  }
}

//Display post in descending order by date
function display_post_by_date(){


  $query = query("SELECT * FROM blog ORDER BY post_date DESC ");

  while ($row = mysqli_fetch_assoc($query)){
    extract($row);
    $cat_title = relate_category($post_category_id);
    $post_excerpt = substr($post_content, 0, 225);
  $display_post = <<<DISPLAY_POST
  <div class="post-container">
      <img src='{$post_image}'>
      <a href="post.php?post_id=$post_id"><h2>$post_title</h2></a>
      <h4>Date: $post_date</h4>
      <h4>In: $cat_title</h4>
      <pre>$post_excerpt...</pre>
  </div>
  DISPLAY_POST;
  echo $display_post;
}
}

function display_post_by_category(){
  $category_id = $_GET['category_id'];
  $query = ("SELECT * FROM blog WHERE post_category_id = $category_id ");
  while ($row = mysqli_fetch_assoc($query)){
    extract($row);
    $cat_title = $post_category_id;
    $display_post_by_category = <<<DISPLAY_POST_BY_CATEGORY
    <div class="post-container">
        <img src='{$post_image}'>
        <a href="post.php?post_id=$post_id"><h2>$post_title</h2></a>
        <h3>$post_date</h3>
        <h3>In: $cat_title</h3>
        <p>$post_content</p>
    </div>
DISPLAY_POST_BY_CATEGORY;
    echo $display_post_by_category;
    }
}

function display_single_post(){
  if(isset($_GET['post_id'])){
    $post_cat_id = $_GET['post_id'];
    $query = query("SELECT * FROM blog WHERE post_id = $post_cat_id ");

    while($row = mysqli_fetch_assoc($query)){
      extract($row);
      $cat_title = relate_category($post_category_id);
      $display_single_post = <<<DISPLAY_SINGLE_POST
      <div class="post-container">
          <img src='{$post_image}'>
          <a href="post.php?post_id=$post_id"><h2>$post_title</h2></a>
          <h3>$post_date</h3>
          <h3>In: $cat_title</h3>
          <pre>$post_content</pre>
      </div>
DISPLAY_SINGLE_POST;
      echo $display_single_post;
    }
  }
}

////////SIDE NAV///////////

//Blog category widget
function get_post_categories(){
  $query = query("SELECT * FROM post_categories");

  while($row = mysqli_fetch_array($query)){
    extract($row);
    $post_category_links = <<<POST_CAT_LINKS
      <li><a href="postbycategory.php?category_id=$blog_cat_id">$blog_cat_title</a></li>
POST_CAT_LINKS;
    echo $post_category_links;
  }
}
//Recent Post widget
function get_recent_post(){
  $query = query("SELECT * FROM blog ORDER BY post_date DESC LIMIT 0, 3 ");

  while($row = mysqli_fetch_array($query)){
    extract($row);
    $recent_post_links = <<<RECENT_POST_LINKS
      <li><a href="post.php?post_id=$post_id">$post_title</a></li>
RECENT_POST_LINKS;
    echo $recent_post_links;
  }
}








///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Contact
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function send_message() {
  if(isset($_POST['submit'])){
    $to = "paulsthorpe@yahoo.com";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $headers = "From: {$name} {$email}";

    $result = mail($to, $subject, $message, $headers);

    if(!$result){
      echo "Contact Failed";
    } else {
      echo "Sent";
    }

  }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ADMIN
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////PRODUCT CATEGORIES////////////////////////////////////////////////////
//Add new product category to database
function add_category(){

  if(isset($_POST['submit_category'])){
    $cat_title = $_POST['category_input'];
    $query = query("INSERT INTO categories (cat_title) VALUES ('{$cat_title}')");
  }

}

function translate_categories(){
  $query = query("SELECT FROM categories WHERE cat_id = $product_id");

  while($row = mysqli_fetch_assoc){
    extract($row);
    $category_title = $cat_id;
    echo $category_id;
  }
}

function display_all_categories() {
  $query = query("SELECT * FROM categories");
  $counter = 1;
  while($row = mysqli_fetch_assoc($query)){
  extract($row);
  $category_items = <<<CAT_ITEMS
  <tr>
  <td>$cat_id</td>
  <td>$cat_title</td>
  </tr>
  CAT_ITEMS;
  echo $category_items;
}
}

//EDIT CATEGORY//
function edit_category() {
  if(isset($_POST['submit_edit'])){
    $get_cat_id = $_POST['category_select'];
    $new_title = $_POST['new_title'];
    $query = query("UPDATE categories SET cat_title = '$new_title'  WHERE cat_id = '$get_cat_id' " );
  }
}

//////////////////////////////////////////////////////PRODUCTS//////////////////////////////////////////////

function display_all_products_admin(){
  $query = query("SELECT * FROM products");

  while ($row = mysqli_fetch_assoc($query)){
  extract($row);

  $query1 = query("SELECT * FROM categories WHERE cat_id = $product_category_id");
  while ($row1 = mysqli_fetch_assoc($query1)) {
    extract($row1);
    $category_title = $row1['cat_title'];
  }

  $display_all_product= <<<ALL_PRODUCT
  <tr>
  <td>$product_id</td>
  <td>$product_title<br>
  <img src="$product_image" alt="">
  </td>
  <td>$category_title</td>
  <td>$product_price</td>
  <td><a href="admin.php?source=edit_product&product_id=$product_id"><button>Edit this Product</button></a></td>
  </tr>
  ALL_PRODUCT;
  echo $display_all_product;
}
}

function display_category_dropdown() {
  $query1 = query("SELECT * FROM categories");

  while ($row1 = mysqli_fetch_assoc($query1)){
  extract($row1);
  $category_dropdown = <<<CAT_DROP_ITEMS
  <option value="$cat_id">$cat_title</option>;
CAT_DROP_ITEMS;
echo $category_dropdown;
  }
}

function add_product() {
    if(isset($_POST['publish'])){
  $product_title = $_POST['product_title'];
  $product_description = $_POST['product_description'];
  $product_price = $_POST['product_price'];
  $product_category_id = $_POST['product_category'];

  $image = $_FILES['image']['name'];
  $image_temp = $_FILES['image']['tmp_name'];
  move_uploaded_file($image_temp, "../../resources/images/productImages/$image" );

  $product_image = "../../public/images/product_images/$image";

  $query = query("INSERT INTO products (product_title,product_category_id,product_description,product_price,product_image) VALUES ('$product_title', '$product_category_id', '$product_description', '$product_price', '$product_image')");

}
}

////////////////////////////////////////EDIT PRODUCTS/////////////////////////////////////////////////////////////
function edit_product_form_fill(){
if(isset($_GET['product_id'])){
  $p_id = $_GET['product_id'];
  $query = query("SELECT * FROM products WHERE product_id = $p_id ");

  while($row = mysqli_fetch_assoc($query)){
    extract($row);
    $edit_product_form = <<<EDIT_FORM
    <form action="admin.php?source=edit_product&product_id=$p_id" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
        <div class="form-group">
          <label for="product-title">Product Title </label>
          <input type="text" name="product_title" class="form-control" value="$product_title">
        </div>
        <div class="form-group">
          <label for="product-description">Product Description</label>
          <textarea name="product_description" id="" cols="30" rows="10" class="form-control">$product_description</textarea>
        </div>
      <div class="form-group row">
        <div class="col-xs-3">
          <label for="product-price">Product Price</label>
          <input type="float" name="product_price" class="form-control" size="60" value="$product_price">
        </div>
      </div>
      </div><!--Main Content-->
    <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
      <!-- Product Tags -->
        <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
          <input type="text" name="product_tags" class="form-control" >
        </div>
      <!-- Product Image -->
        <div class="form-group">
          <label for="product-title">Product Image</label>
          <input type="file" name="image">
        </div>
      <!-- PUBLISH -->
        <div class="form-group">
          <input type="submit" name="edit" class="btn btn-primary btn-lg" value="Edit Product">
        </div>
      </aside><!--SIDEBAR-->
    </form>
EDIT_FORM;
echo $edit_product_form;
  }
}
}

function update_product(){
  if(isset($_POST['edit'])){
    $product_id_for_update = $_GET['product_id'];
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $query = query("UPDATE products SET product_title ='$product_title', product_description = '$product_description', product_price = '$product_price' WHERE product_id = $product_id_for_update ");

    // NEED TAGS AND IMAGES INSERTED!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!//
  }
}

////////////////////////////////////////////////////////////////////BLOG CATEGORIES/////////////////////////////////

function display_blog_categories(){
  $query = query("SELECT * FROM post_categories");

  while($row = mysqli_fetch_assoc($query)){
  extract($row);
  $blog_category_items = <<<BLOG_CAT_ITEMS
  <tr>
  <td>$blog_cat_id</td>
  <td>$blog_cat_title</td>
  </tr>
BLOG_CAT_ITEMS;
  echo $blog_category_items;
  }
}

function add_blog_category(){
  if(isset($_POST['submit_category'])){
    $blog_cat_title = $_POST['category_input'];
    $query = query("INSERT INTO post_categories (blog_cat_title) VALUES ('{$blog_cat_title}')");
  }
}

/////////////////////////////////////////////////////////////////////////////BLOG POST////////////////////////////////

function display_blog_categories_dropdown() {
  $query = query("SELECT * FROM post_categories");

  while ($row = mysqli_fetch_assoc($query)){
  extract($row);
  $blog_category_dropdown = <<<BLOG_CAT_DROP_ITEMS
  <option value="$blog_cat_id">$blog_cat_title</option>;
BLOG_CAT_DROP_ITEMS;
  echo $blog_category_dropdown;
    }
}

function add_post() {
    if(isset($_POST['publish'])){
  $post_title = $_POST['post_title'];
  $post_content = $_POST['post_content'];
  $post_category_id = $_POST['post_categories'];
  $post_tags = $_POST['post_tags'];
  $post_date = date('M-d-Y');
  $image = $_FILES['post_image']['name'];
  $image_temp = $_FILES['post_image']['tmp_name'];
  move_uploaded_file($image_temp, "../../public/images/post_images/$image" );

  $post_image = "../../public/images/post_images/$image";

  $query = query("INSERT INTO blog (post_title,post_category_id,post_date,post_image,post_tags,post_content) VALUES ('$post_title', '$post_category_id', '$post_date', '$post_image', '$post_tags', '$post_content')");

}
}

//////////////////////////////////////////////////////////////////////EDIT BLOG POST////////////////////////////////
function cart() {
    //for each session extract product id and quantity
    $total = 0;
    $_SESSION['cart-total'] = '' ;
    foreach ($_SESSION as $product => $quantity){
        //check $_SESSION qty is more than 0
        if($quantity > 0) {
            //check for session variable containing products and qtys
            if(substr($product, 0, 8 ) == "product_"){
                //create variable to remove "product_" from session variable and isolate product_id
                $length = strlen($product - 8);
                //isolate product id
                $p_id = substr($product, 8, $length);
                $query = query("SELECT * FROM products WHERE product_id = $p_id ");
                while($row = mysqli_fetch_assoc($query)) {
                extract($row);
                $itemSub = $product_price*$quantity;
                $cart_item = <<<CART_ITEM
                <tr>
                <td>$product_title</td>
                <td>$product_price</td>
                <td>$quantity</td>
                <td>$itemSub</td>
                <td><a href="cart.php?add=$product_id"><i class="fa fa-plus-square"></i></a><a href="cart.php?remove=$product_id"><i class="fa fa-minus-square"></i></a><a href="cart.php?delete=$product_id"><i class="fa fa-trash"></i></a></td>
                </tr>
CART_ITEM;

                echo $cart_item;
                $_SESSION['cart-total'] += $itemSub ;
            }//while loop

        }//if statement substr
    }//if statement qty
    }//foreach
}//cartfunction










?>
