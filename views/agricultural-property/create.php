<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Agriculturalproperty */

$this->title = 'Create Agriculturalproperty';
$this->params['breadcrumbs'][] = ['label' => 'Agriculturalproperties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agriculturalproperty-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
