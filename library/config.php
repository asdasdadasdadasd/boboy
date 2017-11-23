<?php
session_start();

// config control 
$hosted = true;

if($hosted){
  define('DB_SERVER','52.77.240.48');
  define('DB_USERNAME','admin');
  define('DB_PASSWORD','howtoforge');
  define('DB_DATABASE','db_sleepnot');
}else{
  define('DB_SERVER','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_DATABASE','db_sleepnotgo');
}