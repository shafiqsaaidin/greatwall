<?php
  require 'header.php';
  require 'session.php';
  require 'api.php';
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
        <li><a href="#about">About</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#contact">Logout</a></li>
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
        Add domain to block
      </div>
      <div class="panel-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="domain" class="form-control" placeholder="facebook.com">
              <div class="input-group-btn">
                <button type="submit" name="filter" class="btn btn-danger">Block</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="panel pabel-default">
      <div class="panel-body">
        <legend>Blocked domain</legend>
        <ul class="list-group">
          <li class="list-group-item">google.com <button type="button" name="button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i></button></li>
          <li class="list-group-item">facebook.com <button type="button" name="button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i></button></li>
          <li class="list-group-item">youtube.com <button type="button" name="button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i></button></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
  require 'footer.php';
?>
