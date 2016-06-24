<?php
//create new object instance to handle user input
  $category = new Categories();
//if submit category button is pressed, use value in the post variable to create new database entry
  
  if(isset($_POST['submit_category'])){
    $category->cat_title = $_POST['category_input'];
    $category->create_blog_category();
  }

  if(isset($_POST['submit_edit'])){
    $edited = Categories::find_blog_cat_by_id( $_POST['category_select']);
    $edited->cat_title = $_POST['new_title'];
    $edited->save_blog_category();
    header("refresh:0");
  }

?>
<div class="container-fluid">
  <h1 class="page-header">
  Blog Categories
  </h1>
    <div class="col-md-4">
      <form action="admin.php?source=blog_categories" method="post">
        <div class="form-group">
          <label for="category-title">Title</label>
          <input type="text" class="form-control" name="category_input">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Add Category" name="submit_category">
        </div>
      </form>
    </div>
  <div class="col-md-8">
    <table class="table">
      <thead>
        <tr>
          <th>Category Id</th>
          <th>Category Title</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $all_categories = $category->find_all_blog_categories();
      foreach ($all_categories as $cat) {
        $blog_category_items = <<<BLOG_CAT_ITEMS
        <tr>
        <td>$cat->cat_id</td>
        <td>$cat->cat_title</td>
        </tr>
BLOG_CAT_ITEMS;
        echo $blog_category_items;
      }
      ?>
      </tbody>
    </table>
  </div>
  <form action="admin.php?source=blog_categories" method="post">
  <h1>Edit Categories</h1>
  <div class="col-md-4">
    <h3>Old Category Title</h3>
    <select name="category_select" id="" class="form-control">
    <?php
    foreach ($all_categories as $cat) {
      $blog_category_items = <<<BLOG_CAT_ITEMS
      <option value="$cat->cat_id">$cat->cat_title</option>;
BLOG_CAT_ITEMS;
      echo $blog_category_items;
    }
    ?>
    </select>

  </div>
  <div class="col-md-6">
    <h3>New Category Title</h3>
    <input type="text" class="form-control" name="new_title">
  </div>
  <div class="col-md-2">
    <button type="submit" name="submit_edit">Submit Edit</button>
  </div>
</form>
</div>
<!-- /.container-fluid -->
