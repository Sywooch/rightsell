function split( val ) {
  return val.split( /,\s*/ );
}
function extractLast( term ) {
  return split( term ).pop();
}

$(document).on("ready", function(){

	/*$( "#tt > input" ).checkboxradio({
      icon: false
    });*/

	$(".available_forradio_resi").on("click", function(){
		//alert($(this).val());
		$(".available_forradio_resi").removeClass("radio_text_active");
		$(this).addClass("radio_text_active");
	});
	$(".available_forradio_comm").on("click", function(){
		//alert($(this).val());
		$(".available_forradio_comm").removeClass("radio_text_active");
		$(this).addClass("radio_text_active");
	});
	$(".available_forradio_agri").on("click", function(){
		//alert($(this).val());
		$(".available_forradio_agri").removeClass("radio_text_active");
		$(this).addClass("radio_text_active");
	});

 	


 	/*$('#residentialproperty-bhk').multiselect({
 		 nonSelectedText: 'Select BHK'
 	});*/


 	// $('#homerad_avaiblefor_rent').on("click")
	// $('#homerad_avaiblefor_buy').on("click")
	// $('#homerad_avaiblefor_flatmate').on("click")

	var selectedlocs = [];

	var cityid = $("#residentialpropertysearch-city_id").val();
	// $("#resprop_locationname").on("keyup", function(){
	// 	var locationname = $(this).val();
	// 	if(locationname.length > 2)
	// 		getCityLocations(cityid, locationname);
	// 	//console.log();
	// });

	$(".rent").hide();

	$("#searchfilteragriculturalproperty").on("submit", function(e){
		e.preventDefault();
		console.log($(this).serialize());
	});

	$("#searchfilterresidentialproperty").on("submit", function(e){
		e.preventDefault();
		//console.log($(this).serialize());
	});

	$("#searchfiltercommercialproperty").on("submit", function(e){
		e.preventDefault();
		console.log($(this).serialize());
		sendCP();
	});

	$("#residentialpropertysearch-available_for").on("change", function()
	{
		//var availablefor = $("input[name='available_for']:checked").val();
		var availablefor = $("input[name='ResidentialpropertySearch[available_for]']:checked").val();
		//console.log(availablefor);
		if(availablefor == "Sale")
		{
			$(".sale").show();
			$(".rent").hide();
		}
		else
		{
			$(".sale").hide();
			$(".rent").show();
		}
		/*$("#min_rate").val("");
		$("#max_rate").val("");
		$("#min_rent").val("");
		$("#max_rent").val("");*/
		// $("input[name='min_rate']").val("");
		// $("input[name='min_rent']").val("");
		// $("input[name='max_rate']").val("");
		// $("input[name='max_rent']").val("");
	});

	$("#commercialpropertysearch-available_for").on("change", function()
	{
		//var availablefor = $("input[name='available_for']:checked").val();
		var availablefor = $("input[name='CommercialpropertySearch[available_for]']:checked").val();
		//console.log(availablefor);
		if(availablefor == "Sale")
		{
			$(".sale").show();
			$(".rent").hide();
		}
		else
		{
			$(".sale").hide();
			$(".rent").show();
		}
	});

	$("#agriculturalpropertysearch-available_for").on("change", function()
	{
		//var availablefor = $("input[name='available_for']:checked").val();
		var availablefor = $("input[name='AgriculturalpropertySearch[available_for]']:checked").val();
		//console.log(availablefor);
		if(availablefor == "Sale")
		{
			$(".sale").show();
			$(".rent").hide();
		}
		else
		{
			$(".sale").hide();
			$(".rent").show();
		}
	});

	$('#filterResProp_locationname, #filterCommProp_locationname,#filterAgriProp_locationname').keydown(function(e){
		if(this.value == "")
		{
			$("#vis").html("");
			selectedlocs = [];
		}
		//console.log(e.keyCode);
	    if (e.keyCode == 8) {

	    }
	});



	/*$(".").on("click", function(e){
		e.preventDefault();
		//alert($(this).data('val'));
		var bathroom = $("#filterResProp_bathroom").val();
		var facing = $("#filterResProp_facing").val();
		var floor = $("#filterResProp_floor").val();
	});*/

	/*$( "#residentialpropertysearch-locationname")
		.autocomplete({
		source: function( request, response ) {
			cityid = $("#residentialpropertysearch-city_id").val();
			$.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
		},
		search: function() {
		  var term = extractLast( this.value );
		  if ( term.length < 2 ) {
		    return false;
		  }
		},
		focus: function() {
		  return false;
		},
		select: function( event, ui ) {
		  this.value = ui.item.value;
		  $( "#residentialpropertysearch-location_id").val(ui.item.id);
		  return false;
		}
	});*/

		$( "#residentialpropertysearch-locationname").autocomplete({
        source: function( request, response ) {
        	cityid = $("#residentialpropertysearch-city_id").val();
          //$.getJSON( "index.php?r=residential-property/get-city-locations", {term: request.term}, response );
          $.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          if($.inArray(ui.item.id, selectedlocs) == -1)
          {
          	//$("#hidlocationids").append("<input type='hidden' name='rplocations[]' value='"+ui.item.id+"'/>");
          	$("#homerespropform").append("<input type='hidden' name='ResidentialpropertySearch[location_id][]' value='"+ui.item.id+"'/>");
          	//$("#sidelocationid").val(ui.item.id);
          	//$("#sidelocationid").val(ui.item.id);
          	this.value = terms.join( ", " );
          	selectedlocs.push(ui.item.id);
          	send();
          }
          else
          {
          	alert(ui.item.value+" already selected");	
          }
          //alert(ui.item.value+" selected");
          return false;
        }
      });


		$( "#commercialpropertysearch-locationname")
		.autocomplete({
		source: function( request, response ) {
			cityid = $("#commercialpropertysearch-city_id").val();
			$.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
		},
		search: function() {
		  var term = extractLast( this.value );
		  if ( term.length < 2 ) {
		    return false;
		  }
		},
		focus: function() {
		  return false;
		},
		select: function( event, ui ) {
		  this.value = ui.item.value;
		  $( "#commercialpropertysearch-location_id").val(ui.item.id);
		  return false;
		}
	});

		$( "#agriculturalpropertysearch-locationname")
		.autocomplete({
		source: function( request, response ) {
			cityid = $("#agriculturalpropertysearch-city_id").val();
			$.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
		},
		search: function() {
		  var term = extractLast( this.value );
		  if ( term.length < 2 ) {
		    return false;
		  }
		},
		focus: function() {
		  return false;
		},
		select: function( event, ui ) {
		  this.value = ui.item.value;
		  $( "#agriculturalpropertysearch-location_id").val(ui.item.id);
		  return false;
		}
	});


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
        	var cityid = $("#residentialpropertysearch-city_id").val();
        	var cityid = $("#property_city_id").val();

          //$.getJSON( "index.php?r=residential-property/get-city-locations", {term: request.term}, response );
          $.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          if($.inArray(ui.item.id, selectedlocs) == -1)
          {
          	//$("#hidlocationids").append("<input type='hidden' name='rplocations[]' value='"+ui.item.id+"'/>");
          	$("#vis").append("<input type='hidden' name='ResidentialpropertySearch[location_id][]' value='"+ui.item.id+"'/>");
          	//$("#sidelocationid").val(ui.item.id);
          	//$("#sidelocationid").val(ui.item.id);
          	this.value = terms.join( ", " );
          	selectedlocs.push(ui.item.id);
          	send();
          }
          else
          {
          	alert(ui.item.value+" already selected");	
          }
          //alert(ui.item.value+" selected");
          return false;
        }
      });


      $( "#filterCommProp_locationname" )
      .autocomplete({
        source: function( request, response ) {
        	//cityid = $("#commercialpropertysearch-city_id").val();
        	cityid = $("#comm_property_city_id").val();
          	$.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          if($.inArray(ui.item.id, selectedlocs) == -1)
          {
          	$("#vis").append("<input type='hidden' name='CommercialpropertySearch[location_id][]' value='"+ui.item.id+"'/>");
          	this.value = terms.join( ", " );
          	selectedlocs.push(ui.item.id);
          	sendCP();
          }
          else
          {
          	alert(ui.item.value+" already selected");	
          }
          //alert(ui.item.value+" selected");
          return false;
        }
      });

      $( "#filterAgriProp_locationname" )
      .autocomplete({
        source: function( request, response ) {
        	cityid = $("#agri_property_city_id").val();
          	$.getJSON( "index.php?r=residential-property/get-city-locations", {cityid:cityid, locationname: extractLast(request.term)}, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          if($.inArray(ui.item.id, selectedlocs) == -1)
          {
          	$("#vis").append("<input type='hidden' name='AgriculturalpropertySearch[location_id][]' value='"+ui.item.id+"'/>");
          	this.value = terms.join( ", " );
          	selectedlocs.push(ui.item.id);
          	sendAP();
          }
          else
          {
          	alert(ui.item.value+" already selected");	
          }
          //alert(ui.item.value+" selected");
          return false;
        }
      });

$("#filterResProp_nearby").on("change", function(){
	$("#resprop_nearby").val($(this).is(":checked"));
	//alert($("#filterResProp_nearby").is(":checked"));
});


$("#filterCommProp_nearby").on("change", function(){
	$("#comprop_nearby").val($(this).is(":checked"));
});

$("#filterAgriProp_nearby").on("change", function(){
	$("#agriprop_nearby").val($(this).is(":checked"));
});

$("#filterResProp_haveimage, #filterCommProp_haveimage, #filterAgriProp_haveimage").on("change", function(){
	//$("#haveimagefilter").val($("#filterResProp_haveimage").is(":checked"));
	$("#haveimagefilter").val($(this).is(":checked"));
});


$("#filterResProp_status").on("change", function(){
	$("#remarkfilter").val($(this).val());
});

$("#filterResProp_minsqfeet").on("keyup", function(){
	var minsqval = $(this).val();
	$("#resprop_minsqval").val(minsqval);
});

$("#filterResProp_maxsqfeet").on("keyup", function(){
	var maxsqval = $(this).val();
	$("#resprop_maxsqval").val(maxsqval);
});

$("#filterCommProp_minws").on("keyup", function(){
	var minsqval = $(this).val();
	$("#commprop_minws").val(minsqval);
});

$("#filterCommProp_maxws").on("keyup", function(){
	var maxsqval = $(this).val();
	$("#commprop_maxws").val(maxsqval);
});

	$("#searchfilterresidentialproperty :input, #searchfilterresidentialproperty > select, #toprespropfilter :input, #toprespropfilter > select").on("change", function() {
		var bathroom = $("#filterResProp_bathroom").val();
		var facing = $("#filterResProp_facing").val();
		var floor = $("#filterResProp_floor").val();
		var preferedtenants = $("#filterResProp_preferred_tenants").val();
		
		
		//alert($("#resprop_nearby").val());
		$("#floor_nofilter").val(floor);
		$("#facingfilter").val(facing);
		$("#bathroomfilter").val(bathroom);
		$("#preferredtenantsfilter").val(preferedtenants);
	
		send();
    });
    /*$("#searchfilterresidentialproperty > select").on("change", function() {
		var bathroom = $("#filterResProp_bathroom").val();
		var facing = $("#filterResProp_facing").val();
		var floor = $("#filterResProp_floor").val();
		$("#floor_nofilter").val(floor);
		$("#facingfilter").val(facing);
		$("#bathroomfilter").val(bathroom);
		send();
    });*/
    /*$("#searchfiltercommercialproperty > select").on("change", function() {
    	sendCP();
    });*/
    $("#searchfiltercommercialproperty :input, #searchfiltercommercialproperty > select, #topcommpropfilter :input, #topcommpropfilter > select").on("change", function() {
		//$.pjax.submit($("#search-form"));
		//getRProperties();
		var bathroom = $("#filterResProp_bathroom").val();
		var facing = $("#filterResProp_facing").val();
		var floor = $("#filterCommProp_floor").val();
		$("#floor_nofilter").val(floor);
		$("#facingfilter").val(facing);
		$("#bathroomfilter").val(bathroom);
		sendCP();
    });

    $("#searchfilteragriculturalproperty :input, #searchfilteragriculturalproperty > select, #topagripropfilter :input, #topagripropfilter > select").on("change", function() {
		//$.pjax.submit($("#search-form"));
		//getRProperties();
		var bathroom = $("#filterResProp_bathroom").val();
		var facing = $("#filterResProp_facing").val();
		var floor = $("#filterResProp_floor").val();
		$("#floor_nofilter").val(floor);
		$("#facingfilter").val(facing);
		$("#bathroomfilter").val(bathroom);
		
		sendAP();
    });

    
    
	$(".sortresprop").on("click", function(e){
		e.preventDefault();
		var order = $(this).data('val');
		//$("#sortby").val($(this).data('val'));
		var availablefor = '';
		availablefor = $("input[name='ResidentialpropertySearch[available_for]']:checked").val();
		if(availablefor=="Sale" && order == "asc")
		{
			$("#sortby").val("&sort=expected_rate_comp");
		}
		else if(availablefor=="Sale" && order == "desc")
		{
			$("#sortby").val("&sort=-expected_rate_comp");
		}
		else if(availablefor=="Rent" && order == "asc")
		{
			$("#sortby").val("&sort=expected_rent_comp");
		}
		else if(availablefor=="Rent" && order == "desc")
		{
			$("#sortby").val("&sort=-expected_rent_comp");
		}
		else if(availablefor=="Flatmate" && order == "asc")
		{
			$("#sortby").val("&sort=expected_rent_comp");
		}
		else if(availablefor=="Flatmate" && order == "desc")
		{
			$("#sortby").val("&sort=-expected_rent_comp");
		}
		else if(order == "asc")
		{
			$("#sortby").val("&sort=expected_rate_comp");
		}
		else if(order == "desc")
		{
			$("#sortby").val("&sort=-expected_rate_comp");
		}
		send();
	});


	$(".sortcommprop").on("click", function(e){
		e.preventDefault();
		var order = $(this).data('val');
		//$("#sortby").val($(this).data('val'));
		var availablefor = '';
		availablefor = $("input[name='CommercialpropertySearch[available_for]']:checked").val();
		if(availablefor=="Sale" && order == "asc")
		{
			$("#sortby").val("&sort=rate_details_comp");
		}
		else if(availablefor=="Sale" && order == "desc")
		{
			$("#sortby").val("&sort=-rate_details_comp");
		}
		else if(availablefor=="Lease" && order == "asc")
		{
			$("#sortby").val("&sort=rent_details_comp");
		}
		else if(availablefor=="Lease" && order == "desc")
		{
			$("#sortby").val("&sort=-rent_details_comp");
		}
		else if(order == "asc")
		{
			$("#sortby").val("&sort=rate_details_comp");
		}
		else if(order == "desc")
		{
			$("#sortby").val("&sort=-rate_details_comp");
		}
		sendCP();
	});

	$(".sortagriprop").on("click", function(e){
		e.preventDefault();
		var order = $(this).data('val');
		//$("#sortby").val($(this).data('val'));
		var availablefor = '';
		availablefor = $("input[name='AgriculturalpropertySearch[available_for]']:checked").val();
		if(availablefor=="Sale" && order == "asc")
		{
			$("#sortby").val("&sort=expected_rate_comp");
		}
		else if(availablefor=="Sale" && order == "desc")
		{
			$("#sortby").val("&sort=-expected_rate_comp");
		}
		else if(availablefor=="Rent" && order == "asc")
		{
			$("#sortby").val("&sort=expected_rent_comp");
		}
		else if(availablefor=="Rent" && order == "desc")
		{
			$("#sortby").val("&sort=-expected_rent_comp");
		}
		else if(order == "asc")
		{
			$("#sortby").val("&sort=expected_rate_comp");
		}
		else if(order == "desc")
		{
			$("#sortby").val("&sort=-expected_rate_comp");
		}
		sendAP();
	});
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

/*function getRProperties()
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

	var proptypearr = [];
	$.each($("input[name='rpproptype[]']:checked"), function(){
		proptypearr.push($(this).val());
	});

	var bhkarr = [];
	$.each($("input[name='rpbhk[]']:checked"), function(){
		bhkarr.push($(this).val());
	});

	var availablefor = '';
	availablefor = $("input[name='available_for']:checked").val();

	var propertyby = '';
	propertyby = $("input[name='property_by']:checked").val();


	var minrate = $("#min_rate").val();
	var maxrate = $("#max_rate").val();

	var minrent = $("#min_rent").val();
	var maxrent = $("#max_rent").val();
	//console.log(minrate);

	var data = {bathroom:bathroom,facing:facing,floor_no:floor,city_id:cityid,location_id:locationidsarr,amenities:checkedamenities,furnished:furnishedarr,available_for:availablefor,property_by:propertyby,bhk:bhkarr,property_type:proptypearr,minrate:minrate,maxrate:maxrate,minrent:minrent,maxrent:maxrent};

	$.ajax(
		{
			method:'post',
			url:"index.php?r=residential-property/ajax-get-properties",
			data:{data},
		}).done(function(data){
			//console.log(data);
		}).success(function(data){
			//console.log(data);
			$("#projects_section").html(data);
		}).fail(function(data){
			//console.log(data);			
		});
}
*/
function sendAP(){
	//var data = {bathroom:bathroom,facing:facing,floor_no:floor,city_id:cityid,location_id:locationidsarr,amenities:checkedamenities,furnished:furnishedarr,available_for:availablefor,property_by:propertyby,bhk:bhkarr,property_type:proptypearr,minrate:minrate,maxrate:maxrate,minrent:minrent,maxrent:maxrent};
	var locationidsarr = [];
	$.each($("input[name='rplocations[]']"), function(){
		locationidsarr.push($(this).val());
	});
	var checkedamenities = [];
	$.each($("input[name='filterAgriProp_amenity[]']:checked"), function(){
		checkedamenities. push($(this). val());
	$("#agriprop_amenities").val(checkedamenities);
	});

	//$("#haveimagefilter").val($("#filterCommProp_haveimage").is(":checked"));
	

	var sortng = $("#sortby").val();
	var data = $("#searchfilteragriculturalproperty").serialize();

	$.ajax(
		{
			url    : $("#searchfilteragriculturalproperty").attr('action'),
			//url:"index.php?"+data+sortng
            type   : 'get',
            data   : data+sortng,
		}).done(function(data){
			//console.log(data);
		}).success(function(data){
			//console.log(data);
			$("#projects_section").html(data);
		}).fail(function(data){
			//console.log(data);			
		});
}



function send(){
	//var data = {bathroom:bathroom,facing:facing,floor_no:floor,city_id:cityid,location_id:locationidsarr,amenities:checkedamenities,furnished:furnishedarr,available_for:availablefor,property_by:propertyby,bhk:bhkarr,property_type:proptypearr,minrate:minrate,maxrate:maxrate,minrent:minrent,maxrent:maxrent};
	var locationidsarr = [];
	$.each($("input[name='rplocations[]']"), function(){
		locationidsarr.push($(this).val());
	});

	var checkedamenities = [];
	$.each($("input[name='filterResProp_amenity[]']:checked"), function(){
		checkedamenities. push($(this). val());
	});
	$("#resiprop_amenities").val(checkedamenities);
	
	console.log($("#haveimagefilter").val() );
	var sortng = $("#sortby").val();

	var data = $("#searchfilterresidentialproperty").serialize();

	$.ajax(
		{
			url    : $("#searchfilterresidentialproperty").attr('action'),
			//url:"index.php?"+data+sortng
            type   : 'get',
            data   : data+sortng,
		}).done(function(data){
			//console.log(data);
		}).success(function(data){
			//console.log(data);
			$("#projects_section").html(data);
		}).fail(function(data){
			//console.log(data);			
		});
}

function sendCP(){
	//var data = {bathroom:bathroom,facing:facing,floor_no:floor,city_id:cityid,location_id:locationidsarr,amenities:checkedamenities,furnished:furnishedarr,available_for:availablefor,property_by:propertyby,bhk:bhkarr,property_type:proptypearr,minrate:minrate,maxrate:maxrate,minrent:minrent,maxrent:maxrent};
	var locationidsarr = [];
	$.each($("input[name='rplocations[]']"), function(){
		locationidsarr.push($(this).val());
	});
	var checkedamenities = [];
	$.each($("input[name='filterCommProp_amenity[]']:checked"), function(){
		checkedamenities. push($(this). val());
	});
	$("#commprop_amenities").val(checkedamenities);

	var sortng = $("#sortby").val();
	var data = $("#searchfiltercommercialproperty").serialize();
	// console.log(data);

	$.ajax(
		{
			url    : $("#searchfiltercommercialproperty").attr('action'),
			//url:"index.php?"+data+sortng
            type   : 'get',
            data   : data+sortng,
		}).done(function(data){
			//console.log(data);
		}).success(function(data){
			//console.log(data);
			$("#projects_section").html(data);
		}).fail(function(data){
			//console.log(data);			
		});
}