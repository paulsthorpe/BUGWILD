<footer>
  <div class="footer-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3">
            <h3>Find Me On Social Media</h3>
            <a href='http://www.facebook.com/Bug-Wild-1580034655571591/'><i class="fa fa-facebook-square"></i></a>
            <a href="http://www.instagram.com/bug.wild/"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="col-lg-3">
            <h3>Quick Links</h3>
            <ul>
              <a href="index.php"><li>Home</li></a>
              <a href="shop.php"><li>Shop</li></a>
              <a href="blog.php"><li>Blog</li></a>
              <a href="cart.php"><li>Cart</li></a>
            </ul>
        </div>
        <div class="col-lg-3">
          <h3>Recent Post</h3>
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
        <div class="col-lg-3">
          <h3>Featured Flies</h3>
          <ul>
            <?php 
              $newest_flies = Products::featured_products();
              foreach ($newest_flies as $fly) {
                echo '<li><a href="item.php?product='.$fly->product_id.'">'.$fly->product_title.'</a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright &copy; <?php //echo date("Y") ?>2016 Bugwild</p>
          <p>Website Designed and Developed by <a href="#">Paul Thorpe</a></p>
        </div>
      </div>
    </div>
  </div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</footer>
