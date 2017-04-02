<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/propertysearch.js',['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResidentialpropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Residential Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid inner_banner">
  <div class="row">
    <div class="container">
    <div class="row">
        <div class="col-sm-8">
          <h1>Get Your Perfect Residential Property</h1>
        </div>
        <div class="col-sm-4"><img src="images/home_img.jpg" alt=""></div>
    </div>
</div>
</div>
</div>
<div class="container-fluid toolbar_section">
    <div class="row search_section">
      <div class="container">
          <div class="row ">
            <div class="col-sm-9">
              <div class="row">
                <div class="col-sm-9 col9">
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Add more Locations..">
              </div>
              <div class="col-sm-3 col3">
                  <div class="row">
                      <div class="col-xs-3">
                          <button type="button" class="btn search_btn"><img src="images/serarch.jpg" alt=""></button>
                      </div>
                      <div class="col-xs-9 padding_left border_right">
                          <div class="checkbox">
                            <input type="checkbox" id="c1" name="cc" checked="checked" />
                            <label class="chkbob_lable" for="c1" style="padding-left:0"><span></span>Nearby properties</label>
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
                                <input type="checkbox" id="pop_1" name="cc"/>
                                <label class="chkbob_lable" for="pop_1"><span></span><img src="images/gym.png" alt="">Gym</label>
                            </p>



                            <p>
                                <input type="checkbox" id="pop_3" name="cc"/>
                                <label class="chkbob_lable" for="pop_3"><span></span><img src="images/power.png" alt="">Power backup</label>
                            </p>

                            <p>
                                <input type="checkbox" id="pop_4" name="cc"/>
                                <label class="chkbob_lable" for="pop_4"><span></span><img src="images/swiming.png" alt="">Swimming pool</label>
                            </p>

                            <p>
                                <input type="checkbox" id="pop_5" name="cc"/>
                                <label class="chkbob_lable" for="pop_5"><span></span><img src="images/home_popup.png" alt="">Club House</label>
                            </p>
                            <p>
                                <input type="checkbox" id="pop_2" name="cc"/>
                                <label class="chkbob_lable" for="pop_2"><span></span><img src="images/door_cam.png" alt="">Door camera</label>
                            </p>
                        </div>
                        <div class="col-sm-3 filter_col">
                            <h1>Filter by</h1>
                            <select>
                                <option>Bathroom</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                            <hr>
                            <select>
                                <option>Facing</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                            <hr>
                            <select>
                                <option>Floor</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                            <hr>
                            <select>
                                <option>Family</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                            <hr>
                            <select>
                                <option>Status</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                            <hr>
                        </div>
                        <div class="col-sm-5 other_col">
                            <h1>Other</h1>
                            <table>
                              <tr>
                                <td>Sq. ft. </td>
                                <td><input name="" type="text"></td>
                                <td>to</td>
                                <td><input name="" type="text"></td>
                            </tr>
                        </table>
                        <hr>
                        <p>
                            <input type="checkbox" id="pop_6" name="cc"/>
                            <label class="chkbob_lable" for="pop_6"><span></span><img src="images/photo.png" alt="">Photos</label>
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
        <!--<ul class="dropdown-menu mega-dropdown-menu row">
            <li class="col-sm-4">
              <ul>
                <li class="dropdown-header">Amenities</li>
                <li><input type="checkbox" id="c40" name="cc"/>
                <label class="chkbob_lable" for="c40"><span></span><img src="images/area.png" alt="">Furnished</label></li>
              </ul>
            </li>
            <li class="col-sm-4">
              <ul>
                <li class="dropdown-header">Amenities</li>
                <li>Easy to customize</li>
              </ul>
            </li>
            <li class="col-sm-4">
              <ul>
                <li class="dropdown-header">Amenities</li>
                <li>Easy to customize</li>
              </ul>
            </li>
        </ul>-->
    </li>

    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/short_ico.jpg" class="short" alt="">Sort by Relevance <img src="images/dd_arrow.jpg" alt=""></a>
        <ul class="dropdown-menu" style="left:18px">
          <li class="first"><a href="#">Relavance</a></li>
          <li><a href="#">Popularity</a></li>
          <li><a href="#">Price (Low to high)</a></li>
          <li><a href="#">Price (High to low)</a></li>
          <li><a href="#">Seller Ratings </a></li>
          <li><a href="#">Date Posted</a></li>
      </ul>
  </li>
</ul>
</div>
</div>
</div>
</div>
</div> 

