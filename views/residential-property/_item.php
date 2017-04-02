<div class="col-sm-5 nopadding">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
				<div class="item">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
				<div class="item">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<div class="col-sm-7">
		<div class="row pro_detail">
			<h1><?=$model->bhk;?> BHK, Near Bridge <?=$locationname?>.</h1>
			<button class="button yellow_btn"><?=$model->bhk?> BHK</button>
			<?php if(strtolower($model->available_for)=="rent"):?>
			<button class="button orrange_btn">Rent <?=number_format($model->expected_rent_comp)?></button>
			<button class="button yellow_btn">Deposit <?=number_format($model->deposit_comp)?></button>
			<?php endif;?>

			<?php if(strtolower($model->available_for)=="sale"):?>
			<button class="button orrange_btn">Rate <?=number_format($model->expected_rate_comp)?></button>
			<?php endif;?>

			<!-- <button class="button yellow_btn">Deposit <?=number_format($model->deposit_comp)?></button> -->
			<div class="row">
				<div class="col-xs-6"><p><img src="images/family.png" alt="">Family only</p></div>
				<div class="col-xs-6"><p><img src="images/car.png" alt="">Car Parking</p></div>
			</div>	
			<div class="row">
				<div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?=$model->carpet_area.' '.$model->carpet_unit?></p></div>
				<?php if(strtolower($model->furnished) == "sf"): ?>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Semi-furnished</p></div>
				<?php elseif(strtolower($model->furnished)=="ff"): ?>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Fully furnished</p></div>
				<?php else: ?>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Un-furnished</p></div>
				<?php endif;?>
				<div class="col-xs-12"><strong>Status:</strong> This property 2 years old</div>
			</div>
			<div class="row">
				<div class="col-xs-6"><button class="button red_btn">Contact Owner</button></div>
				<div class="col-xs-6"><table>
					<tr>
						<td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
						<td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
						<td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
					</tr>
				</table></div>
			</div>
		</div>
	</div>