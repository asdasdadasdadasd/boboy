<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';
include '../../classes/class.auth.php';
include '../../classes/class.brands.php';
include '../../classes/class.orders.php';

$item = new Items();
$brand = new Brands();
$user = new Users();

if(isset($_POST['show_status'])){
  echo $brand->get_brand_status($_POST['brand_id']);
}

if(isset($_POST['change_status'])){
  $brand->change_brand_status($_POST['brand_id'],$_POST['checked']);
  if($_POST['checked']==0){
    $user->remove_cart_unavailable($_POST['brand_id']);
  }
}
?>