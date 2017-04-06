<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CommercialpropertySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commercialproperty-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'available_for') ?>

    <?= $form->field($model, 'property_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'sublocation') ?>

    <?php // echo $form->field($model, 'landmark') ?>

    <?php // echo $form->field($model, 'building_name') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'splitted_area') ?>

    <?php // echo $form->field($model, 'total_no_of_floors') ?>

    <?php // echo $form->field($model, 'floor_no') ?>

    <?php // echo $form->field($model, 'office_no') ?>

    <?php // echo $form->field($model, 'rent_details') ?>

    <?php // echo $form->field($model, 'rentunit') ?>

    <?php // echo $form->field($model, 'deposite_details') ?>

    <?php // echo $form->field($model, 'depositunit') ?>

    <?php // echo $form->field($model, 'rate_details') ?>

    <?php // echo $form->field($model, 'rate_details_unit') ?>

    <?php // echo $form->field($model, 'maintenance_tax') ?>

    <?php // echo $form->field($model, 'maintenance_tax_unit') ?>

    <?php // echo $form->field($model, 'service_tax_applicable') ?>

    <?php // echo $form->field($model, 'service_tax_value') ?>

    <?php // echo $form->field($model, 'other_charges') ?>

    <?php // echo $form->field($model, 'other_charges_unit') ?>

    <?php // echo $form->field($model, 'service_tax_unit') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'furnished') ?>

    <?php // echo $form->field($model, 'reception') ?>

    <?php // echo $form->field($model, 'min_workstations') ?>

    <?php // echo $form->field($model, 'max_workstations') ?>

    <?php // echo $form->field($model, 'cubicle') ?>

    <?php // echo $form->field($model, 'cabin') ?>

    <?php // echo $form->field($model, 'half_cabin') ?>

    <?php // echo $form->field($model, 'boardroom') ?>

    <?php // echo $form->field($model, 'conference_room') ?>

    <?php // echo $form->field($model, 'meeting_room') ?>

    <?php // echo $form->field($model, 'discussion_room') ?>

    <?php // echo $form->field($model, 'admin_room') ?>

    <?php // echo $form->field($model, 'account_room') ?>

    <?php // echo $form->field($model, 'interview_room') ?>

    <?php // echo $form->field($model, 'storage_room') ?>

    <?php // echo $form->field($model, 'ups_room') ?>

    <?php // echo $form->field($model, 'server_room') ?>

    <?php // echo $form->field($model, 'hub_room') ?>

    <?php // echo $form->field($model, 'epabx_room') ?>

    <?php // echo $form->field($model, 'ahu_room') ?>

    <?php // echo $form->field($model, 'electrical_room') ?>

    <?php // echo $form->field($model, 'store_room') ?>

    <?php // echo $form->field($model, 'pantry') ?>

    <?php // echo $form->field($model, 'cafeteria') ?>

    <?php // echo $form->field($model, 'toilets') ?>

    <?php // echo $form->field($model, 'power_backup') ?>

    <?php // echo $form->field($model, 'lift_facility') ?>

    <?php // echo $form->field($model, 'four_wheeler_parking') ?>

    <?php // echo $form->field($model, 'two_wheeler_parking') ?>

    <?php // echo $form->field($model, 'outer_power_backup') ?>

    <?php // echo $form->field($model, 'frontedge') ?>

    <?php // echo $form->field($model, 'frontedge_height') ?>

    <?php // echo $form->field($model, 'mezzanine') ?>

    <?php // echo $form->field($model, 'mezzanine_height') ?>

    <?php // echo $form->field($model, 'warehouse_height') ?>

    <?php // echo $form->field($model, 'power_load') ?>

    <?php // echo $form->field($model, 'open_area') ?>

    <?php // echo $form->field($model, 'office_shed_area') ?>

    <?php // echo $form->field($model, 'owners_name') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'landline_no') ?>

    <?php // echo $form->field($model, 'email_id') ?>

    <?php // echo $form->field($model, 'other_details') ?>

    <?php // echo $form->field($model, 'website_link') ?>

    <?php // echo $form->field($model, 'proposal_title') ?>

    <?php // echo $form->field($model, 'commercial_offer') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'lenden_address') ?>

    <?php // echo $form->field($model, 'picasa_url') ?>

    <?php // echo $form->field($model, 'facing') ?>

    <?php // echo $form->field($model, 'ideal_for') ?>

    <?php // echo $form->field($model, 'available_from') ?>

    <?php // echo $form->field($model, 'gallery_images') ?>

    <?php // echo $form->field($model, 'water_availability') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'publish_on_web') ?>

    <?php // echo $form->field($model, 'added_on') ?>

    <?php // echo $form->field($model, 'added_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'rate_details_comp') ?>

    <?php // echo $form->field($model, 'rent_details_comp') ?>

    <?php // echo $form->field($model, 'deposite_details_comp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
