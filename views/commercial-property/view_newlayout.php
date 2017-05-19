<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Residentialproperty */

$this->title = $model->type." in ".$model->locations->location;
$this->params['breadcrumbs'][] = ['label' => 'Commercialproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$host = "103.208.73.2";$host = "103.208.73.2";
?>

<div class="container-fluid inner_banner" style="background:#3db4f9">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h1>Get Your Perfect Commercial Property</h1>
        </div>
        <div class="col-sm-4"><img src="images/comer_img.png" class="img-responsive" alt=""></div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid toolbar_section">
<div class="row search_section">
  <div class="container">
  <div class="row ">
    <div class="col-sm-9">
      <div class="row">
      <form action="<?=Url::to(['commercial-property/index'])?>" method="post">
      <div class="col-sm-2 demo2">
      <select name="available_for">
                <option>Lease</option>
                <option value="Sale">Buy</option>
        </select></div>
        <div class="col-sm-7">
          <!-- <input type="text" name="locationnames" class="form-control" id="filterResProp_locationname" placeholder="Add more Locations.."> -->
          <?php 
            // Multiple select without model
            echo Select2::widget([
                'name' => 'locationnames',
                'value' => '',
                'pluginOptions' => [
                'ajax' => [
                    'url' => \yii\helpers\Url::to(['residential-property/city-list']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                ],
                'options' => ['multiple' => true, 'placeholder' => 'Add more locations ...',"required"=>"required"]
            ]);
          ?>
          
          <input type="hidden" name="property_city_id" id="property_city_id" value="<?=$model->city_id?>">
        </div>
        <div class="col-sm-3">
          <div class="row">
          <div class="col-xs-3">
              <button type="submit" class="btn search_btn"><img src="images/serarch.jpg" alt=""></button>
            </div>
            <div class="col-xs-9 padding_left border_right">
              <div class="checkbox">
                <input type="checkbox" id="respdetailnearby" name="nearby" value="1">
                <label class="chkbob_lable" for="respdetailnearby" style="padding-left:0"><span></span>Nearby properties</label>
              </div>
            </div>
            
          </div>
        </div>
        </form>
      </div>
    </div>
    
  </div>
  </div>
 </div> 
</div>

<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-9 detail_body">
                    <div>
                        <div class="row">
                            <div class="col-sm-8 detail_body_lt">
                                <div class="row imageGallery1">

                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                
                <?php 
                //http://localhost/RealEstateCrm/files/residentialProperty/
                /*$images = json_decode($model->gallery_images);
                if(count($images) >0)
                {
                    foreach ($images as $image) {
                        echo "<div class='item'>";
                        echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/rightsell/backend/files/commercialProperty/galleryimages/".$model->id."_galleryimages_".$image."' alt=''/>";
                        echo "</div>";
                    }
                }*/
                ?>
                <div class='item active'>
                <?php if($model->photo != "" && $model->photo != null) {?>
          <img class="d-block img-fluid img-responsive" src="http://<?=$host?>/rightsell/backend/files/commercialProperty/<?= $model->id.'_'.$model->photo?>" alt="">
        <?php } else {?>
        <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg"" alt="">
        <?php }?>
        </div>
        <?php 
        //http://localhost/RealEstateCrm/files/residentialProperty/
        $images = json_decode($model->gallery_images);
        //echo "<pre> Images: "; print_r($images);exit;
        if(count($images) >0)
        {
          foreach ($images as $image) {
            echo "<div class='item'>";
            echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/rightsell/backend/files/commercialProperty/galleryimages/".$model->id."_galleryimages_".$image."' alt=''/>";
            echo "</div>";
          }
        }?>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div></div>
                                    <!--<div class="col-sm-8 col-xs-8 gallary_big_photo">
                                        <a href="images/comm_photo1_back.jpg" title="Caption for gallery item 1">
                                            <img src="images/comm_photo1_front.jpg" class="img-responsive" alt="Gallery image 1">
                                            <div class="middle">
                                                <img src="images/zoom.png" class="img-responsive" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-4 col-xs-4">
                                        <div class="row">
                                            <div class="col-sm-12 gallary_small_photo1" style="margin-bottom:-3px;">
                                                <a href="images/comm_photo1_back.jpg" title="Caption for gallery item 2">
                                                    <img src="images/comm_photo1_front.jpg" class="img-responsive" alt="Gallery image 2">
                                                    <div class="middle2">
                                                        <img src="images/zoom.png" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-12 gallary_small_photo">
                                                <a href="images/comm_photo1_back.jpg" title="Caption for gallery item 3">
                                                    <img src="images/comm_photo1_front.jpg" class="img-responsive" alt="Gallery image 3">
                                                    <span class="overlay1">+3</span>
                                                    <div class="middle3">
                                                        <img src="images/zoom.png" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                                <a href="images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                                <a href="images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                                <a href="images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                                <a href="images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="col-sm-4 detail_body_rt">
                                <div class="row detail_body_title">
                                    <?php
                $now = time(); // or your date as well
                $your_date = strtotime($model->added_on);
                $datediff = $now - $your_date;

                $days = floor($datediff / (60 * 60 * 24));
                $from=date_create(date('Y-m-d'));
                $to=date_create($model->added_on);
                $diff=date_diff($to,$from);
                ?>

                                    <span>Posted - <?=$diff->format('%a days');?> old</span>
                                    <h1><?=$model->type." in<br/>".$model->locations->location?></h1>
                                    <p></p>
                                </div>
                                <div class="row detail_body_price">
                                    <ul>
                                        <li>
                                            <span>Builtup</span>
                                            <h1><?=$model->area.' Sq.ft.'?></h1>
                                        </li>
                                        <?php if($model->available_for == "Lease") { ?>
                                        <li>
                                            <span>Rent</span>
                                            <h1>| <i class="fa fa-inr" aria-hidden="true"></i><?= number_format($model->rent_details_comp)?> |</h1>
                                        </li>
                                        <!--<li>
                                            <span>Deposit</span>
                                            <h1><i class="fa fa-inr" aria-hidden="true"></i><?= number_format($model->deposite_details_comp)?></h1>
                                        </li>-->
                                        <?php }?>

                                        <?php if($model->available_for == "Sale") { ?>
                                        <li>
                                            <span>Rate</span>
                                            <h1>| <i class="fa fa-inr" aria-hidden="true"></i><?= number_format($model->rate_details_comp)?> |</h1>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <div class="row detail_body_detail">
                                    <?php $overview = strip_tags($model->ideal_for);
									if($overview!=""){
										?>
                                    <h1>Overview</h1>
									<p><?= substr($overview,0,220)."..."?> 
                                    <?php if(strlen($overview)>220){?>
                                    <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#more_popup">Read More</a>
                                    <?php }?>
									</p>
                                    <?php }?>
									
                                    <span><img src="images/recomended.png" class="img-responsive" style="float:left;" alt="">30 People recommended this property</span>
                                </div>
                                <button class="contact_owner2">Contact Owner</button>
                                <p><img src="images/veryfied.png" class="img-responsive" style="float:left;" alt="">Rightsell verified property</p>
                                <!--<button class="recommend_button" style="margin-right:2px;"><img src="images/recommend_arrow.png" class="img-responsive" style="float:left;" alt="">Recommend</button><button class="recommend_button" style="margin-left:2px;"><img src="images/recommend_arrow2.png" class="img-responsive" style="float:left;" alt="">Don't Recommend</button>-->
                                <button class="recommend_button"><img src="images/recommend_arrow.png" class="img-responsive" style="float:left;" alt="">I recommend this property</button>
                         </div>
                        </div>
                    </div>
                    <div class="row detail_features">
                        <h1>Features</h1>
                        <ul>
                            <li>Total No of floors : <?=$model->floor_no?$model->floor_no:0?></li>
                            <?php
                            $furnished= "Non-Furnished";
                            if($model->furnished == "ff")
                                $furnished = "Fully Furnished";
                            else if($model->furnished == "un")
                                $furnished = "Non-Furnished";
                            else if($model->furnished == "sf")
                                $furnished = "Semi-Furnished";
                            ?>
                            <li>Furnished status : <?=$furnished?></li>
                            <li>Facing : <?=$model->facing?$model->facing:"NA"?></li>
                            <li>Available From : <?=$model->available_from?$model->available_from:"NA"?></li>
                        </ul>
                    </div>
                    <hr class="detail_hr_line">
                    <div class="row detail_features">
                        <h1>Ideal For</h1>
                        <p><?=$model->ideal_for?$model->ideal_for:"NA"?></p>
                    </div>
                    <hr class="detail_hr_line">
                    <div class="row detail_aminities">
                        <h1>Prime Amenities</h1>

                         <?php 
						 $amenityflag = true;
                         /*$amenitiesname=[];
                        if($model->amenityies) {
                            foreach($model->amenityies as $amenities) {
                            $amenitiesname[] = $amenities->amenityName->name;
                            }
                            }*/
                            ?>
                        <ul>
                        <?php if($model->cafeteria == 1) { 
						
						?>
                            <li class="commercial"><img src="images/cafeteria.png" class="img-responsive" alt="">Cafeteria</li>
                        <?php } else { ?>
                        <li class="commercial"><img src="images/cafeteria.png" class="img-responsive" alt="">Cafeteria</li>
                        <?php }?>
                        <?php if($model->wifi == 1) {?>
                            <li class="commercial"><img src="images/active_wifi.png" class="img-responsive" alt="">Wifi</li>
                        <?php } else { ?>
                        <?php }?>
                        <?php if($model->conference_room == 1) {?>
                            <li class="commercial"><img src="images/conference_facility.png" style="margin-top:-5px;" class="img-responsive" alt="">Conference facilities</li>
                        <?php } else { ?>
                        <?php }?>
                        <?php if($model->vastu == 1) {?>
                            <li class="commercial"><img src="images/vaastu_complaint.png" class="img-responsive" alt="">Vastu Compliant</li>
                        <?php } else { ?>
                        <?php }?>
                        <?php if($model->reception == 1) {?>
                            <li class="commercial"><img src="images/reception.png" class="img-responsive" alt="">Reception</li>
                        <?php } else { ?>
                        <?php }?>
                        <?php if($model->toilets == 1) {?>
                            <li class="commercial"><img src="images/washroom.png" class="img-responsive" alt="">Washrooms</li>
                        <?php } else { ?>
                        <?php }?>
                        <?php if($model->firesafety == 1) {?>
                            <li class="commercial"><img src="images/fire_facility.png" class="img-responsive" alt="">Fire safety</li>
                            <?php } else { ?>
                            <?php }?>
                        <?php if($model->four_wheeler_parking == 1 || $model->two_wheeler_parking == 1) {?>
                            <li class="commercial"><img src="images/detail_car_parking.png" class="img-responsive" alt="">Parking</li>
                        <?php } else { ?>
                        <?php }?>
                        <?php if($model->water_availability == 1) {?>
                            <li class="commercial"><img src="images/detail_water_supply.png" class="img-responsive" alt="">Water Storage</li>
                        <?php } else { ?>
                        <?php }?>

                        </ul>
                    </div>
                    
                    <hr class="detail_hr_line">
                    <div class="row detail_regular_aminities2">
                        <h1>Internal Structure</h1>
                        <ul><?php $intStruct = true;?>
                            <?php if($model->reception >= 1) {
								$intStruct = false;?>
                            <li>Reception</li>
                            <?php } ?>
                            <?php if($model->min_workstations >= 1) {
								$intStruct = false;?>
                            <li>Workstations</li>
                            <?php } ?>
                            <?php if($model->conference_room >= 1) {
								$intStruct = false;?>
                            <li>Conference Room</li>
                            <?php } ?>
                            <?php if($model->storage_room >= 1) {
								$intStruct = false;?>
                            <li>Storage Room</li>
                            <?php } ?>
                            <?php if($model->server_room >= 1) {
								$intStruct = false;?>
                            <li>Server Room</li>
                            <?php } ?>
							
							<?php if($intStruct) {?>
                            <li>NA</li>
                            <?php } ?>
                        </ul>
                    </div>
                    
                    <hr class="detail_hr_line">
                    <div class="row detail_regular_aminities2">
                        <h1>Outer Structure</h1>
                        <ul><?php $othStruct = true;?>
                        <?php if($model->lift_facility >= 1) {
							$othStruct = false;?>
                            <li>Lift Facility</li>
                            <?php } ?>
                            <?php if($model->two_wheeler_parking >= 1) {
								$othStruct = false;?>
                            <li>Two Wheeler Parking</li>
                            <?php } ?>
                            <?php if($model->four_wheeler_parking >= 1) {
								$othStruct = false;?>
                            <li>Four Wheeler Parking</li>
                            <?php } ?>
                            <?php if($model->power_backup >= 1) {
								$othStruct = false;?>
                            <li>Outer Power Backup</li>
                            <?php } ?>
							<?php if($othStruct) {?>
                            <li>NA</li>
                            <?php } ?>
                        </ul>
                    </div>
                   
                    <hr class="detail_hr_line2">
                    <div class="row detail_neighbourhood">
                        <h1>Neighbourhood</h1>
                        <div id="map" style="width: 100%; height: 250px" >NA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<div class="modal fade in" id="more_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content popup_bg" style="border-radius: 0">
      <div class="modal-header" style="background: #f58634;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Overview</h4>
      </div>
      <div class="modal-body">
        <?=  $overview?>
      </div>
          </div>
  </div>
</div>
<?php $this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCHbbed7Sn9InZn4Gw5fJBLnnoee7hgrNM', [yii\web\JqueryAsset::className()]); ?>
<?php $this->registerJsFile('js/simpleLightbox.min.js', [yii\web\JqueryAsset::className()]); ?>
<?php
$this->registerCss("#map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }");
$this->registerJs("
    $(document).on('ready', function(){
        initMap();
$('.imageGallery1 a').simpleLightbox();
    
    $('.showGalleryFromArray').on('click', function() {
        $.SimpleLightbox.open({
            items: ['demo/images/1big.jpg', 'demo/images/2big.jpg', 'demo/images/3big.jpg']
        });
    });
$('.customContentLink').on('click', function() {
        $.SimpleLightbox.open({
            content: '<div class=\"contentInPopup\">' +
                        '<h3 class=\"attireTitleType3\">Custom content</h3>' +
                        '<p class=\"attireTextType2\">' +
                            'There are times when you need to show some other type of content in lightbox beside images.' +
                            'SimpleLightbox can be used to display forms, teasers or any custom html content.' +
                        '</p>' +
                     '</div>',
            elementClass: 'slbContentEl'
        });
    });
});

function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          //center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();
        geocodeAddress(geocoder, map);

        /*document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });*/
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = '".trim($model->locations->location).",".trim($model->cityName->city)."';
        //var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            //alert('Geocode was not successful for the following reason: ' + status);
          }
        });
    }");
?>


<?php //".trim($model->societys->society_name).", $this->registerJsFile('https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js', [yii\web\JqueryAsset::className()]); ?> 

<?php // $this->registerJsFile('js/simpleLightbox.min.js', [yii\web\JqueryAsset::className()]); ?> 

<!-- <script src="js/jquery-3.1.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js"></script>
<script src="js/simpleLightbox.min.js"></script> -->
<!-- <script>
    $('.imageGallery1 a').simpleLightbox();
    
    $('.showGalleryFromArray').on('click', function() {
        $.SimpleLightbox.open({
            items: ['demo/images/1big.jpg', 'demo/images/2big.jpg', 'demo/images/3big.jpg']
        });
    });
    
    $('.customContentLink').on('click', function() {
        $.SimpleLightbox.open({
            content: '<div class="contentInPopup">' +
                        '<h3 class="attireTitleType3">Custom content</h3>' +
                        '<p class="attireTextType2">' +
                            'There are times when you need to show some other type of content in lightbox beside images.' +
                            'SimpleLightbox can be used to display forms, teasers or any custom html content.' +
                        '</p>' +
                     '</div>',
            elementClass: 'slbContentEl'
        });
    });
</script> -->