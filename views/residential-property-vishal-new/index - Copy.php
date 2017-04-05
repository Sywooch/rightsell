<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResidentialpropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Residentialproperties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residentialproperty-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Residentialproperty', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'property_id',
            'property_by',
            'available_for',
            'location_id',
            // 'property_type',
            // 'builtup_area',
            // 'builtup_unit',
            // 'carpet_area',
            // 'carpet_unit',
            // 'bhk',
            // 'other',
            // 'other_bhk',
            // 'society_id',
            // 'city_id',
            // 'area_id',
            // 'building_name',
            // 'age_of_building',
            // 'flat_no',
            // 'total_no_of_floors',
            // 'floor_no',
            // 'facing',
            // 'furnished',
            // 'lift_facility',
            // 'amenities:ntext',
            // 'expected_rate',
            // 'rate_currency',
            // 'rent_currency',
            // 'deposit_currency',
            // 'expected_rent',
            // 'deposit',
            // 'available_from',
            // 'agreement_period',
            // 'is_parking_available',
            // 'parking_structure',
            // 'no_of_parking',
            // 'covered_no',
            // 'open_no',
            // 'company_name',
            // 'contact_person_name',
            // 'mobile_no',
            // 'email_id:ntext',
            // 'other_details',
            // 'key_arrangements',
            // 'profile_photo',
            // 'photos_link',
            // 'video_link',
            // 'other_property_details',
            // 'address_in_proposal:ntext',
            // 'bathroom',
            // 'balcony',
            // 'price_negotiable',
            // 'spl_attraction',
            // 'property_profile_photo',
            // 'gallery_images',
            // 'property_video_link',
            // 'maintenance_cost',
            // 'maintenance_price',
            // 'unit',
            // 'preferred_tenants',
            // 'available_rooms',
            // 'tenant_profiling',
            // 'tenant_profiling_desc',
            // 'added_on',
            // 'added_by',
            // 'updated_on',
            // 'updated_by',
            // 'close_through',
            // 'reason',
            // 'agreement_date',
            // 'locking_period_date',
            // 'end_date',
            // 'remark:ntext',
            // 'reminder_days',
            // 'buyer_details:ntext',
            // 'buy_date',
            // 'publish_on_web',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
