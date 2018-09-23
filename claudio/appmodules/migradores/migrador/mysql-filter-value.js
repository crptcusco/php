$(document).ready(function() {
    $("#list-value .row").on("click", ".item-replace", function(e) {
	var table = $(this).attr('table');
	var field = $(this).attr('field');
	var type_date = $(this).attr('type_date');
	var value = $(this).prev().val();
	var search = $(this).parent().prev().text();
	var div = $(this).parent().parent();
	if (value.trim()!=''){
            $.ajax({
		type: "POST",
		url: "./ajax/value/replace.php",
		data: "table="+table+"&field="+field+"&type_date="+type_date+"&value="+value+"&search="+search,
		success: function(aj) {

		    if (aj!='error') {
			div.remove();
		    }
		    a(aj);
		}
            });
	}

	
    });
});
