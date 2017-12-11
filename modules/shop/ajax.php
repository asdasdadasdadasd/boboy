<?php
include '../../library/config.php';
include '../../classes/class.items.php';

$item = new Items();

if(isset($_POST['display_shop'])){
?>
<div class="col-lg-12 col-xs-12">
  <div class="container-fluid">
    <?php 
    // CHECK DISPLAY CONDITION
    if(isset($_POST['search_val']) && $_POST['search_val'] != ""){
      if(isset($_POST['brand_id']) && $_POST['brand_id'] != ""){
        $items = $item->get_shop_items_search_and_brand($_POST['search_val'],$_POST['brand_id']);
      }else{
        $items = $item->get_shop_items_search($_POST['search_val']);
      }
      ?>
      <h4 class="heading">Showing results for '<?php echo $_POST['search_val']?>'</h4>
    <?php
    }else if(isset($_POST['brand_id']) && $_POST['brand_id'] != ""){
      $items = $item->get_shop_items_by_brand($_POST['brand_id']);
    }else{
      $items = $item->get_shop_items();
    }

      // CHECK RETRIEVE BEFORE DISPLAY
      if($items){
      ?>
      <div class="row panel aligned-row">
      <?php
      foreach($items as $i) {
        $img = $i['item_img'];
      ?>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 shop-margin">
        <div class="item-holder">
          <?php
          if(isset($_POST['brand_id']) && $_POST['brand_id'] != ""){?>
            <a href="index.php?mod=shop&brand=<?php echo $_POST['brand_id'];?>&item=<?php echo $i['item_id'];?>">
          <?php
          }else{?>
            <a href="index.php?mod=shop&item=<?php echo $i['item_id'];?>">
          <?php
          }
          ?>
          
            <div class="item-image img-responsive" style="background-image: url('<?php echo "img/upload/".$img;?>');">
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
      }else{?>
        <div class="row panel" style="padding-top: 200px; padding-bottom: 200px;">
            <h4 class="small text-center">No results found for '<?php echo $_POST['search_val'];?>'<h4>
        </div>
      <?php
      }
    }
    ?>
  </div>
</div>