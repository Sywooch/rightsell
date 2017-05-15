
<?php
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\data\Pagination;

$host = "localhost";
//$host = "103.208.73.2";
?>


<div class="container-fluid inner_banner" style="background:#3db4f9">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h1>Get Your Perfect Commercial Property</h1>
        </div>
        <div class="col-sm-4"><img src="images/home_img.png" alt=""></div>
      </div>
    </div>
  </div>
</div>

<form id="topcommpropfilter">
<div class="container-fluid toolbar_section">
<div class="row search_section">
<div class="container">
<div class="row ">
<div class="col-sm-9">
<div class="row">
<div class="col-sm-9 col9">
<input type="text" class="form-control" id="filterCommProp_locationname" placeholder="Add more Locations..">
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
<input type="checkbox" id="filterCommProp_nearby" name="nearbyresprop" value="1" <?php echo ($searchModel->nearby ==1) ? "checked=checked":"";?>/>
<label class="chkbob_lable" for="filterCommProp_nearby" style="padding-left:0"><span></span>Nearby properties</label>
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
<input type="checkbox" id="aminity_cafetria" name="filterCommProp_amenity[]" value="Cafeteria" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_cafetria"><span></span><img src="images/gym.png" alt="">Cafeteria</label>
</p>

<p>
<input type="checkbox" id="aminity_wifi" name="filterCommProp_amenity[]" value="Wifi" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_wifi"><span></span><img src="images/power.png" alt="">Wifi</label>
</p>

<p>
<input type="checkbox" id="aminity_conf" name="filterCommProp_amenity[]" value="Conference" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_conf"><span></span><img src="images/swiming.png" alt="">Conference Facility</label>
</p>

<p>
<input type="checkbox" id="aminity_vastu" name="filterCommProp_amenity[]" value="Vastu" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_vastu"><span></span><img src="images/home_popup.png" alt="">Vastu Compliant</label>
</p>
<p>
<input type="checkbox" id="aminity_reception" name="filterCommProp_amenity[]" value="Reception" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_reception"><span></span><img src="images/door_cam.png" alt="">Reception</label>
</p>

<p>
<input type="checkbox" id="aminity_washroom" name="filterCommProp_amenity[]" value="Washroom" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_washroom"><span></span><img src="images/door_cam.png" alt="">Washroom</label>
</p>

<p>
<input type="checkbox" id="aminity_firefacility" name="filterCommProp_amenity[]" value="Fire Facility" class="filterCommPropAmenity"/>
<label class="chkbob_lable" for="aminity_firefacility"><span></span><img src="images/door_cam.png" alt="">Fire Facility</label>
</p>

</div>
<div class="col-sm-3 filter_col">
<h1>Filter by</h1>
<!-- <select id="filterResProp_bathroom" name="filterResProp_bathroom">
<option value="">Bathroom</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select> -->
<hr>
<select id="filterCommProp_facing" name="filterCommProp_facing">
<option value="">Facing</option>
<option value="East">East</option>
<option value="West">West</option>
<option value="North">North</option>
<option value="South">South</option>
</select>
<hr>
<!-- <select id="filterCommProp_floor" name="filterCommProp_floor">
<option value="">Floor</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select> -->

<select id="filterCommProp_floor" name="filterCommProp_floor" multiple="multiple">
<option value="-1">Basement</option>
<option value="0">Ground</option>
<option value="1,2,3,4">1-4</option>
<option value="5,6,7,8">5-8</option>
<option value="9,10,11,12">9-12</option>
<option value="13,14,15,16">13-16</option>
<option value="16+">16+</option>
</select>


<hr>
<!-- <select id="filterResProp_family" name="filterResProp_family">
<option value="">Family</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select> -->
<hr>
<select id="filterCommProp_status" name="filterCommProp_status">
<option value="">Status</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
<hr>
</div>
<div class="col-sm-5 other_col">
<h1>Other</h1>
<table>
<tr>
<td>Sq. ft. </td>
<td><input id="filterCommProp_minws" name="filterCommProp_minws" type="text"></td>
<td>to</td>
<td><input id="filterCommProp_maxws" name="filterCommProp_maxws" type="text"></td>
</tr>
</table>
<hr>
<p>
<input type="checkbox" id="filterCommProp_haveimage" name="filterCommProp_haveimage"/>
<label class="chkbob_lable" for="filterCommProp_haveimage"><span></span>Properties with images only
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
<li><a href="#" class="sortcommprop" data-val="popular">Popularity</a></li>
<li><a href="#" class="sortcommprop" data-val="asc">Price (Low to high)</a></li>
<li><a href="#" class="sortcommprop" data-val="desc">Price (High to low)</a></li>
<li><a href="#" class="sortcommprop" data-val="rate">Seller Ratings </a></li>
<li><a href="#" class="sortcommprop" data-val="postdate">Date Posted</a></li>
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
<div class="col-md-12 breadcrum"><!-- <a href="#">Home</a> › <a href="#">Property for rent/lease in Pune</a> › <a href="#">Bawdhan</a> › All Commercial --></div>
<div class="col-md-3">
<!--<div class="pro_left_column"><div class="row">
<div class="col-xs-7 filter_text">Filter your Search</div>
<div class="col-xs-5"><a href="<?= Url::to(["commercial-property/index","city"=>$searchModel->city_id]);?>" class="button red_btn" style="float:right; font-size:13px; margin:0"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a></div>
</div>
</div>-->

<div class=""><div class="row">
<div class="col-xs-7 filter_text">&nbsp;Filter your Search</div>
<div class="col-xs-5"><a href="<?= Url::to(["commercial-property/index","city"=>$searchModel->city_id]);?>" class="button reset_btn" style="float:right; font-size:14px; margin:0; color:#f28533"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a></div>
</div>
</div><br>

<?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>

<div class="col-md-7 projects_section" id="projects_section">
<!-- <h1>39 Properties in Wakad, Bawdhan, from owner. &nbsp;&nbsp;</h1>
<h2>0 Nearby properties</h2> -->
<?php 
/*$pages = new Pagination(['totalCount' => $dataProvider->getTotalCount()]);
echo LinkPager::widget([
    'pagination' => $pages,
    'linkOptions'=>['class'=>'custpagination']
]);*/
Pjax::begin([
    'id'=>'newpropsection',
'enablePushState' => false, // to disable push state
'enableReplaceState' => false // to disable replace state
]);?>
<?= $this->render("property_item", ['dataProvider' => $dataProvider,"locationname"=>"","propby"=>"",'availablefr' => $availablefr]);?>
<?php Pjax::end();?>


<!--<div class="row pro_box">
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
</div>-->
</div>
</div>