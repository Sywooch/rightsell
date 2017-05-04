<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\City;
use app\models\Location;
use app\models\Bhk;
use yii\widgets\ActiveForm;

use \app\models\Residentialproperty;
use \app\models\Commercialproperty;
use \app\models\Agriculturalproperty;
use kartik\select2\Select2;
use yii\web\JsExpression;

$this->title = 'Rightsell';
?>
<?php $host = "103.208.73.2";?>
<section class="bg_white">
  <div class="container">
    <div class="row text-center">
      <h2>We have that every choice of yours with us</h2>
    </div>
  </div>
</section>
<section class="bg_white1">
  <div class="container-fluid">
    <div class="row">
      <div class="container">
        <ul class="nav nav-tabs responsive" id="myTab">
          <li class=" test-class tab1 active"><a href="#resi" class="tab1">
      <p class="resi_img"><img src="images/resi_img.png" class="img-responsive" alt=""></p>
        <h1>Residential<span>Explore</span></h1>
      </a></li>
          <li class=" test-class tab2 "><a class="deco-none tab2" href="#com">
         <p class="comr_img"><img src="images/comer_img.png" class="img-responsive" alt=""></p>
        <h1>Commercial<span>Explore</span></h1>
      </a></li>
          <li class=" test-class tab3 "><a class="deco-none tab3" href="#agri">
        <p class="agri_img"><img src="images/agri_img.png" class="img-responsive" alt=""></p>
        <h1>Agricultural<span>Explore</span></h1>
      </a></li>
        </ul>
      </div>
      <?php //$form = ActiveForm::begin(['action'=>['residential-property/index'],'method' => 'get']); 

$resPropRentLocCount = Residentialproperty::find()
->select(['*, COUNT(location_id) AS cnt'])
->where(["available_for"=>"Rent",'status'=>1,'publish_on_web'=>1])
->groupBy(['location_id'])
->orderBy("cnt desc")
->all();

$resPropSaleLocCount = Residentialproperty::find()
->select(['*, COUNT(location_id) AS cnt'])
->where(["available_for"=>"Sale",'status'=>1,'publish_on_web'=>1])
->groupBy(['location_id'])
->orderBy("cnt desc")
->all();

$commPropLocCount = Commercialproperty::find()
->select(['*, COUNT(location_id) AS cnt'])
->where(['status'=>1,'publish_on_web'=>1])
->groupBy(['location_id'])
->orderBy("cnt desc")
->all();


$agriPropLocCount = Agriculturalproperty::find()
->select(['*, COUNT(location_id) AS cnt'])
->where(['status'=>1,'publish_on_web'=>1])
->groupBy(['location_id'])
->orderBy("cnt desc")
->all();



$residentialPropertiesforRentArr = [];
$residentialPropertiesforSaleArr = [];
$commercialPropertiesArr = [];
$agriculturalPropertiesArr = [];
foreach ($resPropRentLocCount as $respropCnt) {
  
  $residentialPropertiesforRentArr[$respropCnt->location_id] = Residentialproperty::find()->where(["available_for"=>"Rent",'status'=>1,'publish_on_web'=>1,'location_id'=> $respropCnt->location_id])->orderBy("added_on desc")->limit(20)->all();
}

foreach ($resPropSaleLocCount as $respropCnt) {
  
  $residentialPropertiesforSaleArr[$respropCnt->location_id] = $residentialPropertiesforSale = Residentialproperty::find()->where(["available_for"=>"Sale",'status'=>1,'publish_on_web'=>1,'location_id'=> $respropCnt->location_id])->orderBy("added_on desc")->limit(20)->all();
}

foreach ($commPropLocCount as $respropCnt) {
  
  $commercialPropertiesArr[$respropCnt->location_id] = $residentialPropertiesforSale = Commercialproperty::find()->where(['status'=>1,'publish_on_web'=>1,'location_id'=> $respropCnt->location_id])->orderBy("added_on desc")->limit(20)->all();
}

foreach ($agriPropLocCount as $respropCnt) {
  
  $agriculturalPropertiesArr[$respropCnt->location_id] = $residentialPropertiesforSale = Agriculturalproperty::find()->where(['status'=>1,'publish_on_web'=>1,'location_id'=> $respropCnt->location_id])->orderBy("added_on desc")->limit(20)->all();
}
//echo "<pre>"; print_r($residentialPropertiesforSaleArr);exit;
//$residentialPropertiesforRent = \app\models\Residentialproperty::find()->where(["available_for"=>"Rent",'status'=>1,'publish_on_web'=>1])->orderBy("added_on desc")->limit(2)->all();

//$residentialPropertiesforSale = \app\models\Residentialproperty::find()->where(["available_for"=>"Sale",'status'=>1,'publish_on_web'=>1])->orderBy("added_on desc")->limit(20)->all();

//$commercialProperties = \app\models\Commercialproperty::find()->where(['status'=>1,'publish_on_web'=>1])->orderBy("added_on desc")->limit(20)->all();

//$agriculturalProperties = \app\models\Agriculturalproperty::find()->where(['status'=>1,'publish_on_web'=>1])->orderBy("added_on desc")->limit(20)->all();


$citydata = City::find()
    ->select(['city as value', 'city as  label','id as id'])
    ->asArray()
    ->all();

$locationdata = Location::find()
    ->select(['location as value', 'location as  label','id as id'])
    ->asArray()
    ->all();
