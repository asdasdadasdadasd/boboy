<div class="container">
  <h2>Shop</h2>
  <div class="">
    <div class="">
      <div class="row" style="margin-top: 8px; margin-bottom: 24px;">
        <div class="col-md-2">
            <div class="sidebar well">
              <h5>Filter By</h5>
              <?php
              $brands = $brand->get_brands();
              if($brands){
              ?>
              <ul class="nav nav-stacked">
              <li><a href='index.php?mod=shop'>All</a></li>
                <?php
                foreach($brands as $b){?>
                  <li><a href='index.php?mod=shop&brand=<?php echo $b['brand_id'];?>'><?php echo $b['brand_name'];?></a></li>
                <?php
                }
                ?>
              </ul>
              <?php
              }
              ?>
            </div>
        </div>
        <div class="container-fluid">
          <div class="col-md-10">
            <?php 
            if(isset($_GET['brand'])){
              $items = $item->get_shop_items_by_brand($_GET['brand']);
              if($items){
              ?>
              <div class="" style="">
                <div class="row panel">
                    <?php
                    foreach($items as $i) {
                    ?>
                    <div class="col-md-3 product-grid compress">
                        <a href="index.php?mod=shop&item=<?php echo $i['item_id'];?>" class="product-anchor">
                            <div class="card product-card-hover">
                                <img class="img-responsive" src="<?php echo $i['item_img'];?>" class="img-responsive" alt="Cinque Terre">
                                <div class="product-padding">
                                    <h5 class="uppercase" style="margin: 0px 0px 4px 0px; font-size: 11px; color: rgba(0,0,0,0.54);"><?php echo $item->get_item_brand($i['brand_id']);?></h5>
                                    <h4 class="uppercase" style="margin: 0px 0px 16px 0px; font-weight: 700;font-size: 20px;color: #ffae00;"><?php echo $i['item_name'];?></h4>
                                    <h5 style="color: rgba(0,0,0,0.7); margin-bottom: 24px; font-weight: 400; font-size: 13px; line-height: 1.5;"><?php echo $i['item_description'];?></h5>
                                    <h4 class="uppercase" style="color: #ffae00; font-weight: 400; font-size: 16px;">PHP <?php echo $i['item_price'];?></h4>
                                </div> 
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
              </div>
              <?php
              }else{
                echo "No item to show";
              }
            }else{
              $items = $item->get_shop_items();
              if($items){
              ?>
              <div class="" style="">
                
                <div class="row panel aligned-row">
                    <?php
                    foreach($items as $i) {
                    ?>
                    <div class="col-md-3 product-grid compress">
                      <a href="index.php?mod=shop&item=<?php echo $i['item_id'];?>" class="product-anchor">
                          <div class="card product-card-hover">
                              <img class="img-responsive" src="<?php echo $i['item_img'];?>" class="img-responsive" alt="Cinque Terre">
                              <div class="product-padding">
                                  <h5 class="uppercase" style="margin: 0px 0px 4px 0px; font-size: 11px; color: rgba(0,0,0,0.54);"><?php echo $item->get_item_brand($i['brand_id']);?></h5>
                                  <h4 class="uppercase" style="margin: 0px 0px 16px 0px; font-weight: 700;font-size: 20px;color: #ffae00;"><?php echo $i['item_name'];?></h4>
                                  <h5 style="color: rgba(0,0,0,0.7); margin-bottom: 24px; font-weight: 400; font-size: 13px; line-height: 1.5;"><?php echo $i['item_description'];?></h5>
                                  <h4 class="uppercase" style="color: #ffae00; font-weight: 400; font-size: 16px;">PHP <?php echo $i['item_price'];?></h4>
                              </div> 
                          </div>
                      </a>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
              </div>
              <?php
              }else{
                echo "No item to show";
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>