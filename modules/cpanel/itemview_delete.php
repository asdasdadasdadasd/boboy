<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';
include '../../classes/class.brands.php';
include '../../classes/class.auth.php';

$item = new Items();
$user = new Users();
$brand = new Brands();
$auth = new Auth();


if(isset($_POST['delete_id'])){
  if($item->delete_item($_POST['delete_id'],$_SESSION['brand_id'])){
    echo "delete_success";
  }
}