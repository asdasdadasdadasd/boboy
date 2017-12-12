<div class="container-fluid">
	<div class="row">
		<div class="table-responsive">
    <h4 class="no-gap" style="position:absolute;">Orders</h4>
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
            <tr>
              <td><?php echo time_elapsed_string($o['created_at']);?></td>
              <td><?php echo $o['usr_name'];?></td>
              <td><?php echo $o['usr_contact']?></td>
              <td><?php echo $currency;?><?php echo $o['order_total'];?></td>
              <td><span class="label label-info"><?php echo $o['order_status'];?></span></td>
            </tr>
            <?php
            }
          }else{
            echo "No Orders";
          }
        ?>
        </tbody>
      </table>
    </div>
	</div>
</div>
<script>

</script>