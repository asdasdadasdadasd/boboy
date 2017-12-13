<div class="container-fluid">
	<div class="row">
    <?php
    if(isset($_GET['o_id'])){
      require_once 'modules/cpanel/order_details.php';
    }else{
    ?>
		<div class="table-responsive roboto">
    <h4 class="no-gap" style="">Orders <?php echo "2017-12-13 11:29:38";?></h4>
      <table id="orders-table" style="margin-left:0;padding-left:0;" class="table mdl-data-table roboto table-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align:center;">Date Ordered</th>
                <th style="text-align:center;">Customer Name</th>
                <th style="text-align:center;">Contact #</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
          $orders = $order->view_brand_orders($_SESSION['brand_id']);
          if($orders){
            foreach($orders as $o){?>
            <tr id="<?php echo $o['order_id'];?>" class="select-order">
              <td><?php echo time_elapsed_string($o['date_ordered']);?></td>
              <td><?php echo $o['usr_name'];?></td>
              <td><?php echo $o['usr_contact']?></td>
              <td><?php echo $currency;?><?php echo $o['order_total'];?></td>
              <td><span class="label label-info"><?php echo $o['order_status'];?></span></td>
            </tr>
            <?php
            }
          }
        ?>
        </tbody>
      </table>
    </div>
    <?php
    }
    ?>
	</div>
</div>