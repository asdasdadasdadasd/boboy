<?php
class Items{
  public $db;
  
    public function __construct(){
      $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
      if(mysqli_connect_errno()){
        echo "Database connection error.";
        exit;
      }
    }

    public function count_items(){
      $sql = "SELECT * FROM ";
    }

    public function get_item_brand($id){
      $sql = "SELECT brand_name FROM brands WHERE brand_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['brand_name'];
      return $value;
    }

    public function get_item_name($id){
      $sql = "SELECT item_name FROM items WHERE item_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['item_name'];
      return $value;
    }

    public function get_shop_items(){
      $sql = "SELECT * FROM items";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_shop_items_by_brand($id){
      $sql = "SELECT * FROM items WHERE brand_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_item($id){
      $sql = "SELECT * FROM items WHERE item_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }
}