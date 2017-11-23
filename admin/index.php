<?php
include 'library/config.php';
include 'classes/class.users.php';
include 'classes/class.items.php';
include 'classes/class.auth.php';

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new Users();
$item = new Items();
$auth = new Auth();

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
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

    <title>SleepNotGo</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/css/bootstrap-theme.css" rel="stylesheet">
    

    <!-- Custom styles for this template -->
    <link href="custom.scss" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top nav-color">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Admin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class=<?php if($module==null){ echo "active";}else{ echo '';}?>><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class=<?php if($module=="shop"){ echo "active";}else{ echo '';}?>><a href="index.php?mod=shop"><span class="glyphicon glyphicon-tags"></span></a></li>
            <li class=<?php if($module=="shop"){ echo "active";}else{ echo '';}?>><a href="index.php?mod=shop"><span class="glyphicon glyphicon-user"></span></a></li>
            
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
