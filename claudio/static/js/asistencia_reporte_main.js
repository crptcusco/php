$(document).ready(function() {
    var prefix = "#asistencia_reporte ";
    var option_empty='<option value=""></option>';

    // -------------------------------------------------------- LOAD
    asistencia_reporte_field_anios();
    asistencia_reporte_field_meses();
    asistencia_reporte_field_calendario();

    // -------------------------------------------------------- EVENTOS
    $( prefix ).on("click", ".field_mostrar_calendario", function(e) {
	asistencia_reporte_field_calendario()
	e.preventDefault();
    });
    $( prefix ).on("click", ".field_day", function(e) {
	asistencia_reporte_field_link_modal_day( $(this).attr('fecha') );
	e.preventDefault();
    });
    $( '#modal_day' ).on("change", ".tardanza_valida", function(e) {
	asistencia_reporte_field_modal_tardanza_valida( $(this) );
	e.preventDefault();
    });

    // -------------------------------------------------------- FUNCIONES
    function asistencia_reporte_field_anios() {
	var combo = $(prefix+'.field_anios');
	var enviar = {
	    anio: $(prefix+'.field_anios').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/asistencia_reporte_anio_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '') {
		    // data = '<option>' + data + '</option>'; // pruebas
		    combo.html(data);
		}
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });		
    }
    function asistencia_reporte_field_meses() {
	var combo = $(prefix+'.field_meses');
	var enviar = {
	    mes: $(prefix+'.field_meses').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/asistencia_reporte_meses_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '') {
		    // data = '<option>' + data + '</option>'; // pruebas
		    combo.html(data);
		}
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });		
    }
    function asistencia_reporte_field_calendario() {
	var calendario = $(prefix+'.field_calendario');
	var enviar = {
	    anio: $(prefix+'.field_anios').val()
	    , mes: $(prefix+'.field_meses').val()
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/tables/asistencia_reporte_calendario.php",
	    success: function(data) {
		calendario.html( data );
	    }
        });
    }
    function asistencia_reporte_field_link_modal_day( in_fecha ) {
	var modal = $(prefix+'#modal_day .ajax-content');
	var enviar = {
	    fecha: in_fecha
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/modals/asistencia_reporte_dia.php",
	    data: enviar,
	    success: function(data) {
		modal.html(data);
	    }
        });
    }
    function asistencia_reporte_field_modal_tardanza_valida( item) {
	var enviar = {
	    id: item.parent().parent().attr('codigo')
	    , estado: item.is(':checked')
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/checkbox/asistencia_reporte_modal_day_checkbox_.php",
	    data: enviar,
	    success: function(data) {
		// $('#modal_day .test').html(data);
	    }
        });
    }

});
