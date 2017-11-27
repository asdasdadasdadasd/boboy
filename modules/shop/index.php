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
            <div class="sidebar sidebar-shop">
              <h5 class="sidebar-link">Filter By</h5>
              <?php
              $brands = $brand->get_brands();
              if($brands){
              ?>
              <ul class="nav nav-stacked">
              <li><a class="sidebar-link" href='index.php?mod=shop'>All</a></li>
                <?php
                foreach($brands as $b){?>
                  <li><a class="sidebar-link" href='index.php?mod=shop&brand=<?php echo $b['brand_id'];?>'><?php echo $b['brand_name'];?></a></li>
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
              <div class="row panel aligned-row">
              <?php
              foreach($items as $i) {
                $img = $i['item_img'];
              ?>
              <div class="col-md-3 col-xs-12 shop-margin">
                <div class="item-holder">
                  <a href="<?php echo $url_str;?>&item=<?php echo $i['item_id'];?>">
                    <div class="item-image img-responsive" style="background-image: url('<?php echo $img;?>');">
                    </div>
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
              <?php
              }else{
                echo "No item to show";
              }
            }else{
              $items = $item->get_shop_items();
              if($items){
              ?>
                
                <div class="row panel aligned-row">
                    <?php
                    foreach($items as $i) {
                      $img = $i['item_img'];
                    ?>
                    <div class="col-md-3 col-xs-12 shop-margin">
                      <div class="item-holder">
                        <a href="<?php echo $url_str;?>&item=<?php echo $i['item_id'];?>">
                          <div class="item-image img-responsive" style="background-image: url('<?php echo $img;?>');">
                          </div>
                          <div class="item-brand">
                            <?php echo $item->get_item_brand($i['brand_id']);?>
                          </div>
                          <div class="item-name" title="<?php echo $i['item_name'];?>">
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