<?php
class Chats{
  public $db;
  
  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function get_convo($uid,$bid){
    //
    $query = $this->db->prepare("SELECT convo_id AS cid,COUNT(convo_id) AS result FROM conversations WHERE usr_id = ? AND brand_id = ?");
    $query->bindParam(1,$uid);
    $query->bindParam(2,$bid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    if(!empty($row['cid'])){
      return $row['cid'];
    }
  }

  public function retrieve_messages($cid){
    $query = $this->db->prepare("SELECT * FROM messages WHERE convo_id = ? ORDER BY created_at ASC");
    $query->bindParam(1,$cid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
  }

  public function send_message($uid,$bid,$msg){
    // Get usr_id of the order
    $query = $this->db->prepare("SELECT convo_id AS cid FROM conversations WHERE usr_id = ? AND brand_id = ?");
    $query->bindParam(1,$uid);
    $query->bindParam(2,$bid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $convo = $row['cid'];

    if($convo == null || $convo == ""){
      $create = $this->db->prepare("INSERT INTO conversations(usr_id,brand_id,created_at) VALUES(?,?,NOW())");
      $create->bindParam(1,$uid);
      $create->bindParam(2,$bid);
      $create->execute();
      $convo = $this->db->lastInsertId();
      
      $send = $this->db->prepare("INSERT INTO messages(convo_id,msg,sender_id,created_at) VALUES(?,?,?,NOW())");
      $send->bindParam(1,$convo);
      $send->bindParam(2,$msg);
      $send->bindParam(3,$bid);
      $send->execute();
      return true;
    }else{
      $send = $this->db->prepare("INSERT INTO messages(convo_id,msg,sender_id,created_at) VALUES(?,?,?,NOW())");
      $send->bindParam(1,$convo);
      $send->bindParam(2,$msg);
      $send->bindParam(3,$bid);
      $send->execute();
      return true;
    }
  }
  
}