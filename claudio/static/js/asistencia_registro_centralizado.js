$(document).ready(function() {
    var prefix = "#asistencia_registro ";
    var option_empty='<option value=""></option>';
    // -------------------------------------------------------- LOAD
    asistencia_registro_tab_content_sin_marcar();
    // -------------------------------------------------------- EVENTOS
    // general
    $(prefix).on("click", ".tab_sin_marcar", function(e) {
	asistencia_registro_tab_content_sin_marcar();
	e.preventDefault();
    });
    $(prefix).on("click", ".tab_marcado", function(e) {
	asistencia_registro_tab_content_marcado();
	e.preventDefault();
    });
    // sin marcar
    $(prefix).on("click", ".tab_content_sin_marcar .field_save", function(e) {
	asistencia_registro_tab_content_sin_marcar_field_save( $(this).parent().parent().parent().parent().parent() );
	e.preventDefault();
    });
    $(prefix).on("click", ".tab_content_marcado .field_save", function(e) {
	asistencia_registro_tab_content_marcado_field_save( $(this).parent().parent().parent().parent().parent() );
	e.preventDefault();
    });

    // -------------------------------------------------------- FUNCIONES
    // genereal
    function asistencia_registro_tab_content_sin_marcar() {
	var prefix = "#asistencia_registro .tab_content_sin_marcar ";
	var lista = $(prefix);
	var enviar = {
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/tables/asistencia_registro_listado_sin_marcar.php",
	    data: enviar,
	    success: function(data) {
		lista.html(data);
	    }
        });
    }
    function asistencia_registro_tab_content_marcado() {
	var prefix = "#asistencia_registro .tab_content_marcado ";
	var lista = $(prefix);
	var enviar = {
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/tables/asistencia_registro_listado_marcado.php",
	    data: enviar,
	    success: function(data) {
		lista.html(data);
	    }
        });
    }
    // sin marcar
    function asistencia_registro_tab_content_sin_marcar_field_save( item ) {
	var enviar = {
	    dni: item.find(".field_persona_id").val()
	    , nota: item.find(".field_nota").val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/button/registro_save.php",
	    data: enviar,
	    success: function(data) {
		// $('.test').html(data);
		item.remove();
	    }
        });

    }
    function asistencia_registro_tab_content_marcado_field_save( item ) {
	var enviar = {
	    dni: item.find(".field_persona_id").val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/button/registro_marcado_save.php",
	    data: enviar,
	    success: function(data) {
		item.remove();
	    }
        });
    }
    // ----------------------------------------------------
    function asistencia_registro_field_test() {
    }

});
