<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';
include '../../classes/class.auth.php';
include '../../classes/class.brands.php';
include '../../classes/class.orders.php';

$item = new Items();
$brand = new Brands();
$user = new Users();
$order = new Orders();

$currency = "P";

function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'Just now';
}


if(isset($_POST['display_orders'])){?>
  <div class="container-fluid">
	<div class="row">
		<div class="table-responsive roboto">
    <h4 class="" style="margin:0;padding-left:12px;padding-top:16px;">Orders</h4>
      <table id="orders-table" style="margin-left:0;padding-left:0;" class="table mdl-data-table roboto table-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align:left;">Date Ordered</th>
                <th style="text-align:left;">Order #</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
          $orders = $order->pending_user_orders($_SESSION['usr_id']);
          if($orders){
            foreach($orders as $o){?>
            <tr id="<?php echo $o['order_id'];?>" class="select-order row-hover">
              <td style="text-align:left;"><?php echo time_elapsed_string($o['created_at']);?></td>
              <td style="text-align:left;"><?php echo $o['order_id'];?></td>
              <td><?php echo $currency;?><?php echo $o['order_total'];?></td>
              <td><span class="label label-status-<?php echo $o['order_status'];?>">
                <?php
                switch($o['order_status']){
                  case 0:
                    echo "Pending";
                    break;
                  case 1:
                    echo "Approved";
                    break;
                  case 2:
                    echo "On Delivery";
                    break;
                };
                ?></span></td>
            </tr>
            <?php
            }
          }
        ?>
        </tbody>
      </table>
    </div>
	</div>
</div>
<script>
  $("#orders-table").dataTable({
    "bSort": false
  });
</script>
<?php
}