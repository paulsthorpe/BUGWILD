images/<?php
//create variable for the post requested in the $_get variable
$post = Post::find_post_by_id($_GET['post_id']);
//if edit button is pressed, edit the objects properties and then update the database with the new values
if(isset($_POST['edit_post'])){
  $post->post_title = $_POST['post_title'];
  $post->post_content = $_POST['post_content'];
  $post->post_tags = $_POST['post_tags'];
  $post->save();
  echo "saved";
  // CHANGE DIRECTORIES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!//

    if(!empty($_FILES['post_image']['name'])){
      $image = $_FILES['post_image']['name'];
      $image_temp = $_FILES['post_image']['tmp_name'];
      $image_dir = "../images/blogImages/$image";
      move_uploaded_file($image_temp, $image_dir);
      $post->post_image = $image_dir;
    } 
    if(!empty($_FILES['pre_image1']['name'])){
      $image = $_FILES['pre_image1']['name'];
      $image_temp = $_FILES['pre_image1']['tmp_name'];
      move_uploaded_file($image_temp, "../images/blogImages/$image");
      $post->content_image1 = "../images/blogImages/$image";
    } 
    if(!empty($_FILES['pre_image2']['name'])){
      $image2 = $_FILES['pre_image2']['name'];
      $image_temp2 = $_FILES['pre_image2']['tmp_name'];
      move_uploaded_file($image_temp2, "../images/blogImages/$image2");
      $post->content_image2 = "../images/blogImages/$image2";
    } 
    if(!empty($_FILES['pre_image3']['name'])){
      $image3 = $_FILES['pre_image3']['name'];
      $image_temp3 = $_FILES['pre_image3']['tmp_name'];
      move_uploaded_file($image_temp3, "../images/blogImages/$image3");
      $post->content_image3 = "../images/blogImages/$image3";
    }

  header("Location: admin.php?source=all_posts");
}

