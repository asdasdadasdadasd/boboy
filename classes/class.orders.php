<?php
class Orders{

  public function view_brand_orders($bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    //$query = $db->prepare("SELECT FROM (SELECT FROM items WHERE brand_id='?')items INNERJOIN oitem on items.item_id=oitem.item_id INNERJOIN orders ON orders.order_id=oitem.order_id");
    $query = $db->prepare("SELECT * FROM orders,oitem,items,users WHERE orders.order_id = oitem.order_id AND oitem.item_id = items.item_id AND items.brand_id = ? AND users.usr_id = orders.usr_id");
    $query->bindParam(1,$bid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function get_order_details($oid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT * FROM oitem,users,items WHERE order_id = ? AND oitem.usr_id = users.usr_id AND oitem.item_id = items.item_id");
    $query->bindParam(1,$oid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function get_order_customer_info($oid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT usr_name,usr_address,usr_contact FROM oitem,users,items WHERE order_id = ? AND oitem.usr_id = users.usr_id AND oitem.item_id = items.item_id");
    $query->bindParam(1,$oid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }
}