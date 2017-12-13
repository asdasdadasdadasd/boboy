<?php
include 'library/config.php';
include 'classes/class.users.php';
include 'classes/class.items.php';
include 'classes/class.auth.php';
include 'classes/class.brands.php';
include 'classes/class.orders.php';

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$t = (isset($_GET['t']) && $_GET['t'] != '') ? $_GET['t'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new Users();
$item = new Items();
$auth = new Auth();
$brand = new Brands();
$order = new Orders();
$currency = "₱";

function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function get_time_ago($time_stamp)
{
    $time_difference = strtotime('now') - $time_stamp;

    if ($time_difference >= 60 * 60 * 24 * 365.242199)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
         * This means that the time difference is 1 year or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
         * This means that the time difference is 1 month or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 7)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
         * This means that the time difference is 1 week or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
    }
    elseif ($time_difference >= 60 * 60 * 24)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day
         * This means that the time difference is 1 day or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
    }
    elseif ($time_difference >= 60 * 60)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour
         * This means that the time difference is 1 hour or more
         */
        return get_time_ago_string($time_stamp, 60 * 60, 'hour');
    }
    else
    {
        /*
         * 60 seconds/minute
         * This means that the time difference is a matter of minutes
         */
        return get_time_ago_string($time_stamp, 60, 'minute');
    }
}

function get_time_ago_string($time_stamp, $divisor, $time_unit)
{
    $time_difference = strtotime("now") - $time_stamp;
    $time_units      = floor($time_difference / $divisor);

    settype($time_units, 'string');

    if ($time_units === '0')
    {
        return 'less than 1 ' . $time_unit . ' ago';
    }
    elseif ($time_units === '1')
    {
        return '1 ' . $time_unit . ' ago';
    }
    else
    {
        /*
         * More than "1" $time_unit. This is the "plural" message.
         */
        // TODO: This pluralizes the time unit, which is done by adding "s" at the end; this will not work for i18n!
        return $time_units . ' ' . $time_unit . 's ago';
    }
}


