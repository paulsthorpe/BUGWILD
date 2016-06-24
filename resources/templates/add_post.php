<?php
//create new object instance to handle user input 
$post = new Post();
//if publish button isset, fill object with user input
if(isset($_POST['publish'])){
  $post->post_title = $_POST['post_title'];
  $post->post_content = $_POST['post_content'];
  $post->post_category_id = $_POST['post_categories'];
  $post->post_tags = $_POST['post_tags'];
  $post->post_date = date('M-d-Y');
  //create image upload
  $image = $_FILES['post_image']['name'];
  $image_temp = $_FILES['post_image']['tmp_name'];
  $image_dir = "../images/blogImages/$image";
  move_uploaded_file($image_temp, $image_dir);
  $post->post_image = $image_dir;












$image = $_FILES['pre_image']['name'];
$image_temp = $_FILES['pre_image']['tmp_name'];
move_uploaded_file($image_temp, "../images/blogImages/$image");
$post->content_image1 = "../images/blogImages/$image";

$image2 = $_FILES['pre_image2']['name'];
$image_temp2 = $_FILES['pre_image2']['tmp_name'];
move_uploaded_file($image_temp2, "../images/blogImages/$image2");
$post->content_image2 = "../images/blogImages/$image2";

$image3 = $_FILES['pre_image3']['name'];
$image_temp3 = $_FILES['pre_image3']['tmp_name'];
move_uploaded_file($image_temp3, "../images/blogImages/$image3");
$post->content_image3 = "../images/blogImages/$image3";






















  $post->save();
  //redirect to prevent for resubmission
  header("Location: admin.php?source=all_posts");
}
?>
<div class="container-fluid">
  <div class="col-md-12">
  <div class="row">
    <h1 class="page-header">Add Post</h1>
  </div>
    <form action="admin.php?source=add_post" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
        <div class="form-group">
          <label for="product-title">Post Title </label>
          <input type="text" name="post_title" class="form-control">
        </div>
        <div class="form-group">
          <label for="post-content">Post Content</label>
          <textarea name="post_content" id="" cols="30" rows="30" class="form-control"></textarea>
        </div>
      </div><!--Main Content-->
    <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
      <!-- Product Categories-->
        <div class="form-group">
          <label for="post_categories">Post Category</label>
          <hr>
          <select name="post_categories" id="" class="form-control">
          <?php
          $all_categories = Categories::find_all_blog_categories();
          foreach ($all_categories as $cat) {
            $blog_category_items = <<<BLOG_CAT_ITEMS
            <option value="$cat->cat_id">$cat->cat_title</option>;
BLOG_CAT_ITEMS;
            echo $blog_category_items;
          }
          ?>
          </select>
        </div>
      <!-- Product Tags -->
        <div class="form-group">
          <label for="product-title">Post Keywords</label>
          <hr>
          <input type="text" name="post_tags" class="form-control">
        </div>
      <!-- Product Image -->
        <div class="form-group">
          <label for="product-title">Post Image</label>
          <input type="file" name="post_image">
        </div>
        <div class="form-group">
          <label for="product-title">Content Image</label>
          <input type="file" name="pre_image">
        </div>
        <div class="form-group">
          <label for="product-title">Content Image 2</label>
          <input type="file" name="pre_image2">
        </div>
        <div class="form-group">
          <label for="product-title">Content Image 3</label>
          <input type="file" name="pre_image3">
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
