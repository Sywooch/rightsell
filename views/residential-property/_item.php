<?php 

use yii\helpers\Url;
$host = "103.208.73.2";
//echo "<pre>"; print_r($model);exit;
?>
<div class="col-sm-5 nopadding">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="d-block img-fluid img-responsive" src="http://<?=$host?>/RealEstateCrm/files/residentialProperty/profiles/<?= $model->id.'_profiles_'.$model->property_profile_photo?>" alt="">
				</div>
				<?php 
				//http://localhost/RealEstateCrm/files/residentialProperty/
				$images = json_decode($model->gallery_images);
				if(count($images) >0)
				{
					foreach ($images as $image) {
						echo "<div class='item'>";
						echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/RealEstateCrm/files/residentialProperty/galleryimages/".$model->id."_galleryimages_".$image."' alt=''/>";
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
			<a href="<?=Url::to(['residential-property/view','id'=>$model->id])?>"><h1><?= $model->bhks->name?> Near <?= $model->locations->location?>.</h1></a>
			<button class="button yellow_btn"><?= $model->bhks->name?></button>
			<?php if(strtolower($model->available_for)=="rent"):?>
			<button class="button orrange_btn">Rent <?= number_format($model->expected_rent_comp)?></button>
			<button class="button yellow_btn">Deposit <?= number_format($model->deposit_comp)?></button>
			<?php 

			/*$current =$model->rent_currency;
			if($model->rent_currency =="Thousands")
				$current = "Th";
			$currdep =$model->deposit_currency;
			if($model->deposit_currency =="Thousands")
				$currdep = "Th";*/
			?>
			<!-- <button class="button orrange_btn">Rent <?php //$model->expected_rent?></button>
			<button class="button yellow_btn">Deposit <?php //$model->deposit?></button> -->
			<?php endif;?>

			<?php if(strtolower($model->available_for)=="sale"):?>
			<button class="button orrange_btn">Rate <?= number_format($model->expected_rate_comp)?></button>
			<?php 
			/*$curr =$model->rate_currency;
			if($model->rate_currency =="Thousands")
				$curr = "Th";*/
			?>
			<!-- <button class="button orrange_btn">Rate <?php // $model->expected_rate ?></button> -->
			<?php endif;?>

			<div class="row">
				<div class="col-xs-6"><p><img src="images/family.png" alt=""><?php
                                        if($model->preferred_tenants == "f")
                                          echo "Family";
                                        else if($model->preferred_tenants == "b")
                                          echo "Bachelors";
                                        else
                                          echo ucfirst($model->preferred_tenants);
                                        ?></p></div>
				<div class="col-xs-6">
				<p><img src="images/car.png" alt="">Parking - <?=$model->no_of_parking?$model->no_of_parking:"No"?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?=$model->builtup_area.' '.$model->builtup_unit?></p></div>
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
				<div class="col-xs-6"><button class="button red_btn showcontactinfo" data-toggle="modal" data-target="#myModal">Contact Owner</button></div>
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