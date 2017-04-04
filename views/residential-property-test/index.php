<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResidentialpropertyTestVisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Residentialproperties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="residentialproperty-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Residentialproperty', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
<?= ListView::widget([
        'id'=>'gridData',
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) ?>
<?php Pjax::end(); ?></div>
<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#search-form").on("pjax:end", function() {
            $.pjax.reload({container:"#gridData"});  //Reload GridView
        });

        $("input, select").on("change", function() {
            $.pjax.submit($("#search-form"));
        });
    });'
);
?>