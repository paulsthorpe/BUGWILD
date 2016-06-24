<?php require_once('../../resources/php/initialize.php'); ?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<?php 
unset($_SESSION['user']);
if(isset($_POST['submit'])){

    $user = $_POST['username'];
    $password = $_POST['password'];

    $user = $database->escape_string($user);
    $password = $database->escape_string($password);

    $query = $database->query("SELECT * FROM users WHERE username = '{$user}' AND password = '{$password}' ");

    if(mysqli_num_rows($query) == 0){

        header("Location: login.php");

    } else {

        while ($row = mysqli_fetch_assoc($query)){
            extract($row);
            $_SESSION['user'] = $user;
            header("Location: admin.php");

        }//while

    }//else

}//ifPOST


?>

<div class="container">
  
    <h1 class="text-center">Login</h1>
    <div class="col-lg-12">

        <form class="" action="login.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                Username :<input type="text" name="username" class="form-control" placeholder="Username">
            </div>
             <div class="form-group">
                Password :<input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="submit" class="btn btn-primary" >
            </div>
        </form>
    </div>
</div>

