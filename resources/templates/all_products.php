<div class="container-fluid">
  <div class="row">
    <h1 class="page-header">All Products</h1>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Category</th>
          <th>Price</th>
          <th>Edit Product</th>
          <th>Delete Product</th>
          <th>Featured Attribute</th>
          <th>On Sale Attribute</th>
          <th>Set Attributes</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $product = new Products();
        $all_products = $product->find_all_products();
        foreach ($all_products as $product) {
          //use attr_options function to create options for select featured and on sale
          $featured_select = attr_options($product->featured);
          $on_sale_select = attr_options($product->on_sale);
          $display_all_product= <<<ALL_PRODUCT
          <tr>
          <td>$product->product_id</td>
          <td>$product->product_title<br>
          <img src="../$product->product_image" alt="">
          </td>
          <td>$product->product_category_id</td>
          <td>$product->product_price</td>
          <td><a href="admin.php?source=edit_product&product_id=$product->product_id"><button>Edit this Product</button></a></td>
          <td><a onclick='return confirm("Are you sure ou want to delete $product->product_title?")' href="admin.php?source=view_all_products&delete=$product->product_id"><button>Delete this Product</button></a></td>
          <form action="admin.php?source=view_all_products&product_id=$product->product_id" method="post">
          <td>
            <select name="featured" id="">
              $featured_select
            </select>
          </td>
          <td>
            <select name="onSale" id="">
              $on_sale_select
            </select>
          </td>
          <td><a href="admin.php?source=view_all_products&product_id=$product->product_id"><input type="submit" name="changeAttr" class="btn btn-primary btn-lg" value="Set Attribute"></a></td>
          </form>
          </tr>
ALL_PRODUCT;
          echo $display_all_product;
        }
        ?>
        </tbody>
      </table>
  </div>
</div>
<!-- /.container-fluid -->
 </div>
</div>
<!-- /.container-fluid -->
<?php
  if(isset($_POST['changeAttr'])){
    //if change attr submit isset, use products static function to change the database value to true or false
    Products::set_product_attr('featured', $_POST['featured'], $_GET['product_id']);
    Products::set_product_attr('on_sale', $_POST['onSale'], $_GET['product_id']);
    //redirect to prevent form resubmission
    header('Location: admin.php?source=view_all_products');
  }
  if(isset($_GET['delete'])){
    //delete product if user uses the delete button
    Products::delete_product($_GET['delete']);
    //redirect to prevent form resubmission
    header("Location: admin.php?source=view_all_products");
  }
?>

<!-- THIS COULD USE SOME VALIDATION TO PREVENT UNWANTED DELETES -->