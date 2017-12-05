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

$item_id = $_POST['edit-item-id'];

// Update item information
if($item->update_item($_POST['edit-item-name'],$_POST['edit-item-desc'],$_POST['edit-item-price'],$_POST['edit-item-status'],$item_id,$_SESSION['brand_id'])){
  echo "update_success";
}

// Check if user wants to upload
if (file_exists($_FILES['edit-item-file']['tmp_name']) || is_uploaded_file($_FILES['edit-item-file']['tmp_name'])) 
{
  $name = $_FILES['edit-item-file']['name'];
  $target_dir = "../../img/upload/";
  $target_file = $target_dir . basename($_FILES["edit-item-file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $extensions_arr = array("jpg","jpeg","png","gif");
  
  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
   $item->change_img($name,$item_id);
   move_uploaded_file($_FILES['edit-item-file']['tmp_name'],$target_dir.$name);
  }
}