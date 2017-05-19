
<?php
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\data\Pagination;

$host = "localhost";
//$host = "103.208.73.2";
?>


<div class="container-fluid inner_banner" style="background:#9dc415">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h1>Get Your Perfect Agricultural Property</h1>
        </div>
        <div class="col-sm-4"><img src="images/agri_img.png" alt=""></div>
      </div>
    </div>
  </div>
</div>
<form id="topagripropfilter">
<div class="container-fluid toolbar_section">
<div class="row search_section">
<div class="container">
<div class="row ">
<div class="col-sm-9">
<div class="row">
<div class="col-sm-9 col9">
<input type="text" class="form-control" id="filterAgriProp_locationname" placeholder="Add more Locations..">
<!-- <ul id="proplocations">
</ul> -->
<div id="hidlocationids">
</div>
</div>
<div class="col-sm-3 col3">
<div class="row">
<div class="col-xs-3">
<button type="button" class="btn search_btn"><img src="images/serarch.jpg" alt=""></button>
</div>
<div class="col-xs-9 padding_left border_right">
<div class="checkbox">
<input type="checkbox" id="filterAgriProp_nearby" name="nearbyresprop" value="1" <?php echo ($searchModel->nearby ==1) ? "checked=checked":"";?>/>
<label class="chkbob_lable" for="filterAgriProp_nearby" style="padding-left:0"><span></span>Nearby properties</label>
</div>
</div>

</div>
</div>
</div>
</div>
<div class="col-sm-3">
<div class="row search_right short_section">
<ul class="nav navbar-nav">
<li><a href="#" data-toggle="modal" data-target="#myModal-5"><img src="images/more.jpg" class="short" alt="">More <img src="images/dd_arrow.jpg" alt=""></a>
<div class="modal" tabindex="-1" id="myModal-5" role="dialog">
<div class="modal-dialog more_modal_dilog" role="document">
<div class="modal-content">

<div class="modal-body popup_content">
<div class="row">
<div class="col-sm-4 amenities_col">
<h1>Amenities</h1>
<p>
<input type="checkbox" id="pop_1" name="filterAgriProp_amenity[]" value="56" class="filterResPropAmenity"/>
<label class="chkbob_lable" for="pop_1"><span></span><img src="images/gym.png" alt="">Fencing</label>
</p>

<p>
<input type="checkbox" id="pop_3" name="filterAgriProp_amenity[]" value="58" class="filterResPropAmenity"/>
<label class="chkbob_lable" for="pop_3"><span></span><img src="images/power.png" alt="">Electricity Supply</label>
</p>

<p>
<input type="checkbox" id="pop_4" name="filterAgriProp_amenity[]" value="53" class="filterResPropAmenity"/>
<label class="chkbob_lable" for="pop_4"><span></span><img src="images/swiming.png" alt="">Water Supply</label>
</p>

<p>
<input type="checkbox" id="pop_5" name="filterAgriProp_amenity[]" value="59" class="filterResPropAmenity"/>
<label class="chkbob_lable" for="pop_5"><span></span><img src="images/home_popup.png" alt="">Compound Wall</label>
</p>
</div>
<div class="col-sm-5 other_col">
<h1>Other</h1>
<table>
<tr>
<td><select id="filterAgriProp_builtupunit" name="builtup_unit__">
    <option value="">Select Unit</option>
    <option>Sq.ft</option>
    <option>Acre</option>
    <option>Hector</option>
</select></td>
<td><input id="filterAgriProp_minsqfeet_" name="filterAgriProp_minsqfeet_" type="text"></td>
<td>to</td>
<td><input id="filterAgriProp_maxsqfeet_" name="filterAgriProp_maxsqfeet_" type="text"></td>

</tr>
</table>
<hr>
<p>
<input type="checkbox" id="filterAgriProp_haveimage" name="filterAgriProp_haveimage"/>
<label class="chkbob_lable" for="filterAgriProp_haveimage"><span></span>Properties with images only
<!-- <img src="images/photo.png" alt="">Photos</label> -->
</p>
<hr>
<p><img src="images/rs_veryfi.png" alt=""><br>
<span>Rightsell verified property</span></p>

</div>
</div>
</div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
</li>

<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/short_ico.jpg" class="short" alt="">Sort by Relevance <img src="images/dd_arrow.jpg" alt=""></a>
<ul class="dropdown-menu" style="left:18px">
<li class="first"><a href="#">Relavance</a></li>
<li><a href="#" class="sortagriprop" data-val="popular">Popularity</a></li>
<li><a href="#" class="sortagriprop" data-val="asc">Price (Low to high)</a></li>
<li><a href="#" class="sortagriprop" data-val="desc">Price (High to low)</a></li>
<li><a href="#" class="sortagriprop" data-val="rate">Seller Ratings </a></li>
<li><a href="#" class="sortagriprop" data-val="postdate">Date Posted</a></li>
</ul>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
<div class="container">
<div class="row">
<div class="col-md-12 breadcrum"><!-- <a href="#">Home</a> › <a href="#">Property for Buy/Rent in Pune</a> › <a href="#">Wakad</a> › All Agricultural --></div>
<div class="col-md-3">
<!--<div class="pro_left_column"><div class="row">
<div class="col-xs-7 filter_text">Filter your Search</div>
<div class="col-xs-5"><a href="<?= Url::to(["agricultural-property/index","city"=>$searchModel->city_id]);?>" class="button red_btn" style="float:right; font-size:13px; margin:0"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a></div>
</div>
</div>-->

<div class=""><div class="row">
<div class="col-xs-7 filter_text">&nbsp;Filter your Search</div>
<div class="col-xs-5"><a href="<?= Url::to(["agricultural-property/index","city"=>$searchModel->city_id]);?>" class="button reset_btn" style="float:right; font-size:14px; margin:0; color:#f28533"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a></div>
</div>
</div><br>

<?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>

<div class="col-md-7 projects_section" id="projects_section">
<?php 
Pjax::begin([
    'id'=>'newpropsection',
'enablePushState' => false, // to disable push state
'enableReplaceState' => false // to disable replace state
]);?>
<?= $this->render("property_item", ['dataProvider' => $dataProvider,"locationname"=>"","propby"=>"",'availablefr' => $availablefr]);?>
<?php Pjax::end();?>
</div>
</div>