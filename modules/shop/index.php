<div class="container-fluid" style="margin-top: 70px;">
</div>
<div style="margin-top: 50px;">
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
      <div class="row">
        <div class="col-lg-2 no-gap">
          <div class="container-fluid" style="background-color: blue;">
            asd
          </div>
        </div>
        <div class="col-lg-10 no-gap">
          <div class="col-xs-12 col-lg-12 no-gap">
            <div class="col-xs-3" style="margin-right:0;padding-right:0;">
              Filter By
              <?php
                $brands = $brand->get_brands();
                if($brands){
                ?>
                <select id="shop-filter-by" class="form-control">
                  <option value="0" <?php echo isset($_GET['brand']) && $_GET['brand'] == null ? 'selected' : ''?>>All</option>
                  <?php
                  foreach($brands as $b){?>
                    <option value="<?php echo $b['brand_id'];?>" <?php echo isset($_GET['brand']) && $_GET['brand'] == $b['brand_id'] ? 'selected' : ''?>><?php echo $b['brand_name'];?></option>
                  <?php
                  }
                  ?>
                </select>
              <?php
              }
              ?>
            </div>
            <div class="col-xs-9">
              Search
              <div class="">
                <form id="shop-search-item" class="form-horizontal">
                  <div id="email-log" class="form-group">
                    <div class="col-md-12">
                      <input id="shop-search-value" name="shop-search-value" type="text" class="form-control" autocomplete="off" placeholder="Search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- START ajax call -->
          <div id="shop-ajax-content">
          </div>
          <!-- END ajax call-->
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
</div>