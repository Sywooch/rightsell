
<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
//$host = "localhost";
$host = "103.208.73.2";

$getPropertyBy="Owner and Agent";
if(isset($_GET['ResidentialpropertySearch']['property_by']))
	$getPropertyBy = $_GET['ResidentialpropertySearch']['property_by'];
// if(isset($_GET['ResidentialpropertySearch']['available_for']))
// $getAvailableFor = $_GET['ResidentialpropertySearch']['available_for'];
// if(isset($_GET['ResidentialpropertySearch']['furnished']))
// $getFurnishedArr = $_GET['ResidentialpropertySearch']['furnished'];
// if(isset($_GET['ResidentialpropertySearch']['bhk']))
// $getBhkArr = $_GET['ResidentialpropertySearch']['bhk'];
?>
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="container-fluid inner_banner">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>Get Your Perfect Residential Property</h1>
				</div>
				<div class="col-sm-4"><img src="images/home_img.jpg" alt=""></div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->render('searchresidentialproperty', ['model' => $searchModel]); ?>




<!-- properties listing  -->

<div class="container">
	<div class="row">
		<div class="col-md-12 breadcrum"><a href="#">Home</a> › <a href="#">Property for rent in Pune</a> › <a href="#">Wakad</a> › All Residential</div>
		<div class="col-md-3">
			<div class="pro_left_column"><div class="row">
				<div class="col-xs-7 filter_text">Filter your Search</div>
				<div class="col-xs-5"><a href="<?= Url::to(["residential-property/index"]);?>" class="button red_btn" style="float:right; font-size:13px; margin:0"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a></div>
			</div></div>
			<?php echo $this->render('_search', ['model' => $searchModel]); ?>
			<!-- <div class="pro_left_column">
				<input type="radio" id="r1" name="rr">
				<label for="r1"><span></span>Owner</label>
				<input type="radio" id="r2" name="rr">
				<label for="r2"><span></span>Agent</label>
			</div>

			<div class="pro_left_column">
				<input type="radio" id="r3" name="rr1">
				<label for="r3"><span></span>Buy</label>
				<input type="radio" id="r4" name="rr1">
				<label for="r4"><span></span>Rent</label>
				<input type="radio" id="r5" name="rr1">
				<label for="r5"><span></span>Flatmate</label>


			</div> -->

			<!-- <div class="pro_left_column">
				<div class="row">
					<div class="col-xs-6" style="padding-right:0"><input type="checkbox" id="c40" name="cc">
					<label class="chkbob_lable" for="c40"><span></span>Furnished</label></div>
					<div class="col-xs-6" style="padding:0 0 0 10px"><input type="checkbox" id="c50" name="cc">
						<label class="chkbob_lable" for="c50"><span></span>Semi-Furnished</label></div>
						<div class="col-xs-12" style="text-align:center"><input type="checkbox" id="c70" name="cc">
						<label class="chkbob_lable" for="c70"><span></span>Non Furnished</label></div>
				</div>
			</div> -->

			<!-- <div class="pro_left_column">
				<div class="row demo">
					<div class="col-xs-5 demo_col">
						<img src="images/rupee.jpg" alt=""><select>
						<option>Min</option>
						<option>5 Lac</option>
						<option>10 Lac</option>
						<option>20 Lac</option>
						<option>25 Lac</option>
						<option>40 Lac</option>
						<option>50 Lac</option>
						<option>80 Lac</option>
						<option>1 Cr</option>
					</select></div>
					<div class="col-xs-2 boldtxt">-</div>
					<div class="col-xs-5 demo_col"><img src="images/rupee.jpg" alt=""><select>
						<option>Max</option>
						<option>10 Lac</option>
						<option>20 Lac</option>
						<option>25 Lac</option>
						<option>40 Lac</option>
						<option>50 Lac</option>
						<option>80 Lac</option>
						<option>1 Cr</option>
						<option>1.5 Cr</option>
					</select></div></div>
				</div> -->

				<!-- <div class="pro_left_column">
					<div class="row">
						<div class="col-xs-6">
							<input type="checkbox" id="c2" name="cc">
							<label class="chkbob_lable" for="c2"><span></span>1 RK</label>
						</div>
						<div class="col-xs-6">
							<input type="checkbox" id="c3" name="cc">
							<label class="chkbob_lable" for="c3"><span></span>2.5 BHK</label>
						</div>
						<div class="col-xs-6"><input type="checkbox" id="c4" name="cc">
							<label class="chkbob_lable" for="c4"><span></span>1 BHK</label></div>
							<div class="col-xs-6"><input type="checkbox" id="c5" name="cc">
								<label class="chkbob_lable" for="c5"><span></span>3 BHK</label></div>
								<div class="col-xs-6"><input type="checkbox" id="c6" name="cc">
									<label class="chkbob_lable" for="c6"><span></span>2 BHK</label></div>
									<div class="col-xs-6"><input type="checkbox" id="c7" name="cc">
										<label class="chkbob_lable" for="c7"><span></span>3.5 BHK</label></div>
									</div>
									<hr style="margin:10px 0 15px 0">
									<div class="row">
										<div class="col-xs-6">
											<input type="checkbox" id="c8" name="cc">
											<label class="chkbob_lable" for="c8"><span></span>Apartment</label>
										</div>
										<div class="col-xs-6">
											<input type="checkbox" id="c9" name="cc">
											<label class="chkbob_lable" for="c9"><span></span>Independent</label>
										</div>
										<div class="col-xs-6"><input type="checkbox" id="c10" name="cc">
											<label class="chkbob_lable" for="c10"><span></span>Bunglow</label></div>
											<div class="col-xs-6"><input type="checkbox" id="c11" name="cc">
												<label class="chkbob_lable" for="c11"><span></span>Penthouse</label></div>
												<div class="col-xs-6"><input type="checkbox" id="c12" name="cc">
													<label class="chkbob_lable" for="c12"><span></span>Villa</label></div>
													<div class="col-xs-6"><input type="checkbox" id="c13" name="cc">
														<label class="chkbob_lable" for="c13"><span></span>Plot</label></div>
													</div>
												</div> -->
														</div>

														<div class="col-md-7 projects_section">
															<h1><?= $dataProvider->getTotalCount(); ?> Properties in <?= $searchModel->locationname; ?> from <?=$getPropertyBy?>. &nbsp;&nbsp;</h1>
															<h2>0 Nearby properties</h2>
