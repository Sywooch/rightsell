<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
//echo $locationname;
?>

<h1><?=$dataProvider->getTotalCount();?> Properties <?= $locationname? "in ".$locationname: "" ?><?= $propby? " from ".$propby: "" ?></h1>
<h2>0 Nearby properties</h2>
<?php 


echo ListView::widget([
        'dataProvider' => $dataProvider,
        'viewParams' => ['locationname' => $locationname],
        'itemOptions' => ['class' => 'row pro_box'],
        'itemView' => '_item',
    ]);

    ?>
<!-- <div class="row pro_box">
	<div class="col-sm-5 nopadding">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
				<div class="item">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
				<div class="item">
					<img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<div class="col-sm-7">
		<div class="row pro_detail">
			<h1>2 BHK, Near Bridge, Wakad.</h1>
			<button class="button yellow_btn">2 BHK</button>
			<button class="button orrange_btn">Rent 12,000</button>
			<button class="button yellow_btn">Deposit 30,000</button>
			<div class="row">
				<div class="col-xs-6"><p><img src="images/family.png" alt="">Family only</p></div>
				<div class="col-xs-6"><p><img src="images/car.png" alt="">Car Parking</p></div>
			</div>	
			<div class="row">
				<div class="col-xs-6"><p><img src="images/area.png" alt="">Area - 600 Sq.Ft.</p></div>
				<div class="col-xs-6"><p><img src="images/furnished.png" alt="">Un-furnished</p></div>
				<div class="col-xs-12"><strong>Status:</strong> This property 2 years old</div>
			</div>
			<div class="row">
				<div class="col-xs-6"><button class="button red_btn">Contact Owner</button></div>
				<div class="col-xs-6"><table>
					<tr>
						<td><a href="#"><img src="images/ico1.png" alt="" border="0"></a></td>
						<td><a href="#"><img src="images/ico2.png" alt="" border="0"></a></td>
						<td><a href="#"><img src="images/ico3.png" alt="" border="0"></a></td>
					</tr>
				</table></div>
			</div>
		</div>
	</div>
</div> -->