<?php
//if a product has been specified in the $_GET request create a new object populated with selected products values
if(isset($_GET['product_id'])){
$product = Products::find_product_by_id($_GET['product_id']);
//change values in object as user desires
  if(isset($_POST['edit'])){
    $product = Products::find_product_by_id($_GET['product_id']);
    $product->product_title = $_POST['product_title'];
    $product->product_description = $_POST['product_description'];
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


  //check if user has decided to change the images for the product, if so upload new images, if not do not delete old images and act no further
    //image 1
    if(!empty($_FILES['image']['name'])){
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_temp, "../images/productImages/$image");
    $product->product_image = "../images/productImages/$image";
  }
    //image2
    if(!empty($_FILES['image2']['name'])){
    $image2 = $_FILES['image2']['name'];
    $image_temp2 = $_FILES['image2']['tmp_name'];
    move_uploaded_file($image_temp2, "../images/productImages/$image2");
    $product->product_image2 = "../images/productImages/$image2";
  }
    //image3
    if(!empty($_FILES['image3']['name'])){
    $image3 = $_FILES['image3']['name'];
    $image_temp3 = $_FILES['image3']['tmp_name'];
    move_uploaded_file($image_temp3, "../images/productImages/$image3");
    $product->product_image3 = "../images/productImages/$image3";
  }

  //change database based on info contained in this object
    $product->save();
    //redirect to prevent for resubmission
    header("Location: admin.php?source=view_all_products");
  }//edit isset
}//get isset
?>

<div class="container-fluid">
  <div class="col-md-12">
  <div class="row">
    <h1 class="page-header">Edit Product</h1>
  </div>
  <?php
  //populate form with selected products property values
      $edit_product_form = <<<EDIT_FORM
      <form action="admin.php?source=edit_product&product_id=$product->product_id" method="post" enctype="multipart/form-data">
        <div class="col-md-8">
          <div class="form-group">
            <label for="product-title">Product Title </label>
            <input type="text" name="product_title" class="form-control" value="$product->product_title">
          </div>
          <div class="form-group">
            <label for="product-description">Product Description</label>
            <textarea name="product_description" id="" cols="30" rows="10" class="form-control">$product->product_description</textarea>
          </div>
        <div class="form-group row">
          <div class="col-xs-3">
            <label for="product-price">Product Price</label>
            <input type="float" name="product_price" class="form-control" size="60" value="$product->product_price">
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
            <img src="../$product->product_image" style="height: 65px; width:65px;"/>
            <input type="file" name="image">
          </div>
          <div class="form-group">
            <label for="product-title">Product Image 2</label>
            <img src="../$product->product_image2" style="height: 65px; width:65px;"/>
            <input type="file" name="image2">
          </div>
          <div class="form-group">
            <label for="product-title">Product Image 3</label>
            <img src="../$product->product_image3" style="height: 65px; width:65px;"/>
            <input type="file" name="image3">
          </div>
        <!-- PUBLISH -->
          <div class="form-group">
            <input type="submit" name="edit" class="btn btn-primary btn-lg" value="Edit Product">
          </div>
        </aside><!--SIDEBAR-->
        <div class="form-group row">
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 1</label>
          <input type="float" name="color" class="form-control" value="$product->color" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 2</label>
          <input type="float" name="color2" class="form-control" value="$product->color2" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 3</label>
          <input type="float" name="color3" class="form-control" value="$product->color3" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 4</label>
          <input type="float" name="color4" class="form-control" value="$product->color4" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 5</label>
          <input type="float" name="color5" class="form-control" value="$product->color5" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Color Option 6</label>
          <input type="float" name="color6" class="form-control" value="$product->color6" size="60">
        </div>
      </div> <!-- color row -->
      <div class="form-group row">
        <div class="col-xs-3">
          <label for="product-price">Product Size Option 1</label>
          <input type="float" name="size1" class="form-control" value="$product->size1" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Size Option 2</label>
          <input type="float" name="size2" class="form-control" value="$product->size2" size="60">
        </div>
        <div class="col-xs-3">
          <label for="product-price">Product Size Option 3</label>
          <input type="float" name="size3" class="form-control" value="$product->size3" size="60">
        </div>
      </div> <!-- size row -->
      </form>
EDIT_FORM;
  echo $edit_product_form;
  ?>
  </div>
</div>
<!-- /.container-fluid -->
