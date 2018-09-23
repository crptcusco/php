$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefix = 'co_search_bienes_field_';
    // ------------------------------------------- INICIO
    co_search_bienes_field_sub_categoria_mueble_tipo();
    co_search_bienes_field_sub_categoria_inmueble();
    co_search_bienes_field_sub_categoria_inmueble_departamento ();
    co_search_bienes_field_sub_categoria_inmueble_provincia ();
    co_search_bienes_field_sub_categoria_inmueble_distrito ();
    // ------------------------------------------- EVENTOS
    // categorias
    $("body").on("change", "#" + prefix + "categoria_ninguno_radio", function(e) {
	co_search_bienes_field_categoria_ninguno_radio();
    });
    $("body").on("change", "#" + prefix + "categoria_mueble_radio", function(e) {
	co_search_bienes_field_categoria_mueble_radio();
    });
    $("body").on("change", "#" + prefix + "categoria_inmueble_radio", function(e) {
	co_search_bienes_field_categoria_inmueble_radio();
    });
    // sub-categoria
    $("body").on("change", "#" + prefix + "sub_categoria_mueble", function(e) {
	co_search_bienes_field_sub_categoria_mueble( $(this).val() );
    });
    // listas
    $("body").on("change", "#" + prefix + "sub_categoria_mueble_tipo", function(e) {
	co_search_bienes_field_sub_categoria_mueble_marca();
	var combo = $('#'+prefix+'sub_categoria_mueble_modelo');
	combo.html(option_empty);	    		
	combo.trigger('chosen:updated');
    });
    $("body").on("change", "#" + prefix + "sub_categoria_mueble_marca", function(e) {
	co_search_bienes_field_sub_categoria_mueble_modelo();
    });
    $("body").on("change", "#" + prefix + "sub_categoria_inmueble_departamento", function(e) {
	$('#'+prefix+'sub_categoria_inmueble_provincia').val('0');
	co_search_bienes_field_sub_categoria_inmueble_provincia ()
	var combo = $('#'+prefix+'sub_categoria_inmueble_distrito');
	combo.html(option_empty);
	combo.trigger('chosen:updated');
    });
    $("body").on("change", "#" + prefix + "sub_categoria_inmueble_provincia", function(e) {
	co_search_bienes_field_sub_categoria_inmueble_distrito ();
    });
    // ------------------------------------------- FUNCIONES
    // categoria
    function co_search_bienes_field_categoria_ninguno_radio() {
	$('.'+prefix+'categoria_content').hide();
	$('.'+prefix+'sub_categoria_content').hide();
    }
    function co_search_bienes_field_categoria_mueble_radio() {
	$('.'+prefix+'categoria_content').hide();
	$('#'+prefix+'categoria_mueble_content').show();
	$('.'+prefix+'sub_categoria_content').hide();
	$('#'+prefix+'sub_categoria_muebles_content').show();	
    }
    function co_search_bienes_field_categoria_inmueble_radio() {
	$('.'+prefix+'categoria_content').hide();
	$('#'+prefix+'categoria_inmueble_content').show();
	$('.'+prefix+'sub_categoria_content').hide();
	$('#'+prefix+'sub_categoria_inmuebles_content').show();	
    }

    // sub-categoria
    function co_search_bienes_field_sub_categoria_mueble( id ) {
	co_search_bienes_field_sub_categoria_mueble_tipo();
	if ( id == '4' ) {
	    $('#'+prefix+'sub_categoria_mueble_marca_content').hide();
	    $('#'+prefix+'sub_categoria_mueble_modelo_content').hide();
	} else {
	    $('#'+prefix+'sub_categoria_mueble_marca_content').show();
	    $('#'+prefix+'sub_categoria_mueble_modelo_content').show();	    
	    $('#'+prefix+'sub_categoria_mueble_marca')
		.html(option_empty)  		
		.trigger('chosen:updated');
	    $('#'+prefix+'sub_categoria_mueble_modelo')
		.html(option_empty)  		
		.trigger('chosen:updated');
	}

    }
    function co_search_bienes_field_sub_categoria_inmueble() {
	var combo = $('#co_search_bienes_field_sub_categoria_inmueble');
	var enviar = {
	    id: combo.val()
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/combos/bienes_inmueble_combo.php",
	    success: function(data) {		
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    // listas
    function co_search_bienes_field_sub_categoria_mueble_tipo() {
	var combo = $('#'+prefix+'sub_categoria_mueble_tipo');
	var enviar = {
	    mueble_tipo_id : $('#'+prefix+'sub_categoria_mueble').val()
	    , tipo_id: $('#'+prefix+'sub_categoria_mueble_tipo').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_mueble_tipo_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else 
		    combo.html(option_empty);	    		
		combo.trigger('chosen:updated');
	    }
        });
    }
    function co_search_bienes_field_sub_categoria_mueble_marca() {
	var combo = $('#'+prefix+'sub_categoria_mueble_marca');
	var enviar = {
	      mueble_tipo_id : $('#'+prefix+'sub_categoria_mueble').val()
	    , tipo_id : $('#'+prefix+'sub_categoria_mueble_tipo').val()
	    , marca_id : $('#'+prefix+'sub_categoria_mueble_marca').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_mueble_marca_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    function co_search_bienes_field_sub_categoria_mueble_modelo() {
	var combo = $('#'+prefix+'sub_categoria_mueble_modelo');
	var enviar = {
	      mueble_tipo_id : $('#'+prefix+'sub_categoria_mueble').val()
	    , tipo_id : $('#'+prefix+'sub_categoria_mueble_tipo').val()
	    , marca_id : $('#'+prefix+'sub_categoria_mueble_marca').val()
	    , modelo_id : $('#'+prefix+'sub_categoria_mueble_modelo').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_mueble_modelo_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    function co_search_bienes_field_sub_categoria_inmueble_departamento () {
	var combo = $('#'+prefix+'sub_categoria_inmueble_departamento');
	var enviar = {
	    departamento_id: $('#'+prefix+'sub_categoria_inmueble_departamento').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_inmueble_departamento_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });	
    }
    function co_search_bienes_field_sub_categoria_inmueble_provincia () {
	var combo = $('#'+prefix+'sub_categoria_inmueble_provincia');
	var enviar = {
	      departamento_id: $('#'+prefix+'sub_categoria_inmueble_departamento').val()
	    , provincia_id: $('#'+prefix+'sub_categoria_inmueble_provincia').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_inmueble_provincia_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    function co_search_bienes_field_sub_categoria_inmueble_distrito () {
	var combo = $('#'+prefix+'sub_categoria_inmueble_distrito');
	var enviar = {
	      departamento_id: $('#'+prefix+'sub_categoria_inmueble_departamento').val()
	    , provincia_id: $('#'+prefix+'sub_categoria_inmueble_provincia').val()
	    , distrito_id: $('#'+prefix+'sub_categoria_inmueble_distrito').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_inmueble_distrito_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
});
