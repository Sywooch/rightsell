<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Commercialproperty */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Commercialproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commercialproperty-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'available_for',
            'property_id',
            'type',
            'location_id',
            'city_id',
            'sublocation',
            'landmark',
            'building_name',
            'area',
            'splitted_area',
            'total_no_of_floors',
            'floor_no',
            'office_no',
            'rent_details',
            'rentunit',
            'deposite_details',
            'depositunit',
            'rate_details',
            'rate_details_unit',
            'maintenance_tax',
            'maintenance_tax_unit',
            'service_tax_applicable',
            'service_tax_value',
            'other_charges',
            'other_charges_unit',
            'service_tax_unit',
            'description',
            'furnished',
            'reception',
            'min_workstations',
            'max_workstations',
            'cubicle',
            'cabin',
            'half_cabin',
            'boardroom',
            'conference_room',
            'meeting_room',
            'discussion_room',
            'admin_room',
            'account_room',
            'interview_room',
            'storage_room',
            'ups_room',
            'server_room',
            'hub_room',
            'epabx_room',
            'ahu_room',
            'electrical_room',
            'store_room',
            'pantry',
            'cafeteria',
            'toilets',
            'power_backup',
            'lift_facility',
            'four_wheeler_parking',
            'two_wheeler_parking',
            'outer_power_backup',
            'frontedge',
            'frontedge_height',
            'mezzanine',
            'mezzanine_height',
            'warehouse_height',
            'power_load',
            'open_area',
            'office_shed_area',
            'owners_name',
            'mobile_no',
            'landline_no',
            'email_id:ntext',
            'other_details:ntext',
            'website_link',
            'proposal_title',
            'commercial_offer:ntext',
            'note:ntext',
            'lenden_address:ntext',
            'picasa_url:ntext',
            'facing',
            'ideal_for:ntext',
            'available_from',
            'gallery_images',
            'water_availability',
            'photo',
            'publish_on_web',
            'added_on',
            'added_by',
            'updated_on',
            'updated_by',
            'reason',
            'status',
            'rate_details_comp',
            'rent_details_comp',
            'deposite_details_comp',
        ],
    ]) ?>

</div>
