<?php
class Orders{

  public function view_brand_orders($bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    //$query = $db->prepare("SELECT FROM (SELECT FROM items WHERE brand_id='?')items INNERJOIN oitem on items.item_id=oitem.item_id INNERJOIN orders ON orders.order_id=oitem.order_id");
    $query = $db->prepare("SELECT *,orders.created_at AS date_ordered FROM orders,oitem,items,users WHERE orders.order_id = oitem.order_id AND oitem.item_id = items.item_id AND items.brand_id = ? AND users.usr_id = orders.usr_id GROUP BY orders.order_id ORDER BY orders.created_at DESC");
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
  public function accept_cpanel_order($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE oitem SET oi_status = 1 WHERE oi_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function decline_order($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE orders SET order_status = 1 WHERE order_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function get_order_details($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT * FROM oitem,users,items WHERE order_id = ? AND oitem.usr_id = users.usr_id AND oitem.item_id = items.item_id AND items.brand_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$bid);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  public function get_order_datetime($oid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT created_at FROM orders WHERE order_id = ?");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $value = $row['created_at'];
    return $value;
  }

  public function get_order_customer_info($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT * FROM orders,users WHERE order_id = ? AND order_status != 1 AND orders.usr_id = users.usr_id");
    $query = $db->prepare("SELECT * FROM items,oitem,orders,users WHERE items.item_id = oitem.item_id AND orders.order_id = oitem.order_id AND orders.order_id = ? AND order_status != 1 AND orders.usr_id = users.usr_id AND items.brand_id = ?");
    $query->bindParam(1,$oid);
    $query->bindParam(2,$bid);
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