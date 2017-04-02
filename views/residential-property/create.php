<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Residentialproperty */

$this->title = 'Create Residentialproperty';
$this->params['breadcrumbs'][] = ['label' => 'Residentialproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residentialproperty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
