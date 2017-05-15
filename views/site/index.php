<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
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
      </div>
      </div>
      </section>
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
        $model->available_for = "Rent";
        $form = ActiveForm::begin(['action'=>['residential-property/index'],'method'=>"get","id"=>"homerespropform"]);
       
        ?>
          <section class="rent_residentialprop">
            <div class="container">
              <div id="tt" class="row text-center">
                <h2 class="rb_text_h1">

                <!-- <label for="radio-1">New York</label>
                <input type="radio" name="radio-1" id="radio-1">
                <label for="radio-2">Paris</label>
                <input type="radio" name="radio-1" id="radio-2">
                <label for="radio-3">London</label>
                <input type="radio" name="radio-1" id="radio-3"> -->

                  <?= $form->field($model, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Sale','Flatmate'=>'Flatmate'],
                        [
                        'item' => function($index, $label, $name, $checked, $value) {
                           
                           
                            $return = '<input id="available_for_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                            if($checked)
                              $return .= '<a href="#"><label for="available_for_'.$label.'" class="radio_text_active available_forradio_resi">';
                              else
                            $return .= '<a href="#"><label for="available_for_'.$label.'" class="radio_text available_forradio_resi">';
                            $return .= ucwords($label);
                            $return .= '</label></a>';
							if($label != "Flatmate")
								$return .= ' | ';

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
                  </td><td><?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(City::find()->where(['status'=>1])->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi", 'required'=>true])->label(false);?></td></tr>
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
         <table class="dd_table">
                  <tr><td valign="top"><img src="images/select_area.png" hspace="5" vspace="5" class="img-responsive" alt="">
                  </td><td><?php //$form->field($model, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>

                  <!-- <select id="locsresi" name="locationname" multiple="true"> -->
          <?php
          //foreach ($locationdata as $item) {
            //echo "<option value='".$item['id']."'>".$item['label']."</option>";
          //}
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
                'pluginEvents' => [
                    "change" => "function() { console.log('change'); }",
                    "select2:opening" => "function() { console.log('select2:opening'); }",
                    "select2:open" => "function() { console.log('open'); }",
                    "select2:closing" => "function() { console.log('close'); }",
                    "select2:close" => "function() { console.log('close'); }",
                    "select2:selecting" => "function() { console.log('selecting'); }",
                    "select2:select" => "function() { console.log('select'); }",
                    "select2:unselecting" => "function() { console.log('unselecting'); }",
                    "select2:unselect" => "function() { console.log('unselect'); }"
                ],
            ])->label(false);

          ?></td></tr>
                </table>
         
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
        <option value="8">1 BHK</option>
        <option value="2">2 BHK</option>
        <option value="3">3 BHK</option>
        <option value="5">4 BHK</option>
        <option value="12">5 BHK</option>

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
         



<li class="demo_home">
<table class="dd_table">
<tr><td><img src="images/select_budget.png" class="img-responsive" alt="">
</td><td>
<?= $form->field($model, 'min_rate_price')->dropdownList(["10"=>"10 lacs - 20 lacs","20"=>"20 lacs - 30 lacs","30"=>"30 lacs - 40 lacs"],['prompt'=>"Select Budget",'class'=>"dd wrapper-dropdown-3 dd_resi",'id'=>""])->label(false);?></td></tr>
</table>
          <!-- homeresmin_rate_pricefilter <div class="dropdown">
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
                <div class="col-md-12 col-sm-12" style="z-index:15 ">
                  <button type="submit" class="btn btn-danger">Get a Dream Home</button>
                </div>
              </div>
            </div>
          </section>
          <?php ActiveForm::end(); ?>
         
            </div>
           
            <div class="tab-pane  hot_property" id="com">
                <section class="rent_commercialprop">
                <?php

        $model = new \app\models\CommercialpropertySearch();
        $model->available_for = "Lease";
        $form = ActiveForm::begin(['action'=>['commercial-property/index'],'method'=>"get"]);
       
        //echo $form->field($model, 'location_id')->hiddenInput()->label(false);
        ?>
            <div class="container">
              <div class="row text-center">
               <h2 class="rb_text_h1">
               <!-- <a href="#." class="rb_text">Rent</a>  |  <a href="#." class="rb_text active">Buy</a> -->
                 <?php // $form->field($model, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Sale'])->label(false);?>

                 <?php /* $form->field($model, 'available_for')->radioList(['Lease'=>'Rent','Sale'=>'Sale'],
                        [
                    'item' => function($index, $label, $name, $checked, $value) {
                       
                       
                        $return = '<input id="comm_available_for_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                        $return .= '<a href="#"><label for="comm_available_for_'.$label.'" class="radio_text_active">';
                        $return .= ucwords($label);
                        $return .= '</label></a> |';

                        return $return;
                    }
                ])->label(false);*/?>

                <?= $form->field($model, 'available_for')->radioList(['Lease'=>'Rent','Sale'=>'Sale'],
                        [
                        'item' => function($index, $label, $name, $checked, $value) {
                           
                           
                            $return = '<input id="comm_available_for_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                            if($checked)
                            $return .= '<a href="#"><label for="comm_available_for_'.$label.'" class="radio_text_active available_forradio_comm">';
                            else
                              $return .= '<a href="#"><label for="comm_available_for_'.$label.'" class="radio_text available_forradio_comm">';
                            $return .= ucwords($label);
                            $return .= '</label></a>';
							
							if($label != "Sale")
								$return .= ' | ';

                            return $return;
                        }
                            ])->label(false);?>

               </h2>
              </div>
              <div class=" dd_row">
        <ul class="">
          <li class="demo_home"><?php // $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(City::find()->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>

          <table class="dd_table">
                  <tr><td><img src="images/location_30km.png" class="img-responsive" alt="">
                  </td><td><?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map(City::find()->where(['status'=>1])->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi", 'required'=>true])->label(false);?></td></tr>
                </table>
                </li>
               
               
                <li>
          <?php // $form->field($model, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>

<table class="dd_table">
                  <tr><td valign="top"><img src="images/select_area.png" hspace="5" vspace="5" class="img-responsive" alt="">
                  </td><td><?php //$form->field($model, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>

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

          ?></td></tr>
                </table>
          </li>
          <li><?php // $form->field($model, 'type')->dropdownList(['Shop'=>'Shop','Showroom'=>'Showroom','Office'=>'Office','Warehouse'=>'Warehouse','Industrial Shed'=>'Industrial Shed','Godown'=>'Godown','Hotel'=>'Hotel'],['prompt'=>"Select Property Type",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>

        <select id="type" name="type[]" multiple="multiple">
          <option value="Shop">Shop</option>
          <option value="Showroom">Showroom</option>
          <option value="Office">Office</option>
          <option value="Warehouse">Warehouse</option>
          <option value="Industrial Shed">Industrial Shed</option>
          <option value="Godown">Godown</option>
          <option value="Hotel">Hotel</option>
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
          <li class="demo_home">
          <table class="dd_table">
                  <tr><td><img src="images/select_budget.png" class="img-responsive" alt="">
                  </td><td><?= $form->field($model, 'min_rate_price')->dropdownList(["10"=>"10 lacs - 20 lacs","20"=>"20 lacs - 30 lacs","30"=>"30 lacs - 40 lacs"],['prompt'=>"Select Budget",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?></td></tr>
                </table>
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
                <div class="col-md-12 col-sm-12" style="z-index:15 ">
                  <button type="submit" class="btn btn-danger">Get a Business place</button>
                </div>
              </div>
            </div>
          </section>
          <?php ActiveForm::end(); ?>
            </div>
            <div class="tab-pane  hot_property_agri" id="agri">
                <section class="rent_agriculturalprop">
          <?php

        $modelagri = new \app\models\AgriculturalpropertySearch();
        $modelagri->available_for = "Rent";
        $form = ActiveForm::begin(['action'=>['agricultural-property/index'],'method'=>"get"]);
       
        //echo $form->field($model, 'available_for')->hiddenInput()->label(false);
        //echo $form->field($modelagri, 'location_id')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        //echo $form->field($model, 'bhk')->hiddenInput()->label(false);
        ?>
            <div class="container">
              <div class="row text-center">
             

                <h2 class="rb_text_h1">
                <?php // $form->field($modelagri, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Buy','Lease'=>'Lease'])->label(false);?>
                <?php /* $form->field($modelagri, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Sale'],
                        [
                    'item' => function($index, $label, $name, $checked, $value) {
                        $return = '<input id="agri_available_for_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                        $return .= '<a href="#"><label for="agri_available_for_'.$label.'" class="radio_text_active">';
                        $return .= ucwords($label);
                        $return .= '</label></a> |';

                        return $return;
                    }
                ])->label(false);*/ ?>

                <?= $form->field($modelagri, 'available_for')->radioList(['Rent'=>'Rent','Sale'=>'Sale'],
                        [
                        'item' => function($index, $label, $name, $checked, $value) {
                           
                           
                            $return = '<input id="agri_available_for_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                            if($checked)
                            $return .= '<a href="#"><label for="agri_available_for_'.$label.'" class="radio_text_active available_forradio_agri">';
                            else
                              $return .= '<a href="#"><label for="agri_available_for_'.$label.'" class="radio_text available_forradio_agri">';
                            $return .= ucwords($label);
                            $return .= '</label></a>';
							if($label != "Sale")
								$return .= ' | ';

                            return $return;
                        }
                            ])->label(false);?>
                 
                </h2>
              </div>
              <div class=" dd_row">
        <ul class="">
          <li class="demo_home">
<?php // $form->field($modelagri, 'city_id')->dropdownList(ArrayHelper::map(City::find()->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>
<table class="dd_table">
  <tr><td><img src="images/location_30km.png" class="img-responsive" alt="">
  </td><td><?= $form->field($modelagri, 'city_id')->dropdownList(ArrayHelper::map(City::find()->where(['status'=>1])->all(),"id","city"),['prompt'=>"Select City",'class'=>"dd wrapper-dropdown-3 dd_resi", 'required'=>true])->label(false);?></td></tr>
</table>

</li>
          <li><?php // $form->field($modelagri, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>
            <table class="dd_table">
                  <tr><td valign="top"><img src="images/select_area.png" hspace="5" vspace="5" class="img-responsive" alt="">
                  </td><td><?php //$form->field($model, 'locationname',["options"=>["class"=>"dd_resi2","style"=>"width:450px; padding:0px 33px; border:1px solid #a5a5a5"]])->textInput(["style"=>"border:0; width:100%; background:#f3f3f3; height:23px; margin:0","placeholder"=>"Search Area"])->label(false);?>

          <?php

          echo $form->field($modelagri, 'locationname')->widget(Select2::classname(), [
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

          ?></td></tr>
                </table>

          </li>
          <li><?= $form->field($modelagri, 'property_type')->dropdownList(['Agricultural land'=>'Agricultural land','Industrial land'=>'Industrial land','NA plots'=>'NA plots','Farm house plot'=>'Farm house plot'],['id'=>"proptype",'multiple'=>true,'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?>
          <!-- <select id="proptype" name="proptype[]" multiple="multiple">
          <option value="Agricultural land">Agricultural land</option>
          <option value="Industrial land">Industrial land</option>
          <option value="NA plots">NA plots</option>
          <option value="Farm house plot">Farm house plot</option>
          </select> -->
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
          <li class="demo_home">
          <table class="dd_table">
                  <tr><td><img src="images/select_budget.png" class="img-responsive" alt="">
                  </td><td><?= $form->field($modelagri, 'min_rate_price')->dropdownList(["10"=>"10 lacs - 20 lacs","20"=>"20 lacs - 30 lacs","30"=>"30 lacs - 40 lacs"],['prompt'=>"Select Budget",'class'=>"dd wrapper-dropdown-3 dd_resi"])->label(false);?></td></tr>
                </table>
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
                <div class="col-md-12 col-sm-12" style="z-index:15 ">
                  <button type="submit" class="btn btn-danger">Get a Farm</button>
                </div>
              </div>
            </div>
          </section>
          <?php ActiveForm::end(); ?>
         
            </div>
           
           
    </div>
  </div>
</section>
<div style=" width:1200px; margin:0 auto;"><section class="hot_property_resi_padding" style="position:absolute; z-index:10; top:480px">
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
                                              $j=0;
                                              foreach ($resPropRentLocCount as $rpc) {
                                                $cls = "";
                                                if($i== 0)
                                                {
                                                  $cls = "active";
                                                  $i++;
                                                }
                                                  ?>
                        <li class="<?=$cls?>"><a href="#rprent_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab">
                          <?=trim($rpc->locations->location)?>
                          </a></li>
                        <?php } ?>
                      
                      </ul>
                    </div>
                    <div class="col-md-9 nopadding">
                      <div class="tab-content">
                        <?php
                        
                                                  foreach ($resPropRentLocCount as $respropCnt) {
                                                $clsj = "";
                                                if($j== 0)
                                                {
                                                  $clsj = "active";
                                                  $j++;
                                                }
                                                ?>
                        <div class="tab-pane <?=$clsj?>" id="rprent_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                         <div id="" class="example example2">
                            <?php
                            $k = 0;
                                                  foreach ($residentialPropertiesforRentArr[$respropCnt->location_id] as $resprop) {
                                                    $cls_alt_box = "home_pro_box";

                                                if($k % 2 == 0)
                                                {
                                                  $cls_alt_box = "home_pro_box_2";
                                                }
                                                $k++;
                                                ?>
                            <div class="row home_pro_box <?=$cls_alt_box?>">
                              <div class="col-sm-5 nopadding">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                  <div class="carousel-inner" role="listbox">
                                    <div class="item active"> <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt=""> </div>
                                    <div class="item"> <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt=""> </div>
                                    <div class="item"> <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt=""> </div>
                                  </div>
                                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                              </div>
                              <div class="col-sm-7">
                                <div class="row home_pro_detail">
                                  <h1>
                                    <?= $resprop->bhks->name.", Near ".$resprop->locations->location?>
                                  </h1>
                                  <button class="button yellow_btn">
                                  <?=$resprop->bhks->name?>
                                  </button>
                                  <button class="button orrange_btn">Rent
                                  <?= number_format($resprop->expected_rent_comp)?>
                                  </button>
                                  <button class="button yellow_btn">Deposit
                                  <?= number_format($resprop->deposit_comp)?>
                                  </button>
                                  <div class="row">
                                    <div class="col-xs-6">
                                      <p><img src="images/family.png" alt="">
                                        <?php
                                        if($resprop->preferred_tenants == "f")
                                          echo "Family";
                                        else if($resprop->preferred_tenants == "b")
                                          echo "Bachelors";
                                        else
                                          echo ucfirst($resprop->preferred_tenants);
                                        ?>
                                      </p>
                                    </div>
                                    <div class="col-xs-6">
                                      <p><img src="images/car.png" alt="">Parking -
                                        <?=$resprop->no_of_parking?$resprop->no_of_parking:"No"?>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-6">
                                      <p><img src="images/area.png" alt="">Area -
                                        <?= $resprop->builtup_area. " ". $resprop->builtup_unit ?>
                                      </p>
                                    </div>
                                    <div class="col-xs-6">
                                      <p><img src="images/furnished.png" alt="">
                                        <?php
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
                           
                              ?>
                                      </p>
                                    </div>
                                    <div class="col-xs-12"><strong>Status:</strong> This property
                                      <?=$diff->format('%a days');?>
                                      old</div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-6">
                                      <button class="button red_btn">Contact Owner</button>
                                    </div>
                                    <div class="col-xs-6">
                                      <table>
                                        <tr>
                                          <td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
                                          <td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
                                          <td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
                                        </tr>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-2"></div>
                            </div>
                            <?php }?>
                          </div>
                        </div>
                        <?php }?>
                       
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
                                              $j=0;
                                              foreach ($resPropSaleLocCount as $rpc) {
                                                $cls = "";
                                                if($i== 0)
                                                {
                                                  $cls = "active";
                                                  $i++;
                                                }
                                                  ?>
                        <li class="<?=$cls?>"><a href="#rpsale_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab">
                          <?=trim($rpc->locations->location)?>
                          </a></li>
                        <?php } ?>
                      
                      </ul>
                    </div>
                    <div class="col-md-9 nopadding">
                      <div class="tab-content">
                        <?php 
                        
                        foreach ($resPropSaleLocCount as $respropCnt) {
                            
                          $clsj = "";
                          if($j== 0)
                          {
                            $clsj = "active";
                            $j++;
                          }
                          ?>
                        <div class="tab-pane <?=$clsj?>" id="rpsale_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                        <div id="" class="example example2">
                          <?php
                                                  //echo "<pre>"; print_r($residentialProperties);exit;
                                                  foreach ($residentialPropertiesforSaleArr[$respropCnt->location_id] as $resprop) {?>
                          <div class="row home_pro_box">
                            <div class="col-sm-5 nopadding">
                              <div id="myCarousel1" class="carousel slide" data-ride="carousel">
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
                                <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                            </div>
                            <div class="col-sm-7">
                              <div class="row home_pro_detail">
                                <h1>
                                  <?= $resprop->bhks->name.", Near ".$resprop->locations->location?>
                                </h1>
                                <button class="button yellow_btn">
                                <?= $resprop->bhks->name?>
                                </button>
                                <button class="button orrange_btn">Rate
                                <?= number_format($resprop->expected_rate_comp)?>
                                </button>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <p><img src="images/family.png" alt="">
                                      <?= $resprop->preferred_tenants?>
                                    </p>
                                  </div>
                                  <div class="col-xs-6">
                                    <p><img src="images/car.png" alt="">Parking -
                                      <?=$resprop->no_of_parking?$resprop->no_of_parking:"No"?>
                                    </p>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <p><img src="images/area.png" alt="">Area -
                                      <?= $resprop->builtup_area. " ". $resprop->builtup_unit ?>
                                    </p>
                                  </div>
                                  <div class="col-xs-6">
                                    <p><img src="images/furnished.png" alt="">
                                      <?php
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
                           
                              ?>
                                    </p>
                                  </div>
                                  <div class="col-xs-12"><strong>Status:</strong> This property
                                    <?=$diff->format('%a days');?>
                                    old</div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <button class="button red_btn">Contact Owner</button>
                                  </div>
                                  <div class="col-xs-6">
                                    <table>
                                      <tr>
                                        <td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
                                        <td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
                                        <td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2"></div>
                          </div>
                          <?php }?>
                        </div>
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
                                              $j=0;
                                              foreach ($commPropLocCount as $rpc) {
                                                $cls = "";
                                                if($i== 0)
                                                {
                                                  $cls = "active";
                                                  $i++;
                                                }
                                                  ?>
                        <li class="<?=$cls?>"><a href="#comm_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab">
                          <?=trim($rpc->locations->location)?>
                          </a></li>
                        <?php } ?>
                      
                      </ul>
                    </div>
                    <div class="col-md-9 nopadding">
                      <div class="tab-content">
                        <?php foreach ($commPropLocCount as $respropCnt) {

                                                $clsj = "";
                                                if($j == 0)
                                                {
                                                  $clsj = "active";
                                                  $j++;
                                                }
                                                ?>
                        <div class="tab-pane <?=$clsj?>" id="comm_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                        <div id="" class="example example2">
                          <?php
                                                  //echo "<pre>"; print_r($residentialProperties);exit;
                                                  foreach ($commercialPropertiesArr[$respropCnt->location_id] as $model) {

                                                ?>
                          <div class="row home_pro_box">
                            <div class="col-sm-5 nopadding">
                              <div id="myCarousel2" class="carousel slide" data-ride="carousel">
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
                                <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                            </div>
                            <div class="col-sm-7">
		<div class="row pro_detail">
			<a href="<?=Url::to(['commercial-property/view','id'=>$model->id])?>"><h1><?= $model->type?> Near <?= $model->locations?$model->locations->location:""?>.</h1></a>
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
                            <div class="col-sm-2"></div>
                          </div>
                          <?php }?>
                        </div>
                        </div>
                        <?php }?>
                       
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
                                              $j=0;
                                              foreach ($agriPropLocCount as $rpc) {
                                                $cls = "";
                                                if($i== 0)
                                                {
                                                  $cls = "active";
                                                  $i++;
                                                }
                                                  ?>
                        <li class="<?=$cls?>" style="border-bottom: 0px"><a href="#agri_<?=str_replace(' ', '_',trim($rpc->locations->location))?>" data-toggle="tab">
                          <?=trim($rpc->locations->location)?>
                          </a></li>
                        <?php } ?>
                       
                      </ul>
                    </div>
                    <div class="col-md-9 nopadding">
                      <div class="tab-content">
                        <?php foreach ($agriPropLocCount as $respropCnt) {
                          $clsj = "";
                          if($j== 0)
                          {
                            $clsj = "active";
                            $j++;
                          }
                                                ?>
                        <div class="tab-pane <?=$clsj?>" id="agri_<?=str_replace(' ', '_',trim($respropCnt->locations->location))?>">
                        <div id="" class="example example2">
                          <?php
                                                  //echo "<pre>"; print_r($residentialProperties);exit;
                                                  foreach ($agriculturalPropertiesArr[$respropCnt->location_id] as $model) {?>
                          <div class="row home_pro_box">
                            <div class="col-sm-5 nopadding">
                              <div id="myCarousel4" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                  <?php
                              $images = json_decode($respropCnt->gallery_images);
                            if(count($images) >0)
                            {
                              foreach ($images as $image) {
                                echo "<div class='item'>";
                                echo "<img class='d-block img-fluid img-responsive' src='http://".$host."/RealEstateCrm/files/commercialProperty/galleryimages/".$respropCnt->id."_galleryimages_".$image."' alt=''/>";
                                echo "</div>";
                              }
                            }
                            else
                              echo '<div class="item active">
                                <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">          </div>';
                              ?>
                                </div>
                                <a class="left carousel-control" href="#myCarousel4" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel4" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
                            </div>
                            <div class="col-sm-7">
                              <div class="row home_pro_detail">
                                <h1>
                                  <?= $model->property_type?>
                                  Near
                                  <?= $model->locations->location?>
                                  .</h1>
                                <button class="button yellow_btn">
                                <?= $model->property_type?>
                                </button>
                                <?php if(strtolower($model->available_for)=="rent"):?>
                                <button class="button orrange_btn">Rent
                                <?=number_format($model->expected_rent_comp);?>
                                </button>
                                <button class="button yellow_btn">Deposit
                                <?=number_format($model->deposit_comp)?>
                                </button>
                                <?php endif;?>
                                <?php if(strtolower($model->available_for)=="sale"):?>
                                <button class="button orrange_btn">Rate
                                <?=number_format($model->expected_rate_comp);?>
                                </button>
                                <?php endif;?>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <p><img src="images/family.png" alt="">
                                      <?php //$model->ideal_for?ucfirst($model->ideal_for):"Anyone"?>
                                      NA
                                    </p>
                                  </div>
                                  <div class="col-xs-6">
                                    <p><img src="images/water.jpg" alt="">
                                      <?=$model->water_supply=="Yes"?"Water Available":"No water"?>
                                    </p>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <p><img src="images/area.png" alt="">Area -
                                      <?=$model->property_area.' '.$model->property_unit?>
                                    </p>
                                  </div>
                                  <div class="col-xs-6">
                                    <p><img src="images/loc.jpg" alt=""><?=$model->electric_supply=="Yes"?"Electricity Available":"No Electricity"?></p>
                                  </div>
                                  <?php
                            $now = time(); // or your date as well
                            $your_date = strtotime($model->added_on);
                            $datediff = $now - $your_date;
                   
                            $days = floor($datediff / (60 * 60 * 24));
                            $from=date_create(date('Y-m-d'));
                            $to=date_create($model->added_on);
                            $diff=date_diff($to,$from);
                            ?>
                                  <div class="col-xs-12"><strong>Status:</strong> This property
                                    <?=$diff->format('%a days');?>
                                    old</div>
                                  <!-- <div class="col-xs-12"><strong>Status:</strong> This property 2 years old</div> -->
                                </div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <button class="button red_btn">Contact Owner</button>
                                  </div>
                                  <div class="col-xs-6">
                                    <table>
                                      <tr>
                                        <td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
                                        <td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
                                        <td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-2"></div>
                          </div>
                          <?php }?>
                        </div>
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
      </section></div>
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

           
            ?>