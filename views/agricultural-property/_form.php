<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agriculturalproperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agriculturalproperty-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'property_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_for')->dropDownList([ 'Sale' => 'Sale', 'Rent' => 'Rent', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'property_type')->dropDownList([ 'Agricultural land' => 'Agricultural land', 'Industrial land' => 'Industrial land', 'NA plots' => 'NA plots', 'Farm house plot' => 'Farm house plot', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'property_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amenities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'expected_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expected_rent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rent_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deposit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'othercharges')->textInput() ?>

    <?= $form->field($model, 'deposit_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'othercharges_currency')->dropDownList([ 'Thousands' => 'Thousands', 'Lacs' => 'Lacs', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'electric_supply')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'description_ES')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'water_supply')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'description_WS')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'profile_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photos_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_in_proposal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ideal_for')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'connectivity')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'property_profile_photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gallery_images')->textInput(['maxlength' => true]) ?>

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
