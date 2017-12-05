<?php
if(!$user->get_session()){
  header('location: index.php');
  exit;
}
?>