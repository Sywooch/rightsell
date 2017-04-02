/*!
 * Scripts for the demo pages on the jScrollPane website.
 *
 * You do not need to include this script or use it on your site.
 *
 * Copyright (c) 2010 Kelvin Luck
 * Dual licensed under the MIT or GPL licenses.
 */

/*$(function()
{
	// Copy the pages javascript sourcecode to the display block on the page for easy viewing...
	var sourcecodeDisplay = $('#sourcecode-display');
	if (sourcecodeDisplay.length) {
		sourcecodeDisplay.empty().append(
			$('<code />').append(
				$('<pre />').html(
					$('#sourcecode').html().replace(/\n\t\t\t/gm, '\n').replace('>', '&gt;').replace('<', '&lt;')
				)
			)
		);
		$('#css-display').empty().append(
			$('<code />').append(
				$('<pre />').html(
					$('#page-css').html().replace(/\n\t\t\t/gm, '\n')
				)
			)
		);
	}
});

// It seems some people copy this file and put it on their sites despite the message at the top
// So let's make sure they don't end up in my stats...
if (window.location.hostname == 'jscrollpane.kelvinluck.com') { 
	// Google analytics tracking code for demo site 
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-17828883-1']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
} else if(window.location.protocol == 'file:' || window.location.hostname == 'localhost') {
	// Allow local testing without annoying alerts
} else {
	alert('Do not include demo.js on your site!');
}*/

$(document).on("ready", function(){
	var cityid = $("#filterResProp_cityid").val();
	// $("#resprop_locationname").on("keyup", function(){
	// 	var locationname = $(this).val();
	// 	if(locationname.length > 2)
	// 		getCityLocations(cityid, locationname);
	// 	//console.log();
	// });

	$( "#filterResProp_locationname" )
      // don't navigate away from the field on tab when selecting an item
      // .on( "keydown", function( event ) {
      //   if ( event.keyCode === $.ui.keyCode.TAB &&
      //       $( this ).autocomplete( "instance" ).menu.active ) {
      //     event.preventDefault();
      //   }
      // })
      .autocomplete({
        source: function( request, response ) {
          //$.getJSON( "index.php?r=residential-property/get-city-locations", {term: request.term}, response );
          $.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: request.term}, response );
        },
        search: function() {
          // custom minLength
          // var term = extractLast( this.value );
          // if ( term.length < 2 ) {
          //   return false;
          // }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          /*var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );*/
          $("#hidlocationids").append("<input type='hidden' name='rplocations[]' value='"+ui.item.id+"'/>");
          alert(ui.item.value+" selected");
          return false;
        }
      });

	$("#proplocations > .selloc").on("click", function(){
		console.log("hsad");
	});

	$(".filterResPropAmenity").on("click", function()
	{
		getRProperties();
	});

	$(".filterResPropFurnished").on("click", function()
	{
		getRProperties();
	});

	$("#filterResProp_bathroom").on("change", function()
	{
		getRProperties();
	});
	$("#filterResProp_facing").on("change", function()
	{
		getRProperties();
	});
	$("#filterResProp_floor").on("change", function()
	{
		getRProperties();
	});

	$(".rpfilter_availablefor").on("change", function()
	{
		getRProperties();
	});

	$(".rpfilter_propertyby").on("change", function()
	{
		getRProperties();
	});

	$(".search_btn").on("click", function(){
		getRProperties();
	})
});

function getCityLocations(cityid, locationname)
{
	$.ajax(
		{
			type:"POST",
			url:"index.php?r=residential-property/get-city-locations",
			data:{cityid:cityid, locationname: locationname},
		}).success(function(data){
			if(data)
			 	$("#proplocations").html("");
			var jsonobj = $.parseJSON(data);
			for (var i = jsonobj.length - 1; i >= 0; i--) {
				$("#proplocations").append("<li class='selloc'>"+jsonobj[i].location+"</li>");
				//console.log(jsonobj[i]);
			}
		}).fail(function(data){
			console.log(data);			
		});
}

function getRProperties()
{
	var cityid = $("#filterResProp_cityid").val();
	var bathroom = $("#filterResProp_bathroom").val();
	var facing = $("#filterResProp_facing").val();
	var floor = $("#filterResProp_floor").val();
	var checkedamenities = [];
	$.each($("input[name='filterResProp_amenity[]']:checked"), function(){
		checkedamenities. push($(this). val());
	});
	var locationidsarr = [];
	$.each($("input[name='rplocations[]']"), function(){
		locationidsarr.push($(this).val());
	});

	var furnishedarr = [];
	$.each($("input[name='rpfurnished[]']:checked"), function(){
		furnishedarr.push($(this).val());
	});
	var availablefor = '';
	availablefor = $("input[name='available_for']:checked").val();
	var propertyby = '';
	propertyby = $("input[name='property_by']:checked").val();

	var data = {bathroom:bathroom,facing:facing,floor_no:floor,city_id:cityid,location_id:locationidsarr,amenities:checkedamenities,furnished:furnishedarr,available_for:availablefor,property_by:propertyby};

	$.ajax(
		{
			method:'post',
			url:"index.php?r=residential-property/ajax-get-properties",
			data:{data},
		}).done(function(data){
			//console.log(data);
		}).success(function(data){
			console.log(data);
			$("#projects_section").html(data);
		}).fail(function(data){
			console.log(data);			
		});
}