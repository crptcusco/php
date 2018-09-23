$(document).ready(function() {
    $("body").on("click", ".yazan", function(e) {
	var table = $(this).attr('table');
	var field = $(this).attr('field');
	var value = $(this).parent().prev().children('input').val();
	var search = $(this).attr('value');

	var div = $(this).parent().parent();
        $.ajax({
            type: "POST",
            url: "./ajax/replace.php",
            data: "table=" + table +'&field='+field+'&value='+value+'&search='+search,
            success: function(ad) {		
		if (ad!='') {
		    //a(ad);
                    div.remove();
		} else{
		    alert('error');
		}
            }
        });
	return false;
    });
});
