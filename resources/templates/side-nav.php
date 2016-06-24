<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">Bugwild</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
      <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="divider"></li>
                <li>
                    <a href="login.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="admin.php?source=view_all_products"><i class="fa fa-fw fa-bar-chart-o"></i>View Products</a>
            </li>
            <li>
                <a href="admin.php?source=add_products"><i class="fa fa-fw fa-table"></i>Add Product</a>
            </li>
            <li>
                <a href="admin.php?source=categories"><i class="fa fa-fw fa-desktop"></i>Product Categories</a>
            </li>
            <li>
                <a href="admin.php?source=users"><i class="fa fa-fw fa-wrench"></i>Users</a>
            </li>
            <li>
                <a href="admin.php?source=all_posts"><i class="fa fa-fw fa-table"></i>All Blog Post</a>
            </li>
            <li>
                <a href="admin.php?source=add_post"><i class="fa fa-fw fa-rss"></i>Add Blog Post</a>
            </li>
            <li>
                <a href="admin.php?source=blog_categories"><i class="fa fa-fw fa-desktop"></i>Blog Categories</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
