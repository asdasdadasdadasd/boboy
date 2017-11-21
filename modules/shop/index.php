<div class="container">
  <h2>Shop</h2>
  <div class="panel">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <div class="sidebar">
            <h5>Filter By</h5>
            <ul class="nav nav-stacked">
              <li><a href='#'>Starbucks</a></li>
              <li><a href='#'>Tomntoms</a></li>
              <li><a href='#'>Public/Sleepnot</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-10" style="background: ;">
          <?php 
          $x = 1; 
          ?>
          <div class="container-fluid" style="margin-top: 24px;">
            <div class="row">
                <?php
                while($x <= 11) {
                ?>
                <div class="col-md-3 product-grid compress">
                    <a href="#" class="product-anchor">
                        <div class="card product-card-hover">
                            <img class="img-responsive" src="http://static4.businessinsider.com/image/5509a9685afbd3705e8b4568-1190-625/starbucks-says-tingyi-to-make-starbucks-drink-products-in-china.jpg" class="img-responsive" alt="Cinque Terre">
                            <div class="product-padding">
                                <h5 style="margin: 0px 0px 4px 0px; font-size: 13px; color: rgba(0,0,0,0.54);">Starbucks</h5>
                                <h4 style="margin: 0px 0px 16px 0px; padding: 0; font-weight: 400; color: #ffae00;">Iced Coffee</h4>
                                <h5 style="color: rgba(0,0,0,0.7); margin-bottom: 24px; font-weight: 400; font-size: 13px; line-height: 1.5;">A delicate float of house-made vanilla sweet cream that cascades throughout the cup.</h5>
                                <h4 style="color: #ffae00; font-weight: 400; font-size: 16px;">PHP 155.00</h4>
                            </div> 
                        </div>
                    </a>
                </div>
                <?php
                    $x++;
                }
                ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>