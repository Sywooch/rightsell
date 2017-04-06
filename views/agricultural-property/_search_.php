<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgriculturalpropertySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agriculturalproperty-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'property_id') ?>

    <?= $form->field($model, 'property_by') ?>

    <?= $form->field($model, 'available_for') ?>

    <?= $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'property_type') ?>

    <?php // echo $form->field($model, 'property_area') ?>

    <?php // echo $form->field($model, 'property_unit') ?>

    <?php // echo $form->field($model, 'amenities') ?>

    <?php // echo $form->field($model, 'expected_rate') ?>

    <?php // echo $form->field($model, 'rate_currency') ?>

    <?php // echo $form->field($model, 'expected_rent') ?>

    <?php // echo $form->field($model, 'rent_currency') ?>

    <?php // echo $form->field($model, 'deposit') ?>

    <?php // echo $form->field($model, 'othercharges') ?>

    <?php // echo $form->field($model, 'deposit_currency') ?>

    <?php // echo $form->field($model, 'othercharges_currency') ?>

    <?php // echo $form->field($model, 'electric_supply') ?>

    <?php // echo $form->field($model, 'description_ES') ?>

    <?php // echo $form->field($model, 'water_supply') ?>

    <?php // echo $form->field($model, 'description_WS') ?>

    <?php // echo $form->field($model, 'contact_person_name') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'email_id') ?>

    <?php // echo $form->field($model, 'profile_photo') ?>

    <?php // echo $form->field($model, 'photos_link') ?>

    <?php // echo $form->field($model, 'address_in_proposal') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'ideal_for') ?>

    <?php // echo $form->field($model, 'connectivity') ?>

    <?php // echo $form->field($model, 'property_profile_photo') ?>

    <?php // echo $form->field($model, 'gallery_images') ?>

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
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
