<?php
class Orders{

  public function pending_brand_orders($bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    //$query = $db->prepare("SELECT FROM (SELECT FROM items WHERE brand_id='?')items INNERJOIN oitem on items.item_id=oitem.item_id INNERJOIN orders ON orders.order_id=oitem.order_id");
    $query = $db->prepare("SELECT *,orders.created_at AS date_ordered FROM orders,oitem,items,users WHERE orders.order_id = oitem.order_id AND oitem.item_id = items.item_id AND items.brand_id = ? AND users.usr_id = orders.usr_id AND order_status != 2 GROUP BY orders.order_id ORDER BY orders.created_at DESC");
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

  public function pending_user_orders($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    //$query = $db->prepare("SELECT FROM (SELECT FROM items WHERE brand_id='?')items INNERJOIN oitem on items.item_id=oitem.item_id INNERJOIN orders ON orders.order_id=oitem.order_id");
    $query = $db->prepare("SELECT * FROM orders WHERE usr_id = ? GROUP BY order_id ORDER BY created_at DESC");
    $query->bindParam(1,$id);
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

  public function ready_cpanel_order($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE oitem SET oi_delivery = 1 WHERE oi_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function claim_cpanel_order($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE oitem SET oi_delivery = 2 WHERE oi_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function decline_cpanel_order($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE oitem SET oi_status = 2 WHERE oi_id = ?");
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

  public function shop_oitems_id($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    
    // Count total order item of order ID
    $query = $db->prepare("SELECT oi_id FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id AND brand_id = ?");
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

  public function approve_order_status($oid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE orders SET order_status = 1 WHERE order_id = ?");
    $query->bindParam(1,$oid);
    return $query->execute();
  }

  public function approval_status($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");

    // CHECK TOTAL NEED TO PROVIDE
    $query = $db->prepare("SELECT COUNT(oi_id) AS total_need FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ?");
    $query->bindParam(1,$bid);
    $query->bindParam(2,$oid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $total_need = $row['total_need'];

    // CHECK IF ALL PROVIDE IS APPROVED
    $query2 = $db->prepare("SELECT COUNT(oi_id) AS total_need FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_status = 1");
    $query2->bindParam(1,$bid);
    $query2->bindParam(2,$oid);
    $query2->execute();
    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    $total_approved = $row2['total_need'];

    // CHECK IF ALL PROVIDE IS DECLINED
    $query3 = $db->prepare("SELECT COUNT(oi_id) AS total_declined FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_status = 2");
    $query3->bindParam(1,$bid);
    $query3->bindParam(2,$oid);
    $query3->execute();
    $row3 = $query3->fetch(PDO::FETCH_ASSOC);
    $total_declined = $row3['total_declined'];

    if($total_need == $total_approved){
      return "Approved";
    }else if($total_need == $total_declined){
      return "Declined";
    }else{
      return "Pending";
    }
  }

  public function order_status($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");

    // Count total order item of order ID
    $query1 = $db->prepare("SELECT COUNT(oi_status) AS total_orders FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id AND brand_id = ?");
    $query1->bindParam(1,$oid);
    $query1->bindParam(2,$bid);
    $query1->execute();

    $row1 = $query1->fetch(PDO::FETCH_ASSOC);
    $value1 = $row1['total_orders'];  
    
    
    // Count items that have been approved of order ID
    $query2 = $db->prepare("SELECT COUNT(oi_status) AS total_approved FROM oitem,items WHERE order_id = ? AND items.item_id = oitem.item_id AND brand_id = ? AND oi_status = 1");
    $query2->bindParam(1,$oid);
    $query2->bindParam(2,$bid);
    $query2->execute();

    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    $value2 = $row2['total_approved'];
    if($value1 == $value2){
      return "Complete";
    }else{
      return "Pending";
    } 
  }

  public function check_order_votes($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT COUNT(oi_status) AS votes FROM oitem,items WHERE oitem.item_id = items.item_id AND order_id = ? AND oi_status = 0");
    $query->bindParam(1,$oid);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['votes'];
  }
  public function get_order_customer_info($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT * FROM items,oitem,orders,users WHERE items.item_id = oitem.item_id AND orders.order_id = oitem.order_id AND orders.order_id = ? AND orders.usr_id = users.usr_id AND items.brand_id = ?");
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
  public function get_delivery_status($oid,$bid){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    // CHECK ALL ITEMS BRAND NEEDS TO PROVIDE
    $query = $db->prepare("SELECT COUNT(oi_id) AS total_items FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ?");
    $query->bindParam(1,$bid);
    $query->bindParam(2,$oid);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $total_items = $row['total_items'];

    // CHECK IF ITEMS ARE READY TO BE CLAIMED
    $query2 = $db->prepare("SELECT COUNT(oi_id) AS total_for_claim FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_delivery = 1");
    $query2->bindParam(1,$bid);
    $query2->bindParam(2,$oid);
    $query2->execute();
    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
    $total_ready = $row2['total_for_claim'];

    

    // CHECK ITEMS IF CLAIMED
    $query3 = $db->prepare("SELECT COUNT(oi_id) AS total_claimed FROM oitem,items WHERE items.item_id = oitem.item_id AND items.brand_id = ? AND order_id = ? AND oi_delivery = 2");
    $query3->bindParam(1,$bid);
    $query3->bindParam(2,$oid);
    $query3->execute();
    $row3 = $query3->fetch(PDO::FETCH_ASSOC);
    $total_claimed = $row3['total_claimed'];

    if($total_items == $total_ready){
      return "Ready";
    }else if($total_items == $total_claimed){
      return "Complete";
    }else{
      return "Pending";
    }
    

    
  }
}