<?php
  require 'header.php';
  require 'session.php';
  require 'api.php';

  if(isset($_POST['filter'])){
    $action = $_POST['filter'];
    $val = htmlspecialchars($_POST['domain']);
    switch ($action) {
      case 'add':
        filter_add($val);
        break;
      case 'del':
        filter_del($val);
        break;
      default:
        # code...
        break;
    }
  }
?>
<style>
  body {
    background-image: url("img/bg-2.jpg");
    background-size: cover;
  }
</style>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">GreatWall</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin-main.php">Home</a></li>
        <li><a href="admin-firewall.php">Firewall</a></li>
        <li class="active"><a href="admin-filter.php">Web-Filter</a></li>
        <li><a href="about.php">About</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp<?php echo $_SESSION['login_user']; ?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav> <!-- end Navbar -->

<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default panel-bg">
      <div class="panel-heading">
        Add and Delete domain
      </div>
      <div class="panel-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="form-group">
            <input type="text" name="domain" class="form-control" placeholder="facebook.com">
            <div class="btn-group btn-group-justified">
              <div class="btn-group">
                <button type="submit" name="filter" value="add" class="btn btn-success">Block</button>
              </div>
              <div class="btn-group">
                <button type="submit" name="filter" value="del" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="panel pabel-default panel-bg">
      <div class="panel-body">
        <legend>Blocked domain</legend>
        <?php
          $list = shell_exec('grep -w "address=" /etc/dnsmasq.conf');
          echo "<pre>$list</pre>";
        ?>
      </div>
    </div>
  </div>
</div>
<?php
  require 'footer.php';
?>
