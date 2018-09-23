$('.chosen-select').chosen({allow_single_deselect: true, width: "100%"});
$(document).ready(function() {
    $("body").on("click", ".delete-bad", function(e) {
	var bad = $(this).attr('bad');
	var table = $(this).attr('table');
	var enviar ='';
	enviar+='bad='+bad+'&';
	enviar+='table='+table;
	var div = $(this).parent();
	div.css('background-color', '#FEC7C7');
        var myVar = setInterval(function() {
            $.ajax({
		type: "POST",
		url: "./ajax/identificar-definiciones.php",
		data: enviar,
		success: function(ad) {
		    if (ad=='exito') {
			div.remove();
		    } 
		}
            });
	    clearInterval(myVar);
	}, 1000);
	//a(table+':'+bad);
	return false;
    });
    $("#select-table").chosen().change( function() {
	var val = $(this).val();

	if (val=='0'){
	    $('#good').val("");
	    $('#good').trigger('chosen:updated');
	    $('#bad').val("");
	    $('#bad').trigger('chosen:updated');
	}

    });
});

