ORDERS
<?php
$value = 16;
$foo = $item->pdo_select($value);
foreach($foo as $i){
  echo $i['item_name'];
  echo $i['item_description'];
}

?>