<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">

    <link rel="stylesheet" href="css/scroll.css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/responsive-tabs.css">
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-fluid" style="border-bottom:solid 1px #e6e6e6"><div class="container-fluid main_header">
  <div class="row">
  <div class="col-sm-3 logo"><a href="<?= Url::home()?>" ><img src="images/logo.jpg" class="img-responsive" alt=""></a></div>
        <div class="col-sm-9 header_right">
          <div class="row">
            <div class="col-xs-10 header_lt_col">
              <div class="header_text">
                <div>
                  <ul>
                    <li class="sec1"><img src="images/contact_ico.jpg" alt="">
                      <p>Support <span>+91 987 700 0000</span></p>
                    </li>
                    <li class="sec2"><img src="images/home_ico.jpg" alt="">
                      <p><a href="#">Post your Property</a></p>
                    </li>
                    
            <li style="margin-left: 25px; margin-top: 4px;"><a href="#">Sign in</a>    &nbsp;|&nbsp;   <a href="#">Sign Up</a></li>
                  </ul>
                </div>
                
              </div>
            </div>
            <div class="col-xs-2 header_rt_col"><a href="#"><img src="images/menu_ico.jpg" class="img-responsive menu_ico" alt=""></a></div>
          </div>
        </div>
    <!--<div class="container">
      <div class="row">
        
      </div>
    </div>-->
  </div>
</div></div>
<?= $content ?>

<section class="about">
  <div class="container">
    <div class="row">
      <!--<div class="col-md-5 col-sm-5">
        <h2>About US</h2>
        <p>new home rental platform that makes it easier to find your new home without paying any brokerage. Use our verified listing to ensure you find your dream home by contacting the owners directly. In case you cannot find a property you are looking to please post a requirement and we'll send you email notification with properties matching your requirements. </p>
    <div class="col-md-12 col-sm-12" style="padding-left:0"><ul class="nav nav-pills" role="tablist">
          <li role="presentation" class="active"><a href="#"><span class="fa fa-thumbs-o-up">&nbsp;&nbsp;Like</span></a></li>
          <li role="presentation" class="active"><a href="#">Share</a></li>
        </ul><br>

     <img src="images/like_us.jpg"/> </div>
      </div>-->
      <div class="col-md-3 col-sm-6 footer_links">
        <h2>Company</h2>
        <ul>
      <li><a href="#">Career</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Customer Care</a></li>
      <li><a href="#"> Terms & Conditions</a></li>
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Sitemap</a></li>
      <li><a href="#">Faq</a></li>
    </ul>
      </div>
     <div class="col-md-3 col-sm-6 social_links">
        <h2>Follow Us</h2>
        <div class="social"> <a href="#"><i class="fa fa-facebook fa-2x"></i> Share on Facebook</a> </div>
        <div class="social_1"> <a href="#"><i class="fa fa-twitter fa-2x"></i> Share on Twitter</a> </div>
        <div class="social_2"> <a href="#"><i class="fa fa-google-plus fa-2x"></i> Share on Google+</a> </div>
      </div>
    
      <div class="col-md-4 col-sm-6 footer_links">
        <h2>Quick Links</h2>
    <ul>
      <li><a href="#">Popular Rent Properties</a></li>
      <li><a href="#">Popular Buy Properties</a></li>
      <li><a href="#">Popular Commercial Properties</a></li>
      <li><a href="#">Popular Agricultural Properties</a></li>
      <li><a href="#">Client & Expert Advice</a></li>
    </ul>
        <br/>
      </div>
     
    </div>
  </div>
</section>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="js/demo.js"></script> -->

<!-- <script src="js/bootstrap.js"></script>
<script src="js/responsiveTabs.js"></script> -->
<script type="text/javascript">
        $(function () {
            $('#bhk').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'Select BHK',
                numberDisplayed:2,
                /*buttonWidth: '100px'*/
            });
            $('#locsresi').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'Select BHK',
                enableFiltering: true,

            });

            $('#type').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'Select Type',
                numberDisplayed:1

            });
            $('#proptype').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'Select Type',
                numberDisplayed:1

            });

            $('#filterResProp_floor').multiselect({
              nonSelectedText: 'Floor',
              numberDisplayed:2,
              buttonClass: 'btn btn-link',
              inheritClass: true,

            });

            $('#filterCommProp_floor').multiselect({
              nonSelectedText: 'Floor',
              numberDisplayed:2,
              buttonClass: 'btn btn-link',
            });

            $('#homeresbhkfilter').multiselect({
              nonSelectedText: 'Select Bhk',
              numberDisplayed:2
            });

            $('#homeresmin_rate_pricefilter').multiselect({
              nonSelectedText: 'Select Budget',
              numberDisplayed:2
            });

            /*$('#btnSelected').click(function () {
                var selected = $("#lstFruits option:selected");
                var message = "";
                selected.each(function () {
                    message += $(this).text() + " " + $(this).val() + "\n";
                });
                alert(message);
            });*/
        });
    </script>
<!-- <script src="js/responsiveTabs.js"></script> -->
<!--<script type="text/javascript">-->
      <?php $this->registerJs("$( '#myTab a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      $( '#moreTabs a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      ( function( $ ) {
          // Test for making sure event are maintained
          $( '.js-alert-test' ).click( function () {
            alert( 'Button Clicked: Event was maintained' );
          } );
         // fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      } )( jQuery );");?>


    <!--</script>-->
            
            
        <!-- scripts specific to this demo site -->

        <!--<script type="text/javascript">-->
            
        <!--</script>-->
<script type="text/javascript">
    function DropDown(el) {
    this.dd = el;
    this.placeholder = this.dd.children('span');
    this.opts = this.dd.find('ul.dropdown > li');
    //this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents : function() {
        var obj = this;
        obj.dd.on('click', function(event){
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click',function(){
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
        });
    },
    getValue : function() {
        return this.val;
    },
    getIndex : function() {
        return this.index;
    }
}
$(function() {

    var dd_resi_city = new DropDown( $('.dd_resi_city') );
    var dd_resi_bhk = new DropDown( $('.dd_resi_bhk') );
    var dd_resi_budget = new DropDown( $('.dd_resi_budget') );

    var dd_comm_city = new DropDown( $('.dd_comm_city') );

    var dd_agri_city = new DropDown( $('.dd_agri_city') );
    $(document).click(function() {
        // all dropdowns
        $('.wrapper-dropdown-3').removeClass('active');
        // $("#residentialproperty-city_id").val("1");
    });
    /*var dd = new DropDown( $('.dd2') );
    $(document).click(function() {
        // all dropdowns
        $('.wrapper-dropdown-3').removeClass('active');
    });
    var dd = new DropDown( $('.dd3') );
    $(document).click(function() {
        // all dropdowns
        $('.wrapper-dropdown-3').removeClass('active');
    });*/
});
</script>
	<script type="text/javascript">
	  $(document).ready(function(){
	  	$('.example1, .example2').rollbar({zIndex:1}); 
	  	//$('body').rollbar({zIndex:1});
	  });
	</script>

<!-- <script>jQuery.noConflict();</script> -->
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
