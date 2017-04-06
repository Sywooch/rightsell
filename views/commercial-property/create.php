<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Commercialproperty */

$this->title = 'Create Commercialproperty';
$this->params['breadcrumbs'][] = ['label' => 'Commercialproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commercialproperty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
