
<div class="container" style="margin-top: 94px;">
<div class="">
  <div class="">
    <div class="row" style="margin-top: 24px; margin-bottom: 24px;">
      <div class="col-lg-3 col-md-3">
        <div class="" style="display:inline-block;width:100%;">
          <div class="" style="display:inline-block;">
            <label id="shop-cpanel-id" class="roboto" style="padding: 16px 16px 16px 16px;margin:0;" value="<?php echo $_SESSION['brand_id'];?>"><?php echo $_SESSION['usr_name'];?><label>
          </div>
          <div class="" style="display:inline-block;float:right;">
            <input type="checkbox" id="id-name--1" name="set-name" class="switch-input">
            <label for="id-name--1" class="switch-label roboto"><span id="show-shop-status"></span>
            </label>
          </div>
        </div>
        <!-- Sidenav Filter Left -->
          <div class="sidebar hidden-xs" style="margin-bottom: 16px;">
            
            <ul class="nav nav-stacked" style="background-color:#f9f9f9; ">
              <li class="bordered-s no-gap"><a class="thick washed roboto" href='index.php?mod=cpanel&t=items'>My Items<?php if($t == "items"){?><span class="pull-right glyphicon glyphicon-menu-right"></span><?php }?></a></li>
              <li class="bordered-s no-gap"><a class="thick washed roboto" href='index.php?mod=cpanel&t=orders'>Orders<?php if($t == "orders"){?><span class="pull-right glyphicon glyphicon-menu-right"></span><?php }?></a></li>
              <li class="bordered-s no-gap"><a class="thick washed roboto" href='index.php?mod=cpanel&t=account'>Account<?php if($t == "account"){?><span class="pull-right glyphicon glyphicon-menu-right"></span><?php }?></a></li>
              <li class="bordered-s no-gap"><a class="thick washed roboto" href='index.php?mod=cpanel'>Unknown</a></li>
            </ul>
          </div>
          <!-- End of Sidenav -->
      </div>
      <!-- Shop Content/Item list -->
      <div class="container-fluid">
        <div class="col-lg-9 col-md-9" style="margin:0;padding:0;">
          <div class="main-wrapper bordered">
          <?php
            switch($t){
              case 'items':
                if(isset($_GET['q'])){
                  require_once 'modules/cpanel/itemview.php';
                }else{
                  require_once 'modules/cpanel/items.php';
                }
                break;
              case 'account':
                require_once 'modules/cpanel/account.php';
                break;
              case 'orders':
                require_once 'modules/cpanel/orders.php';
                break;
              default:
                require_once 'modules/cpanel/dashboard.php';
                break;
            }
          ?>
          </div>
        </div>
      </div>
      <!-- End of Shop/Item list -->
    </div>
  </div>
</div>
</div>