<?php
if(isset($_GET['brand'])&&isset($_GET['item'])){
  $item_data = $item->get_item_and_brand($_GET['item'],$_GET['brand']);
}else{
  $item_data = $item->get_item($_GET['item']);
}
?>
<div class="container">
<div class="content-wrapper">	
<div class="item-container">	
  <?php
  if($item_data){
    foreach($item_data as $data);
  ?>
  <div class="container-fluid">	
    <div class="" style="margin-top: 24px;">
      <div class="col-md-5">
            <img class="img-responsive b-radius" src="<?php echo $data['item_img'];?>" alt=""></img>
      </div>
        
      <div class="col-md-7">
        <form id="atc-form" method="POST">
          <div class="product-brand" style="margin-top: 16px;">
            <?php echo $item->get_item_brand($data['brand_id']);?>
          </div>
          <div class="product-title uppercase" style="font-size: 24px;"><?php echo $data['item_name'];?></div>
          <div class="product-desc"><?php echo $data['item_description'];?></div>
          <hr>
          
          <div class="product-price uppercase" style="color: #333;">PHP <?php echo $data['item_price'];?></div>
          <div class="product-stock">In Stock</div>
          <hr>
          <input type="hidden" name="item_id" value="<?php echo $data['item_id'];?>">
          <input type="hidden" name="item_price" value="<?php echo $data['item_price'];?>">
          <div class="btn-group">
          <select class="select" name="order_qty">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div class="btn-group cart">
            <button type="submit" name="submit" id="btn-atc" class="btn btn-primary uppercase">
              Add to cart 
            </button>            
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>
<div class="container-fluid">		
  <div class="col-md-12 product-info">
      <ul id="myTab" class="nav nav-tabs nav_tabs">
        
        <li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
        <li><a href="#service-two" data-toggle="tab">PRODUCT INFO</a></li>
        <li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>
        
      </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="service-one">
         
          <section class="container-fluid product-info">
            The Corsair Gaming Series GS600 power supply is the ideal price-performance solution for building or upgrading a Gaming PC. A single +12V rail provides up to 48A of reliable, continuous power for multi-core gaming PCs with multiple graphics cards. The ultra-quiet, dual ball-bearing fan automatically adjusts its speed according to temperature, so it will never intrude on your music and games. Blue LEDs bathe the transparent fan blades in a cool glow. Not feeling blue? You can turn off the lighting with the press of a button.

            <h3>Corsair Gaming Series GS600 Features:</h3>
            <li>It supports the latest ATX12V v2.3 standard and is backward compatible with ATX12V 2.2 and ATX12V 2.01 systems</li>
            <li>An ultra-quiet 140mm double ball-bearing fan delivers great airflow at an very low noise level by varying fan speed in response to temperature</li>
            <li>80Plus certified to deliver 80% efficiency or higher at normal load conditions (20% to 100% load)</li>
            <li>0.99 Active Power Factor Correction provides clean and reliable power</li>
            <li>Universal AC input from 90~264V — no more hassle of flipping that tiny red switch to select the voltage input!</li>
            <li>Extra long fully-sleeved cables support full tower chassis</li>
            <li>A three year warranty and lifetime access to Corsair’s legendary technical support and customer service</li>
            <li>Over Current/Voltage/Power Protection, Under Voltage Protection and Short Circuit Protection provide complete component safety</li>
            <li>Dimensions: 150mm(W) x 86mm(H) x 160mm(L)</li>
            <li>MTBF: 100,000 hours</li>
            <li>Safety Approvals: UL, CUL, CE, CB, FCC Class B, TÜV, CCC, C-tick</li>
          </section>
                  
        </div>
      <div class="tab-pane " id="service-two">
        
        <section class="container">
            asd
        </section>
        
      </div>
      <div class="tab-pane " id="service-three">
                    
      </div>
    </div>
    <hr>
  </div>
  <?php
}else{
  ?>
  <div class="page-unavailable">
      <h2>Oops, it seems that the page you are trying to reach does not exist.<h2>
  </div>
<?php
}
?>
</div>
</div>
</div>
