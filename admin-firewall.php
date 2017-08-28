<?php
  require 'header.php';
  require 'session.php';
  require 'api.php';

  // Message Vars
  $msg = '';
  $msgClass = '';
  $fwcheck = $_POST['fwcheck'];

  // On off firewall
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

  // Reset Firewall Rule
  if(isset($_POST['reset'])){
    $passwd = hash('sha256', $_POST['fw_reset']);
    if($passwd == "240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9"){
      fwReset();
    }
  }

  // Check for submit
  if(filter_has_var(INPUT_POST, 'add')){
      $port = $_POST['port'];

      // Check required fields
      if(!empty($port)){
          fwAdd($port);
      } else {
          // Failed
          $msg = 'Please fill in port';
          $msgClass = 'alert-danger';
      }
  } elseif(filter_has_var(INPUT_POST, 'del')){
      $num = $_POST['num'];

      // Check required fields
      if(!empty($num)){
          fwDel($num);
      } else {
          // Failed
          $msg = 'Please fill in the number';
          $msgClass = 'alert-danger';
      }
  }

  if(isset($_POST['advance-add'])){
      $policy = htmlspecialchars($_POST['policy']);
      $direction = htmlspecialchars($_POST['direction']);
      $src = htmlspecialchars($_POST['src']);
      $dst = htmlspecialchars($_POST['dst']);
      $port = htmlspecialchars($_POST['port']);
      $protocol = htmlspecialchars($_POST['protocol']);

      //sudo ufw allow from 192.168.0.4 to any port 22 proto tcp
      fwAdvance($policy, $direction, $src, $dst, $port, $protocol);
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
        <li class="active"><a href="admin-firewall.php">Firewall</a></li>
        <li><a href="admin-filter.php">Web-Filter</a></li>
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
      <div class="panel-heading">Add rule</div>
      <div class="panel-body">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal">
          <div class="form-group">
            <div class="col-md-2">
             <label>Port:</label>
            </div>
            <div class="col-md-10">
             <div class="input-group">
               <input type="text" class="form-control" id="port" name="port" placeholder="Example: 80">
               <div class="input-group-btn">
                 <button style="width: 90px;" class="btn btn-success btn-block" type="submit" name="add">Add Rule</button>
               </div>
             </div>
            </div>
          </div>
           <div class="form-group">
               <label class="control-label col-md-2"><a data-toggle="modal" data-target="#myModal">advance</a></label>
           </div>
       </form>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default panel-bg">
      <div class="panel-heading">Delete rule</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <div class="col-md-2">
             <label>Number:</label>
            </div>
            <div class="col-md-10">
             <div class="input-group">
               <input type="text" class="form-control" id="del" name="num" placeholder="Example: 1">
               <div class="input-group-btn">
                 <button style="width: 90px;" class="btn btn-danger btn-block" type="submit" name="del">Delete</button>
               </div>
             </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-md-offset-2">
    <br><legend style="">Firewall Rule <button type="button" name="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reset">reset all</button></legend>
    <?php echo list_port_num(); ?>
  </div>
</div>

<!-- Reset confirmation -->
<div id="reset" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Please verify your password</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group">
                  <input type="password" class="form-control" placeholder="Password" name="fw_reset">
                  <div class="input-group-btn">
                    <button class="btn btn-success" type="submit" name="reset">Verify</button>
                  </div>
              </div>
              </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Advance Firewall Rule</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label class="control-label col-md-2" for="policy">Policy:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="policy">
                            <option value="allow">Allow</option>
                            <option value="deny">Deny</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Direction:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="direction">
                            <option value="in">Inbound</option>
                            <option value="out">Outbound</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Source:</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="src" value="any">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Destination:</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="dst" value="any">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Port:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="port" placeholder="example: 80">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Protocol:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="protocol">
                            <option value="tcp">Tcp</option>
                            <option value="udp">Udp</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block" name="advance-add">Add</button><br>
            </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
  require 'footer.php';
?>
