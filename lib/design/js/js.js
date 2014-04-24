$(document).ready(function() {
	$('#contentTable').dataTable();
	$(".yoxview").yoxview();
});


/**
 * AJAX methods
 */

/**
 * Method retrieves subtypes as JSON according to inputted select value and 
 * updates subtypes select with retrieved values.
 */
function updateSubTypes(select) {
	var typeId = select.value;
	$.ajax({
		type: "POST",
		url: prefix + '/ajax.php?op=getSubTypes',
		data: { typeId: typeId },
		success: function(data) {
			//get the elements from server and parse json to array
			var elements = eval($.parseJSON(data));
			//empty previous elements
			var $el = $("#subtypes");
			$el.empty();
			$.each(elements, function(key, value) {
			  $el.append($("<option></option>")
			     .attr("value", key).text(value));
			});
		}
	});	
}