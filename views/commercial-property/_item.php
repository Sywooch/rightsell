<?php $host = "103.208.73.2";
//echo "Property By: ".$model->property_by;
?>
<div class="col-sm-5 nopadding">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="d-block img-fluid img-responsive" src="http://<?=$host?>/RealEstateCrm/files/commercialProperty/profiles/<?= $model->id.'_profiles_'.$model->photo?>" alt="">
				</div>
				<?php 
				//http://localhost/RealEstateCrm/files/residentialProperty/
				$images = json_decode($model->gallery_images);
				if(count($images) >0)
				{
					foreach ($images as $image) {
						echo "<div class='item'>";
						echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/RealEstateCrm/files/commercialProperty/galleryimages/".$model->id."_galleryimages_".$image."' alt=''/>";
						echo "</div>";
					}
				}?>
				<!-- <div class="item">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
				<div class="item">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div> -->
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
			<h1><?= $model->type?> Near <?= $model->locations?$model->locations->location:""?>.</h1>
			<button class="button yellow_btn"><?= $model->type?></button>
			<?php if(strtolower($model->available_for)=="lease"):?>
			<button class="button orrange_btn">Rent <?=number_format($model->rent_details_comp)?></button>
			<button class="button yellow_btn">Deposit <?=number_format($model->deposite_details_comp)?></button>
			<?php endif;?>

			<?php if(strtolower($model->available_for)=="sale"):?>
			<button class="button orrange_btn">Rate <?=number_format($model->rate_details_comp)?></button>
			<?php endif;?>
			<div class="row">
				<?php
				$minws = $model->min_workstations;
				$maxws = $model->max_workstations;
				$ws = $minws." - ".$maxws;
				if($minws == 0)
					$ws = $maxws;
				if($ws == "")
				{
					$ws = 0;
				}
				?>
				<div class="col-xs-6"><p><img src="images/shop.jpg" alt="">
				<?php //$model->type?ucfirst($model->type):"Any"?>
				<?= "Workstation - ".$ws?>
				</p></div>
				<div class="col-xs-6">
				<?php
				$fwp = $model->four_wheeler_parking;
				$twp = $model->two_wheeler_parking;
				$parking = "No";
				if($fwp != 0 && $twp != 0)
					$parking = "Yes";
				
				// $parking = $model->four_wheeler_parking;

				?>
				<!-- <p><img src="images/car.png" alt="">Parking - Four wheeler:<?php /*$model->four_wheeler_parking?$model->four_wheeler_parking:"0"*/?> Two wheeler: <?php /*$model->two_wheeler_parking?$model->two_wheeler_parking:"0"*/?> Lift: <?php /*$model->lift_facility?$model->lift_facility:"0"*/?></p> -->

				<p><img src="images/car.png" alt="">Parking - <?=$parking ?></p>

				</div>
			</div>	
			<div class="row">
				<div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?=$model->area.' Sq.ft.'?></p></div>
				<?php if(strtolower($model->furnished) == "sf"): ?>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Semi-Furnished</p></div>
				<?php elseif(strtolower($model->furnished)=="ff"): ?>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Fully Furnished</p></div>
				<?php else: ?>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Non Furnished</p></div>
				<?php endif;?>
				<?php
				$now = time(); // or your date as well
				$your_date = strtotime($model->added_on);
				$datediff = $now - $your_date;

				$days = floor($datediff / (60 * 60 * 24));
				$from=date_create(date('Y-m-d'));
				$to=date_create($model->added_on);
				$diff=date_diff($to,$from);
				?>
				<div class="col-xs-12"><strong>Status:</strong> This property <?=$diff->format('%a days');?> old</div>
				<!-- <div class="col-xs-12"><strong>Status:</strong> This property 2 years old</div> -->
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