function time2string($timeline) {
  $periods = array('day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);

  foreach($periods AS $name => $seconds){
      $num = floor($timeline / $seconds);
      $timeline -= ($num * $seconds);
      $ret .= $num.' '.$name.(($num > 1) ? 's' : '').' ';
  }

  return trim($ret);
}

function time_ago(Datetime $date) {
  $time_ago = '';

  $diff = $date->diff(new Datetime('now'));


  if (($t = $diff->format("%m")) > 0)
    $time_ago = $t . ' months';
  else if (($t = $diff->format("%d")) > 0)
    $time_ago = $t . ' days';
  else if (($t = $diff->format("%H")) > 0)
    $time_ago = $t . ' hours';
  else
    $time_ago = 'minutes';

  return $time_ago . ' ago (' . $date->format('M j, Y') . ')';
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="John Carlo H. Octabio">
    <link rel="icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <title>SleepNotGo</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/datatables.material.min.css" rel="stylesheet">
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/bootstrap-switch.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="custom.scss" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav id="nav-id" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div style="margin-left: 24px;">
            <a class="navbar-brand example6" href="/sng"></a>
          </div>
        </div>
        <div id="navbar" class="collapse navbar-collapse roboto">
          <ul class="nav navbar-nav navbar-right">
            <li class=<?php if($module==null){ echo "active";}else{ echo '';}?>><a href="/sng" class="uppercase">Home</a></li>
            <li class=<?php if($module=="shop"){ echo "active";}else{ echo '';}?>><a href="/sng/?mod=shop" class="uppercase">Shop</a></li>
            <?php
            if($user->get_session()){?>
              <?php 
              if($_SESSION['usr_auth'] == 1){
              ?>
              <li class="<?php if($module==cart){ echo "active";}else{ echo '';}?>">
                <a class="uppercase" href="/sng/?mod=cart"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Cart (<?php echo $item->count_cart($_SESSION['usr_id'])?>)</a>
              </li>
              <?php
              }
              ?>
              <li class="dropdown <?php if($module==profile){ echo "";}else{ echo '';}?>">
                <a class="dropdown-toggle uppercase" data-toggle="dropdown" href=""><span class="glyphicon glyphicon-user"></span>&nbsp;<?php if($_SESSION['usr_auth'] == 2){echo $_SESSION['usr_name'];}?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu" style="background-color: #f7f7f7;">
                  <?php
                  if($_SESSION['usr_auth'] == 1){
                  ?>
                  <li class="dropdown-header" style="color: rgba(0,0,0,0.8); font-weight: 500; font-size: 14px;"><?php echo $_SESSION['usr_name'];?></li>
                  <li class="divider"></li>
                  <?php
                  }
                  ?>
                  <li class="dropdown-header">Account</li>
                  <?php
                  if($_SESSION['usr_auth'] == 1){
                  ?>
                  <li style=""><a href="/sng/?mod=profile">My Profile</a></li>
                  <?php
                  }else{?>
                    <li style=""><a href="/sng/?mod=cpanel">Control Panel</a></li>
                  <?php
                  }
                  ?>
                  <li><a id="btn-logout"  href="#">Logout</a></li>
                </ul>
              </li>
            <?php
            }else{?>
              <li><a class="uppercase" href="" data-toggle="modal" data-target="#myModal">Login</a></li>
            <?php
            }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
      <?php
      $url_str = substr($_SERVER['REQUEST_URI'], 5);
      if(isset($_GET['mod'])){
      ?>
      <div class="nav-helper">
        <div class="container">
          <a class="shop-directory" href="/sng/?mod=<?php echo $_GET['mod'];?>"><?php echo ucfirst($_GET['mod']);?></a> / <?php if($_GET['mod'] == "shop"){if(isset($_GET['brand'])){?>
                <a class="shop-directory" href="/sng/?mod=shop&brand=<?php echo $_GET['brand'];?>">
                <?php
                echo $item->get_item_brand($_GET['brand']);
                ?>
                </a>
                <?php
                if(isset($_GET['item'])&&isset($_GET['brand'])){?>
                  / <a class="shop-directory" href="<?php echo $url_str;?>">
                      <?php
                        $dir_name = $item->get_item_and_brand($_GET['item'],$_GET['brand']);
                        if($dir_name){
                          foreach($dir_name as $o);
                          echo $o['item_name'];
                        }
                      ?>
                  </a><?php
                }
                ?>
              <?php
              }else{?><a class="shop-directory" href="/sng/?mod=shop"><?php echo "All";?></a><?php
                if(isset($_GET['item'])){
                  $s = $item->check_item_status($_GET['item']);
                  if($s == 1){?>
                  / <a class="shop-directory" href="<?php echo $url_str;?>">
                      <?php
                        echo $item->get_item_name($_GET['item']);
                      ?>
                  </a>
                <?php
                  }
                }
              }
            }else if($_GET['mod']=="cpanel"){
              if(isset($_GET['t'])){?>
                <a class="shop-directory" href="/sng/?mod=cpanel&t=<?php echo $_GET['t'];?>"><?php echo ucfirst($_GET['t']);?></a> <?php if(isset($_GET['q'])){?>/<a class="shop-directory" href='<?php echo $url_str;?>'><?php echo $item->get_item_name($_GET['q']);?></a>
            <?php 
                }
              }
            }
            ?></div></div><?php
      }
      ?>
    </nav>
    <div class=""><?php
      if($module == null){?>
        <div class="header-wrapper">
        <?php
        require_once 'modules/home/header.php';
        ?>
        </div>
      <?php
      }
      ?>
      <div class="main"><?php switch($module){
          case 'login':
            require_once 'modules/login/index.php';
            break;
          case 'shop':
            require_once 'modules/shop/index.php';
            break;
          case 'profile':
            if($_SESSION['usr_auth'] == 1){
              require_once 'modules/profile/index.php';
            }else{
              header('location: index.php');
            }
            break;
          case 'register':
            require_once 'modules/register/index.php';
            break;
          case 'cpanel':
            if($_SESSION['usr_auth'] == 2){
              require_once 'modules/cpanel/index.php';
            }else{
              header('location: index.php');
              exit;
            }
            break;
          case 'cart':
            if($_SESSION['usr_auth'] == 1){
              require_once 'modules/cart/index.php';
            }else{
              header('location: index.php');
              exit;
            }
            break;
          default:
            require_once 'modules/home/index.php';
            break;
        }
      ?>
      </div><!-- /.container -->
    </div>

    <!-- Footer Content Goes Here -->
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="/sng/">Home</a></li>
                        <li><a href="/sng/?mod=register">Register</a></li>
                        <li><a href="#">Downloads</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help desk</a></li>
                        <li><a href="#">Forums</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 info">
                    <h5>Information</h5>
                    <p>The Palms, 18th Street Lacson, Bacolod City</br>
                    @iamsleepnot</br>
                    Call 4741654</p>
                </div>
            </div>
        </div>
        <div class="second-bar">
           <div class="container">
                <h2 class="logo"><a class="navbar-brand example6" style="width: 50px;" href="/sng/"></a></h2><span style="width: 10px;" >Copyright 2017</span>
                <div class="social-icons">
                    <a href="#" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.facebook.com/iamsleepnot/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/iamsleepnot/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <?php
    require_once 'modules/modals/login_modal.php';
    require_once 'modules/modals/remove_cart.php';
    require_once 'modules/modals/item_modal.php';
    require_once 'modules/modals/ui_modals.php';
    ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-switch.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/dataTables.material.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>