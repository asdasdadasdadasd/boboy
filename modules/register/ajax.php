<?php
  if($_POST['password_confirm']!=$_POST['password']){
    echo "non_match_password";
  }else{
    echo "correct";
  }
  //print_r($_POST);
?>