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
        <li><a href="admin-filter.php">Web-Filter</a></li>
        <li class="active"><a href="about.php">About</a></li>
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
  <div class="col-md-6 col-md-offset-3">

    <ul class="list-group">

      <li style="background-color: rgba(51,51,51,0.5)" class="active list-group-item">
        <h3 style="color: #e74c3c; font-weight: bold">GreatWall Firewall</h3>
        <img src="img/pi2.png" class="img-responsive">
      </li>
      <li class="list-group-item"><label>Modal: </label> Raspberry pi 3</li>
      <li class="list-group-item"><label>Version: </label> Version 1.0, build 1</li>
      <li class="list-group-item"><label></label>Copyright 2017 GreatWall All rights reserved.</li>
    </ul>
  </div>
</div>
<?php
  require 'footer.php';
?>
