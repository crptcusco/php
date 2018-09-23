$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefix = 'co_search_involucrado_field_';
    // ------------------------------------------- INICIO
    co_search_involucrado_field_coordinador_id();
    co_search_involucrado_field_tipo_juridico_id();
    co_search_involucrado_field_tipo_natural_id();    
    co_search_involucrado_field_vendedor_id();
    // ------------------------------------------- EVENTOS
    $("body").on("change", "."+prefix+"tipo_radio", function(e) {
	var tipo_persona = $(this).val();
	co_search_involucrado_field_tipo_radio(tipo_persona);
    });
    $("body").on('change', "#"+prefix+"tipo_juridico_id", function() {
	co_search_involucrado_field_tipo_juridico_contacto_id();
	co_search_involucrado_field_tipo_juridico_contacto_datos_clear();
    });
    $("body").on('change', "#"+prefix+"tipo_juridico_contacto_id", function() {
	co_search_involucrado_field_tipo_juridico_contacto_datos();
    });
    $("body").on('change', "#"+prefix+"tipo_natural_id", function() {
	co_search_involucrado_field_tipo_natural_datos();
    });
    // ------------------------------------------- FUNCIONES
    function co_search_involucrado_field_coordinador_id() {
	var combo = $('#'+prefix+'coordinador_id');
	var enviar = {
	    id: combo.val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/involucrados_coordinador.php",
	    data: enviar,
	    success: function(data) {
		if (data != '') {		    
		    combo.html(data);
		    combo.trigger('chosen:updated');
		} else {
		    combo.html(option_empty);
		    combo.trigger('chosen:updated');
		}
	    }
        });	
    }
    function co_search_involucrado_field_tipo_radio( tipo_persona ) {
	if ( tipo_persona == 'juridico') {
	    $("#"+prefix+"tipo_juridico").show();
	    $("#"+prefix+"tipo_natural").hide();
	}
	if ( tipo_persona == 'natural') {
	    $("#"+prefix+"tipo_juridico").hide();
	    $("#"+prefix+"tipo_natural").show();
	}
    }
    function co_search_involucrado_field_tipo_juridico_id() {
	var combo = $('#'+prefix+'tipo_juridico_id');
        $.ajax({
	    type: "POST",
	    data: "id=" + combo.val(),
	    url: "./ajax/combos/involucrados_juridico_razon_social.php",
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
    function co_search_involucrado_field_tipo_juridico_contacto_id () {
	var combo = $('#'+prefix+'tipo_juridico_contacto_id');
	var enviar = {
	    id: $('#'+prefix+'tipo_juridico_contacto_id').val()
	    , juridico_id: $('#'+prefix+'tipo_juridico_id').val()
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/combos/involucrados_juridico_contacto.php",
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
    function co_search_involucrado_field_tipo_juridico_contacto_datos() {
	var combo = $('#'+prefix+'tipo_juridico_contacto_id');
	if (combo.val()!='') {
	    var enviar = {
		id: combo.val()
	    }
            $.ajax({
		type: "POST",
		url: "./ajax/combos/involucrados_juridico_contacto_datos.php",
		data: enviar,
		success: function(data) {
		    if (data != '') {
			$('#' + prefix + 'tipo_juridico_contacto_datos').html( data );
		    }
		}
            });
	} else {
	    co_search_involucrado_field_tipo_juridico_contacto_datos_clear();
	}
    }
    function co_search_involucrado_field_tipo_juridico_contacto_datos_clear() {
	$('#'+prefix+'tipo_juridico_contacto_datos').html('');
    }
    function co_search_involucrado_field_tipo_natural_id() {
	var combo = $('#'+prefix+'tipo_natural_id');
	var enviar = {
	    id: combo.val()
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/combos/involucrados_natural_nombre.php",
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
    function co_search_involucrado_field_tipo_natural_datos() {
	var combo = $('#'+prefix+'tipo_natural_id');
	if (combo.val()!='') {
	    var enviar = {
		id: combo.val()
	    }
            $.ajax({
		type: "POST",
		url: "./ajax/combos/involucrados_natural_datos.php",
		data: enviar,
		success: function(data) {
		    if (data != '') {
			$('#' + prefix + 'tipo_natural_datos').html( data );
		    }
		}
            });
	} else {
 	    co_search_involucrado_field_tipo_natural_datos_clear();
	}	
    }
    function co_search_involucrado_field_tipo_natural_datos_clear() {
	$('#'+prefix+'tipo_natural_datos').html('');
    }
    function co_search_involucrado_field_vendedor_id() {
	var combo = $('#'+prefix+'vendedor_id');
	var enviar = {
	    id: combo.val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/involucrados_vendedor.php",
	    data: enviar,
	    success: function(data) {		
		if (data != '') {		    
		    combo.html(data);
		    combo.trigger('chosen:updated');
		} else {
		    combo.html(option_empty);
		    combo.trigger('chosen:updated');
		}
	    }
        });
    }
});
