<?php
include '../../library/config.php';
include '../../classes/class.items.php';

$item = new Items();

if(isset($_POST['display_cart'])){
?>

<table class="table table-borderless" style="margin-top: 24px;">
  <tr class="text-light">
    <th class="text-center">QTY</th>
    <th>ITEM</th>
    <th class="text-right">PRICE</th>
    <th></th>
  </tr>
  <?php 
  $cart = $item->get_cart($_SESSION['usr_id']);
  foreach($cart as $c){
  ?>
  <tr>
    <td class="text-center"><?php echo $c['item_qty'];?></td>
    <td><?php echo $item->get_item_name($c['item_id']);?></td>
    <td class="text-right cart-price">&#8369;<?php echo $c['subtotal'];?></td>
    <td class="text-right"><a class="glyphicon glyphicon-remove wtf"><input type="hidden" class="id_remove" value="<?php echo $c['cart_id'];?>"></a></td>
  </tr>
  <?php
  }
  ?>
</table>
<div class="row">
  <div class="col-md-8">
    <div class="container-fluid">
      <span class="cart-total-label">Total:</span><span class="cart-total">&#8369;1050.00</span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="container-fluid">
      <button class="btn btn-primary">ORDER</button>
    </div>
  </div>
</div>
<?php
}
?>
<script>
  
  $('body').click(".wtf",function(){
    var id_remove = $(this).val(); 
    alert(id_remove);
  });
</script>