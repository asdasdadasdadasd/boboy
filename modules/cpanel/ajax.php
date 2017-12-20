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

$currency = "₱";
if(isset($_POST['show_status'])){
  echo $brand->get_brand_status($_POST['brand_id']);
}

if(isset($_POST['change_status'])){
  $brand->change_brand_status($_POST['brand_id'],$_POST['checked'],1);
  if($_POST['checked']==0){
    $user->remove_cart_unavailable($_POST['brand_id']);
  }
}

if(isset($_POST['cpanel_status'])){
?>
<input type="checkbox" id="id-name--1" name="set-name" class="switch-input" checked>
            <label for="id-name--1" class="switch-label roboto"><span id="show-shop-status"></span>
            </label>
<?php
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
                <th style="text-align:left;">Customer Name</th>
                <th style="text-align:left;">Contact #</th>
                <th>Total Price</th>
                <th>Approval</th>
                <th>Delivery Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
          $orders = $order->pending_brand_orders($_SESSION['brand_id']);
          if($orders){
            foreach($orders as $o){?>
            <tr id="<?php echo $o['order_id'];?>" class="select-order row-hover">
              <td style="text-align:left;"><?php echo time_elapsed_string($o['date_ordered']);?></td>
              <td style="text-align:left;"><?php echo $o['usr_name'];?></td>
              <td style="text-align:left;"><?php echo $o['usr_contact']?></td>
              <td><?php echo $currency;?><?php echo $o['order_total'];?></td>
              <td><span class="label label-status-1"><?php if($o['order_status'] == 0){echo $order->order_status($o['order_id'],$_SESSION['brand_id']);}else{ echo "Complete";}?></span></td>
              <td>Pending</td>
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

if(isset($_POST['accept_order'])){
  $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
  if($list){
    foreach($list as $arr){
      $order->accept_cpanel_order($arr['oi_id']);   
    }
    if($order->check_order_votes($_POST['order_id'],$_SESSION['brand_id']) == 0){
      $order->approve_order_status($_POST['order_id']);
    }
  }
}

if(isset($_POST['decline_order'])){
  $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
  if($list){
    foreach($list as $arr){
      $order->decline_cpanel_order($arr['oi_id']);   
    }
  }
}

if(isset($_POST['order_info'])){
  if(isset($_POST['order_id'])){
    $order_info = $order->get_order_customer_info($_POST['order_id'],$_SESSION['brand_id']);
    if($order_info){
      foreach($order_info as $oci);
      //ACCEPTED ORDER VIEW
      if($oci['order_status'] == 2){
      ?>
        <div class="container-fluid">
        <div class="row">
          <section class="content roboto">
            <div class="container-fluid" style="padding: 0px 0px 8px 0px;">
              <div class="row">
                <div class="col-md-12 col-xs-12" style="  ">
                <a href="/sng/?mod=cpanel&t=orders" class="btn btn-action"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
                  <h4 class="no-gap">Order Details <?php echo $oci['created_at'];?></h4>
                  <label style="background-color: #eaeaea; width: 100%;display:inline-block;">Customer</label>
                  <h5 class="no-gap"><?php echo $oci['usr_name'];?></h5>
                  <label class="">Address</label>
                  <h5><?php echo $oci['usr_address'];?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-12 no-gap">
              <div class="">
                <div class="panel-body no-gap">
                  <div class="table-container" style="margin-top: 8px;">
                    <table class="table table-filter2">
                      <tbody>
                      <?php
                      $item_details = $order->get_order_details($_POST['order_id'],$_SESSION['brand_id']);
                      if($item_details){
                        foreach($item_details as $_i){?>
                          <tr>
                            <td>
                              <div class="media">
                                <div class="media-photo pull-left" style="background-image: url('<?php echo "img/upload/".$_i['item_img'];?>');">
                                </div>	
                                <div class="media-body">
                                  <span class="media-meta pull-right">Subtotal</span>
                                  <h4 class="title">
                                    <?php echo $_i['item_name'];
                                    ?>
                                    <span class="pull-right">asd</span>
                                  </h4>
                                  <p class="summary">Quantity: <?php echo $_i['oi_qty'];?></p>
                                </div>
                              </div>
                            </td>
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
            </div>
          </section>
        </div>
      </div>
      <?php 
      //PENDING ORDER VIEW
      }else if($oci['order_status'] == 0){?>
        <div class="container-fluid">
        <div class="row">
          <section class="content roboto">
            <div class="container-fluid" style="padding: 0px 0px 8px 0px;">
              <div class="row">
                <div class="col-md-12 col-xs-12" style="  ">
                <a href="/sng/?mod=cpanel&t=orders" class="btn btn-action"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
                  <h4 class="no-gap">Order Details <?php echo $oci['created_at'];?></h4>
                  <label style="background-color: #eaeaea; width: 100%;display:inline-block;">Customer</label>
                  <h5 class="no-gap"><?php echo $oci['usr_name'];?></h5>
                  <label class="">Address</label>
                  <h5><?php echo $oci['usr_address'];?></h5>
                </div>
              </div>
            </div>
            <div class="col-md-12 no-gap">
              <div class="">
                <div class="panel-body no-gap">
                  <div class="table-container" style="margin-top: 8px;">
                    <table class="table table-filter2">
                      <tbody>
                      <?php
                      $item_details = $order->get_order_details($_POST['order_id'],$_SESSION['brand_id']);
                      if($item_details){
                        foreach($item_details as $_i){?>
                          <tr>
                            <td>
                              <div class="media">
                                <div class="media-photo pull-left" style="background-image: url('<?php echo "img/upload/".$_i['item_img'];?>');">
                                </div>	
                                <div class="media-body">
                                  <span class="media-meta pull-right">Subtotal</span>
                                  <h4 class="title">
                                    <?php echo $_i['item_name'];
                                    ?>
                                    <span class="pull-right">asd</span>
                                  </h4>
                                  <p class="summary">Quantity: <?php echo $_i['oi_qty'];?></p>
                                </div>
                              </div>
                            </td>
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
              <div class="content-footer">
                <div class="pull-right">
                  <button type="button" id="accept-order" class="btn btn-action"><span class="glyphicon glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approve</button>
                  <button type="button" id="decline-order" class="btn btn-action"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Decline</button>
                </div>
              </div>
            </div>
          </section>
          
        </div>
      </div>
      <?php
      }
    }else{
      echo "order_unavailable";
    }
  }
}
?>
