<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Residentialproperty */

$this->title = $model->bhks->name." in ".$model->locations->location;
$this->params['breadcrumbs'][] = ['label' => 'Residentialproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

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
<div class="container-fluid toolbar_section">
<div class="row search_section">
  <div class="container">
  <div class="row ">
    <div class="col-sm-9">
      <div class="row">
      <form action="<?=Url::to(['residential-property/index'])?>" method="post">
      <div class="col-sm-2 demo2">
      <select name="available_for">
                <option value="Sale">Buy</option>
                <option>Rent</option>
                <option selected="selected">Flatmate</option>
        </select></div>
        <div class="col-sm-7">
          <input type="text" name="locationnames" class="form-control" id="filterResProp_locationname" placeholder="Add more Locations..">
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
                                    <div class="col-sm-8 col-xs-8 gallary_big_photo">
                                        <a href="http://visiongraphics.co.in/right_sell_property/images/photo1_back.jpg" title="Caption for gallery item 1">
                                            <img src="images/photo1_front.jpg" class="img-responsive" alt="Gallery image 1">
                                            <div class="middle">
                                                <img src="images/zoom.png" class="img-responsive" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-4 col-xs-4">
                                        <div class="row">
                                            <div class="col-sm-12 gallary_small_photo1">
                                                <a href="http://visiongraphics.co.in/right_sell_property/images/photo2_back.jpg" title="Caption for gallery item 2">
                                                    <img src="images/photo2_front.jpg" class="img-responsive" alt="Gallery image 2">
                                                    <div class="middle2">
                                                        <img src="images/zoom.png" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-12 gallary_small_photo">
                                                <a href="http://visiongraphics.co.in/right_sell_property/images/photo3_back.jpg" title="Caption for gallery item 3">
                                                    <img src="images/photo3_front.jpg" class="img-responsive" alt="Gallery image 3">
                                                    <span class="overlay1">+3</span>
                                                    <div class="middle3">
                                                        <img src="images/zoom.png" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                                <a href="http://visiongraphics.co.in/right_sell_property/images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                                <a href="http://visiongraphics.co.in/right_sell_property/images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                                <a href="http://visiongraphics.co.in/right_sell_property/images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                                <a href="http://visiongraphics.co.in/right_sell_property/images/photo3_back.jpg" title="Caption for gallery item 3"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <h1><?=$model->bhks->name." in ".$model->locations->location?></h1>
                                    <p><?=$model->societys? $model->societys->society_name: "-"?></p>
                                </div>
                                <div class="row detail_body_price">
                                    <ul>
                                        <li>
                                            <span>Builtup</span>
                                            <h1><?=$model->builtup_area." ".$model->builtup_unit?></h1>
                                        </li>
                                        <?php if($model->available_for == "Rent") { ?>
                                        <li>
                                            <span>Rent</span>
                                            <h1>| Rs.<?= number_format($model->expected_rent_comp)?> |</h1>
                                        </li>
                                        <li>
                                            <span>Deposit</span>
                                            <h1>Rs.<?= number_format($model->deposit_comp)?></h1>
                                        </li>
                                        <?php }?>

                                        <?php if($model->available_for == "Sale") { ?>
                                        <li>
                                            <span>Rate</span>
                                            <h1>| Rs.<?= number_format($model->expected_rate_comp)?> |</h1>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <div class="row detail_body_detail">
                                    <h1>Overview</h1>
                                    <p><?=$model->spl_attraction?></p>
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
                            <li><img src="images/family.png" class="img-responsive" alt="">Family/ Bachelors</li>
                            <li><img src="images/furniture.png" class="img-responsive" alt="">Un-furnished</li>
                            <li style="margin-left:31px;">Possession within 30 days</li>
                        </ul>
                    </div>
                    <hr class="detail_hr_line">
                    <div class="row detail_aminities">
                        <h1>Prime amenities</h1>
                        <ul>
                        <?php 
                        $amenitiesname=[];
                        if($model->amenityies) {
                            foreach($model->amenityies as $amenities) {
                            $amenitiesname[] = $amenities->amenityName->name;
                            }
                            }?>
                            <?php if(in_array("power backup", $amenitiesname)){?>
                            <li>
                            <img src="images/detail_power_backup.png" class="img-responsive" alt="">Power backup</li>
                            <?php } else { ?>
                            <li class="deactive">
                            <img src="images/detail_power_backup.png" class="img-responsive" alt="">Power backup</li>
                            <?php }?>
                            <?php if(in_array("gym", $amenitiesname)){?>
                            <li><img src="images/gym.png" class="img-responsive" alt="">Gym</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_gym.png" class="img-responsive" alt="">Gym</li>
                            <?php }?>
                            <?php if(in_array("Swimming Pool", $amenitiesname)){?>
                            <li><img src="images/detail_swimming_pool.png" class="img-responsive" alt="">Swimming pool</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_swimming_pool.png" class="img-responsive" alt="">Swimming pool</li>
                            <?php }?>

                            
                            <?php if(in_array("Club House", $amenitiesname)){?>
                            <li><img src="images/detail_club_house.png" class="img-responsive" alt="">Club House</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_club_house.png" class="img-responsive" alt="">Club House</li>
                            <?php }?>


                            <?php if(in_array("Door Camera", $amenitiesname)){?>
                            <li><img src="images/detail_door_cam.png" class="img-responsive" alt="">Door Camera</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_door_cam.png" class="img-responsive" alt="">Door Camera</li>
                            <?php }?>


                            <!-- <li><img src="images/detail_club_house.png" class="img-responsive" alt="">Club House</li>
                            <li class="deactive"><img src="images/detail_door_cam.png" class="img-responsive" alt="">Door Camera</li> -->

                            <?php if(in_array("Car Parking", $amenitiesname)){?>
                            <li><img src="images/detail_car_parking.png" class="img-responsive" alt="">Car Parking</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_car_parking.png" class="img-responsive" alt="">Car Parking</li>
                            <?php }?>

                            <?php if(in_array("Security", $amenitiesname)){?>
                            <li><img src="images/detail_security.png" class="img-responsive" alt="">Security</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_security.png" class="img-responsive" alt="">Security</li>
                            <?php }?>


                            <!-- <li><img src="images/detail_car_parking.png" class="img-responsive" alt="">Car Parking</li>
                            <li><img src="images/detail_security.png" class="img-responsive" alt="">Security</li> -->

                            <?php if(in_array("Garden", $amenitiesname)){?>
                            <li><img src="images/detail_garden.png" class="img-responsive" alt="">Garden</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_garden.png" class="img-responsive" alt="">Garden</li>
                            <?php }?>

                            <?php if(in_array("Elevator", $amenitiesname)){?>
                            <li><img src="images/detail_elevetor.png" class="img-responsive" alt="">Elevator</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_elevetor.png" class="img-responsive" alt="">Elevator</li>
                            <?php }?>

                            <!-- <li><img src="images/detail_garden.png" class="img-responsive" alt="">Garden</li>
                            <li><img src="images/detail_elevetor.png" class="img-responsive" alt="">Elevator</li> -->

                            <?php if(in_array("Water Supply", $amenitiesname)){?>
                            <li><img src="images/detail_water_supply.png" class="img-responsive" alt="">Water Supply</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_water_supply.png" class="img-responsive" alt="">Water Supply</li>
                            <?php }?>

                            <?php if(in_array("Jogging track", $amenitiesname)){?>
                            <li><img src="images/detail_jogging_park.png" class="img-responsive" alt="">Jogging track</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_jogging_park.png" class="img-responsive" alt="">Jogging track</li>
                            <?php }?>

                            <?php if(in_array("Intercom", $amenitiesname)){?>
                            <li><img src="images/detail_intercom.png" class="img-responsive" alt="">Intercom</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_intercom.png" class="img-responsive" alt="">Intercom</li>
                            <?php }?>

                            <?php if(in_array("Wifi", $amenitiesname)){?>
                            <li><img src="images/detail_wifi.png" class="img-responsive" alt="">Wifi</li>
                            <?php } else { ?>
                            <li class="deactive"><img src="images/detail_wifi.png" class="img-responsive" alt="">Wifi</li>
                            <?php }?>

                            <!-- <li><img src="images/detail_water_supply.png" class="img-responsive" alt="">Water Supply</li>
                            <li class="deactive"><img src="images/detail_jogging_park.png" class="img-responsive" alt="">Jogging track</li>
                            <li><img src="images/detail_intercom.png" class="img-responsive" alt="">Intercom</li>
                            <li class="deactive"><img src="images/detail_wifi.png" class="img-responsive" alt="">Wifi</li> -->
                        </ul>
                    </div>
                    <div class="row detail_regular_aminities">
                        <h1>Regular amenities</h1>
                        <ul>
                        <?php if($model->amenityies) {
                            foreach($model->amenityies as $amenities) {?>
                            <li><?=$amenities->amenityName->name?></li>
                            <?php }
                            }?>
                            <!-- <li>Swimming Pool</li>
                            <li>Air Conditioned</li>
                            <li>Rain Water Harvesting</li>
                            <li>Gas Pipeline</li>
                            <li>Laundry</li>
                            <li>Jogging Track</li>
                            <li>Park</li>
                            <li>Private Terrace/Garden</li>
                            <li>Intercom</li>
                            <li>Servent Room</li>
                            <li>Conference Room</li>
                            <li>Solar Water Heater </li>
                            <li>DTH Television</li>
                            <li>Video Door Phone</li> -->
                        </ul>
                    </div>
                    <hr class="detail_hr_line2">
                    <div class="row detail_neighbourhood">
                        <h1>Neighbourhood</h1>
                        <div id="map" style="width: 100%; height: 250px" >Your map</div>
                        <!-- <img src="images/map.jpg" class="img-responsive" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--This is body section-->
<br>
<br>

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
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

    ");
?>


<?php //$this->registerJsFile('https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js', [yii\web\JqueryAsset::className()]); ?> 

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