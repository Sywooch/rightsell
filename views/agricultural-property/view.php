<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Agriculturalproperty */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Agriculturalproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agriculturalproperty-view">

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
            'property_id',
            'property_by',
            'available_for',
            'location_id',
            'city_id',
            'property_type',
            'property_area',
            'property_unit',
            'amenities:ntext',
            'expected_rate',
            'rate_currency',
            'expected_rent',
            'rent_currency',
            'deposit',
            'othercharges',
            'deposit_currency',
            'othercharges_currency',
            'electric_supply',
            'description_ES:ntext',
            'water_supply',
            'description_WS:ntext',
            'contact_person_name',
            'mobile_no',
            'email_id:ntext',
            'profile_photo',
            'photos_link',
            'address_in_proposal:ntext',
            'description:ntext',
            'ideal_for:ntext',
            'connectivity:ntext',
            'property_profile_photo',
            'gallery_images',
            'added_on',
            'added_by',
            'updated_on',
            'updated_by',
            'close_through',
            'reason',
            'agreement_date',
            'locking_period_date',
            'end_date',
            'remark:ntext',
            'reminder_days',
            'buyer_details:ntext',
            'buy_date',
            'publish_on_web',
            'status',
        ],
    ]) ?>

</div>
