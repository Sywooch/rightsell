<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
?>

<h1><?=$dataProvider->getTotalCount();?> Properties <?= $locationname? "in ".$locationname: "" ?><?= $propby? " from ".$propby: "" ?></h1>
<h2>0 Nearby properties</h2>
<?php 
$pages = new Pagination(['totalCount' => $dataProvider->getTotalCount()]);
echo LinkPager::widget([
	'pagination' => $pages,
	'linkOptions'=>['class'=>'custpagination']
]);

echo ListView::widget([
        'dataProvider' => $dataProvider,
        'viewParams' => ['locationname' => $locationname],
        'itemOptions' => ['class' => 'row pro_box'],
        'itemView' => '_item',
    ]);

    ?>