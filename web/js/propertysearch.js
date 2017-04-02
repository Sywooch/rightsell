$('.getResidentialProperties').on('click', function(){

$.ajax({
url : 'index.php?r=residential-property/get-properties',
type: 'get',
contentType: "application/json",
data: {
'residentialproperty[property_by]' : 'owner',
'residentialproperty[available_for]' : 'rent',
'residentialproperty[furnished]' : 'ff',
'residentialproperty[property_type]' : 'apartment',
'residentialproperty[city]' : 'pune',
'residentialproperty[area]' : 'wakad',
},

beforeSend: function (jqXHR, settings) {
if (jqXHR && jqXHR.overrideMimeType) {
jqXHR.overrideMimeType("application/j-son;charset=UTF-8");
}
},

success: function(response) { 
alert('Success is here');
alert(response);
},

error: function (jqXHR, textStatus, errorThrown) {
alert(errorThrown);
}

});

}); 