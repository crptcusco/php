$(document).ready(function() {
    var prefix = "co_search_result_field_";
    var option_empty='<option value=""></option>';
    // ------------------------------------------- INICIO
    // ------------------------------------------- EVENTO
    $("body").on("click", "#" + prefix + "search", function(e) {
	co_result_field_search();
	e.preventDefault();
    });

    // ------------------------------------------- FUNCIONES
    function co_result_field_search(){
	var enviar = {
	    general_actualizacion_si: $('#co_search_general_field_actualizacion_si').is(':checked')
	    , general_actualizacion_no: $('#co_search_general_field_actualizacion_no').is(':checked')
	    , general_tipo_servicio: $('#co_search_general_field_tipo_servicio').val()
	    , general_estado_cotizacion: $('#co_search_general_field_estado_cotizacion').val()
	    , involucrados_coordinador_id: $('#co_search_involucrado_field_coordinador_id').val()
	    , involucrados_rol_cliente: $('#co_search_involucrado_field_rol_cliente').is(':checked')
	    , involucrados_rol_solicitante: $('#co_search_involucrado_field_rol_solicitante').is(':checked')
	    , involucrados_rol_propietario: $('#co_search_involucrado_field_rol_propietario').is(':checked')
	    , involucrados_tipo_juridico: $('#co_search_involucrado_field_tipo_juridico_radio').is(':checked')
	    , involucrados_tipo_natural: $('#co_search_involucrado_field_tipo_natural_radio').is(':checked')
	    , involucrados_juridico_id: $('#co_search_involucrado_field_tipo_juridico_id').val()
	    , involucrados_juridico_contacto_id: $('#co_search_involucrado_field_tipo_juridico_contacto_id').val()
	    , involucrados_natural_id: $('#co_search_involucrado_field_tipo_natural_id').val()
	    , involucrados_vendedor_id: $('#co_search_involucrado_field_vendedor_id').val()
	    , bienes_cateroria_ninguno : $('#co_search_bienes_field_categoria_ninguno_radio').is(':checked')
	    , bienes_cateroria_mueble : $('#co_search_bienes_field_categoria_mueble_radio').is(':checked')
	    , bienes_cateroria_inmueble : $('#co_search_bienes_field_categoria_inmueble_radio').is(':checked')
	    , bienes_sub_cateroria_mueble: $('#co_search_bienes_field_sub_categoria_mueble').val()
	    , bienes_sub_cateroria_inmueble: $('#co_search_bienes_field_sub_categoria_inmueble').val()
	    , bienes_sub_mueble_tipo: $('#co_search_bienes_field_sub_categoria_mueble_tipo').val()
	    , bienes_sub_mueble_marca: $('#co_search_bienes_field_sub_categoria_mueble_marca').val()
	    , bienes_sub_mueble_modelo: $('#co_search_bienes_field_sub_categoria_mueble_modelo').val()
	    , bienes_sub_mueble_descripcion: $('#co_search_bienes_field_sub_categoria_mueble_descripcion').val()
	    , bienes_sub_inmueble_departamento: $('#co_search_bienes_field_sub_categoria_inmueble_departamento').val()
	    , bienes_sub_inmueble_provincia: $('#co_search_bienes_field_sub_categoria_inmueble_provincia').val()
	    , bienes_sub_inmueble_distrito: $('#co_search_bienes_field_sub_categoria_inmueble_distrito').val()
	    , bienes_sub_inmueble_direccion: $('#co_search_bienes_field_sub_categoria_inmueble_direccion').val()
	}
	$.ajax({
	    type: "POST",
	    data: enviar, 
	    url: "./ajax/buttons/search.php",
	    success: function(data) {
	    	if ( data!='' ) {
		    $('#'+prefix+'table').html( data );
	    	}
	    }
	});
    }
    
} );
