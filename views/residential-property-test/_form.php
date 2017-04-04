<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Residentialproperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="residentialproperty-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'property_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_for')->dropDownList([ 'Sale' => 'Sale', 'Rent' => 'Rent', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'property_type')->dropDownList([ 'Apartment' => 'Apartment', 'Rowhouse' => 'Rowhouse', 'Penthouse' => 'Penthouse', 'Bunglow' => 'Bunglow', 'Plot' => 'Plot', 'Villa' => 'Villa', 'Other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'builtup_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builtup_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carpet_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carpet_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bhk')->textInput() ?>

    <?= $form->field($model, 'other')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_bhk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'society_id')->textInput() ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'area_id')->textInput() ?>

    <?= $form->field($model, 'building_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age_of_building')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flat_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_no_of_floors')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floor_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facing')->dropDownList([ 'East' => 'East', 'West' => 'West', 'North' => 'North', 'South' => 'South', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'furnished')->dropDownList([ 'UN' => 'UN', 'SF' => 'SF', 'FF' => 'FF', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'lift_facility')->textInput() ?>

    <?= $form->field($model, 'amenities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'expected_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rent_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deposit_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expected_rent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deposit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_from')->textInput() ?>

    <?= $form->field($model, 'agreement_period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_parking_available')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'parking_structure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_of_parking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'covered_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key_arrangements')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photos_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_property_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_in_proposal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bathroom')->textInput() ?>

    <?= $form->field($model, 'balcony')->textInput() ?>

    <?= $form->field($model, 'price_negotiable')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'spl_attraction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_profile_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gallery_images')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_video_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maintenance_cost')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'maintenance_price')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preferred_tenants')->dropDownList([ 'f' => 'F', 'b' => 'B', 'any' => 'Any', 'male' => 'Male', 'female' => 'Female', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'available_rooms')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tenant_profiling')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tenant_profiling_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'added_on')->textInput() ?>

    <?= $form->field($model, 'added_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'close_through')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agreement_date')->textInput() ?>

    <?= $form->field($model, 'locking_period_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reminder_days')->textInput() ?>

    <?= $form->field($model, 'buyer_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'buy_date')->textInput() ?>

    <?= $form->field($model, 'publish_on_web')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
