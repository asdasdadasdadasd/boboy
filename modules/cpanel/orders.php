ORDERS

<div class="container-fluid">
	<div class="row">
		<div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>Full Name</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Date</th>
            <th>Price</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $orders = $order->view_brand_orders($_SESSION['brand_id']);
          if($orders){
            foreach($orders as $o){?>
            <tr>
              <td><?php echo $o['created_at'];?></td>
              <td><?php echo $o['usr_name'];?></td>
              <td></td>
              <td><?php echo $o['usr_address']?></td>
              <td><?php echo $o['created_at'];?></td>
              <td>$899.00</td>
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