//if the $_GET request has a post specified, then populate the form with the database records current values and allow them to be edited and resubmitted
if(isset($_GET['post_id'])){
$edit_post_form_fill = <<< EDIT_POST_FORM
<div class="container-fluid">
  <div class="col-md-12">
  <div class="row">
    <h1 class="page-header">Edit Post</h1>
  </div>
    <form action="admin.php?source=edit_post&post_id=$post->post_id" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
        <div class="form-group">
          <label for="product-title">$post->post_title </label>
          <input type="text" name="post_title" class="form-control" value="$post->post_title">
        </div>
        <div class="form-group">
          <label for="post-content">Post Content</label>
          <textarea name="post_content" id="" cols="30" rows="30" class="form-control">$post->post_content</textarea>
        </div>
      </div><!--Main Content-->
    <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
      <!-- Product Tags -->
        <div class="form-group">
          <label for="post_tags">Post Keywords</label>
          <hr>
          <input type="text" name="post_tags" class="form-control" value="$post->post_tags">
        </div>

        <div class="form-group">
          <label for="product-title">Post Image</label>
          <input type="file" name="post_image">
        </div>

        <div class="form-group">
          <label for="product-title">Content Image</label>
          <input type="file" name="pre_image1">
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
          <input type="submit" name="edit_post" class="btn btn-primary btn-lg" value="Publish">
        </div>
      </aside><!--SIDEBAR-->
    </form>
  </div>
</div>
EDIT_POST_FORM;
echo $edit_post_form_fill;
}
?>
<?php
  echo  "<img src='" . $post->post_image . "' style='width:300px; height:auto;'/>";
  ?>
  <br></br>
  <br></br>
  <br></br>
  <?php
  echo  "<img src='" . $post->content_image1 . "' style='width:300px; height:auto;'/>";
  //echo "<a href='index.php?source=edit_post&id=" . $post->post_id ."&delete_photo=" . $post->post_id . "'>Delete This Photo</a>";
  ?>
    <br></br>
  <br></br>
    <form action="index.php?source=edit_post&id=<?php echo $post->post_id ?>" method="post">
      <label for="width">Width</label>
      <input type="text" name="width1">
      <label for="float">Float</label>
      <select name="float1" id="">
        <option value="left">Left</option>
        <option value="right">Right</option>
        <option value="display:block;">Center</option>
      </select>
      <input type="submit" name="create1" value="Create Image">
    </form>

    <?php  
    if(isset($_POST['create1'])){
      if($_POST['float1'] === "display:block;"){
        $correctPath = substr($post->content_image1, 3);
        $output = "&ltimg src=\"" . $correctPath . "\" style=\"width:".$_POST['width1'];
        $output .= "; height:auto; display:block;margin: 15px auto;\"/&gt";
        echo $output;
      } else {
        $correctPath = substr($post->content_image1, 3);
        $output = "&ltimg src=\"" . $correctPath . "\" style=\"width:".$_POST['width1'];
        $output .= "; height:auto;display:inline-block;float:".$_POST['float1']."; margin:15px;\"/&gt";
        echo $output;
      } 
    }
    ?>
    <br></br>
    <br></br>
    <br></br>
    <?php
      echo  "<img src='" . $post->content_image2 . "' style='width:300px; height:auto;'/>";
      //echo "<a href='index.php?source=edit_post&id=" . $post->post_id ."&delete_photo=" . $post->post_id . "'>Delete This Photo</a>";
    ?>
      <br></br>
  <br></br>
    <form action="index.php?source=edit_post&id=<?php echo $post->post_id ?>" method="post">
      <label for="width">Width</label>
      <input type="text" name="width2">
      <label for="float">Float</label>
      <select name="float2" id="">
        <option value="left">Left</option>
        <option value="right">Right</option>
        <option value="display:block;">Center</option>
      </select>
      <input type="submit" name="create2" value="Create Image">
    </form>
    <?php  
    if(isset($_POST['create2'])){
      if($_POST['float2'] === "display:block;"){
        $correctPath = substr($post->content_image2, 3);
        $output = "&ltimg src=\"" . $correctPath . "\" style=\"width:".$_POST['width2'];
        $output .= "; height:auto; display:block;margin: 15px auto;\"/&gt";
        echo $output;
      } else {
        $correctPath = substr($post->content_image2, 3);
        $output = "&ltimg src=\"" . $correctPath . "\" style=\"width:".$_POST['width2'];
        $output .= "; height:auto;display:inline-block;float:".$_POST['float2']."; margin:15px;\"/&gt";
        echo $output;
      } 
    }
    ?>
    <br></br>
    <br></br>
    <br></br>
      <?php
        echo  "<img src='" . $post->content_image3 . "' style='width:300px; height:auto;'/>";
        //echo "<a href='index.php?source=edit_post&id=" . $post->post_id ."&delete_photo=" . $post->post_id . "'>Delete This Photo</a>";
      ?>
  <br></br>
  <br></br>
    <form action="index.php?source=edit_post&id=<?php echo $post->post_id ?>" method="post">
      <label for="width">Width</label>
      <input type="text" name="width3">
      <label for="float">Float</label>
      <select name="float3" id="">
        <option value="left">Left</option>
        <option value="right">Right</option>
        <option value="display:block;">Center</option>
      </select>
      <input type="submit" name="create3" value="Create Image">
    </form>
    <?php  
      if(isset($_POST['create3'])){
        if($_POST['float3'] === "display:block;"){
          $correctPath = substr($post->content_image3, 3);
          $output = "&ltimg src=\"" . $correctPath . "\" style=\"width:".$_POST['width3'];
          $output .= "; height:auto; display:block;margin: 15px auto;\"/&gt";
          echo $output;
        } else {
          $correctPath = substr($post->content_image3, 3);
          $output = "&ltimg src=\"" . $correctPath . "\" style=\"width:".$_POST['width3'];
          $output .= "; height:auto;display:inline-block;float:".$_POST['float3']."; margin:15px;\"/&gt";
          echo $output;
        } 
      }
    ?>
      <br></br>
  <br></br>  <br></br>
  <br></br>