//echo "<pre>"; print_r($citydata); print_r($locationdata); exit;
    ?>

    
      <div class="tab-content responsive">
        <div class="tab-pane active hot_property_resi" id="resi">
        <?php 

        $model = new \app\models\ResidentialpropertySearch();
        $form = ActiveForm::begin(['action'=>['residential-property/index'],'method'=>"get","id"=>"homerespropform"]);
        
        //echo $form->field($model, 'available_for')->hiddenInput()->label(false);
        //echo $form->field($model, 'location_id[]')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        ?> 
          <section class="rent_residentialprop">
            <div class="container">
              <div class="row text-center">
                <h2 class="rb_text_h1">
                <!-- <a href="#." id="homerad_avaiblefor_rent" class="rb_text">Rent</a>  |  <a href="#." class="rb_text" id="homerad_avaiblefor_buy">Buy</a>  |  <a href="#." id="homerad_avaiblefor_flatmate" class="rb_text">Flatmate</a> -->
                  <?= $form->field($model, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Sale','Flatmate'=>'Flatmate'],
                        [
                                'item' => function($index, $label, $name, $checked, $value) {
                                    if($checked)
                                    {
                                    $return = '<label for="" class="radio_text_active">';
                                    }
                                    else
                                    $return = '<label for="" class="radio_text">';


                                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>' . ucwords($label) . ' | </span>';
                                    $return .= '</label>';

                                    return $return;
                                }
                            ])->label(false);?>

                </h2>
              </div>
              <div class="dd_row">
                <ul class="">
                <li class="demo_home">
                <table class="dd_table">
                  <tr><td><img src="images/location_30km.png" class="img-responsive" alt="">
                  </td><td><?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(City::find()->where(['status'=>1])->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi ", 'required'=>true])->label(false);?></td></tr>
                </table>
                  <!-- <div class="dropdown">
                  <div id="" class="dd wrapper-dropdown-3 dd_resi_city" tabindex="1">
                    <span>Select City</span>
                    <ul class="dropdown" style="width:200px;">
                    <?php //foreach ($citydata as $city) {
                      //echo "<li><a href='".$city['id']."'>".$city['value']."</a></li>";
                    //}?>
                    </ul>
                </div>
                </div> -->
              </li>
          <li>
          <?php //$form->field($model, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>

          <?php 

          echo $form->field($model, 'locationname')->widget(Select2::classname(), [
    'options' => ['placeholder' => 'Select Area ...',"class"=>"auto_search_bar"],
    'size' => Select2::MEDIUM,
    'theme' => Select2::THEME_BOOTSTRAP,
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true,
    'ajax' => [
        'url' => \yii\helpers\Url::to(['residential-property/city-list']),
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {q:params.term}; }')
    ],
    ],
])->label(false);

          ?>
          <!-- <div class="dropdown">
          <div id="" class="dd2 dd_resi2" tabindex="1" style="width:450px; padding:0px 33px; border:1px solid #a5a5a5">
          <input name="" class="form-control" type="text" style="border:0; width:100%; background:#f3f3f3; height:32px; margin:0" placeholder="Search Area" id="filterIndex_locationname">
          </div>
          </div> --></li>
          <li>
<?php // $form->field($model, 'bhk')->dropdownList(ArrayHelper::map(Bhk::find()->where(['status'=>1])->orderBy("name asc")->all(),"id","name"),['class'=>"dd wrapper-dropdown-3 dd_resi",'multiple'=>true,'id'=>"homeresbhkfilter"])->label(false);?>
<?php
// echo $form->field($model, 'bhk')->widget(Select2::classname(), [
//     'options' => ['placeholder' => 'Select BHK',"class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"],
//     'size' => Select2::MEDIUM,
//     'theme' => Select2::THEME_BOOTSTRAP,
//     'pluginOptions' => [
//         'allowClear' => true,
//         'multiple' => true,
//     ],
//     'data'=>[1=>'1 BHK',2=>'2 BHK',3=>'3 BHK',4=>'4 BHK',5=>'5 BHK'],
// ])->label(false);

?>
<select id="bhk" name="bhk[]" multiple="multiple">
        <option value="1">1 BHK</option>
        <option value="2">2 BHK</option>
        <option value="3">3 BHK</option>
        <option value="4">4 BHK</option>
        <option value="5">5 BHK</option>

    </select>
