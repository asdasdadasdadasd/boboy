<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();

if($_POST['password_confirm']!=$_POST['password']){
  echo "non_match_password";
}else{
  $chk_email = $user->chk_email_exists($_POST['email']);
  if($chk_email == 1){
    echo "email_exists";
  }else{
    if($user->register_credentials($_POST['name'],$_POST['email'],md5($_POST['password']),$_POST['auth-type'],0)){
      echo "register_success";
    }else{
      echo "register_failed";
    }
  }
}

?>