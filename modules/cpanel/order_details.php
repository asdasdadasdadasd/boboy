<?php
if(isset($_GET['o_id'])){
  
  foreach($order->get_order_customer_info($_GET['o_id']) as $oci);
  ?>
    <div class="container-fluid">
    <div class="row">
      <section class="content roboto">
        <div class="container-fluid" style="padding: 0px 0px 8px 0px;">
          <div class="row">
            <div class="col-md-12 col-xs-12" style="padding-top: 8px;">
              <h4 class="no-gap">Order Details</h4>
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
                  $item_details = $order->get_order_details($_GET['o_id']);
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
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="content-footer">
            <p>
              Page © - 2016 <br>
              Powered By <a href="https://www.facebook.com/tavo.qiqe.lucero" target="_blank">TavoQiqe</a>
            </p>
          </div>
        </div>
      </section>
      
    </div>
  </div>
  <?php 
}
?>