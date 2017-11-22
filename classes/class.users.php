<?php
class Users{
  public $db;
  
    public function __construct(){
      $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
      if(mysqli_connect_errno()){
        echo "Database connection error.";
        exit;
      }
    }

    public function get_session(){
      if(isset($_SESSION['usr_login']) && $_SESSION['usr_login'] == true){
        return true;
      }
      else{
        return false;
      }
    }

    public function chk_email_exists($str){
      $sql = "SELECT * FROM users WHERE usr_email = '$str'";
      $result = mysqli_query($this->db,$sql);
      $count = $result->num_rows;
      return $count;
    }

    public function register_credentials($name,$email,$pwd,$auth,$status){
      $sql = "INSERT INTO users(usr_name,usr_email,usr_password,usr_auth,usr_status) VALUES('$name','$email','$pwd','$auth','$status')";
      $result = mysqli_query($this->db,$sql) or die(error() . "Cannot Insert Data");
      return $result;
    }
    public function check_login($email,$password){
      $sql = "SELECT * FROM users WHERE
      usr_email='$email' AND usr_password='$password'";
      $result=mysqli_query($this->db,$sql);
      $userdata=mysqli_fetch_array($result);
      $count = $result->num_rows;
      if($count == 1){
              $_SESSION['usr_login']=true;
              $_SESSION['usr_id']=$userdata['usr_id'];
              $_SESSION['usr_name']=$userdata['usr_name'];
              $_SESSION['usr_auth']=$userdata['usr_auth'];
        return true;
      }
      else{
        return false;
      }
    }
}