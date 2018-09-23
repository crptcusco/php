$(document).ready(function() {
    var prefix = 'co_montos_field_';
    co_montos_field_monto();
    co_montos_field_monto_valor();
    co_montos_field_igv();
    co_montos_field_perito_id();
    co_montos_field_cargar_montos();
    co_montos_field_servicios();
    
    // ----------------------------------------- eventos
    $(".co_montos_field_moneda").change(function() {
	var id = $(this).val();
	var destino = $(this).attr('destino');
	co_montos_field_monto_valor2(id,destino);
        // a('aa');
    });
    $("body").on("click", "#co_montos_field_moneda_general_save", function(e) {
	// co_montos_field_moneda_general_save();
	// return false;
    });
    $("body").on("click", "#co_montos_field_igv_save", function(e) {
    // co_montos_field_igv_save( );
    // e.preventDefault();
    });
    $( "#co_montos_field_total_sin_igv" ).keyup(function() {
	co_montos_field_total(
	    '#co_montos_field_total_sin_igv'
	    , '#co_montos_field_total_igv'
	    , '#co_montos_field_total_con_igv'
	    , 'a_con'
	);
    });
    $( "#co_montos_field_total_con_igv" ).keyup(function() {
	co_montos_field_total(
	    '#co_montos_field_total_sin_igv'
	    , '#co_montos_field_total_igv'
	    , '#co_montos_field_total_con_igv'
	    , 'a_sin'
	);
    });
    $("#co_montos_field_total_igv").change(function() {
	var direccion = $('#co_montos_field_total_igv_direccion').val();	
	if (direccion == 'con') {
	    direccion = 'a_sin';
	} else if (direccion = 'sin') {
	    direccion = 'a_con';
	}
	co_montos_field_total(
	    '#co_montos_field_total_sin_igv'
	    , '#co_montos_field_total_igv'
	    , '#co_montos_field_total_con_igv'
	    , direccion
	);	
    });
    $("body").on("click", "#co_montos_field_total_save", function(e) {
	co_montos_field_total_save();
	e.preventDefault();
    });
    // -------------------- servicios
    $("#co_montos_field_servicios").on("click", ".edit", function(e) {
        co_montos_field_servicios_edit($(this))
	e.preventDefault();
    });
    $("#co_montos_field_servicios").on("click", ".delete", function(e) {
        co_montos_field_servicios_delete($(this))
	e.preventDefault();
    });
    $("#co_servicios_save").on("click", function(e) {
        co_montos_field_servicios_save()
	e.preventDefault();
    });
    $("#co_servicios_clear").on("click", function(e) {
        co_montos_field_servicios_clear()
	e.preventDefault();
    });
    // -- modales
    $("body").on("click", "#co_montos_field_perito_link", function(e) {
	co_montos_field_perito_link();
	e.preventDefault();
    });
    $("body").on("click", "#montos-juridico-table-ajax .edit", function(e) {
	co_montos_field_perito_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#co_montos_field_perito_modal_field_cancel", function(e) {
	co_montos_field_perito_modal_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_montos_field_perito_modal_field_save", function(e) {
	co_montos_field_perito_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#co_montos_field_perito_modal[data-reveal]', function () {
	co_montos_field_perito_id();	
    });
    // ----------------------------------------- eventos
    $("#co_montos_tipo_cambio_str").change(function() {
	montos_optener_tipo_cambio_monto();
    });
    $(".only-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    // ----------------------------------------- funciones
    function co_montos_field_monto() {
	var combo = $('.co_montos_field_moneda');
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/monto_moneda_str.php",
	    success: function( data ) {		
		combo.html( data );
		combo.trigger( 'chosen:updated' );
	    }
        });	
    }
    function co_montos_field_monto_valor() {
	var caja = $('.co_montos_field_monto_valor');
	var value =  $("#co_montos_field_moneda_general_id").val();
	if (value == null) {
	    value = 1;
	}
	var enviar = {
	    id : value
	};
        $.ajax({
	    type: "POST",
	    url: "./ajax/text/monto_moneda_monto.php",
	    data: enviar,
	    success: function( data ) {
		if ( data != '' ) {
		    $('.co_montos_field_monto_valor').val( data );
		}
	    }
        });	
    }
    function co_montos_field_monto_valor2(id,name) {
	var caja = $('#'+name);
	var value =  id;
	if (value == null) {
	    value = 1;
	}
	var enviar = {
	    id : value
	};
        $.ajax({
	    type: "POST",
	    url: "./ajax/text/monto_moneda_monto.php",
	    data: enviar,
	    success: function( data ) {
		if ( data != '' ) {
		    caja.val( data );
		    caja.attr('moneda', enviar.id )
                    if (id == '1') {
                        caja.attr('readonly','readonly');
                    } else {
                        caja.removeAttr('readonly');
                    }
		}
	    }
        });	
    }
    function co_montos_field_igv() {
	var oculto = $('#co_montos_field_igv_oculto');
        $.ajax({
	    type: "POST",
	    url: "./ajax/text/montos_igv.php",
	    success: function( data ) {
		oculto.val( data );
	    }
        });	
    }
    function co_montos_field_moneda_general_save() {
	// enviar = {
	//     id: $('#'+ prefix +'moneda_general_id').val()
	//     , valor: $('#'+ prefix +'moneda_general_monto').val()
	//     , co_id: $('#co_id').val()
	// }
        // $.ajax({
	//     type: "POST",
	//     data: enviar,
	//     url: "./ajax/buttons/involucrados-cambio-buttons.php",
	//     success: function( data ) {
	// 	if (enviar.id==1){
	// 	    $('#co_montos_field_moneda_general_monto').val('1.00');
	// 	}
	// 	// cambiando las monedas
	// 	$('.'+prefix+'monto_valor').each(function() {
	// 	    var moneda_id = $(this).attr('moneda');		    
	// 	    if ( moneda_id==enviar.id && enviar.id!=1 ) {
	// 		$( this ).val( enviar.valor );
	// 	    }
	// 	});
	//     }
        // });
    }
    function co_montos_field_igv_save() {
	// var oculto = $('#co_montos_field_igv_oculto');
	// enviar = {
	//     igv: $('#'+ prefix +'igv').val()
	//     , co_id: $('#co_id').val()
	// }
        // $.ajax({
	//     type: "POST",
	//     data: enviar,
	//     url: "./ajax/buttons/involucrados-igv-buttons.php",
	//     success: function( data ) {
	// 	oculto.val( enviar.igv );
	//     }
        // });
	// // actualizando peritos
	// $('#' + prefix + 'tabla .item_perito').remove();
    }
    //--------------------- peritos
    function co_montos_field_perito_id() {
	var combo = $('#co_montos_field_perito_id');
	var enviar = {
	    id: combo.val()
	}
	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/combos/monto_perito_combo.php",
	    success: function( data ) {
		combo
		    .html(data)
		    .trigger('chosen:updated');		
	    }
	});
    }
    // modals
    function co_montos_field_perito_link() {
	var tabla = $('#co_montos_field_perito_modal_field_tabla');
	var enviar = {
	}
	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/modal/montos_peritos_tables_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    function co_montos_field_perito_modal_field_edit( item ) {
	var prefix = '#co_montos_field_perito_modal_field_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , telefono: item.find("td").eq(1).text()
	    , correo: item.find("td").eq(2).text()
	    , status: item.find("td").eq(3).text()
	    , save: 'Editar'
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
        $(prefix + 'telefono').val( datos.telefono );
        $(prefix + 'correo').val( datos.correo );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	$('#montos-juridico-table-ajax tr').removeClass('edit_item');
	item.addClass('edit_item');
    }
    function co_montos_field_perito_modal_field_cancel() {
	var prefix = '#co_montos_field_perito_modal_field_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , telefono: ''
	    , correo: ''
	    , status: 'Activo'
	    , save: 'Añadir'
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
        $(prefix + 'telefono').val( datos.telefono );
        $(prefix + 'correo').val( datos.correo );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	$('#montos-juridico-table-ajax tr').removeClass('edit_item');

    }
    function co_montos_field_perito_modal_field_save() {
	var prefix = '#co_montos_field_perito_modal_field_';
	var enviar = {
            id: $(prefix + 'id').val()
	    , nombre: $(prefix + 'nombre').val()
	    , telefono: $(prefix + 'telefono').val()
	    , correo: $(prefix + 'correo').val()
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != '' 
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/modal/montos_peritos/save_peritos.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#montos-juridico-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#montos-juridico-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    co_montos_field_perito_modal_field_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('Falta Insertar Información');
	}
    }
    // ----- otros
    function co_montos_field_total(in_sin, in_igv, in_con, in_tipo) {
	var igv = $(in_igv).is(':checked');
	var tipo = in_tipo;
	if (igv==true){
	    igv = $('#co_montos_field_igv_oculto').val();
	} else {
	    igv = 0;
	}
	if ( tipo == "a_con") {
	    var sin = $(in_sin).val();
	    if (sin.trim()=='') sin = 0;
	    var con = parseFloat(sin) * (1+parseFloat(igv));
	    con = redondeoV3(con, 2);
	    $(in_sin).css( 'background-color','#C5FCFF' );
	    $(in_con).css( 'background-color','transparent' );
	    $(in_con).val( con );
	    $('#co_montos_field_total_igv_direccion').val('sin');
	}
	if ( tipo == "a_sin") {
	    var con = $(in_con).val();
	    if (con.trim()=='') con = 0;
	    var sin = parseFloat(con) / (1+parseFloat(igv));
	    sin = redondeoV3(sin, 2);
	    $(in_con).css( 'background-color','#C5FCFF' );
	    $(in_sin).css( 'background-color','transparent' );
	    $(in_sin).val( sin );
	    $('#co_montos_field_total_igv_direccion').val('con');
	}
    }
    // ----------------------------
    function co_montos_field_cargar_montos() {
	var prefix = '#co_montos_field_total_';
	var enviar = {
	    cotizacion_id: $('#co_id').val()
	}
	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/text/montos_cargar_totales.php",
	    success: function( data ) {
		var jsn = jQuery.parseJSON( data );
		$(prefix+'sin_igv').val(jsn.sin_igv);
		if (jsn.igv!='0.00') {
		    $(prefix+'igv').prop('checked', true);
		} else {
		    $(prefix+'igv').prop('checked', false);
		}
		$(prefix+'igv_direccion').val(jsn.igv_de);
		if (jsn.igv_de=='sin') {
		    $(prefix+'sin_igv').css( 'background-color','#C5FCFF' );
		    $(prefix+'con_igv').css( 'background-color','transparent' );
		} 
		if (jsn.igv_de=='con') {
		    $(prefix+'con_igv').css( 'background-color','#C5FCFF' );
		    $(prefix+'sin_igv').css( 'background-color','transparent' );		    
		} 
		$(prefix+'con_igv').val(jsn.con_igv);
		$(prefix+'moneda')
		    .val(jsn.moneda_id)
		    .trigger('chosen:updated');
		$(prefix+'moneda_monto').val(jsn.moneda_monto);
                if (jsn.moneda_id == '1') {
                    $(prefix+'moneda_monto').attr('readonly','readonly');
                }
	    }
	});

    }
    // servicios
    function co_montos_field_servicios() {
	var enviar = {
	    cotizacion_id: $('#co_id').val()
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/tables/servicios-tables.php",
	    success: function( data ) {
                $('#co_montos_field_servicios tbody').html(data);
            }
        });
    }
    function co_montos_field_servicios_edit(item) {
        var datos = {
            servicios_id: item.attr('codigo'),
            descripcion:  item.parent().parent().find("td").eq(0).text(),
            subtotal:     item.parent().parent().find("td").eq(1).text(),
        }
        // c(datos);
        $('#co_servicios_id').val(datos.servicios_id);
        $('#co_servicios_descripcion').val(datos.descripcion);
        $('#co_servicios_subtotal').val(datos.subtotal);

        $('#co_montos_field_servicios tr').removeClass('active');
        item.parent().parent().addClass('active');
    }
    function co_montos_field_servicios_delete(item) {
        var datos = {
            servicio_id: item.attr('codigo'),
        }
        // c(datos);
        $.ajax({
	    type: "POST",
	    data: datos,
	    url: "./ajax/delete/servicios_delete.php",
	    success: function( data ) { }
        });
        var div = item.parent().parent();  
        div.addClass('delete');
        var myVar = setInterval( function() {
	    div.remove();
            clearInterval(myVar);
	}, 2000 );
        co_montos_field_servicios_calcular();
    }
    function co_montos_field_servicios_save() {
        var save = true;
        var datos = {
            cotizacion_id : $('#co_id').val(),
            servicio_id  : $('#co_servicios_id').val(),
            descripcion   : $('#co_servicios_descripcion').val(),
            subtotal      : $('#co_servicios_subtotal').val(),
        }
        // c(datos);
        if (datos.descripcion.trim() == '') {
            save = false;
            alert('Ingrese Descripción');
        }
        if (datos.subtotal.trim() == '') {
            save = false;
            alert('Ingrese SubTotal');
        }
        if (save) {
            $.ajax({
	        type: "POST",
	        data: datos,
	        url: "./ajax/buttons/servicios-save-buttons.php",
	        success: function( data ) {

                }
            });
        }
        co_montos_field_servicios();
        co_montos_field_servicios_calcular();
        co_montos_field_servicios_clear();
    }
    function co_montos_field_servicios_clear() {
        var datos = {
            servicios_id: '0',
            descripcion : '',
            subtotal    : '',
        }
        // c(datos);
        $('#co_servicios_id').val(datos.servicios_id);
        $('#co_servicios_descripcion').val(datos.descripcion);
        $('#co_servicios_subtotal').val(datos.subtotal);

        $('#co_montos_field_servicios tr').removeClass('active')
    }
    function co_montos_field_servicios_calcular() {
        var datos = {
            cotizacion_id: $('#co_id').val(),
            igv_sino: $('#co_montos_field_total_igv').is(':checked')
        }
        $.ajax({
	    type: "POST",
	    data: datos,
	    url: "./ajax/text/servicios_total.php",
	    success: function( data ) {
                // c(data);
                var jsn = jQuery.parseJSON(data);
                // c(jsn);
                $('#co_montos_field_total_sin_igv').val(jsn.total);
                $('#co_montos_field_total_con_igv').val(jsn.total_igv);

            }
        });            
    }
    // ----------------------------------------- funciones
    function redondeoV3(numero, decimales) {
	if(typeof(numero) === 'string' || numero instanceof String){
            var resultado = parseFloat( numero );
	}
	var factorConversion = Math.pow(10,decimales);
	var resultado = Math.round(numero*factorConversion)/factorConversion;
	return resultado.toFixed(decimales);
    }
    function co_montos_field_total_save() {
	var enviar = {
	    cotizacion_id: $('#co_id').val(),
	    sin: $('#co_montos_field_total_sin_igv').val(),
	    igv_si: $('#co_montos_field_total_igv').is(':checked'),
	    igv_monto: $('#co_montos_field_igv_oculto').val(),
            
	    con: $('#co_montos_field_total_con_igv').val(),
	    moneda_id: $('#co_montos_field_total_moneda').val(),
	    cambio: $('#co_montos_field_total_moneda_monto').val(),
	    de: $('#co_montos_field_total_igv_direccion').val()
	};
        $.ajax({
	    type: "POST",
	    url: "./ajax/buttons/montos-buttons.php",
	    data: enviar,
	    success: function( data ) {
	    }
        });
    }
});
