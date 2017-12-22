<?php
include '../../library/config.php';
include '../../classes/class.chats.php';

$chat = new Chats();

if($chat->send_message($_POST['user_id'],$_SESSION['brand_id'],$_POST['chat-input-message'])){
  echo "message_sent";
}else{
  echo "message_failed";
}
?>