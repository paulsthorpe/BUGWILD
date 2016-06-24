<?php
//create new object instance to handle user input
$product = new Products();
//if publish button isset, populate object with user input
if(isset($_POST['publish'])){
$product->product_title = $_POST['product_title'];
$product->product_description = $_POST['product_description'];
$product->product_category_id = $_POST['product_category'];
$product->product_price = $_POST['product_price'];
$product->color = $_POST['color'];
$product->color2 = $_POST['color2'];
$product->color3 = $_POST['color3'];
$product->color4 = $_POST['color4'];
$product->color5 = $_POST['color5'];
$product->color6 = $_POST['color6'];
$product->size1 = $_POST['size1'];
$product->size2 = $_POST['size2'];
$product->size3 = $_POST['size3'];
//handle image uploads
$image = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];
move_uploaded_file($image_temp, "../images/productImages/$image");
$product->product_image = "../images/productImages/$image";

$image2 = $_FILES['image2']['name'];
$image_temp2 = $_FILES['image2']['tmp_name'];
move_uploaded_file($image_temp2, "../images/productImages/$image2");
$product->product_image2 = "../images/productImages/$image2";

$image3 = $_FILES['image3']['name'];
$image_temp3 = $_FILES['image3']['tmp_name'];
move_uploaded_file($image_temp3, "../images/productImages/$image3");
$product->product_image3 = "../images/productImages/$image3";
//save object in database
$product->save();
//redirect to prevent form resubmission
header("Location: admin.php?source=view_all_products");
}
?>
<div class="container-fluid">
  <div class="col-md-12">
  <div class="row">
    <h1 class="page-header">Add Product</h1>
    <?php echo getcwd(); ?>
  </div>
    <form action="admin.php?source=add_products" method="post" enctype="multipart/form-data">
      <div class="col-md-8">

        <div class="form-group">
          <label for="product-title">Product Title </label>
          <input type="text" name="product_title" class="form-control">
        </div>
        <div class="form-group">
          <label for="product-description">Product Description</label>
          <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>

      <div class="form-group row">
        <div class="col-xs-3">
          <label for="product-price">Product Price</label>
          <input type="float" name="product_price" class="form-control" size="60">
        </div>
      </div> <!-- price row -->
      <!-- COLOR INPUTS -->
      <div class="form-group row">
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 1</label>
          <input type="float" name="color" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 2</label>
          <input type="float" name="color2" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 3</label>
          <input type="float" name="color3" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 4</label>
          <input type="float" name="color4" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 5</label>
          <input type="float" name="color5" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 6</label>
          <input type="float" name="color6" class="form-control" size="60">
        </div>
      </div> <!-- color row -->
      <!-- SIZE INPUTS -->
      <div class="form-group row">
        <div class="col-xs-3">
          <label for="product-price">Product Size Option 1</label>
          <input type="float" name="size1" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Size Option 2</label>
          <input type="float" name="size2" class="form-control" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Size Option 3</label>
          <input type="float" name="size3" class="form-control" size="60">
        </div>
      </div> <!-- size row -->
      
      </div><!--Main Content-->
    <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
      <!-- Product Categories-->
        <div class="form-group">
          <label for="product-title">Product Category</label>
          <hr>
          <select name="product_category" id="" class="form-control">
          <?php
          //create dropdown with all possible product categories from info in categories table
          $all_categories = Categories::find_all_product_categories();
          foreach ($all_categories as $cat) {
            $product_category_items = <<<PRODUCT_CAT_ITEMS
            <option value="$cat->cat_id">$cat->cat_title</option>;
PRODUCT_CAT_ITEMS;
            echo $product_category_items;
          }
          ?>
          </select>
        </div>
      <!-- Product Tags -->
        <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
          <input type="text" name="product_tags" class="form-control">
        </div>
      <!-- Product Image -->
        <div class="form-group">
          <label for="product-title">Product Image</label>
          <input type="file" name="image">
        </div>
        <div class="form-group">
          <label for="product-title">Product Image 2</label>
          <input type="file" name="image2">
        </div>
        <div class="form-group">
          <label for="product-title">Product Image 3</label>
          <input type="file" name="image3">
        </div>
      <!-- PUBLISH -->
        <div class="form-group">
          <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
        </div>
      </aside><!--SIDEBAR-->
    </form>
  </div>
</div>
<!-- /.container-fluid -->
