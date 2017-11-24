<div class="container">
  <a href="index.php?mod=shop">Shop</a>
</div>
<div style="margin-top: 24px;">
<?php
if(isset($_GET['item'])){?>
  <div class="">
    <?php
    require_once 'modules/item/index.php';
    ?>
  </div>
<?php
}else{
?>
<div class="container">
  <div class="">
    <div class="">
      <div class="row" style="margin-top: 8px; margin-bottom: 24px;">
        <div class="col-md-2">
          <!-- Sidenav Filter Left -->
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
            <!-- End of Sidenav -->
        </div>
        <!-- Shop Content/Item list -->
        <div class="container-fluid">
          <div class="col-md-10">
            <?php 
            if(isset($_GET['brand'])){
              $items = $item->get_shop_items_by_brand($_GET['brand']);
              if($items){
              ?>
              <div class="" style="">
              
              <div class="row panel aligned-row">
                  <?php
                  foreach($items as $i) {
                  ?>
                  <div class="col-md-3 shop-margin">
                    <div class="item-holder">
                      <a href="<?php echo $url_str;?>&item=<?php echo $i['item_id'];?>">
                        <img class="img-responsive" src="<?php echo $i['item_img'];?>" class="img-responsive" alt="Cinque Terre">
                        <div class="item-brand">
                          <?php echo $item->get_item_brand($i['brand_id']);?>
                        </div>
                        <div class="item-name">
                          <?php echo $i['item_name'];?>
                        </div>
                        <div class="item-description">
                          <?php echo $i['item_description'];?>
                        </div>
                        <div class="item-price">
                          PHP <?php echo $i['item_price'];?>
                        </div>
                      </a>
                    </div>
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
                    <div class="col-md-3 shop-margin">
                      <div class="item-holder">
                        <a href="<?php echo $url_str;?>&item=<?php echo $i['item_id'];?>">
                          <img class="img-responsive" src="<?php echo $i['item_img'];?>" class="img-responsive" alt="Cinque Terre">
                          <div class="item-brand">
                            <?php echo $item->get_item_brand($i['brand_id']);?>
                          </div>
                          <div class="item-name">
                            <?php echo $i['item_name'];?>
                          </div>
                          <div class="item-description">
                            <?php echo $i['item_description'];?>
                          </div>
                          <div class="item-price">
                            PHP <?php echo $i['item_price'];?>
                          </div>
                        </a>
                      </div>
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
        <!-- End of Shop/Item list -->
      </div>
    </div>
  </div>
</div>
<?php
}
?>
</div>