<?php include '/includes/header.php' ?>
<body>
<style>


    .post-bottom-nav .col-lg-2 ul li {
        list-style: none;
        text-decoration: none !important;
        color: black;
    }

    #sidenav ul a li:hover {
        color: darkorange;
        font-weight: 800;
        transition: color .5s, font-weight .5s;
    }


    #content{
        text-align: center;
    }

    .post-container {
        margin: 20px auto;
        padding-top: 20px;
    }

    .post-container img{
        width: 80%;
    }
</style>

<div class="content-container">
  <div class="container-fluid">
    <div class="row">
       <div class="col-lg-12" id="content">
        <?php
          $post = Post::find_post_by_id($_GET['post_id']);
          $image = substr($post->post_image, 3);
          $post_category_title = Post::relate_category($post->post_category_id);
          $display_single_post = <<<DISPLAY_SINGLE_POST
            <div class="post-container">
               <img src='$image'>
               <a href="post.php?post_id=$post->post_id"><h2>$post->post_title</h2></a>
               <h3>$post->post_date</h3>
               <h3>In: $post_category_title </h3>
               <pre>$post->post_content</pre>
            </div>
DISPLAY_SINGLE_POST;
          echo $display_single_post;
        ?>
       </div>
    </div>
    <div class="row post-bottom-nav">
    <h1>More From The Blog...</h1>
    <div class="col-lg-4"></div>
      <div class="col-lg-2 post-recent-post">
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
      </div>
      <div class="col-lg-2 post-post-categories">
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
      </div>
    </div>
  </div>
</div>
<!--         <h3>SEARCH</h3>
        <input type="text" name="search-blog" placeholder="Search The Blog">
        <button class="btn btn-default" name="search-blog">Search</button> -->
</body>
<?php include "/includes/footer.php" ?>
