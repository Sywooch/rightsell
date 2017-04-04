<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResidentialpropertyTestVisSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="residentialproperty-search">

<?php yii\widgets\Pjax::begin(['id' => 'search-form']) ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true ]
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'property_id') ?>

    <?= $form->field($model, 'property_by') ?>

    <?= $form->field($model, 'available_for') ?>

    <?= $form->field($model, 'location_id') ?>

    <?php echo $form->field($model, 'property_type') ?>

    <?php // echo $form->field($model, 'builtup_area') ?>

    <?php // echo $form->field($model, 'builtup_unit') ?>

    <?php // echo $form->field($model, 'carpet_area') ?>

    <?php // echo $form->field($model, 'carpet_unit') ?>

    <?php echo $form->field($model, 'bhk') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'other_bhk') ?>

    <?php // echo $form->field($model, 'society_id') ?>

    <?php echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'area_id') ?>

    <?php // echo $form->field($model, 'building_name') ?>

    <?php // echo $form->field($model, 'age_of_building') ?>

    <?php // echo $form->field($model, 'flat_no') ?>

    <?php // echo $form->field($model, 'total_no_of_floors') ?>

    <?php echo $form->field($model, 'floor_no') ?>

    <?php echo $form->field($model, 'facing') ?>

    <?php echo $form->field($model, 'furnished') ?>

    <?php // echo $form->field($model, 'lift_facility') ?>

    <?php echo $form->field($model, 'amenities') ?>

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

    <?php // echo $form->field($model, 'bathroom') ?>

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

    <?php // echo $form->field($model, 'expected_rate_comp') ?>

    <?php // echo $form->field($model, 'expected_rent_comp') ?>

    <?php // echo $form->field($model, 'deposit_comp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php yii\widgets\Pjax::end(); ?>
</div>