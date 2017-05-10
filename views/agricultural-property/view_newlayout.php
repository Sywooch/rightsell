<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Residentialproperty */

$this->title = $model->property_type." in ".$model->locations->location;
$this->params['breadcrumbs'][] = ['label' => 'agriculturalproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid inner_banner" style="background:#9dc415;">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h1>Get Your Perfect Agricultural  Property</h1>
        </div>
        <div class="col-sm-4"><img src="images/resi_img.png" alt=""></div>
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
      <form action="<?=Url::to(['agricultural-property/index'])?>" method="post">
      <div class="col-sm-2 demo2">
      <select name="available_for">
                <option value="Sale">Buy</option>
                <option>Rent</option>
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
                'options' => ['multiple' => true, 'placeholder' => 'Add more locations ...']
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
                                    <div class="col-sm-8 col-xs-8 gallary_big_photo">
                                        <a href="images/agri_photo1_back.jpg" title="Caption for gallery item 1">
                                            <img src="images/agri_photo1_front.jpg" class="img-responsive" alt="Gallery image 1">
                                            <div class="middle">
                                                <img src="images/zoom.png" class="img-responsive" alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-4 col-xs-4">
                                        <div class="row">
                                            <div class="col-sm-12 gallary_small_photo1" style="margin-bottom:-3px;">
                                                <a href="images/agri_photo1_back.jpg" title="Caption for gallery item 2">
                                                    <img src="images/agri_photo1_front.jpg" class="img-responsive" alt="Gallery image 2">
                                                    <div class="middle2">
                                                        <img src="images/zoom.png" class="img-responsive" alt="">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-12 gallary_small_photo">
                                                <a href="images/agri_photo1_back.jpg" title="Caption for gallery item 3">
                                                    <img src="images/agri_photo1_front.jpg" class="img-responsive" alt="Gallery image 3">
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
                                    <h1><?=$model->property_type." in ".$model->locations->location?></h1>
                                    <p></p>
                                </div>
                                <div class="row detail_body_price">
                                    <ul>
                                        <li>
                                            <span>Builtup</span>
                                            <h1><?=$model->property_area.' '.$model->property_unit?></h1>
                                        </li>
                                        <?php if($model->available_for == "Rent") { ?>
                                        <li>
                                            <span>Rent</span>
                                            <h1>| <i class="fa fa-inr" aria-hidden="true"></i><?= number_format($model->expected_rent_comp)?> |</h1>
                                        </li>
                                        <li>
                                            <span>Deposit</span>
                                            <h1><i class="fa fa-inr" aria-hidden="true"></i><?= number_format($model->deposit_comp)?></h1>
                                        </li>
                                        <?php }?>

                                        <?php if($model->available_for == "Sale") { ?>
                                        <li>
                                            <span>Rate</span>
                                            <h1>| <i class="fa fa-inr" aria-hidden="true"></i><?= number_format($model->expected_rate_comp)?> |</h1>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <div class="row detail_body_detail">
                                    <h1>Overview</h1>
                                    <p>Property at prime location, near by market and school. ideal for family, twenty-four hrs water and security, car park, brokerage applicable. very nice flat, near joyti hotel. This place is a lovely abode for you and your family.</p>
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
                            <li><strong>Ideal For :</strong> <?=$model->ideal_for?> </li>
                            <li><strong>Connectivity : </strong><?=$model->connectivity?> </li>
                        </ul>
                    </div>
                    <hr class="detail_hr_line">
                    <div class="row detail_aminities">
                        <h1>Prime amenities</h1>
                        <ul>
                        <?php if($model->amenityies) {
                            foreach($model->amenityies as $amenities) {?>
                            <li><?=$amenities->amenityName->name?></li>
                            <?php }
                            }?>
                            <!-- <li><img src="images/fensing.png" class="img-responsive" alt="">Fencing</li>
                            <li><img src="images/detail_power_backup.png" style="padding-top:2px;" class="img-responsive" alt="">Electricity supply</li>
                            <li><img src="images/detail_water_supply.png" class="img-responsive" alt="">Water Supply</li>
                            <li><img src="images/compound_wall.png" style="padding-top:1px;" class="img-responsive" alt="">Compound wall</li>
                            
                        </ul> -->
                    </div>
                    <div class="row detail_features_vr">
                    <br>

                        <ul>
                            <li><strong>Electricity Supply :</strong> <?=$model->electric_supply?> </li>
                            <li><strong>Water Supply : </strong><?=$model->water_supply?></li>
                        </ul>
                    </div>
                    <hr class="detail_hr_line2">
                    <div class="row detail_neighbourhood">
                        <h1>Neighbourhood</h1>
                        <div id="map" style="width: 100%; height: 250px" >Your map</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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