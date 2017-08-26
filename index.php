<?php
  require 'header.php';
  session_start();

  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    if($username == "admin" && $password == "240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9"){
      $_SESSION['login_user'] = $username;
      header("location: admin-main.php");
    } else {
      header("location: index.php");
    }
  }
?>
<section class="section1">
  <div class="container">
    <div class="row">
      <div style="margin-top:30px;" class="col-md-4 col-md-offset-4">
        <img class="img-responsive" src="img/fw1.png">
        <h3 align="center">GreatWall</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="login" class="btn btn-success btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
