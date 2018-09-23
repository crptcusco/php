$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefix = 'co_search_general_field_'
    // ------------------------------------------- INICIO
    co_search_general_field_tipo_servicio();
    co_search_general_field_estado_cotizacion();

    // ------------------------------------------- EVENTOS


    // ------------------------------------------- FUNCIONES
    function co_search_general_field_tipo_servicio( ) {
	var combo = $('#'+prefix+'tipo_servicio');
	$.ajax({
	    type: "POST",
	    url: "./ajax/combos/tipo_servicios.php",
	    data: "id=" + combo.val(),
	    success: function(data) {
		if (data != '') {
		    combo.html(data);
		    combo.trigger('chosen:updated');
		}
		else {
		    combo.html(option_empty);
		    combo.trigger('chosen:updated');
		}	
	    }
	});	
    }
    function co_search_general_field_estado_cotizacion( ) {
	var combo = $('#'+prefix+'estado_cotizacion');
	$.ajax({
	    type: "POST",
	    url: "./ajax/combos/estado_cotizacion.php",
	    data: "id=" + combo.val(),
	    success: function(data) {
		if (data != '') {
		    combo.html(data);
		    combo.trigger('chosen:updated');
		}
		else {
		    combo.html(option_empty);
		    combo.trigger('chosen:updated');
		}	
	    }
	});
    }
});
