$(document).ready(function() { 
    $("body").on("click", "#co_save_cotizacion_finalizada", function(e){
	var texto = $('#co_mensaje_cotizacion_finalizada').val();
	var enviar = '';
	if (texto.trim()!='') {	    
	    enviar += 'co_id='+$("#co_id").val() + '&';
	    enviar += 'texto='+ texto + '&';
	    enviar += 'fecha=&';
	    enviar += 'estado_cotizacion='+$("#co_estado_cotizacion").val();
	    c(enviar);
	    $.ajax({
	    	type: "POST",
	    	url: "./ajax/buttons/mensajes-buttons.php",
	    	data: enviar,
	    	success: function( ajax ) {}
            });
	    var checked = "";
	    if ( $('#co_actualizacion_cotizacion_finalizada').is(':checked') ) {
	    	checked = 'On';
	    } else {
	    	checked = '';
	    }
	    var datos = {
	    	id: $('#co_id_cotizacion_finalizada').val()
	    	, co_codigo: $('#co_codigo_cotizacion_finalizada').val()
	    	, co_actualizacion: checked
	    	, co_tipo_servicio: $('#co_tipo_servicio_cotizacion_finalizada').val()
	    	, co_estado_cotizacion: $('#co_estado_cotizacion_cotizacion_finalizada').val()
		// fecha
		, co_fecha_solicitud: $('#co_fecha_solicitud_cotizacion_finalizada').val()
		, co_fecha_envio_cliente: $('#co_fecha_envio_cliente_cotizacion_finalizada').val()
		, co_fecha_finalizado: $('#co_fecha_finalizado_cotizacion_finalizada').val()
		//  involucrados
		, co_involucrados_vendedor: $('#co_involucrados_vendedor_cotizacion_finalizada').val()
                , co_tipo_cotizacion: $('#co_tipo_cotizacion_cotizacion_finalizada').val()
                , co_desglose: $('#co_desglose_cotizacion_finalizada').val()
                // cambio
                , montos_sin: $('#co_montos_field_total_sin_igv_cotizacion_finalizada').val()
                , montos_igv_si: $('#co_montos_field_total_igv_cotizacion_finalizada').val()
                , montos_igv_monto: $('#co_montos_field_igv_oculto_cotizacion_finalizada').val()
                , montos_de: $('#co_montos_field_total_igv_direccion_cotizacion_finalizada').val()
                , montos_con: $('#co_montos_field_total_con_igv_cotizacion_finalizada').val()
                , montos_moneda_id: $('#co_montos_field_total_moneda_cotizacion_finalizada').val()
                , montos_cambio: $('#co_montos_field_total_moneda_monto_cotizacion_finalizada').val()
                //
		, co_finalizada: '1'
	    }
	    $.ajax({
	    	type: "POST",
	    	url: "./save.php",
	    	data: datos,
	    	success: function( ajax ) {
		    //c(datos);
		    document.location.href = document.location.href;
		    // window.location.href = "./";
		}
            });
	} else {
	    alert('El mensaje es obligatorio');
	}
	return false;
	
    });
    $("body").on("click", "#co_cotizacion_save", function(e){
	var codigo = $('#co_codigo').val();
	var estado = $('#co_estado_cotizacion').val();
	/**
	 * 1: Pendiente
	 * 2: En Espera
	 * 3: Aprobado
	 * 4: Desestimado
	 */
	if ( codigo==0 && estado==4 ){
	    a('Estado de COTIZACIÓN invalida: ya que cierra la COTIZACIÓN');
	    return false;
	}
	if ( codigo!=0 && estado==4 ){
            //c(codigo);
	    finalizar_cotizacion();
            jQuery('#link_finalizar_cotizacion')[0].click();
            $(function() { 
                $("#link_finalizar_cotizacion").change(function() {
                });
            });
	    return false;
	}

    });
    function finalizar_cotizacion(estado) {
	var modal = $( '#modal_finalizar_cotizacion .modal_ajax' );
	var enviar = '';
	// var arreglo = [];
	// $.ajax({
	//     type: "POST",
	//     url: "./ajax/text/mensajes_texto.php",
	//     data: enviar, 
	//     success: function(cadena) {
	// 	arreglo = cadena.split("!!-!!");
	// 	//c(arreglo);
	// 	$( "#co_mensaje_cotizacion_finalizada" ).autocomplete({
	// 	    source: arreglo
	// 	});
	//     }
	// });
	var checked = "";
	if ( $('#co_actualizacion').is(':checked') ) {
	    checked = 'On';
	}	
	var datos = {
	    id: $('#co_id').val()
	    , codigo: $('#co_codigo').val()
	    , actualizacion: checked
	    , tipo_servicio: $('#co_tipo_servicio').val()
	    , estado_cotizacion: $('#co_estado_cotizacion').val()
	    , co_fecha_solicitud: $('#co_fecha_solicitud').val()
	    , co_fecha_envio_cliente: $('#co_fecha_envio_cliente').val()
	    , co_fecha_finalizado: $('#co_fecha_finalizado').val()	    
	    , co_involucrados_vendedor: $('#co_involucrados_vendedor').val()	    
	    , co_tipo_cotizacion: $('#co_tipo_cotizacion').val()
            , co_desglose: $('#co_desglose').val()
            , montos_sin: $('#co_montos_field_total_sin_igv').val()
            , montos_igv_si: $('#co_montos_field_total_igv').is(':checked')
            , montos_igv_monto: $('#co_montos_field_igv_oculto').val()
            , montos_de: $('#co_montos_field_total_igv_direccion').val()
            , montos_con: $('#co_montos_field_total_con_igv').val()
            , montos_moneda_id: $('#co_montos_field_total_moneda').val()
            , montos_cambio: $('#co_montos_field_total_moneda_monto').val()
	}
        // c(datos);
	$('#co_id_cotizacion_finalizada').val( datos.id );
	$('#co_codigo_cotizacion_finalizada').val( datos.codigo );
	$('#co_actualizacion_cotizacion_finalizada').val( datos.actualizacion );
	$('#co_tipo_servicio_cotizacion_finalizada').val( datos.tipo_servicio );
	$('#co_estado_cotizacion_cotizacion_finalizada').val( datos.estado_cotizacion );
	$('#co_fecha_solicitud_cotizacion_finalizada').val( datos.co_fecha_solicitud );
	$('#co_fecha_envio_cliente_cotizacion_finalizada').val( datos.co_fecha_envio_cliente );
	$('#co_fecha_finalizado_cotizacion_finalizada').val( datos.co_fecha_finalizado );
	$('#co_involucrados_vendedor_cotizacion_finalizada').val( datos.co_involucrados_vendedor );
        $('#co_tipo_cotizacion_cotizacion_finalizada').val(datos.co_tipo_cotizacion);
        $('#co_desglose_cotizacion_finalizada').val(datos.co_desglose);
        // 
        $('#co_montos_field_total_sin_igv_cotizacion_finalizada').val(datos.montos_sin);
        if (datos.montos_igv_si == true) datos.montos_igv_si = 'on';
        else  datos.montos_igv_si = '';
        $('#co_montos_field_total_igv_cotizacion_finalizada').val(datos.montos_igv_si);
        $('#co_montos_field_total_igv_direccion_cotizacion_finalizada').val(datos.montos_de);
        $('#co_montos_field_total_con_igv_cotizacion_finalizada').val(datos.montos_con);
        $('#co_montos_field_igv_oculto_cotizacion_finalizada').val(datos.montos_igv_monto);
        $('#co_montos_field_total_moneda_cotizacion_finalizada').val(datos.montos_moneda_id);
        $('#co_montos_field_total_moneda_monto_cotizacion_finalizada').val(datos.montos_cambio);
    }
});
