<div class="container-fluid">
	<div class="row">

		<section class="content roboto">
      <div class="pull-right">
				<div class="btn-group">
					<button type="button" class="btn"><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span>New</button>
			  </div>
			</div>
			<h4>My Items</h4>
			<div class="col-md-12 no-gap">
				<div class="">
					<div class="panel-body no-gap">
						<div class="table-container" style="margin-top: 8px;">
							<table class="table table-filter">
								<tbody>
                <?php
                $mi = $item->my_items($_SESSION['brand_id']);
                foreach($mi as $mia){?>
									<tr id="<?php echo $mia['item_id'];?>" class="item-select">
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img src="<?php echo "img/upload/".$mia['item_img'];?>" class="media-photo">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">Febrero 13, 2016</span>
													<h4 class="title">
														<?php echo $mia['item_name'];
														if($mia['item_status']==0){
															$stat = "negative";
														}else{
															$stat = "positive";
														}
														?>
														<span class="pull-right <?php echo $stat;?>">(<?php if($mia['item_status']==0){ echo "Unavailable";}else{ echo "Available";}?>)</span>
													</h4>
													<p class="summary"><?php echo $mia['item_description'];?></p>
												</div>
											</div>
										</td>
									</tr>
                  <?php
                  }
                  ?>
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