</div>
<div class="container">
  <div class="row">
    <div class="col-md-12 breadcrum"><a href="#">Home</a> › <a href="#">Property for rent in Pune</a> › <a href="#">Wakad</a> › All Residential</div>
    <div class="col-md-3">
        <div class="pro_left_column"><div class="row">
          <div class="col-xs-7 filter_text">Filter your Search</div>
          <div class="col-xs-5"><a href="<?= Url::to(["residential-property/index"]);?>" class="button red_btn" style="float:right; font-size:13px; margin:0"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a></div>
      </div></div>
      <div class="pro_left_column">
        <input type="radio" id="r1" name="property_by" value="owner" class="getResidentialProperties"/>
        <label for="r1"><span></span>Owner</label>
        <input type="radio" id="r2" name="property_by" value="agent" class="getResidentialProperties"/>
        <label for="r2"><span></span>Agent</label>
        <!-- <input type="radio" id="r5" name="property_by" value="flatmate" />
        <label for="r5"><span></span>Flatmate</label> -->
    </div>

    <div class="pro_left_column">
        <input type="radio" id="r3" name="available_for" value="sale"/>
        <label for="r3"><span></span>Buy</label>
        <input type="radio" id="r4" name="available_for" value="rent"/>
        <label for="r4"><span></span>Rent</label>
        <input type="radio" id="r5" name="available_for" value=""/>
        <label for="r5"><span></span>Flatmate</label>
        
        
    </div>

    <div class="pro_left_column">
        <div class="row">
            <div class="col-xs-6" style="padding-right:0"><input type="checkbox" id="c40" name="furnished" value="ff"/>
                <label class="chkbob_lable" for="c40"><span></span>Furnished</label></div>
                <div class="col-xs-6" style="padding:0 0 0 10px"><input type="checkbox" id="c50" name="furnished" value="sf"/>
                    <label class="chkbob_lable" for="c50"><span></span>Semi-Furnished</label></div>

                    <div class="col-xs-12" style="text-align:center"><input type="checkbox" id="c70" name="furnished" value="uf"/>
                        <label class="chkbob_lable" for="c70"><span></span>Non Furnished</label></div>
                    </div>
                </div>

                <div class="pro_left_column">
                    <div class="row demo">
                        <div class="col-xs-5 demo_col">
                            <img src="images/rupee.jpg" alt=""><select>
                            <option>Min</option>
                            <option>5 Lac</option>
                            <option>10 Lac</option>
                            <option>20 Lac</option>
                            <option>25 Lac</option>
                            <option>40 Lac</option>
                            <option>50 Lac</option>
                            <option>80 Lac</option>
                            <option>1 Cr</option>
                        </select></div>
                        <div class="col-xs-2 boldtxt">-</div>
                        <div class="col-xs-5 demo_col"><img src="images/rupee.jpg" alt=""><select>
                            <option>Max</option>
                            <option>10 Lac</option>
                            <option>20 Lac</option>
                            <option>25 Lac</option>
                            <option>40 Lac</option>
                            <option>50 Lac</option>
                            <option>80 Lac</option>
                            <option>1 Cr</option>
                            <option>1.5 Cr</option>
                        </select></div></div>
                    </div>

                    <div class="pro_left_column">
                      <div class="row">
                        <div class="col-xs-6">
                            <input type="checkbox" id="c2" name="cc"/>
                            <label class="chkbob_lable" for="c2"><span></span>1 RK</label>
                        </div>
                        <div class="col-xs-6">
                            <input type="checkbox" id="c3" name="cc"/>
                            <label class="chkbob_lable" for="c3"><span></span>2.5 BHK</label>
                        </div>
                        <div class="col-xs-6"><input type="checkbox" id="c4" name="cc"/>
                            <label class="chkbob_lable" for="c4"><span></span>1 BHK</label></div>
                            <div class="col-xs-6"><input type="checkbox" id="c5" name="cc"/>
                                <label class="chkbob_lable" for="c5"><span></span>3 BHK</label></div>
                                <div class="col-xs-6"><input type="checkbox" id="c6" name="cc"/>
                                    <label class="chkbob_lable" for="c6"><span></span>2 BHK</label></div>
                                    <div class="col-xs-6"><input type="checkbox" id="c7" name="cc"/>
                                        <label class="chkbob_lable" for="c7"><span></span>3.5 BHK</label></div>
                                    </div>
                                    <hr style="margin:10px 0 15px 0">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <input type="checkbox" id="c8" name="cc"/>
                                            <label class="chkbob_lable" for="c8"><span></span>Apartment</label>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="checkbox" id="c9" name="cc"/>
                                            <label class="chkbob_lable" for="c9"><span></span>Independent</label>
                                        </div>
                                        <div class="col-xs-6"><input type="checkbox" id="c10" name="cc"/>
                                            <label class="chkbob_lable" for="c10"><span></span>Bunglow</label></div>
                                            <div class="col-xs-6"><input type="checkbox" id="c11" name="cc"/>
                                                <label class="chkbob_lable" for="c11"><span></span>Penthouse</label></div>
                                                <div class="col-xs-6"><input type="checkbox" id="c12" name="cc"/>
                                                    <label class="chkbob_lable" for="c12"><span></span>Villa</label></div>
                                                    <div class="col-xs-6"><input type="checkbox" id="c13" name="cc"/>
                                                        <label class="chkbob_lable" for="c13"><span></span>Plot</label></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-7 projects_section">
                                                <h1>39 Properties in Wakad, Bawdhan, from owner. &nbsp;&nbsp;</h1>
                                                <h2>0 Nearby properties</h2>

                                                <div class="row pro_box">
                                                    <div class="col-sm-5 nopadding">
                                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                          <div class="carousel-inner" role="listbox">
                                                            <div class="item active">
                                                              <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">                    </div>
                                                              <div class="item">
                                                                  <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">                    </div>
                                                                  <div class="item">
                                                                      <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">                    </div>
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
                                                    <!--<div class="col-sm-2"></div>-->
                                                </div>
                                                <div class="row pro_box">
                                                    <div class="col-sm-5 nopadding">
                                                      <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                          <div class="carousel-inner" role="listbox">
                                                            <div class="item active">
                                                              <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">                    </div>
                                                              <div class="item">
                                                                  <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">                    </div>
                                                                  <div class="item">
                                                                      <img class="d-block img-fluid img-responsive" src="images/pro_img.jpg" alt="">                    </div>
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
                                                                    <div class="col-xs-12"><strong>Status:</strong> This property 5 years old</div>
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
                                                    <!--<div class="col-sm-2"></div>-->
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <div class="col-md-2"></div>-->
                                    </div>