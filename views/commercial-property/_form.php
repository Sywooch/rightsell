<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Commercialproperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commercialproperty-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'available_for')->dropDownList([ 'Sale' => 'Sale', 'Lease' => 'Lease', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'property_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Shop' => 'Shop', 'Showroom' => 'Showroom', 'Office' => 'Office', 'Warehouse' => 'Warehouse', 'Industrial Shed' => 'Industrial Shed', 'Godown' => 'Godown', 'Hotel' => 'Hotel', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'sublocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'building_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'splitted_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_no_of_floors')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floor_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rent_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rentunit')->dropDownList([ 'Thousands' => 'Thousands', 'Lacs' => 'Lacs', 'Crores' => 'Crores', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'deposite_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'depositunit')->dropDownList([ 'Thousands' => 'Thousands', 'Lacs' => 'Lacs', 'Crores' => 'Crores', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'rate_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate_details_unit')->dropDownList([ 'Thousands' => 'Thousands', 'Lacs' => 'Lacs', 'Crores' => 'Crores', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'maintenance_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maintenance_tax_unit')->dropDownList([ 'Thousands' => 'Thousands', 'Lacs' => 'Lacs', 'Crores' => 'Crores', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'service_tax_applicable')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'service_tax_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_charges')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_charges_unit')->dropDownList([ 'Thousands' => 'Thousands', 'Lacs' => 'Lacs', 'Crores' => 'Crores', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'service_tax_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'furnished')->dropDownList([ 'UN' => 'UN', 'SF' => 'SF', 'FF' => 'FF', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reception')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_workstations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_workstations')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cubicle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cabin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'half_cabin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'boardroom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conference_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meeting_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discussion_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interview_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storage_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ups_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'server_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hub_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'epabx_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ahu_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'electrical_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pantry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cafeteria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'toilets')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'power_backup')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lift_facility')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'four_wheeler_parking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'two_wheeler_parking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outer_power_backup')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'frontedge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'frontedge_height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mezzanine')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'mezzanine_height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warehouse_height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'power_load')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_shed_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owners_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landline_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'website_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposal_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commercial_offer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lenden_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'picasa_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'facing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ideal_for')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'available_from')->textInput() ?>

    <?= $form->field($model, 'gallery_images')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'water_availability')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publish_on_web')->textInput() ?>

    <?= $form->field($model, 'added_on')->textInput() ?>

    <?= $form->field($model, 'added_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'rate_details_comp')->textInput() ?>

    <?= $form->field($model, 'rent_details_comp')->textInput() ?>

    <?= $form->field($model, 'deposite_details_comp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
