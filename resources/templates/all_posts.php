<div class="container-fluid">
  <div class="row">
    <h1 class="page-header">All Post</h1>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Category</th>
          <th>Edit Post</th>
          <th>Delete Post</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $all_post = Post::find_all_posts();
        foreach ($all_post as $post) {
          $display_all_posts= <<<ALL_POSTS
          <tr>
          <td>$post->post_id</td>
          <td>$post->post_title</td>
          <td>$post->post_category_id</td>
          <td><a href="admin.php?source=edit_post&post_id=$post->post_id"><button>Edit this Post</button></a></td>
          <td><a onclick='return confirm("Are you sure you want to delete $post->post_title?")' href="admin.php?source=all_posts&delete=$post->post_id"><button>Delete this Post</button></a></td>
          </tr>
ALL_POSTS;
          echo $display_all_posts;
          }
          //delete if user clicks delete button
          if(isset($_GET['delete'])){
            Post::delete_post($_GET['delete']);
            //redirect to prevent form resubmission
            header("Location: admin.php?source=all_posts");
          }
        ?>
        </tbody>
      </table>
  </div>
</div>
<!-- /.container-fluid -->
