<?php include '/includes/header.php' ?>

<body>
   <div class="content-container">
   <h1 style="font-size: 4em;">From The Blog...</h1>
       <aside class="col-lg-3" id="sidenav">
<!--            <h3>SEARCH</h3>
           <input type="text" name="search-blog" placeholder="Search The Blog">
           <button class="btn btn-default" name="search-blog">Search</button> -->
           <h3>RECENT POST</h3>
           <ul>
               <?php
              $recent_post = Post::recent_post();
              foreach ($recent_post as $post) {
                $recent_post_links = <<<RECENT_POST_LINKS
                  <li><a href="post.php?post_id=$post->post_id">$post->post_title</a></li>
RECENT_POST_LINKS;
                echo $recent_post_links;
              }
?>
           </ul>
           <h3>CATEGORIES</h3>
           <ul>
               <?php
               $post_categories = Categories::find_all_blog_categories();
               foreach ($post_categories as $category) {
                 $post_category_links = <<<POST_CAT_LINKS
                   <li><a href="postbycategory.php?category_id=$category->cat_id">$category->cat_title</a></li>
POST_CAT_LINKS;
                 echo $post_category_links;
               }
              ?>
           </ul>
       </aside>
       <div class="col-lg-9" id="content">
           <?php
           //display all Post
           $all_post = Post::find_all_posts();
          foreach ($all_post as $post) {
            $image = substr($post->post_image, 3);
            $excerpt = substr($post->post_content, 0, 300);
            $post_category_title = Post::relate_category($post->post_category_id);
            $display_post = <<<DISPLAY_POST
            <div class="post-container">
                <img src='$image'>
                <a href="post.php?post_id=$post->post_id"><h2>$post->post_title</h2></a>
                <h4>Date: $post->post_date</h4>
                <h4>In: $post_category_title </h4>
                <pre class="excerpt">$excerpt... <a href="post.php?post_id=$post->post_id">More</a></pre>
            </div>
DISPLAY_POST;
            echo $display_post;
          }
            ?>
       </div>
   </div>
</body>
<?php include "/includes/footer.php" ?>
