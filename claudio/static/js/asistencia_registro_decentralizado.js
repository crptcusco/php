$(document).ready(function() {
    var prefix = "#asistencia_registro ";
    var option_empty='<option value=""></option>';
    // -------------------------------------------------------- LOAD
    asistencia_registro_field_dni( $( prefix + ".field_dni" ).val() );
    // -------------------------------------------------------- EVENTOS
    $( prefix + ".field_dni" ).keyup(function() {
	asistencia_registro_field_dni( $(this).val() );
    });
    $("body").on("click", prefix + ".field_save", function(e) {
	asistencia_registro_field_save( $(this) );
	e.preventDefault();
    });

    // -------------------------------------------------------- FUNCIONES
    function asistencia_registro_field_dni(value) {
	if (value.length>=8) {
	    var enviar = {
		dni: value
	    }
            $.ajax({
		type: "POST",
		url: "./ajax/input_type_text/registro_search_dni.php",
		data: enviar,
		success: function(data) {
		    if (data!='') {
			var jsn = jQuery.parseJSON( data );			
			$( prefix + ".field_nombre" ).html('<h5>' + jsn.persona + '</h5>')
			$( prefix + ".field_imagen" ).attr('src','./files/personas/'+jsn.imagen);
			$( prefix + ".field_dni_valido" ).val('1');
			asistencia_registro_buttons( jsn.status );
		    } else {
			$( prefix + ".field_nombre" ).html( '' )
			$( prefix + ".field_dni_valido" ).val('0');
			$( prefix + ".field_imagen" ).attr('src','./files/personas/default.jpg');
			asistencia_registro_buttons( 0 );
		    }		    
		}
            });
	} else {
	    $( prefix + ".field_nombre" ).html( '' );
	    $( prefix + ".field_dni_valido" ).val('0');
	    $( prefix + ".field_imagen" ).attr('src','./files/personas/default.jpg');
	    asistencia_registro_buttons( 0 );
	}
    }
    function asistencia_registro_buttons( status ) {
	if ( status== 0) {
	    $( prefix + "#bt1" ).removeAttr('disabled','');
	    $( prefix + "#bt2" ).attr('disabled','disabled');
	    $( prefix + "#bt3" ).attr('disabled','disabled');
	    $( prefix + "#bt4" ).attr('disabled','disabled');
	}
	if ( status== 1) {
	    $( prefix + "#bt1" ).attr('disabled','');
	    $( prefix + "#bt2" ).removeAttr('disabled','');
	    $( prefix + "#bt3" ).attr('disabled','disabled');
	    $( prefix + "#bt4" ).removeAttr('disabled','');
	}
	if ( status== 2) {
	    $( prefix + "#bt1" ).attr('disabled','disabled');
	    $( prefix + "#bt2" ).attr('disabled','disabled');
	    $( prefix + "#bt3" ).removeAttr('disabled','');
	    $( prefix + "#bt4" ).attr('disabled','disabled');
	}
	if ( status== 3) {
	    $( prefix + "#bt1" ).attr('disabled','disabled');
	    $( prefix + "#bt2" ).attr('disabled','disabled');
	    $( prefix + "#bt3" ).attr('disabled','disabled');
	    $( prefix + "#bt4" ).removeAttr('disabled','');
	}
	if ( status== 4) {
	    $( prefix + "#bt1" ).attr('disabled','disabled');
	    $( prefix + "#bt2" ).attr('disabled','disabled');
	    $( prefix + "#bt3" ).attr('disabled','disabled');
	    $( prefix + "#bt4" ).attr('disabled','disabled');
	}
    }
    function asistencia_registro_field_cancel() {

	$( prefix + ".field_dni_valido" ).val('0');
	$( prefix + ".field_nombre" ).html('');
	$( prefix + ".field_dni" ).val('');
	$( prefix + ".field_nota" ).val('');
    }
    function asistencia_registro_field_save(item) {
	if (item.attr('disabled') == null) {
	    var enviar = {
		dni_valido: $( prefix + ".field_dni_valido" ).val()
		, status: item.attr('status')
		, dni: $( prefix + ".field_dni" ).val()
		, nota: $( prefix + ".field_nota" ).val()
	    }
	    if (enviar.dni_valido==1) {
		c(enviar);
		$.ajax({
			type: "POST",
			url: "./ajax/button/registro_save_by_status.php",
			data: enviar,
			success: function(data) {
			    $( prefix + ".pruebas" ).html(data);
			    asistencia_registro_field_cancel();
			}
		});
	    } else if(enviar.dni_valido==0) {
		a('Dni No existe');
	    }
	}
    }

});
