<?php
  require 'header.php';
  require 'session.php';
  require 'api.php';

  //Quick menu option
  //Firewall button
  $fwcheck = $_POST['fwcheck'];
  switch($fwcheck){
    case "on":
      $stat = "on";
      fwCheck($stat);
      break;
    case "off":
      $stat = "off";
      fwCheck($stat);
      break;
    default:
      break;
  }

  //Firewall button
  $fwfilter = $_POST['fwfilter'];
  switch($fwfilter){
    case "on":
      $stat = "on";
      fwFilter($stat);
      break;
    case "off":
      $stat = "off";
      fwFilter($stat);
      break;
    default:
      break;
  }

  //Remote button
  $fwremote = $_POST['fwremote'];
  switch($fwremote){
    case "on":
      $val = "on";
      fwRemote($val);
      break;
    case "off":
      $val = "off";
      fwRemote($val);
      break;
    default:
      break;
  }

  //Device button
  $fwdevice = $_POST['fwdevice'];
  switch($fwdevice){
    case "restart":
      $val = "restart";
      fwDevice($val);
      break;
    case "poweroff":
      $val = "poweroff";
      fwDevice($val);
      break;
    default:
      break;
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
        <li class="active"><a href="admin-main.php">Home</a></li>
        <li><a href="admin-firewall.php">Firewall</a></li>
        <li><a href="admin-filter.php">Web-Filter</a></li>
        <li><a href="#about">About</a></li>
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
  <div class="middle-div">
    <div class="row">
        <div class="col-md-3 text-center">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-arrow-circle-down" aria-hidden="true"></i><br />
              <?php echo $rx; ?><br>
              <label>Inbound</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-arrow-circle-up" aria-hidden="true"></i><br />
              <?php echo $tx; ?><br>
              <label>Outbound</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-globe" aria-hidden="true"></i><br />
              <?php echo exec("ip addr | grep 'inet 192' | awk {'print $2'}"); ?><br>
              <label>Ip Address</label>
            </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-search" aria-hidden="true"></i><br />
              <?php echo exec("cat /etc/resolv.conf | grep nameserver | awk {'print $2'}"); ?><br>
              <label>Dns Server</label>
            </div>
          </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-3">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-shield" aria-hidden="true"></i><br />
              <label>Firewall</label><br />
              <?php
                $stat = exec("sudo ufw status | grep Status: | awk '{print $2}'");
                if($stat == 'active'){
                  echo "<span style='color: #27ae60'>$stat</span>";
                } elseif($stat == 'inactive') {
                  echo "<span style='color: #e74c3c'>$stat</span>";
                }
              ?>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="btn-group btn-group-justified">
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwcheck" value="on" class="btn btn-primary">On</button>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwcheck" value="off" class="btn btn-danger">Off</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-filter" aria-hidden="true"></i><br />
              <label>Web Filter</label><br />
              <?php
                $stat = exec("sudo service dnsmasq status | grep active | awk '{print $2}'");
                if($stat == 'active'){
                  echo "<span style='color: #27ae60'>$stat</span>";
                } elseif($stat == 'inactive') {
                  echo "<span style='color: #e74c3c'>$stat</span>";
                }
              ?>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="btn-group btn-group-justified">
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwfilter" value="on" class="btn btn-primary">On</button>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwfilter" value="off" class="btn btn-danger">Off</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-laptop" aria-hidden="true"></i><br />
              <label>Remote</label><br />
              <?php
                $stat = exec("sudo service ssh status | grep active | awk '{print $2}'");
                if($stat == 'active'){
                  echo "<span style='color: #27ae60'>$stat</span>";
                } elseif($stat == 'inactive') {
                  echo "<span style='color: #e74c3c'>$stat</span>";
                }
              ?>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="btn-group btn-group-justified">
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwremote" value="on" class="btn btn-primary">On</button>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwremote" value="off" class="btn btn-danger">Off</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <i class="fa fa-power-off" aria-hidden="true"></i><br />
              <label>Device</label><br />
              <span style='color: #27ae60'><?php echo "running"; ?></span>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="btn-group btn-group-justified">
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwdevice" value="restart" class="btn btn-primary" onclick='return confirm(`Restart this device?`);'>
                      Restart
                    </button>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <button type="submit" name="fwdevice" value="poweroff" class="btn btn-danger" onclick='return confirm(`Shutdown this device?`);'>
                      Shutdown
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div id="progress">
        <div class="col-md-4">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <label>RAM</label>
              <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo get_ram_usage(); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo get_ram_usage()."%"; ?>"><?php echo get_ram_usage()."%"; ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <label>CPU</label>
              <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo get_cpu_usage(); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo get_cpu_usage()."%"; ?>"><?php echo get_cpu_usage()."%"; ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default panel-bg">
            <div class="panel-body">
              <label>HDD</label>
              <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo rtrim(get_cpu_usage(), "% "); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo get_hdd_usage(); ?>"><?php echo get_hdd_usage(); ?></div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- /.container -->
<footer class="footer navbar-default">
  <div class="container">
    <p class="text-muted text-center">&copy 2017 - GreatWall - All right reserve</p>
  </div>
</footer>
<?php
  require 'footer.php';
?>
