<?php
include 'library/config.php';
include 'classes/class.users.php';

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new Users();

if(isset($_REQUEST['login'])){
  extract($_REQUEST);
  $login = $user->check_login($email,md5($password));
  if($login){
  header('location: index.php');
  }
  else{
  header('location: index.php?auth=error');
  } 
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SleepNotGo</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="custom.scss" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top nav-color">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SleepNotGo</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class=<?php if($module=="shop"){ echo "active";}else{ echo '';}?>><a href="index.php?mod=shop">Shop</a></li>
            <?php
            if($user->get_session()){?>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><?php echo $_SESSION['usr_name'];?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">My Profile</a></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
              
            <?php
            }else{?>
              <li><a href="" data-toggle="modal" data-target="#myModal">Login <?php echo $user->get_session();?></a></li>
            <?php
            }
            ?>
            
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="wekwok" style="">
    <?php
      switch($module){
        case 'login':
          require_once 'modules/login/index.php';
          break;
        case 'shop':
          require_once 'modules/shop/index.php';
          break;
        case 'profile':
          require_once 'modules/profile/index.php';
          break;
        case 'register':
          require_once 'modules/register/index.php';
          break;
        default:
          require_once 'modules/home/header.php';
          require_once 'modules/home/index.php';
          break;
      }
    ?>
    </div><!-- /.container -->

    <?php
    require_once 'modules/modals/login_modal.php';
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
  </body>
</html>