<input type="hidden" name="home" value="1"/>
          <!-- <div class="dropdown">
                    <div id="dd" class="wrapper-dropdown-4 dd_resi3" tabindex="1">
            <span>Select BHK</span>
            <ul class="dropdown" style="width:200px; padding:0">
              <li><input type="checkbox" id="el-1" name="el-1" value="donut"><label for="el-1">1 BHK</label></li>
              <li><input type="checkbox" id="el-2" name="el-2" value="neighbour"><label for="el-2">2 BHK</label></li>
              <li><input type="checkbox" id="el-3" name="el-3" value="T-rex"><label for="el-3">3 BHK</label></li>
              <li><input type="checkbox" id="el-3" name="el-3" value="T-rex"><label for="el-3">5 BHK</label></li>
  
            </ul>
          </div>
                  </div> --></li>
          <li>
          <?= $form->field($model, 'min_rate_price')->dropdownList(["10"=>"10 lacs - 20 lacs","20"=>"20 lacs - 30 lacs","30"=>"30 lacs - 40 lacs"],['prompt'=>"Select Budget",'class'=>"dd wrapper-dropdown-3 dd_resi",'id'=>"homeresmin_rate_pricefilter"])->label(false);?>
          <!-- <div class="dropdown">
          <div id="" class="dd4 wrapper-dropdown-3 dd_resi4" tabindex="1">
          <span>Select Budget</span>
          <ul class="dropdown" style="width:200px;">
          <li><a href="#">10 Lac - 20 Lac</a></li>
          <li><a href="#">20 Lac - 30 Lac</a></li>
          <li><a href="#">40 Lac - 80 Lac</a></li>
          <li><a href="#">80 Lac - 1 Cr.</a></li>
          </ul>
          </div>
          </div> --></li>
        </ul>
               
              </div>
            </div>
          </section>
          
          <section class="business_place">
            <div class="container">
              <div class="row text-center">
                <div class="col-md-12 col-sm-12">
                  <button type="submit" class="btn btn-danger">Get a Dream Home</button>
                </div>
              </div>
            </div>
          </section>
          <?php ActiveForm::end(); ?>
          <section class="hot_property_resi_padding">
            <div class="container">
              <div class="row text-center">
                <div class="col-md-12 col-sm-12">
                  <h2>Hot Properties</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-sm-6 nopadding nomargin">
                  <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#Hot_properties_for_rent" data-toggle="tab">Hot Properties for Rent</a></li>
                    <li><a href="#Hot_properties_to_buy" data-toggle="tab">Hot Properties to Buy</a></li>
                    <li><a href="#Hot_Commercial_Properties" data-toggle="tab">Hot Commercial Properties</a></li>
                    <li><a href="#Your_Agricultural_Farms" data-toggle="tab">Your Agricultural Farms</a></li>
                  </ul>
                </div>
                <div class="col-md-9 col-sm-12 nopadding ">
                  <div class="tab-content">
                    <div class="tab-pane active" id="Hot_properties_for_rent">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                          <?php 
                          $i=0;
                          foreach ($resPropRentLocCount as $rpc) {
                            $cls = "";
                            if($i== 0)
                            {
                              $cls = "active";
                              $i++;
                            }
                              ?>
                            <li class="<?=$cls?>"><a href="#rprent_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab"><?=trim($rpc->locations->location)?></a></li>
                          <?php } ?>
                            <!-- <li class="active"><a href="#Undri" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud" data-toggle="tab">Kothrud</a></li>
                            <li><a href="#Khadaki" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar" data-toggle="tab">Karve Nagar</a></li> -->
                          </ul>
                        </div>
                        <div class="col-md-9 nopadding">
                          <div class="tab-content">
                          <?php 
                              foreach ($resPropRentLocCount as $respropCnt) {?>
                            <div class="tab-pane active" id="rprent_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                              <div class="scroll-pane">
                              <?php 
                              foreach ($residentialPropertiesforRentArr[$respropCnt->location_id] as $resprop) {?>
                <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
        <h1><?= $resprop->bhks->name.", Near ".$resprop->locations->location?></h1>
        <button class="button yellow_btn"><?=$resprop->bhks->name?></button>
        <button class="button orrange_btn">Rent <?= number_format($resprop->expected_rent_comp)?></button>
        <button class="button yellow_btn">Deposit <?= number_format($resprop->deposit_comp)?></button>
        <div class="row">
          <div class="col-xs-6"><p><img src="images/family.png" alt=""><?= $resprop->preferred_tenants?></p></div>
          <div class="col-xs-6"><p><img src="images/car.png" alt="">Parking - <?=$resprop->no_of_parking?$resprop->no_of_parking:"No"?></p></div>
        </div>  
          <div class="row">
          <div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?= $resprop->builtup_area. " ". $resprop->builtup_unit ?></p></div>
          <div class="col-xs-6"><p><img src="images/furnished.png" alt=""><?php
          if($resprop->furnished == "FF") 
            echo "Fully Furnished"; 
          else if($resprop->furnished == "UN")
            echo "Non Furnished";
          else if($resprop->furnished == "SF")
            echo "Semi-Furnished";

          
        $now = time(); // or your date as well
        $your_date = strtotime($resprop->added_on);
        $datediff = $now - $your_date;

        $days = floor($datediff / (60 * 60 * 24));
        $from=date_create(date('Y-m-d'));
        $to=date_create($resprop->added_on);
        $diff=date_diff($to,$from);
        
          ?></p></div>
          <div class="col-xs-12"><strong>Status:</strong> This property <?=$diff->format('%a days');?> old</div>
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
      <div class="col-sm-2"></div>
    </div>
    <?php }?>
                              
                </div>
                            </div>
<?php }?>
                            <div class="tab-pane" id="Loni">
                  
                  
                            </div>
                            <div class="tab-pane" id="Wagholi">
                              
                  
                            </div>
                            <div class="tab-pane" id="Kharadi">
                              
                            </div>
                            <div class="tab-pane" id="Kondhwa">
                            
                            </div>
                            <div class="tab-pane" id="Aundh">
                              
                            </div>
                            <div class="tab-pane" id="Koregao_park">
                              
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar">
                              
                            </div>
                            <div class="tab-pane" id="Khadaki">
                              
                            </div>
                            <div class="tab-pane" id="Hadapsar">
                            
                            </div>
                            <div class="tab-pane" id="Karve_Nagar">
                            
                            </div>
                            <div class="tab-pane" id="Kothrud">
                            
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Hot_properties_to_buy">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                          <?php 
                          $i=0;
                          foreach ($resPropSaleLocCount as $rpc) {
                            $cls = "";
                            if($i== 0)
                            {
                              $cls = "active";
                              $i++;
                            }
                              ?>
                            <li class="<?=$cls?>"><a href="#rpsale_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab"><?=trim($rpc->locations->location)?></a></li>
                          <?php } ?>
                            <!-- <li class="active"><a href="#Undri_2" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_2" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_2" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_2" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_2" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_2" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_2" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_2" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_2" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_2" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_2" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_2" data-toggle="tab">Kothrud</a></li> -->
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                          <?php foreach ($resPropSaleLocCount as $respropCnt) {?>
                            <div class="tab-pane active" id="rpsale_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">

                            <?php 
                              //echo "<pre>"; print_r($residentialProperties);exit;
                              foreach ($residentialPropertiesforSaleArr[$respropCnt->location_id] as $resprop) {?>
                <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <?php
          $images = json_decode($resprop->gallery_images);
        if(count($images) >0)
        {
          foreach ($images as $image) {
            echo "<div class='item'>";
            echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/RealEstateCrm/files/commercialProperty/galleryimages/".$resprop->id."_galleryimages_".$image."' alt=''/>";
            echo "</div>";
          }
        }
        else 
          echo '<div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>';
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
        <div class="row home_pro_detail">
        <h1><?= $resprop->bhks->name.", Near ".$resprop->locations->location?></h1>
        <button class="button yellow_btn"><?= $resprop->bhks->name?></button>
        <button class="button orrange_btn">Rate <?= number_format($resprop->expected_rate_comp)?></button>
        
        <div class="row">
          <div class="col-xs-6"><p><img src="images/family.png" alt=""><?= $resprop->preferred_tenants?></p></div>
          <div class="col-xs-6"><p><img src="images/car.png" alt="">Parking - <?=$resprop->no_of_parking?$resprop->no_of_parking:"No"?></p></div>
        </div>  
          <div class="row">
          <div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?= $resprop->builtup_area. " ". $resprop->builtup_unit ?></p></div>
          <div class="col-xs-6"><p><img src="images/furnished.png" alt=""><?php
          if($resprop->furnished == "FF") 
            echo "Fully Furnished"; 
          else if($resprop->furnished == "UN")
            echo "Non Furnished";
          else if($resprop->furnished == "SF")
            echo "Semi-Furnished";

          
        $now = time(); // or your date as well
        $your_date = strtotime($resprop->added_on);
        $datediff = $now - $your_date;

        $days = floor($datediff / (60 * 60 * 24));
        $from=date_create(date('Y-m-d'));
        $to=date_create($resprop->added_on);
        $diff=date_diff($to,$from);
        
          ?></p></div>
          <div class="col-xs-12"><strong>Status:</strong> This property <?=$diff->format('%a days');?> old</div>
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
      <div class="col-sm-2"></div>
    </div>
    <?php }?>
                              
                            </div>
                            <?php }?>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Hot_Commercial_Properties">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                          <?php 
                          $i=0;
                          foreach ($commPropLocCount as $rpc) {
                            $cls = "";
                            if($i== 0)
                            {
                              $cls = "active";
                              $i++;
                            }
                              ?>
                            <li class="<?=$cls?>"><a href="#comm_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab"><?=trim($rpc->locations->location)?></a></li>
                          <?php } ?>

                            <!-- <li class="active"><a href="#Undri_3" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_3" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_3" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_3" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_3" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_3" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_3" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_3" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_3" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_3" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_3" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_3" data-toggle="tab">Kothrud</a></li> -->
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                          <?php foreach ($commPropLocCount as $respropCnt) {?>
                            <div class="tab-pane active" id="comm_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                              <?php 
                              //echo "<pre>"; print_r($residentialProperties);exit;
                              foreach ($commercialPropertiesArr[$respropCnt->location_id] as $model) {?>
                <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <?php
          $images = json_decode($model->gallery_images);
        if(count($images) >0)
        {
          foreach ($images as $image) {
            echo "<div class='item'>";
            echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/RealEstateCrm/files/commercialProperty/galleryimages/".$model->id."_galleryimages_".$image."' alt=''/>";
            echo "</div>";
          }
        }
        else 
          echo '<div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>';
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
        <div class="row home_pro_detail">
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
        <div class="col-xs-6"><p><img src="images/shop.jpg" alt=""><?=$model->type?ucfirst($model->type):"Any"?></p></div>
        <div class="col-xs-6">
        <p><img src="images/car.png" alt="">Parking - Four wheeler:<?=$model->four_wheeler_parking?$model->four_wheeler_parking:"0"?> Two wheeler: <?=$model->two_wheeler_parking?$model->two_wheeler_parking:"0"?> Lift: <?=$model->lift_facility?$model->lift_facility:"0"?></p>
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
      <div class="col-sm-2"></div>
    </div>
    <?php }?>
                            </div>
                            <?php }?>
                            <div class="tab-pane" id="Loni_3">
                              
                            </div>
                            <div class="tab-pane" id="Wagholi_3">
                              
                            </div>
                            <div class="tab-pane" id="Kharadi_3">
                            </div>
                            <div class="tab-pane" id="Kondhwa_3">

                            </div>
                            <div class="tab-pane" id="Aundh_3">
                            </div>
                            <div class="tab-pane" id="Koregao_park_3">
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_3">
                            </div>
                            <div class="tab-pane" id="Khadaki_3">
                            </div>
                            <div class="tab-pane" id="Hadapsar_3">
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_3">
                            </div>
                            <div class="tab-pane" id="Kothrud_3">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Your_Agricultural_Farms">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                          <?php 
                          $i=0;
                          foreach ($agriPropLocCount as $rpc) {
                            $cls = "";
                            if($i== 0)
                            {
                              $cls = "active";
                              $i++;
                            }
                              ?>
                            <li class="<?=$cls?>"><a href="#agri_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab"><?=trim($rpc->locations->location)?></a></li>
                          <?php } ?>

                            <!-- <li class="active"><a href="#Undri_4" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_4" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_4" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_4" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_4" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_4" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_4" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_4" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_4" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_4" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_4" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_4" data-toggle="tab">Kothrud</a></li> -->
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                          <?php foreach ($agriPropLocCount as $respropCnt) {?>
                            <div class="tab-pane active" id="agri_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                              <?php 
                              //echo "<pre>"; print_r($residentialProperties);exit;
                              foreach ($agriculturalPropertiesArr[$respropCnt->location_id] as $model) {?>
                <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <?php
          $images = json_decode($model->gallery_images);
        if(count($images) >0)
        {
          foreach ($images as $image) {
            echo "<div class='item'>";
            echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/RealEstateCrm/files/commercialProperty/galleryimages/".$model->id."_galleryimages_".$image."' alt=''/>";
            echo "</div>";
          }
        }
        else 
          echo '<div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>';
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
        <div class="row home_pro_detail">
        <h1><?= $model->property_type?> Near <?= $model->locations->location?>.</h1>
      <button class="button yellow_btn"><?= $model->property_type?></button>
      <?php if(strtolower($model->available_for)=="rent"):?>
      <button class="button orrange_btn">Rent <?=number_format($model->expected_rent_comp);?></button>
      <button class="button yellow_btn">Deposit <?=number_format($model->deposit_comp)?></button>
      <?php endif;?>

      <?php if(strtolower($model->available_for)=="sale"):?>
      <button class="button orrange_btn">Rate <?=number_format($model->expected_rate_comp);?></button>
      <?php endif;?>

      
      <div class="row">
        <div class="col-xs-6"><p><img src="images/family.png" alt=""><?=$model->ideal_for?ucfirst($model->ideal_for):"Anyone"?></p></div>
        <div class="col-xs-6">
        <p><img src="images/water.jpg" alt=""><?=$model->water_supply=="Yes"?"Water Available":"No water"?></p>
        </div>
      </div>  
      <div class="row">
        <div class="col-xs-6"><p><img src="images/area.png" alt="">Area - <?=$model->property_area.' '.$model->property_unit?></p></div>
        
        <div class="col-xs-6"><p><img src="images/loc.jpg" alt="">30 Km from city</p></div>
        
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
      <div class="col-sm-2"></div>
    </div>
    <?php }?>
                            </div>

                            <?php }?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="tab-pane hot_property" id="com">
          <section class="rent_commercialprop">
          <?php 

        $model = new \app\models\CommercialpropertySearch();
        $form = ActiveForm::begin(['action'=>['commercial-property/indexhome'],'method'=>"get"]);
        
        //echo $form->field($model, 'available_for')->hiddenInput()->label(false);
        echo $form->field($model, 'location_id')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        ?> 
            <div class="container">
              <div class="row text-center">
               <h2 class="rb_text_h1">
               <!-- <a href="#." class="rb_text">Rent</a>  |  <a href="#." class="rb_text active">Buy</a> -->
                 <?= $form->field($model, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Sale'])->label(false);?>
               </h2>
              </div>
              <div class=" dd_row">
        <ul class="">
          <li><?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(City::find()->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?><!-- <div class="dropdown">
          <div id="" class="dd wrapper-dropdown-3 dd_comm_city" tabindex="1">
          <span>Select City</span>
          <ul class="dropdown" style="width:200px;">
          <li><a href="#">Pune</a></li>
          <li><a href="#">Mumbai</a></li>
          <li><a href="#">Thane</a></li>
          <li><a href="#">Nashik</a></li>
          <li><a href="#">Nagpur</a></li>
          <li><a href="#">Solapur</a></li>
          </ul>
          </div>
          </div> --></li>
          <li><?= $form->field($model, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?><!-- <div class="dropdown">
          <div id="" class="dd2 dd_resi2" tabindex="1" style="width:450px; padding:0px 33px; border:1px solid #a5a5a5">
          <input name="" class="form-control" type="text" style="border:0; width:100%; background:#f3f3f3; height:32px; margin:0" placeholder="Search Area">
          </div>
          </div> --></li>
          <li><?= $form->field($model, 'type')->dropdownList(['Shop'=>'Shop','Showroom'=>'Showroom','Office'=>'Office','Warehouse'=>'Warehouse','Industrial Shed'=>'Industrial Shed','Godown'=>'Godown','Hotel'=>'Hotel'],['prompt'=>"Select Property Type",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>
          <!-- <div class="dropdown">
                    <div id="dd" class="wrapper-dropdown-4 dd_resi3" tabindex="1">
            <span>Select BHK</span>
            <ul class="dropdown" style="width:200px; padding:0">
              <li><input type="checkbox" id="el-1" name="el-1" value="donut"><label for="el-1">1 BHK</label></li>
              <li><input type="checkbox" id="el-2" name="el-2" value="neighbour"><label for="el-2">2 BHK</label></li>
              <li><input type="checkbox" id="el-3" name="el-3" value="T-rex"><label for="el-3">3 BHK</label></li>
              <li><input type="checkbox" id="el-3" name="el-3" value="T-rex"><label for="el-3">5 BHK</label></li>
  
            </ul>
          </div>
                  </div> --></li>
          <li><?= $form->field($model, 'min_rate_price')->dropdownList(["10"=>"10 lacs - 20 lacs","20"=>"20 lacs - 30 lacs","30"=>"30 lacs - 40 lacs"],['prompt'=>"Select Budget",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?><!-- <div class="dropdown">
          <div id="" class="dd4 wrapper-dropdown-3 dd_resi4" tabindex="1">
          <span>Select Budget</span>
          <ul class="dropdown" style="width:200px;">
          <li><a href="#">10 Lac - 20 Lac</a></li>
          <li><a href="#">20 Lac - 30 Lac</a></li>
          <li><a href="#">40 Lac - 80 Lac</a></li>
          <li><a href="#">80 Lac - 1 Cr.</a></li>
          </ul>
          </div>
          </div> --></li>
        </ul>
               
              </div>
            </div>
          </section>
          <section class="business_place">
            <div class="container">
              <div class="row text-center">
                <div class="col-md-12 col-sm-12">
                  <button type="submit" class="btn btn-danger">Get a Business place</button>
                </div>
              </div>
            </div>
          </section>
          <?php ActiveForm::end(); ?>
          <section class="hot_property_padding">
            <div class="container">
              <div class="row text-center">
                <div class="col-md-12 col-sm-12">
                  <h2>Hot Properties</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-sm-6 nopadding nomargin">
                  <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#Hot_properties_for_rent" data-toggle="tab">Hot Properties for Rent</a></li>
                    <li><a href="#Hot_properties_to_buy" data-toggle="tab">Hot Properties to Buy</a></li>
                    <li><a href="#Hot_Commercial_Properties" data-toggle="tab">Hot Commercial Properties</a></li>
                    <li><a href="#Your_Agricultural_Farms" data-toggle="tab">Your Agricultural Farms</a></li>
                  </ul>
                </div>
                <div class="col-md-9 col-sm-12 nopadding ">
                  <div class="tab-content">
                    <div class="tab-pane active" id="Hot_properties_for_rent">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud" data-toggle="tab">Kothrud</a></li>
              <li><a href="#Khadaki" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar" data-toggle="tab">Karve Nagar</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9 nopadding">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri">
                <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                              <div class="row  home_pro_box home_pro_box_2">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Loni">
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Wagholi">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kharadi">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Aundh">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Khadaki">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kothrud">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Hot_properties_to_buy">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri_2" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_2" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_2" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_2" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_2" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_2" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_2" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_2" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_2" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_2" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_2" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_2" data-toggle="tab">Kothrud</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Undri Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Loni_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Loni Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Wagholi_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Wagholi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kharadi_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kharadi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kondhwa Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Aundh_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Aundh Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Koregao_park Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kalyani_nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Khadaki_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Khadaki Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Hadapsar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Karve_Nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kothrud_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kothrud Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Hot_Commercial_Properties">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri_3" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_3" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_3" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_3" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_3" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_3" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_3" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_3" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_3" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_3" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_3" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_3" data-toggle="tab">Kothrud</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Undri Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Loni_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Loni Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Wagholi_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Wagholi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kharadi_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kharadi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kondhwa Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Aundh_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Aundh Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Koregao_park Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kalyani_nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Khadaki_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Khadaki Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Hadapsar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Karve_Nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kothrud_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kothrud Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Your_Agricultural_Farms">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri_4" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_4" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_4" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_4" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_4" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_4" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_4" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_4" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_4" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_4" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_4" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_4" data-toggle="tab">Kothrud</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Undri Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Loni_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Loni Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Wagholi_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Wagholi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kharadi_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kharadi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kondhwa Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Aundh_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Aundh Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Koregao_park Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kalyani_nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Khadaki_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Khadaki Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Hadapsar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Karve_Nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kothrud_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kothrud Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>


                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="tab-pane hot_property_agri" id="agri">
          <section class="rent_agriculturalprop">
          <?php 

        $modelagri = new \app\models\AgriculturalpropertySearch();
        $form = ActiveForm::begin(['action'=>['agricultural-property/indexhome'],'method'=>"get"]);
        
        //echo $form->field($model, 'available_for')->hiddenInput()->label(false);
        echo $form->field($modelagri, 'location_id')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        ?> 
            <div class="container">
              <div class="row text-center">
              

                <h2 class="rb_text_h1">
                <?= $form->field($modelagri, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Buy','Lease'=>'Lease'])->label(false);?>
                <!-- <a href="#." class="rb_text active">Rent</a>  |  <a href="#." class="rb_text">Buy</a> | <a href="#." class="rb_text">Lease</a> --></h2>
              </div>
              <div class=" dd_row">
        <ul class="">
          <li>
<?= $form->field($modelagri, 'city_id')->dropdownList(ArrayHelper::map(City::find()->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>
<!-- <div class="dropdown">
          <div id="" class="dd wrapper-dropdown-3 dd_agri_city" tabindex="1">
          <span>Select City</span>
          <ul class="dropdown" style="width:200px;">

    
          <li><a href="#">Pune</a></li>
          <li><a href="#">Mumbai</a></li>
          <li><a href="#">Thane</a></li>
          <li><a href="#">Nashik</a></li>
          <li><a href="#">Nagpur</a></li>
          <li><a href="#">Solapur</a></li>
          </ul>
          </div>
          </div> --></li>
          <li><?= $form->field($modelagri, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>
<!-- <div class="dropdown">
          <div id="" class="dd2 dd_resi2" tabindex="1" style="width:450px; padding:0px 33px; border:1px solid #a5a5a5">
          <input name="" class="form-control" type="text" style="border:0; width:100%; background:#f3f3f3; height:32px; margin:0" placeholder="Search Area">
          </div>
          </div> --></li>
          <li><?= $form->field($modelagri, 'property_type')->dropdownList(['Agricultural land'=>'Agricultural land','Industrial land'=>'Industrial land','NA plots'=>'NA plots','Farm house plot'=>'Farm house plot'],['prompt'=>"Select Property Type",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>
          <!-- <div class="dropdown">
                    <div id="dd" class="wrapper-dropdown-4 dd_resi3" tabindex="1">
            <span>Select BHK</span>
            <ul class="dropdown" style="width:200px; padding:0">
              <li><input type="checkbox" id="el-1" name="el-1" value="donut"><label for="el-1">1 BHK</label></li>
              <li><input type="checkbox" id="el-2" name="el-2" value="neighbour"><label for="el-2">2 BHK</label></li>
              <li><input type="checkbox" id="el-3" name="el-3" value="T-rex"><label for="el-3">3 BHK</label></li>
              <li><input type="checkbox" id="el-3" name="el-3" value="T-rex"><label for="el-3">5 BHK</label></li>
  
            </ul>
          </div>
                  </div> --></li>
          <li>


<?= $form->field($modelagri, 'min_rate_price')->dropdownList(["10"=>"10 lacs - 20 lacs","20"=>"20 lacs - 30 lacs","30"=>"30 lacs - 40 lacs"],['prompt'=>"Select Budget",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>
<div class="dropdown">
          <!-- <div id="" class="dd4 wrapper-dropdown-3 dd_resi4" tabindex="1">
          <span>Select Budget</span>
          <ul class="dropdown" style="width:200px;">
          <li><a href="#">10 Lac - 20 Lac</a></li>
          <li><a href="#">20 Lac - 30 Lac</a></li>
          <li><a href="#">40 Lac - 80 Lac</a></li>
          <li><a href="#">80 Lac - 1 Cr.</a></li>
          </ul>
          </div>
          </div> --></li>
        </ul>
               
              </div>
            </div>
          </section>
          

          <section class="business_place">
            <div class="container">
              <div class="row text-center">
                <div class="col-md-12 col-sm-12">
                  <button type="submit" class="btn btn-danger">Get a Farm</button>
                </div>
              </div>
            </div>
          </section>
          <?php ActiveForm::end(); ?>
          <section class="hot_property_agri_padding">
            <div class="container">
              <div class="row text-center">
                <div class="col-md-12 col-sm-12">
                  <h2>Hot Properties</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-sm-6 nopadding nomargin">
                  <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#Hot_properties_for_rent" data-toggle="tab">Hot Properties for Rent</a></li>
                    <li><a href="#Hot_properties_to_buy" data-toggle="tab">Hot Properties to Buy</a></li>
                    <li><a href="#Hot_Commercial_Properties" data-toggle="tab">Hot Commercial Properties</a></li>
                    <li><a href="#Your_Agricultural_Farms" data-toggle="tab">Your Agricultural Farms</a></li>
                  </ul>
                </div>
                <div class="col-md-9 col-sm-12 nopadding ">
                  <div class="tab-content">
                    <div class="tab-pane active" id="Hot_properties_for_rent">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud" data-toggle="tab">Kothrud</a></li>
              <li><a href="#Khadaki" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar" data-toggle="tab">Karve Nagar</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9 nopadding">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri">
                <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                              <div class="row  home_pro_box home_pro_box_2">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Loni">
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Wagholi">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kharadi">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Aundh">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Khadaki">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                            <div class="tab-pane" id="Kothrud">
                              <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
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
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                  <div class="row home_pro_box">
      <div class="col-sm-5 nopadding">
        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          <div class="item">
            <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>
          </div>
          <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-sm-7">
        <div class="row home_pro_detail">
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
      <div class="col-sm-2"></div>
    </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Hot_properties_to_buy">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri_2" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_2" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_2" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_2" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_2" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_2" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_2" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_2" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_2" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_2" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_2" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_2" data-toggle="tab">Kothrud</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Undri Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Loni_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Loni Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Wagholi_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Wagholi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kharadi_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kharadi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kondhwa Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>

                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Aundh_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Aundh Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Koregao_park Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kalyani_nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Khadaki_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Khadaki Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Hadapsar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Karve_Nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kothrud_2">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kothrud Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Hot_Commercial_Properties">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri_3" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_3" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_3" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_3" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_3" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_3" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_3" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_3" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_3" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_3" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_3" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_3" data-toggle="tab">Kothrud</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Undri Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>

                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Loni_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Loni Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Wagholi_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Wagholi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kharadi_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kharadi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kondhwa Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Aundh_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Aundh Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>

                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Koregao_park Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kalyani_nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Khadaki_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Khadaki Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Hadapsar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Karve_Nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kothrud_3">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kothrud Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Your_Agricultural_Farms">
                      <div class="row">
                        <div class="col-md-3 nomargin nopadding">
                          <ul class="nav nav-tabs area_tabs">
                            <li class="active"><a href="#Undri_4" data-toggle="tab">Undri</a></li>
                            <li><a href="#Loni_4" data-toggle="tab">Loni</a></li>
                            <li><a href="#Wagholi_4" data-toggle="tab">Wagholi</a></li>
                            <li><a href="#Kharadi_4" data-toggle="tab">Kharadi</a></li>
                            <li><a href="#Kondhwa_4" data-toggle="tab">Kondhwa</a></li>
                            <li><a href="#Aundh_4" data-toggle="tab">Aundh</a></li>
                            <li><a href="#Koregao_park_4" data-toggle="tab">Koregao park</a></li>
                            <li><a href="#Kalyani_nagar_4" data-toggle="tab">Kalyani nagar</a></li>
                            <li><a href="#Khadaki_4" data-toggle="tab">Khadaki</a></li>
                            <li><a href="#Hadapsar_4" data-toggle="tab">Hadapsar</a></li>
                            <li><a href="#Karve_Nagar_4" data-toggle="tab">Karve Nagar</a></li>
                            <li><a href="#Kothrud_4" data-toggle="tab">Kothrud</a></li>
                          </ul>
                        </div>
                        <div class="col-md-9">
                          <div class="tab-content">
                            <div class="tab-pane active" id="Undri_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Undri Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Loni_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Loni Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Wagholi_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Wagholi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">

                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kharadi_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kharadi Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kondhwa_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kondhwa Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Aundh_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Aundh Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Koregao_park_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Koregao_park Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kalyani_nagar_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kalyani_nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Khadaki_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Khadaki Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Hadapsar_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Hadapsar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Karve_Nagar_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Karve_Nagar Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane" id="Kothrud_4">
                              <div class="row back5">
                                <div class="col-md-4 col-sm-6">
                                  <!-- <img src="images/img1.jpg" width="100%"/> -->
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image1.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image3.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6">Kothrud Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>


                                  <div class="add2">
                                    <button class="button button1">1BHK </button>
                                    <button class="button button2">Rent 12,000</button>
                                    <button class="button button1">Deposit 30,000</button>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                              <div class="row back6">
                                <div class="col-md-4 col-sm-6">
                                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
                                      <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                      <div class="item active"> <img src="images/image3.jpg" alt="Chania"> </div>
                                      <div class="item"> <img src="images/image1.jpg" alt="Chania"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                                </div>
                                <div class="col-md-8 mall col-sm-6"> Kanchanganga Apatment, Near Kinara hotel, Kothrud.<br/>
                                  <button class="button button1">1BHK </button>
                                  <button class="button button2">Rent 12,000</button>
                                  <button class="button button1">Deposit 30,000</button>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/family.png"/> Family only </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car.png"/> Car parking </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/select_area.png"/> Area - 600 Sq.Ft. </div>
                                    <div class="col-md-4 col-sm-6 add3"> <img src="images/car1.png"/> Un-furnished </div>
                                  </div>
                                  <div class="add">
                                    <input type="checkbox" name="vehicle" value="Bike">
                                    Add to compare<br>
                                  </div>
                                  <div>
                                    <button class="button button3">Get Details</button>
                                    <button class="button button3">Compare</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="ups">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12 col-sm-12">
        <h1>Our USPs</h1>
        <p>It’s always better to be specific.. when it comes to a home</p>
      </div>
    </div>
    <div class="row text-center ups1">
      <div class="col-md-2 col-md-offset-1 col-sm-12"> <img src="images/expert.png"/>
        <h3>Expert Guidance</h3>
      </div>
      <div class="col-md-2 col-sm-12"> <img src="images/buyer.png"/>
        <h3>Buyer’s Trust</h3>
      </div>
      <div class="col-md-2 col-sm-12"> <img src="images/ample.png"/>
        <h3>Ample Properties</h3>
      </div>
      <div class="col-md-2 col-sm-12"> <img src="images/expert.png"/>
        <h3>Sellers preference</h3>
      </div>
      <div class="col-md-2 col-sm-12"> <img src="images/budget.png"/>
        <h3>Budget Homes</h3>
      </div>
    </div>
  </div>
</section>

<?php 
//$this->registerJsFile(Yii::$app->request->baseUrl . '/js/bootstrap-multiselect.js');

$this->registerJS("
$(function() {

  //var dd = new DropDown( $('#residentialpropertysearch-city_id') );

  //$('.ui.dropdown').dropdown();

});
  ");
/*$this->registerJS("

      $( '#myTab a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      $( '#moreTabs a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      ( function( $ ) {
          // Test for making sure event are maintained
          $( '.js-alert-test' ).click( function () {
            alert( 'Button Clicked: Event was maintained' );
          } );
         // fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      } )( jQuery );
    ");*/