<?php
foreach ($dataProvider->getModels() as $model):?>
	
															<div class="row pro_box">
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
																			}

																			?>
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
																					<h1><?= $model->bhk?> BHK, <?= $model->property_type?><?= $model->area ? ", ".$model->area->area:""?></h1>
																					<button class="button yellow_btn"><?= $model->property_type?></button>
																					<?php if($model->expected_rent):?>
																					<button class="button orrange_btn">Rent <?= $model->expected_rent." ".$model->rent_currency?></button>
																					<?php endif?>
																					<?php if($model->deposit):?>
																					<button class="button yellow_btn">Deposit <?= $model->deposit." ".$model->deposit_currency?></button>
																					<?php endif;?>
																					<div class="row">
																						<?php if($model->preferred_tenants != ""):?>
																						<div class="col-xs-6"><p><img src="images/family.png" alt=""><?= ucfirst($model->preferred_tenants)?></p></div>
																					<?php else: ?>
																							<div class="col-xs-6"><p><img src="images/family.png" alt="">Any</p></div>
																						<?php endif ?>
																						<div class="col-xs-6"><p><img src="images/car.png" alt=""><?= $model->is_parking_available?></p></div>
																					</div>	
																					<div class="row">
																						<div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?= $model->carpet_area?> - <?= $model->carpet_unit?>.</p></div>
																						<div class="col-xs-6"><p><img src="images/furnished.png" alt=""><?= $model->furnished?></p></div>
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
																					</div>
																					<div class="row">
																						<div class="col-xs-6"><button class="button red_btn">Contact Owner</button></div>
																						<div class="col-xs-6"><table>
																							<tbody><tr>
																								<td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
																								<td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
																								<td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
																							</tr>
																						</tbody></table></div>
																					</div>
																				</div>
																			</div>
																			<!--<div class="col-sm-2"></div>-->
																		</div>
																		<?php endforeach;?>
																		<!--<div class="row pro_box">
																			<div class="col-sm-5 nopadding">
																				<div id="myCarousel" class="carousel slide" data-ride="carousel">
																					<div class="carousel-inner" role="listbox">
																						<div class="item">
																							<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">					</div>
																							<div class="item active">
																								<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">					</div>
																								<div class="item">
																									<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">					</div>
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
																								<h1>2 BHK, Near Bridge, Wakad.</h1>
																								<button class="button yellow_btn">2 BHK</button>
																								<button class="button orrange_btn">Rent 12,000</button>
																								<button class="button yellow_btn">Deposit 30,000</button>
																								<div class="row">
																									<div class="col-xs-6"><p><img src="images/family.png" alt="">Family only</p></div>
																									<div class="col-xs-6"><p><img src="images/car.png" alt="">Car Parking</p></div>
																								</div>	
																								<div class="row">
																									<div class="col-xs-6"><p><img src="images/area.png" alt="">Area - 600 Sq.Ft.</p></div>
																									<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Un-furnished</p></div>
																									<div class="col-xs-12"><strong>Status:</strong> This property 5 years old</div>
																								</div>
																								<div class="row">
																									<div class="col-xs-6"><button class="button red_btn">Contact Owner</button></div>
																									<div class="col-xs-6"><table>
																										<tbody><tr>
																											<td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
																											<td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
																											<td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
																										</tr>
																									</tbody></table></div>
																								</div>
																							</div>
																						</div>
																						
																					</div>-->

																				</div>
																			</div>
																			<!-- <div class="col-md-2"></div>-->
																		</div>
<!-- properties listing - end -->