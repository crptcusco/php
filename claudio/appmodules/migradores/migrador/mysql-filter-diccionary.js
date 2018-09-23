$(document).ready(function() {
    $("#list-diccionary .row").on("click", ".item-search", function(e) {
	var value = $(this).prev().val();
	var table = $(this).attr('table');
	var div = $(this).parent().parent().next().children();

	div.css('display','block');

        $.ajax({
            type: "POST",
            url: "./ajax/search.php",
            data: "search=" + value+'&table='+table,
            success: function(a) {
                div.html(a);
            }
        });
	return false;
    });
    $("#list-diccionary .row").on("click", ".item-add", function(e) {
	var value = $(this).attr('value');
	var table = $(this).attr('table');
	var div = $(this).parent().parent();
        $.ajax({
            type: "POST",
            url: "./ajax/add.php",
            data: "add=" + value+'&table='+table,
            success: function(a) {
		if (a!=''){
		    //alert(a);
		    div.next().remove();
		    div.remove();
		}                
            }
        });
	
	return false;
    });
    $("#list-diccionary .row").on("click", ".item-replace", function(e) {
	var id = $(this).prev().val();
	var value = $(this).attr('value');
	var table = $(this).attr('table');
	var div = $(this).parent().parent();
	if (id.trim()!='') {
            $.ajax({
		type: "POST",
		url: "./ajax/replace.php",
		data: "id=" + id+'&value='+value+'&table='+table,
		success: function(a) {
		    if (a!=''){
			alert(a);
			div.next().remove();
			div.remove();
		    }                
		}
            });
	}

	return false;
    });
});
