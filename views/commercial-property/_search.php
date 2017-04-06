<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Area;
use app\models\Bhk;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialpropertySearch */
/* @var $form yii\widgets\ActiveForm */

//echo "<pre>"; print_r($model);exit;
?>

<div class="residentialproperty-search">

    <?php $form = ActiveForm::begin([
        'options'=>['id'=>'searchfiltercommercialproperty'],
        'action' => ['commercial-property/ajax-get-properties-update'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'property_id') 

    //echo $model->property_by;exit;?>

<div class="pro_left_column">
<?php echo \yii\helpers\Html::activeRadioList($model,'available_for',["Sale"=>"Buy","Lease" =>"Rent"],['tag'=>'div','item'=>function($index, $label, $name, $checked, $value) {
                    $return = '<input id="rad_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '"/>';
                    $return .= '<label for="rad_'.$label.'"><span></span>' . ucwords($label).'</label>';
                    return $return;
                }, ]);?>
        <?php /*
        $form->field($model, 'available_for')
            ->radioList(
                ["Sale"=>"Buy","Rent" =>"Rent","Flatmate"=>"Flatmate"],
                [
                    'item' => function($index, $label, $name, $checked, $value) {

                        $return = "";
                        $return = '<input id="rad_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '">';
                        $return .= '<label for="rad_'.$label.'"><span></span>' . ucwords($label).'</label>';

                        return $return;
                    }
                ]
            )
        ->label(false);*/
        ?>
</div>

<div class="pro_left_column">
<?php /*echo \yii\helpers\Html::activeRadioList($model,'property_by',["Owner"=>"Owner","Agent" =>"Agent"],['tag'=>'div','item'=>function($index, $label, $name, $checked, $value) {
                    $return = '<input id="rad_'.$label.'" type="radio" name="' . $name . '" value="' . $value . '"/>';
                    $return .= '<label for="rad_'.$label.'"><span></span>' . ucwords($label).'</label>';
                    return $return;
                }, ]);*/?>
    <?php
    /*$form->field($model, 'property_by')
        ->radioList(
            ["Owner"=>"Owner","Agent" =>"Agent"],
            [

                'item' => function($index, $label, $name, $checked, $value) {
                    $return = '<input type="radio" name="' . $name . '" value="' . $value . '"/>';
                    $return .= '<label for="rad_'.$label.'"><span></span>' . ucwords($label).'</label>';
                    return $return;
                }
            ]
        )
    ->label(false);*/
    ?>
</div>


<!-- <div class="pro_left_column"> -->
<?php /*echo \yii\helpers\Html::activeCheckboxList($model,'furnished',['ff'=>'Furnished', 'sf' => 'semifurnished','un' => 'Unfurnished'],['tag'=>'div','item'=>function($index, $label, $name, $checked, $value) {
                    $return = '<input id="rad_'.$label.'" type="checkbox" name="' . $name . '" value="' . $value . '"/>';
                    $return .= '<label for="rad_'.$label.'" style="font-weight:normal"><span></span>' . ucwords($label).'</label><br>';
                    return $return;
                }, ]);*/?>
        <?php /*
        $form->field($model, 'furnished')
            ->checkboxList(
                ['ff'=>'Furnished', 'sf' => 'semifurnished','un' => 'Unfurnished',],
                [
                    'item' => function($index, $label, $name, $checked, $value) {
                        //$return = '<label class="modal-radio">';
                        //echo "string ".$checked;
                        if($checked)
                            $return = '<input id="chkbx_'.$label.'" type="checkbox" name="' . $name . '" value="' . $value . '" tabindex="3" checked>';
                        else
                            $return = '<input id="chkbx_'.$label.'" type="checkbox" name="' . $name . '" value="' . $value . '" tabindex="3">';
                        //$return .= '<span></span>';
                        $return .= '<label for="chkbx_'.$label.'"><span></span>' . ucwords($label);
                        $return .= '</label><br>';

                        return $return;
                    }
                ]
            )
        ->label(false);*/
        ?>
<!-- </div> -->

 <div class="pro_left_column sale">
    <div class="row demo">
        <div class="col-xs-5 demo_col">
            <img src="images/rupee.jpg" alt="">

<?php echo \yii\helpers\Html::activeDropDownList($model,'min_rate_price',["500000"=>"5 Lac", "1000000"=>"10 Lac","2000000"=>"20 Lac","2500000"=>"25 Lac","4000000"=>"40 Lac","5000000"=>"50 Lac","8000000"=>"80 Lac","10000000"=>"1 Cr"],['prompt'=>'Min']);?>

            <?php
        /*$form->field($model, 'min_rate_price')->dropDownList(["500000"=>"5 Lac", "1000000"=>"10 Lac","2000000"=>"20 Lac","2500000"=>"25 Lac","4000000"=>"40 Lac","5000000"=>"50 Lac","8000000"=>"80 Lac","10000000"=>"1 Cr"],['prompt'=>'Min'])->label(false);*/?>
            <!-- <select>
            <option>Min</option>
            <option>5 Lac</option>
            <option>10 Lac</option>
            <option>20 Lac</option>
            <option>25 Lac</option>
            <option>40 Lac</option>
            <option>50 Lac</option>
            <option>80 Lac</option>
            <option>1 Cr</option>
        </select> --></div>
        <div class="col-xs-2 boldtxt">-</div>
        <div class="col-xs-5 demo_col">
        <img src="images/rupee.jpg" alt="">
        <?php echo \yii\helpers\Html::activeDropDownList($model,'max_rate_price',["1000000"=>"10 Lac","2000000"=>"20 Lac","2500000"=>"25 Lac","4000000"=>"40 Lac","5000000"=>"50 Lac","8000000"=>"80 Lac","10000000"=>"1 Cr","15000000"=>"1.5 Cr"],['prompt'=>'Max']);?>

        <?php /*
        $form->field($model, 'max_rate_price')->dropDownList(["1000000"=>"10 Lac","2000000"=>"20 Lac","2500000"=>"25 Lac","4000000"=>"40 Lac","5000000"=>"50 Lac","8000000"=>"80 Lac","10000000"=>"1 Cr","15000000"=>"1.5 Cr"],['prompt'=>'Max'])->label(false);*/?>
        <!-- <select>
            <option>Max</option>
            <option>10 Lac</option>
            <option>20 Lac</option>
            <option>25 Lac</option>
            <option>40 Lac</option>
            <option>50 Lac</option>
            <option>80 Lac</option>
            <option>1 Cr</option>
            <option>1.5 Cr</option>
        </select> --></div></div>
    </div>
    <div class="pro_left_column rent">
    <div class="row demo">
        <div class="col-xs-5 demo_col">
            <img src="images/rupee.jpg" alt="">

<?php echo \yii\helpers\Html::activeDropDownList($model,'min_rent_price',["5000"=>"5 Thousand", "10000"=>"10 Thousand","20000"=>"20 Thousand","25000"=>"25 Thousand","40000"=>"40 Thousand","50000"=>"50 Thousand","80000"=>"80 Thousand","100000"=>"1 Lac"],['prompt'=>'Min']);?>

            <?php
        /*$form->field($model, 'min_rate_price')->dropDownList(["500000"=>"5 Lac", "1000000"=>"10 Lac","2000000"=>"20 Lac","2500000"=>"25 Lac","4000000"=>"40 Lac","5000000"=>"50 Lac","8000000"=>"80 Lac","10000000"=>"1 Cr"],['prompt'=>'Min'])->label(false);*/?>
            <!-- <select>
            <option>Min</option>
            <option>5 Lac</option>
            <option>10 Lac</option>
            <option>20 Lac</option>
            <option>25 Lac</option>
            <option>40 Lac</option>
            <option>50 Lac</option>
            <option>80 Lac</option>
            <option>1 Cr</option>
        </select> --></div>
        <div class="col-xs-2 boldtxt">-</div>
        <div class="col-xs-5 demo_col">
        <img src="images/rupee.jpg" alt="">
        <?php echo \yii\helpers\Html::activeDropDownList($model,'max_rent_price',["10000"=>"10 Thousand","20000"=>"20 Thousand","25000"=>"25 Thousand","40000"=>"40 Thousand","50000"=>"50 Thousand","80000"=>"80 Thousand","100000"=>"1 Lac"],['prompt'=>'Max']);?>

        <?php /*
        $form->field($model, 'max_rate_price')->dropDownList(["1000000"=>"10 Lac","2000000"=>"20 Lac","2500000"=>"25 Lac","4000000"=>"40 Lac","5000000"=>"50 Lac","8000000"=>"80 Lac","10000000"=>"1 Cr","15000000"=>"1.5 Cr"],['prompt'=>'Max'])->label(false);*/?>
        <!-- <select>
            <option>Max</option>
            <option>10 Lac</option>
            <option>20 Lac</option>
            <option>25 Lac</option>
            <option>40 Lac</option>
            <option>50 Lac</option>
            <option>80 Lac</option>
            <option>1 Cr</option>
            <option>1.5 Cr</option>
        </select> --></div></div>
    </div>

<div class="pro_left_column">
    <div class="row">

    
    <?php echo \yii\helpers\Html::activeCheckboxList($model,'type',['Shop'=>'Shop','Showroom'=>'Showroom','Office'=>'Office','Warehouse'=>'Warehouse','Industrial Shed'=>'Industrial Shed','Godown'=>'Godown','Hotel'=>'Hotel'],['tag'=>'div','item'=>function($index, $label, $name, $checked, $value) {
                    $return = '<div class="col-xs-6"><input id="rad_'.$label.'" type="checkbox" name="' . $name . '" value="' . $value . '"/>';
                    $return .= '<label for="rad_'.$label.'" style="font-weight:normal"><span></span>' . ucwords($label).'</label></div>';
                    return $return;
                }, ]);?>
    <!-- <div class="col-xs-6">
        <input type="checkbox" id="c2" name="bhk">
        <label class="chkbob_lable" for="c2"><span></span><?php //$bhkModel->name;?></label>
    </div> -->
    <?php
        /*$form->field($model, 'bhk[]')
            ->checkboxList(
                ArrayHelper::map($bhkModels, "id","name"),
                [
                    'item' => function($index, $label, $name, $checked, $value) {

                        if($checked)
                            $return = '<div class="col-xs-6"><input id="chkbx_'.$label.'" type="checkbox" name="' . $name . '" value="' . $value . '" tabindex="3" checked>';
                        else
                            $return = '<div class="col-xs-6"><input id="chkbx_'.$label.'" type="checkbox" name="' . $name . '" value="' . $value . '" tabindex="3">';
                        //$return .= '<span></span>';
                        $return .= '<label class="chkbob_lable" for="chkbx_'.$label.'"><span></span>' . ucwords($label);
                        $return .= '</label></div>';

                        return $return;
                    }
                ]
            )
        ->label(false);*/
        ?>


</div>
</div>

   
            <!-- <div class="col-xs-6">
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
<?php
//$arealist = Area::findAll(['status' => 1,'is_in_use'=>0]);
?>
    <?php // $form->field($model, 'area_id')->dropDownList(ArrayHelper::map($arealist,'id', 'area')) ?>
    <div id="vis">
    <?php // $form->field($model, 'location_id[]')->hiddenInput()->label(false) ?>
    </div>
    <?php // $form->field($model, 'locationname')->hiddenInput(['id'=>'sidelocationname'])->label(false) ?>
    <?php // echo $form->field($model, 'property_type') ?>

    <?php // echo $form->field($model, 'builtup_area') ?>

    <?php // echo $form->field($model, 'builtup_unit') ?>

    <?php // echo $form->field($model, 'carpet_area') ?>

    <?php // echo $form->field($model, 'carpet_unit') ?>

    <?php // echo $form->field($model, 'bhk') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'other_bhk') ?>

    <?php // echo $form->field($model, 'society_id') ?>

    <?php echo $form->field($model, 'city_id')->hiddenInput(['value'=>33])->label(false); ?>

    <?php // echo $form->field($model, 'area_id') ?>

    <?php // echo $form->field($model, 'building_name') ?>

    <?php // echo $form->field($model, 'age_of_building') ?>

    <?php // echo $form->field($model, 'flat_no') ?>

    <?php // echo $form->field($model, 'total_no_of_floors') ?>

    <?php //echo $form->field($model, 'floor_no')->hiddenInput(['id'=>'floor_nofilter'])->label(false) ?>

    <?php //echo $form->field($model, 'facing')->hiddenInput(['id'=>'facingfilter'])->label(false) ?>

    <?php // echo $form->field($model, 'furnished') ?>

    <?php // echo $form->field($model, 'lift_facility') ?>

    <?php // echo $form->field($model, 'amenities') ?>

    <?php // echo $form->field($model, 'expected_rate') ?>

    <?php // echo $form->field($model, 'rate_currency') ?>

    <?php // echo $form->field($model, 'rent_currency') ?>

    <?php // echo $form->field($model, 'deposit_currency') ?>

    <?php // echo $form->field($model, 'expected_rent') ?>

    <?php // echo $form->field($model, 'deposit') ?>

    <?php // echo $form->field($model, 'available_from') ?>

    <?php // echo $form->field($model, 'agreement_period') ?>

    <?php // echo $form->field($model, 'is_parking_available') ?>

    <?php // echo $form->field($model, 'parking_structure') ?>

    <?php // echo $form->field($model, 'no_of_parking') ?>

    <?php // echo $form->field($model, 'covered_no') ?>

    <?php // echo $form->field($model, 'open_no') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'contact_person_name') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'email_id') ?>

    <?php // echo $form->field($model, 'other_details') ?>

    <?php // echo $form->field($model, 'key_arrangements') ?>

    <?php // echo $form->field($model, 'profile_photo') ?>

    <?php // echo $form->field($model, 'photos_link') ?>

    <?php // echo $form->field($model, 'video_link') ?>

    <?php // echo $form->field($model, 'other_property_details') ?>

    <?php // echo $form->field($model, 'address_in_proposal') ?>

    <?php //echo $form->field($model, 'bathroom')->hiddenInput(['id'=>'bathroomfilter'])->label(false) ?>

    <?php // echo $form->field($model, 'balcony') ?>

    <?php // echo $form->field($model, 'price_negotiable') ?>

    <?php // echo $form->field($model, 'spl_attraction') ?>

    <?php // echo $form->field($model, 'property_profile_photo') ?>

    <?php // echo $form->field($model, 'gallery_images') ?>

    <?php // echo $form->field($model, 'property_video_link') ?>

    <?php // echo $form->field($model, 'maintenance_cost') ?>

    <?php // echo $form->field($model, 'maintenance_price') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'preferred_tenants') ?>

    <?php // echo $form->field($model, 'available_rooms') ?>

    <?php // echo $form->field($model, 'tenant_profiling') ?>

    <?php // echo $form->field($model, 'tenant_profiling_desc') ?>

    <?php // echo $form->field($model, 'added_on') ?>

    <?php // echo $form->field($model, 'added_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'close_through') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'agreement_date') ?>

    <?php // echo $form->field($model, 'locking_period_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'reminder_days') ?>

    <?php // echo $form->field($model, 'buyer_details') ?>

    <?php // echo $form->field($model, 'buy_date') ?>

    <?php // echo $form->field($model, 'publish_on_web') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?php //Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
