<?php

use yii\helpers\Html;
use app\models\City;
use app\models\Location;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Residentialproperty */
/* @var $form ActiveForm */
?>
<div class="residential-property-searchresidentialproperty">

    <?php $form = ActiveForm::begin(['action'=>['index'],
        'method' => 'get']); 

$citydata = City::find()
    ->select(['city as value', 'city as  label','id as id'])
    ->asArray()
    ->all();

$data = Location::find()
    ->select(['location as value', 'location as  label','id as id'])
    ->asArray()
    ->all();
//echo "<pre>"; print_r($cities);exit;
    ?>

<div class="container-fluid toolbar_section">
    <div class="row search_section">
        <div class="container">
            <div class="row ">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-9 col9">
                            <!-- <input type="text" class="form-control" id="propertylocation" placeholder="Add more Locations.."> -->
                            <?php 
                            echo $form->field($model,"location_id")->hiddenInput()->label(false);
echo $form->field($model, 'locationname')->widget(\yii\jui\AutoComplete::classname(), ["clientOptions"=> ["source"=>$data,'autoFill'=>true,'select' => new \yii\web\JsExpression("function( event, ui ) {
    $('#residentialpropertysearch-location_id').val(ui.item.id);
    }")],"options"=>["class"=>"form-control",'placeholder' => 'Add more locations..']])->label(false);
                            //echo $form->field($model, 'location_id')->textInput(["class"=>"form-control",'placeholder' => 'Add more locations..'])->label(false);

                            // echo $form->field($model, 'location_id')->widget(\yii\jui\AutoComplete::classname(), ["clientOptions"=>["source"=>new \yii\web\JsExpression("function(request, response) {
                            //         $.getJSON('".Yii::$app->urlManager->createUrl("residential-property/get-all-cities")."', {
                            //             term: request.term
                            //         }, response);
                            //     }")],
                            // "options"=>["select"=>"js:function(event, ui) {alert('hi')}"]]);

                            /*$form->field($model, 'location_id')->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'model' => $model,
                            'attribute' => 'locationName',
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                                'minLength' => '1',
                                'showAnim' => 'fold',
                                'select' => "js:function(event, ui) {
                                    $('#ResidentialProperty_location_id').val(ui.item.id);

                                }",
                                'change' => "js:function(event, ui){}",
                            ),
                            //'source' => Yii::app()->createUrl("user/ResidentialProperty/getLocations"),
                            'source' => 'js: function(request, response) {
                                $.ajax({
                                        url: "' . Yii::$app->urlManager->createUrl('ResidentialProperty/getLocations') . '",
                                        dataType: "json",
                                        data: { term: request.term, cityId: $("#ResidentialProperty_city_id").val() },
                                        success: function (data) { response(data); }
                                });
                            }',
                            'htmlOptions' => array(
                                // 'style'=>'margin-left:8px',
                                'placeholder' => "Enter Area",
                                'value' => ($model->location_id != '') ? GFunctions::getLocationName($model->location_id) : '',
                            ),
                        ));*/
                        ?>
                        </div>
                        <div class="col-sm-3 col3">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!-- <button type="button" class="btn search_btn"><img src="images/serarch.jpg" alt=""></button> -->
                                    <?= Html::submitButton('<img src="images/serarch.jpg" alt="">', ['class' => 'btn search_btn']) ?>
                                </div>
                                <div class="col-xs-9 padding_left border_right">
                                    <div class="checkbox">
                                        <input type="checkbox" id="c1" name="cc" checked="checked">
                                        <label class="chkbob_lable" for="c1" style="padding-left:0"><span></span>Nearby properties</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row search_right short_section">
                        <ul class="nav navbar-nav">
                            <li><a href="#" data-toggle="modal" data-target="#myModal-5"><img src="images/more.jpg" class="short" alt="">More <img src="images/dd_arrow.jpg" alt=""></a>
                                <div class="modal" tabindex="-1" id="myModal-5" role="dialog">
                                    <div class="modal-dialog more_modal_dilog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body popup_content">
                                                <div class="row">
                                                    <div class="col-sm-4 amenities_col">
                                                        <h1>Amenities</h1>
                                                        <p>
                                                            <input type="checkbox" id="pop_1" name="ResidentialpropertySearch[amenities][]" value="1">
                                                            <label class="chkbob_lable" for="pop_1"><span></span><img src="images/gym.png" alt="">Gym</label>
                                                        </p>



                                                        <p>
                                                            <input type="checkbox" id="pop_3" name="ResidentialpropertySearch[amenities][]" value="2">
                                                            <label class="chkbob_lable" for="pop_3"><span></span><img src="images/power.png" alt="">Power backup</label>
                                                        </p>

                                                        <p>
                                                            <input type="checkbox" id="pop_4" name="ResidentialpropertySearch[amenities][]" value="3">
                                                            <label class="chkbob_lable" for="pop_4"><span></span><img src="images/swiming.png" alt="">Swimming pool</label>
                                                        </p>

                                                        <p>
                                                            <input type="checkbox" id="pop_5" name="ResidentialpropertySearch[amenities][]" value="4">
                                                            <label class="chkbob_lable" for="pop_5"><span></span><img src="images/home_popup.png" alt="">Club House</label>
                                                        </p>
                                                        <p>
                                                            <input type="checkbox" id="pop_2" name="ResidentialpropertySearch[amenities][]" value="4">
                                                            <label class="chkbob_lable" for="pop_2"><span></span><img src="images/door_cam.png" alt="">Door camera</label>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-3 filter_col">
                                                        <h1>Filter by</h1>
                                                        <?= $form->field($model,"bathroom")->dropDownList([1=>1,2=>2,3=>3],['prompt'=>'Bathroom'])->label(false);?>
                                                        <!-- <select name="bathroom">
                                                            <option>Bathroom</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select> -->
                                                        <hr>
                                                        <?= $form->field($model,"facing")->dropDownList(['East'=>'East', 'West'=>'West','North'=>'North','South'=>'South'],['prompt'=>'Facing'])->label(false);?>
                                                        <!-- <select>
                                                            <option>Facing</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select> -->
                                                        <hr>
                                                        <?= $form->field($model,"floor_no")->dropDownList([1=>1,2=>2,3=>3],['prompt'=>'Floor'])->label(false);?>
                                                        <!-- <select>
                                                            <option>Floor</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select> -->
                                                        <hr>
                                                        <?php /* $form->field($model,"family")->dropDownList([1=>1,2=>2,3=>3],['prompt'=>'Family'])->label(false);*/?>
                                                        <!-- <select>
                                                            <option>Family</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select> -->
                                                        <hr>
                                                        <?= $form->field($model,"status")->dropDownList([1=>1,2=>2,3=>3],['prompt'=>'Status'])->label(false);?>
                                                        <!-- <select>
                                                            <option>Status</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                        </select> -->
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-5 other_col">
                                                        <h1>Other</h1>
                                                        <table>
                                                            <tbody><tr>
                                                                <td>Sq. ft. </td>
                                                                <td><input name="ResidentialpropertySearch[min_carpet_area]" type="text"></td>
                                                                <td>to</td>
                                                                <td><input name="ResidentialpropertySearch[max_carpet_area]" type="text"></td>
                                                            </tr>
                                                        </tbody></table>
                                                        <hr>
                                                        <p>
                                                            <input type="checkbox" id="pop_6" name="ResidentialpropertySearch[haveimages]">
                                                            <label class="chkbob_lable" for="pop_6"><span></span><img src="images/photo.png" alt="">Photos</label>
                                                        </p>
                                                        <hr>
                                                        <p><img src="images/rs_veryfi.png" alt=""><br>
                                                            <span>Rightsell verified property</span></p>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
    </li>

    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/short_ico.jpg" class="short" alt="">Sort by Relevance <img src="images/dd_arrow.jpg" alt=""></a>
        <ul class="dropdown-menu" style="left:18px">
            <li class="first"><a href="#">Relavance</a></li>
            <li><a href="<?= Yii::$app->request->url."&sort=popular";?>">Popularity</a></li>
            <li><a href="<?= Yii::$app->request->url."&sort=pricedown";?>">Price (Low to high)</a></li>
            <li><a href="<?= Yii::$app->request->url."&sort=priceup";?>">Price (High to low)</a></li>
            <li><a href="#">Seller Ratings </a></li>
            <li><a href="#">Date Posted</a></li>
        </ul>
    </li>
</ul>
</div>
</div>
</div>
</div>
</div> 
</div>

        <?php // $form->field($model, 'location_id') ?>
        <?php // $form->field($model, 'city_id') ?>
        <?php // $form->field($model, 'amenities') ?>    
        <!-- <div class="form-group">
            <?php // Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div> -->
    <?php ActiveForm::end(); ?>

</div><!-- residential-property-searchresidentialproperty -->
