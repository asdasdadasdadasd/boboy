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
            foreach($orders as $o){
              if($order->approval_status($o['order_id'],$_SESSION['brand_id']) != "Declined"){?>
              <tr id="<?php echo $o['order_id'];?>" class="select-order row-hover">
                <td style="text-align:left;"><?php echo time_elapsed_string($o['date_ordered']);?></td>
                <td style="text-align:left;"><?php echo $o['usr_name'];?></td>
                <td style="text-align:left;"><?php echo $o['usr_contact']?></td>
                <td><?php echo $currency;?><?php echo $o['order_total'];?></td>
                <td><span class="label label-status-2"><?php echo $order->approval_status($o['order_id'],$_SESSION['brand_id']);?></span></td>
                <td><span class="glyphicon"></span><?php echo $order->get_delivery_status($o['order_id'],$_SESSION['brand_id']);?></td>
              </tr>
              <?php
              }
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

if(isset($_POST['order_claimed'])){
  $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
  if($list){
    foreach($list as $arr){
      $order->claim_cpanel_order($arr['oi_id']);   
    }
  }
}

if(isset($_POST['order_ready'])){
  $list = $order->shop_oitems_id($_POST['order_id'],$_SESSION['brand_id']);
  if($list){
    foreach($list as $arr){
      $order->ready_cpanel_order($arr['oi_id']);   
    }
  }
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
      $check_status = $order->approval_status($_POST['order_id'],$_SESSION['brand_id']);
      $delivery_status = $order->get_delivery_status($_POST['order_id'],$_SESSION['brand_id']);
      foreach($order_info as $oci);
      
      // DON'T SHOW COMPLETED ORDERS HERE
      if($oci['order_status'] == 2){
        echo "order_unavailable";
      }else{?>
        <div class="container-fluid">
        <div class="row">
          <section class="content roboto">
            <div class="container-fluid" style="padding: 0px 0px 8px 0px;">
              <div class="row">
                <div class="col-md-12 col-xs-12" style=" ">
                <a href="/sng/?mod=cpanel&t=orders" class="btn btn-action"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Back</a>
                <span class="pull-right">
                <?php
                if($check_status == "Approved" && $delivery_status == "Complete"){?>
                  <span class="label label-status-2"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Order Approved</span>
                  <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                  <span class='label label-status-2'><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Preparation</span>
                  <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                  <span class="label label-status-2"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Complete</span>
                <?php
                }else if($check_status == "Pending"){?>
                  <span class="label label-muted">Order Approved</span>
                  <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                  <span class='label <?php echo $delivery_status == "Ready" ? 'label-status-2' : 'label-muted'?>'><?php if($delivery_status == "Ready"){?><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php }?>Preparation</span>
                  <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                  <span class="label label-muted">Complete</span>
                <?php
                }else{?>
                  <span class="label label-status-2"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Order Approved</span>
                  <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                  <span class='label <?php echo $delivery_status == "Ready" ? 'label-status-2' : 'label-muted'?>'><?php if($delivery_status == "Ready"){?><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;<?php }?>Preparation</span>
                  <span style="font-size:10px;color:rgba(0,0,0,0.4);" class="glyphicon glyphicon-arrow-right"></span>
                  <span class="label label-muted">Complete</span>
                <?php
                }
                ?>
                </span>
                  
                </div>
              </div>
            </div>
            <div class="col-md-12 no-gap">
              <div class="">
                
                <div class="panel-body no-gap">
                  <div class="" >
                    <div class="pull-left" style="padding:16px 16px;">
                     <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Order #</label>
                      <p class="no-gap" style="font-size: 14px;"><?php echo $oci['order_id'];?></p>
                    </div>
                    <div class="pull-left" style="padding:16px 16px;">
                      <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Customer</label>
                      <p class="no-gap" style="font-size:13px;font-weight:400;"><?php echo $oci['usr_name'];?></p>
                    </div>
                    <div class="pull-left" style="padding:16px 16px;">
                      <label class="no-gap" style="color:rgba(0,0,0,0.8);font-size:13px;font-weight:500;">Address</label>
                      <p><?php echo $oci['usr_address'];?></p>
                    </div>
                  </div>
                  
                  
                  
                  <div class="table-container" style="margin-top: 16px;">
                    <table class="table table-filter">
                      <tbody>
                      <?php
                      $item_details = $order->get_order_details($_POST['order_id'],$_SESSION['brand_id']);
                      if($item_details){
                        foreach($item_details as $_i){?>
                          <tr class="order-details">
                          <td>
                            <div class="media">
                              <?php
                              if($_i['item_img'] != null){
                              ?>
                              <div class="media-photo pull-left" style="background-image: url('<?php echo "img/upload/".$_i['item_img'];?>');">
                              </div>	
                              <?php 
                              }else{?>
                              <div class="media-photo pull-left" style="background-image: url('img/no-image.png');">
                              </div>
                              <?php
                              }
                              ?>
                              <div class="media-body">
                                <span class="media-meta pull-right" style="font-size:14px;"><?php echo $_i['oi_subtotal'];?></span>
                                <h4 class="title">
                                  <?php echo $_i['item_name'];?>
                                </h4>
                                <p class="summary"><?php echo $_i['item_description'];?></p>
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
                <div class="pull-left">
                  <button type="button" id="open-chat" class="btn btn-action" value="<?php echo $oci['usr_id']?>"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Message</button>
                </div>
                <div class="pull-right">
                  <?php
                  if($check_status == "Approved" && $delivery_status == "Complete"){?>
                    <span class="label label-clean"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Order Completed</span>
                  <?php
                  }else if($check_status == "Approved" && $delivery_status == "Ready"){?>
                    <small style="margin-right:5px;">Waiting to be claimed..</small>
                    <button type="button" id="order-claimed" class="btn btn-action" value="<?php echo $oci['usr_id']?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;Claimed</button>
                  <?php
                  }else if($check_status == "Approved"){?>
                    <small class="text-muted" style="margin-right:8px;">Click the button if the order is now ready</small>
                    <button type="button" id="order-ready" class="btn btn-action" value="<?php echo $oci['usr_id']?>"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Ready For Pick Up</button>
                  <?php
                  }else if($check_status == "Pending"){
                  ?>
                  <button type="button" id="accept-order" class="btn btn-action"><span class="glyphicon glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Approve</button>
                  <button type="button" id="decline-order" class="btn btn-action"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Decline</button>
                  <?php
                  }else{
                    echo "declined order";
                  }
                  ?>
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
