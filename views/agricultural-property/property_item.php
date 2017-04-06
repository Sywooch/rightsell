<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
//echo $model->property_by; exit;
?>

<h1><?=$dataProvider->getTotalCount();?> Properties <?= $locationname? "in ".$locationname: "" ?><?= $propby? " from ".$propby: "" ?><?= $availablefr? " for ".$availablefr: "" ?></h1>
<h2>0 Nearby properties</h2>
<?php 


echo ListView::widget([
        'dataProvider' => $dataProvider,
        'viewParams' => ['locationname' => $locationname],
        'itemOptions' => ['class' => 'row pro_box'],
        'itemView' => '_item',
    ]);

    ?>