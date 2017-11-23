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
}