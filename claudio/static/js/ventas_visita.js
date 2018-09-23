$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#ve_propuesta_field_';
    var prefixClass = '.ve_propuesta_field_';
    // --------------------------------------------------------------- load
    ve_propuesta_field_visita_table();
    ve_propuesta_visita_modal_field_estado_id();
    ve_propuesta_visita_modal_field_departamento_id();
    ve_propuesta_visita_modal_field_provincia_id();
    ve_propuesta_visita_modal_field_distrito_id();
    // ------------------------------------------------------------ eventos
    $("body").on("click", "#ve_propuesta_field_visita_add", function(e) {
	ve_propuesta_field_visita_add();
	e.preventDefault();
    });
    $("#ve_propuesta_field_visita_table").on("click", ".edit", function(e) {
	ve_propuesta_field_visita_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("#ve_propuesta_field_visita_table").on("click", ".delete", function(e) {
	ve_propuesta_field_visita_delete( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_visita_modal_field_save", function(e) {
	ve_propuesta_field_visita_save();
	e.preventDefault();
    });
    
    // ------- ubigeo
    $("body").on("change", "#ve_propuesta_visita_modal_field_departamento_id", function(e) {
	$('#ve_propuesta_visita_modal_field_provincia_id').val('0');
	ve_propuesta_visita_modal_field_provincia_id();
	$('#ve_propuesta_visita_modal_field_distrito_id')
	    .html(option_empty)
	    .trigger('chosen:updated');
    });
    $("body").on("change", "#ve_propuesta_visita_modal_field_provincia_id", function(e) {
	$('#ve_propuesta_visita_modal_field_distrito_id').val('0');
	ve_propuesta_visita_modal_field_distrito_id();
    });
    // ---------------------------------------------------------- funciones
    function ve_propuesta_field_visita_table() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';
	
	var enviar = {
	    propuesta_id: $(prefixId+'id').val()
	}
	// c(enviar);
	element_simple( './ajax/tables/visitas_propuesta_table.php', prefixId+'visita_table tbody', enviar );
    }
    function ve_propuesta_field_visita_add() {
	var f = new Date();
	var mes = f.getMonth() +1;
	if (mes < 10) {
	    mes = "0" + mes;
	}
	var datos = {
	    accion: 'add'
	    , id:'0'
	    , estado_id:'1'
	    , contacto_id:'0'
	    , fecha: f.getDate() + "-" + mes + "-" + f.getFullYear()
	    , hora:''
	    , minuto:'0'
	    , meridiano:'am'
	    , direccion:''
	    , observacion:''
	}
	// c(datos);
	ve_propuesta_visita_modal_field_datos( datos );
    }
    function ve_propuesta_field_visita_edit(item) {
	var datos = {
	    accion: 'edit'
	    , id:item.attr('codigo')
	    , estado_id: item.find("td").eq(0).attr('estado_id')
	    , contacto_id: item.find("td").eq(1).attr('contacto_id')
	    , fecha: item.find("td").eq(2).text()
	    , hora: item.find("td").eq(3).attr('hora')
	    , minuto: item.find("td").eq(3).attr('minuto')
	    , meridiano: item.find("td").eq(3).attr('meridiano')
	    , departamento_id: item.find("td").eq(4).attr('departamento_id')
	    , provincia_id: item.find("td").eq(4).attr('provincia_id')
	    , distrito_id: item.find("td").eq(4).attr('distrito_id')
	    , direccion: item.find("td").eq(5).text()
	    , observacion:item.find("td").eq(6).text()
	}
	// c(datos);
	ve_propuesta_visita_modal_field_datos( datos );
    }
    function ve_propuesta_field_visita_save() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';

	var enviar = {
	    accion: 'save'
	    , propuesta_id: $(prefixId+'id').val()
	    , id: $(prefixSubId+'id').val()
	    , estado_id: $(prefixSubId+'estado_id').val()
	    , contacto_id: $(prefixSubId+'contacto_id').val()
	    , fecha: $(prefixSubId+'fecha').val()
	    , hora: $(prefixSubId+'hora').val()
	    , minuto: $(prefixSubId+'minuto').val()
	    , meridiano: $(prefixSubId+'meridiano').val()
	    , departamento_id: $(prefixSubId+'departamento_id').val()
	    , provincia_id: $(prefixSubId+'provincia_id').val()
	    , distrito_id: $(prefixSubId+'distrito_id').val()
	    , direccion: $(prefixSubId+'direccion').val()
	    , observacion: $(prefixSubId+'observacion').val()
	}
	c(enviar);
	if ( enviar.fecha.trim() !=''
	     && enviar.hora.trim() !=''
	     && enviar.minuto.trim() !=''
	     && enviar.departamento_id !=''
	     && enviar.distrito_id_id !=''
	     && enviar.provincia_id_id !=''
	     
	) {
	    $.ajax({
		type: "POST",
		data: enviar,
		url: './ajax/button/visita_modals_button.php',
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
	    	    	// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$(prefixId+'visita_table tbody' ).append( data );
	    	    } else {
	    	    	// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( prefixId+'visita_table tbody .item_' + enviar.id ).html( data );
	    	    }
		    ve_propuesta_visita_modal_field_datos( enviar );
		}
	    });
	} else {
	    alert('Falta llenar algunos datos.');
	}
    }
    function ve_propuesta_field_visita_delete( item ) {
	var enviar = {
	    propuesta_id: $(prefixId+'id').val()
	    , visita_id: item.attr('codigo')	    
	}
	delete_simple( './ajax/delete/visita_delete.php'
		       ,'#ve_propuesta_field_visita_table .item_'+enviar.visita_id
		       ,enviar );
    }
    function ve_propuesta_visita_modal_field_datos( datos ) {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';
	if (datos.accion=='add') {
	    $(prefixSubId+'my_form').show();
	    $(prefixSubId+'my_mensaje').hide();
	    $(prefixSubId+'id').val(datos.id);
	    $(prefixSubId+'estado_id').val(datos.estado_id).trigger('chosen:updated');
	    $(prefixSubId+'contacto_id').val(datos.contacto_id).trigger('chosen:updated');
	    ve_propuesta_visita_modal_field_contacto_id();
	    $(prefixSubId+'fecha').val(datos.fecha);
	    $(prefixSubId+'hora').val(datos.hora);
	    $(prefixSubId+'minuto').val(datos.minuto);
	    $(prefixSubId+'meridiano').val(datos.meridiano).trigger('chosen:updated');
	    $(prefixSubId+'direccion').val(datos.direccion);
	    $(prefixSubId+'observacion').val(datos.observacion);
	} 
	if (datos.accion=='edit') {
	    $(prefixSubId+'my_form').show();
	    $(prefixSubId+'my_mensaje').hide();

	    $(prefixSubId+'id').val(datos.id);
	    $(prefixSubId+'estado_id').val(datos.estado_id).trigger('chosen:updated');
	    $(prefixSubId+'contacto_id').html('<option value="'+datos.contacto_id+'"></option>');   
	    ve_propuesta_visita_modal_field_contacto_id();
	    $(prefixSubId+'fecha').val(datos.fecha);
	    $(prefixSubId+'hora').val(datos.hora);
	    $(prefixSubId+'minuto').val(datos.minuto);
	    $(prefixSubId+'meridiano').val(datos.meridiano).trigger('chosen:updated');
	    $(prefixSubId+'departamento_id').html('<option value="'+datos.departamento_id+'"></option>');
	    $(prefixSubId+'provincia_id').html('<option value="'+datos.provincia_id+'"></option>');
	    $(prefixSubId+'distrito_id').html('<option value="'+datos.distrito_id+'"></option>');
	    ve_propuesta_visita_modal_field_departamento_id();
	    ve_propuesta_visita_modal_field_provincia_id();
	    ve_propuesta_visita_modal_field_distrito_id();
	    $(prefixSubId+'direccion').val(datos.direccion);
	    $(prefixSubId+'observacion').val(datos.observacion);
	}
	if (datos.accion=='save') {
	    $(prefixSubId+'my_form').hide();
	    $(prefixSubId+'my_mensaje').html('Registro guardado');	    
	    $(prefixSubId+'my_mensaje').show();
	}
	var enviar = {
	    vendedor_id: $(prefixId+'vendedor_id').val()
	}
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: './ajax/info/es_propuesta_de_usuario.php',
	    success: function(data) {
		if (data.trim()=='si') {
		    $(prefixSubId+'direccion').val(datos.direccion);
		    $(prefixSubId+'observacion').val(datos.observacion);
		} else if (data.trim()=='no') {
		    $(prefixSubId+'my_form').hide();
		    $(prefixSubId+'my_mensaje').html('Sin permiso');	    
		    $(prefixSubId+'my_mensaje').show();
		}

	    }
	});
    }
    function ve_propuesta_visita_modal_field_estado_id() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';

	var enviar = { id: $(prefixSubId+'estado_id').val() }
	select_simple( './ajax/select/estado_visita_modal_save.php', prefixSubId+'estado_id', enviar );	
    }
    function ve_propuesta_visita_modal_field_contacto_id() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';
	
	var enviar = {
	    id: $(prefixSubId+'contacto_id').val()
	    , tipo_juridica: $(prefixId+'persona_tipo_juridico').is(':checked')
	    , tipo_natural: $(prefixId+'persona_tipo_natural').is(':checked')
	    , juridica_id: $(prefixId+'persona_juridico_id').val()
	    , natural_id: $(prefixId+'persona_natural_id').val()	    
	}
	// c(enviar);
	select_simple( './ajax/select/contacto_visita_modal_save.php', prefixSubId+'contacto_id', enviar );
    }
    function ve_propuesta_visita_modal_field_departamento_id() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';
	var enviar = {
	    departamento_id: $(prefixSubId+'departamento_id').val()
	}

	// c(enviar);
	select_simple( '../cotizacion/ajax/combos/bienes_inmueble_departamento_combo.php', prefixSubId+'departamento_id', enviar );
    }
    function ve_propuesta_visita_modal_field_provincia_id() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';
	var enviar = {
	    departamento_id: $(prefixSubId+'departamento_id').val()
	    , provincia_id: $(prefixSubId+'provincia_id').val()
	}
	select_simple( '../cotizacion/ajax/combos/bienes_inmueble_provincia_combo.php', prefixSubId+'provincia_id', enviar );
    }
    function ve_propuesta_visita_modal_field_distrito_id() {
	var prefixSubId    = '#ve_propuesta_visita_modal_field_';
	var prefixSubClass = '.ve_propuesta_visita_modal_field_';
	var enviar = {
	    departamento_id: $(prefixSubId+'departamento_id').val()
	    , provincia_id: $(prefixSubId+'provincia_id').val()
	    , distrito_id: $(prefixSubId+'distrito_id').val()
	}
	select_simple( '../cotizacion/ajax/combos/bienes_inmueble_distrito_combo.php', prefixSubId+'distrito_id', enviar );
    }
    // ------------------------------------------------------ reutilizables
    function select_simple( path, componente, enviar ) {
	var select = $(componente);	
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
		select.html(data);
		select.trigger('chosen:updated');
	    }
	});
    }
    function element_simple( path, componente, enviar ) {
	var element = $(componente);
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
		element.html(data);
	    }
	});
    }
    function val_simple( path, componente, enviar ) {
	var element = $(componente);
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
		element.val(data);
	    }
	});
    }
    function variable_simple( path, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
		return data;
	    }
	});
    }
    function process_simple( path, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {}
	});
    }
    function delete_simple( path, componente, enviar ) {
	$(componente).css( 'background-color', '#FEC7C7' );
        $.ajax({
	    type: "POST",
	    url: path,
	    data: enviar,
	    success: function( data ) {
		if (data.trim() =='SIN PERMISO') {
		    $(componente).css( 'background-color', 'transparent' );
		    alert( data.trim() );		    
		} else {
		    var myVar = setInterval( function() {
			$(componente).remove();
		    }, 2200 );
		}
	    }
	});
    }
});
