$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#ve_propuesta_field_';
    var prefixClass = '.ve_propuesta_field_';
    var dataTable_juridico = '';
    var dataTable_natural = '';
    // --------------------------------------------------------------- load    
    persona_tipo();
    persona_juridico_id();
    persona_juridico_info();
    persona_natural_id();
    persona_natural_info();
    
    // --------------------------------------------------------------- eventos
    $('body').on('click', prefixClass+'persona_tipo', function(e) {
	persona_tipo_clic( $(this).val() );
    });
    $('body').on('change', prefixId+'persona_juridico_id', function(e) {
	persona_juridico_id_change( $(this).val() );
    });
    $('body').on('change', prefixId+'persona_natural_id', function(e) {
	persona_natural_id_change( $(this).val() );
    });
    $('body').on('click', prefixId+'guardar', function(e) {
	var vendedor_id = $(prefixId+'vendedor_id').val();
	var vendedor_cliente_id = $(prefixId+'vendedor_cliente_id').val();
	if ( vendedor_id == '' ) {
	    alert('No es un vendedor');
	    e.preventDefault();
	} else if ( vendedor_id != vendedor_cliente_id ) {
	    alert('El cliente no te pertenece');
	    e.preventDefault();
	} else if ( vendedor_id == vendedor_cliente_id ) {
	    guardar_clic();
	}
    });
    // ---------------------------- vendedor
    $('body').on('click', prefixId+'vendedor_link', function(e) {
	vendedor_modal();
    });
    $('body').on('click', '#ve_propuesta_vendedor_modal_field_cancel', function(e) {
	ve_propuesta_vendedor_modal_field_cancel();
	e.preventDefault();
    });
    $('body').on('click', '#ve_propuesta_vendedor_modal_field_save', function(e) {
	ve_propuesta_vendedor_modal_field_save();
	e.preventDefault();
    });
    $('body').on('click', '#ve_propuesta_vendedor_modal_field_tabla .edit', function(e) {
	ve_propuesta_vendedor_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    // ---------------------------- juridico
    $("body").on("click", "#ve_propuesta_field_persona_juridico_link", function(e) {
	ve_propuesta_field_persona_juridico_link();
	e.preventDefault();
    });
    $('#ve_propuesta_juridico_modal_field_tabla .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            dataTable_juridico.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $('#ve_propuesta_juridico_modal_field_tabla .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_juridico.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });
    $("#ve_propuesta_juridico_modal_field_tabla").on("click", ".editar", function(e) {
	ve_propuesta_juridico_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_cancel", function(e) {
	ve_propuesta_juridico_modal_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_save", function(e) {
	ve_propuesta_juridico_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#ve_propuesta_field_persona_juridico_modal[data-reveal]', function () {
    });
    // ---------- tabs
    $("body").on("click", "#ve_propuesta_juridico_modal_field_tabs-link-1", function(e) {
        $('#ve_propuesta_juridico_modal_field_tabla').hide();
	ve_propuesta_juridico_modal_field_clasificacion_tab_tabla();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_tabs-link-2", function(e) {
        $('#ve_propuesta_juridico_modal_field_tabla').hide();
	ve_propuesta_juridico_modal_field_grupo_tab_tabla();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_tabs-link-3", function(e) {
        $('#ve_propuesta_juridico_modal_field_tabla').hide();
	ve_propuesta_juridico_modal_field_actividad_tab_tabla();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_tabs-link-4", function(e) {
        $('#ve_propuesta_juridico_modal_field_tabla').show();
	ve_propuesta_juridico_modal_field_clasificacion();
	ve_propuesta_juridico_modal_field_actividad();
	ve_propuesta_juridico_modal_field_grupo();
    });
    // ---------- clasificacion
    $("body").on("click", "#involucrados-juridico-clasificacion-table-ajax .edit", function(e) {
	ve_propuesta_juridico_modal_field_clasificacion_tab_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_clasificacion_tab_cancel", function(e) {
	ve_propuesta_juridico_modal_field_clasificacion_tab_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_clasificacion_tab_save", function(e) {
	ve_propuesta_juridico_modal_field_clasificacion_tab_save();
	e.preventDefault();
    });
    // ---------- actividad
    $("body").on("click", "#involucrados-juridico-actividad-table-ajax .edit", function(e) {
	ve_propuesta_juridico_modal_field_actividad_tab_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_actividad_tab_cancel", function(e) {
	ve_propuesta_juridico_modal_field_actividad_tab_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_actividad_tab_save", function(e) {
	ve_propuesta_juridico_modal_field_actividad_tab_save();
	e.preventDefault();
    });
    // ---------- grupo
    $("body").on("click", "#involucrados-juridico-grupo-table-ajax .edit", function(e) {
	ve_propuesta_juridico_modal_field_grupo_tab_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_grupo_tab_cancel", function(e) {
	ve_propuesta_juridico_modal_field_grupo_tab_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_juridico_modal_field_grupo_tab_save", function(e) {
	ve_propuesta_juridico_modal_field_grupo_tab_save();
	e.preventDefault();
    });
    // ----------------------------- natural
    $("body").on("click", "#ve_propuesta_field_persona_natural_link", function(e) {
	ve_propuesta_field_persona_natural_link();
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_natural_modal_field_cancel", function(e) {
	ve_propuesta_natural_modal_field_cancel();
	e.preventDefault();
    });
    $("#ve_propuesta_field_persona_natural_modal").on("click", ".editar", function(e) {
	ve_propuesta_natural_modal_field_edit( $(this) );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_natural_modal_field_save", function(e) {
	ve_propuesta_natural_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#ve_propuesta_field_persona_natural_modal[data-reveal]', function () {	
    });
    // ----------------------------- contacto
    $("body").on("click", "#ve_propuesta_field_persona_juridico_contacto_link", function(e) {
	ve_propuesta_field_persona_contacto_link('juridica');
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_field_persona_natural_contacto_link", function(e) {
	ve_propuesta_field_persona_contacto_link('natural');
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_contacto_modal_field_cancel", function(e) {
	ve_propuesta_contacto_modal_field_cancel();
	e.preventDefault();
    });
    $("#ve_propuesta_field_persona_contacto_modal").on("click", ".editar", function(e) {
	ve_propuesta_contacto_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("#ve_propuesta_field_persona_contacto_modal").on("click", ".delete", function(e) {
	ve_propuesta_contacto_modal_field_delete( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_contacto_modal_field_save", function(e) {
	ve_propuesta_contacto_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#ve_propuesta_field_persona_contacto_modal[data-reveal]', function () {
    });
    // ----------------------------- tipo de servicio
    $("body").on("click", "#ve_propuesta_field_servicio_tipo_link", function(e) {
	ve_propuesta_field_servicio_tipo_link();
	e.preventDefault();
    });
    $("body").on("click", "#ve_propuesta_servicio_tipo_modal_field_tabla a", function(e) {
	ve_propuesta_servicio_tipo_modal_field_tabla_a( $(this) );
	e.preventDefault();
    });
    $("body").on("change", "#ve_propuesta_servicio_tipo_modal_field_tabla input.servicio_tipo_item", function(e) {
	ve_propuesta_servicio_tipo_modal_field_tabla_check( $(this) );
	e.preventDefault();
    });
    
    // ----------------------------------------------------------------------- funciones
    function persona_tipo() {
	var tipo = $(prefixId+'persona_tipo').val();
        c(tipo);
	if ( tipo == 'Juridica' ) {
	    $(prefixId+'persona_tipo_juridico').prop('checked', true);
	    var enviar = { id: $(prefixId+'persona_juridico_id').val() }
	    val_simple ( './ajax/hidden/juridico_vendedor_cliente_hidden.php', prefixId+'vendedor_cliente_id', enviar );
	} else if ( tipo == 'Natural' ) {
	    $(prefixId+'persona_tipo_natural').prop('checked', true);
	    var enviar = { id: $(prefixId+'persona_natural_id').val() }
	    val_simple ( './ajax/hidden/natural_vendedor_cliente_hidden.php', prefixId+'vendedor_cliente_id', enviar );
	}
	persona_tipo_clic(tipo);
    }
    function persona_tipo_clic( tipo ) {
	if ( tipo == 'Juridica' ) {
	    $(prefixId+'persona_contenido_juridico').show();
	    $(prefixId+'persona_contenido_natural').hide();
	}
	if ( tipo == 'Natural' ) {
	    $(prefixId+'persona_contenido_natural').show();
	    $(prefixId+'persona_contenido_juridico').hide();
	}
    }
    function persona_juridico_id() {
	var componente = prefixId+'persona_juridico_id';
	var enviar = {
	    id: $(componente).val()
	}
	$(componente).html('<option value="' + enviar.id + '"></option>');
	select_simple( './ajax/select/juridico_select.php',  componente, enviar );
    }
    function persona_juridico_id_change( item ) {
	var enviar = {
	    id: item
	}
	element_simple( './ajax/info/juridico_info.php', prefixId+'persona_juridico_info', enviar );
	val_simple    ( './ajax/hidden/juridico_vendedor_cliente_hidden.php', prefixId+'vendedor_cliente_id', enviar );
    }
    function persona_juridico_info() {
	var enviar = {
	    id: $(prefixId+'persona_juridico_id').val()
	}
	element_simple( './ajax/info/juridico_info.php', prefixId+'persona_juridico_info', enviar );
    }
    function persona_natural_id() {
	var componente = prefixId+'persona_natural_id';
	var enviar = {
	    id: $(componente).val()
	}
	select_simple( './ajax/select/natural_select.php',  componente, enviar );
    }
    function persona_natural_id_change( item ) {
	var enviar = {
	    id: item
	}
	element_simple( './ajax/info/natural_info.php', prefixId+'persona_natural_info', enviar );
	val_simple    ( './ajax/hidden/natural_vendedor_cliente_hidden.php', prefixId+'vendedor_cliente_id', enviar );
    }
    function persona_natural_info() {
	var enviar = {
	    id: $(prefixId+'persona_natural_id').val()
	}
	element_simple( './ajax/info/natural_info.php', prefixId+'persona_natural_info', enviar );
    }
    function guardar_clic() {
	var tp = $(prefixId+'persona_tipo_natural').prop('checked');
	if (tp) {
	    tp = 'Natural';
	} else {
	    tp = 'Juridica';
	}	
	var enviar = {
	    id: $(prefixId+'id').val()
	    , codigo: $(prefixId+'codigo').val()
	    , persona_tipo: tp
	    , juridica_id: $(prefixId+'persona_juridico_id').val()
	    , natural_id: $(prefixId+'persona_natural_id').val()
	}
	if ( enviar.juridica_id == 0 && enviar.natural_id == 0 ) {
	    alert('FALTA SELECCIONAR A LA PERSONA');
	} else {
	    var element = $(prefixId+'propuesta_id');
	    $.ajax({
		type: "POST",
		data: enviar,
		url: './ajax/button/propuesta_button.php',
		success: function(data) {		    
		    if (data=='NoUser') {
			alert('LA PROPUESTA NO TE PERTENECE');
		    } else {
			element.html(data);
			location.href="editar.php?codigo="+data;
		    }
		}
	    });	    
	}
    }
    // modals
    // ------------------------ vendedor
    function vendedor_modal() {
	var prefixSubId = '#ve_propuesta_vendedor_modal_field_';
	var prefixSubClass = '.ve_propuesta_vendedor_modal_field_';
	var vendedor_id = $(prefixId+'vendedor_id').val();
	var vendedor_rol_id = $(prefixId+'vendedor_rol_id').val();
	ve_propuesta_vendedor_modal_field_cancel();
	
	$(prefixSubId+'vendedor_id').val(vendedor_id);
	$(prefixSubId+'vendedor_rol_id').val(vendedor_rol_id);
	
	if (vendedor_rol_id != '2') { // si no es coordinado 
	    $(prefixSubClass+'user').hide();
	    var enviar = { }
	    $.ajax({
		type: "POST",
		data: enviar,
		url: './ajax/modal/vendedor_modal.php',
		success: function(data) {
		    var jsn = jQuery.parseJSON( data );

		    $(prefixSubId+'nombre').val(jsn.nombre);
		    $(prefixSubId+'telefono').val(jsn.telefono);
		    $(prefixSubId+'correo').val(jsn.correo);
		    $(prefixSubId+'estado').prop('checked',jsn.estado);
		    $(prefixSubId+'save').html('Editar');
		}
	    });	    
	} else {
	    $(prefixSubClass+'user').show();
	    var enviar = { }
	    element_simple( './ajax/tables/vendedor_modal_table.php', prefixSubId+'tabla tbody', enviar );
	    $(prefixSubId+'vendedor_id').val(0);
	}
    }
    function ve_propuesta_vendedor_modal_field_cancel() {
	var prefixSubId = '#ve_propuesta_vendedor_modal_field_';
	var prefixSubClass = '.ve_propuesta_vendedor_modal_field_';
	var enviar = {
	    vendedor_id: 0
	    , nombre: ''
	    , telefono: ''
	    , correo: ''
	    , login: ''
	    , estado: true
	    , password: ''
	    , password_save: true
	    , save: 'GUARDAR'
	}
	$(prefixSubId+'vendedor_id').val(enviar.vendedor_id);
	$(prefixSubId+'nombre').val(enviar.nombre);
	$(prefixSubId+'telefono').val(enviar.telefono);
	$(prefixSubId+'correo').val(enviar.correo);
	$(prefixSubId+'login').val(enviar.login);
	$(prefixSubId+'password').val(enviar.password);
	$(prefixSubId+'estado').prop('checked',enviar.estado);
	$(prefixSubId+'password_save').prop('checked',enviar.password_save);
	$(prefixSubId+'save').html(enviar.save);
	$(prefixSubId+'tabla tbody tr.item').removeClass('edit_item');
    }
    function ve_propuesta_vendedor_modal_field_edit( item ) {
	var prefixSubId = '#ve_propuesta_vendedor_modal_field_';
	var prefixSubClass = '.ve_propuesta_vendedor_modal_field_';
	var enviar = {
	    vendedor_id: item.attr('vendedor_id')
	    , nombre: item.find("td").eq(0).text()
	    , telefono: item.find("td").eq(1).text()
	    , correo: item.find("td").eq(2).text()	    
	    , login: item.find("td").eq(3).text()
	    , estado: item.find("td").eq(4).text()
	    , password_save: false
	    , save: 'EDITAR'
	}
	$(prefixSubId+'vendedor_id').val(enviar.vendedor_id);
	$(prefixSubId+'nombre').val(enviar.nombre);
	$(prefixSubId+'telefono').val(enviar.telefono);
	$(prefixSubId+'correo').val(enviar.correo);
	$(prefixSubId+'login').val(enviar.login);
	$(prefixSubId+'password_save').prop('checked',enviar.password_save);
	if (enviar.estado=='Activo') {
	    $(prefixSubId+'estado').prop('checked', true);	    
	} else if (enviar.estado=='Desactivo') {
	    $(prefixSubId+'estado').prop('checked', false);
	}
	$(prefixSubId+'save').html(enviar.save);
	$(prefixSubId+'tabla tbody tr.item').removeClass('edit_item');
	$(prefixSubId+'tabla tbody tr.item.item_'+enviar.vendedor_id).addClass('edit_item');
    }
    function ve_propuesta_vendedor_modal_field_save() {
	var prefixSubId = '#ve_propuesta_vendedor_modal_field_';
	var prefixSubClass = '.ve_propuesta_vendedor_modal_field_';
	var enviar = {
	    vendedor_id: $(prefixSubId+'vendedor_id').val()
	    , vendedor_rol_id: $(prefixSubId+'vendedor_rol_id').val()
	    , nombre: $(prefixSubId+'nombre').val()
	    , telefono: $(prefixSubId+'telefono').val()
	    , correo: $(prefixSubId+'correo').val()
	    , login: $(prefixSubId+'login').val()
	    , estado: $(prefixSubId+'estado').prop('checked')
	    , password: $(prefixSubId+'password').val()
	    , password_save: $(prefixSubId+'password_save').prop('checked')
	}
	if ( enviar.vendedor_id.trim() != '' &&
	    enviar.login.trim() != '' )
	{
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/button/vendedor_modals_button.php",
		success: function(data) {
	    	    if ( enviar.vendedor_id== 0 ) {
			if ( data == 'LoginExistente' ) {
			    alert( 'Cambie de login, ya esta siendo usado' );
			} else {
	    	    	    $( prefixSubId+'tabla tbody' ).append( data );
			    ve_propuesta_vendedor_modal_field_cancel();
			}
	    	    } else {
			if ( data == 'LoginExistente' ) {
			    alert( 'Cambie de login, ya esta siendo usado' );
			} else {
			    $( prefixSubId+'tabla tbody tr.item.item_'+enviar.vendedor_id ).html( data );
			    ve_propuesta_vendedor_modal_field_cancel();
			}	    	    	
	    	    }
		    if (enviar.vendedor_rol_id!='2') {
			var cc = $('#ve_propuesta_field_codigo').val();
			if (cc!='0') {
			    location.href="editar.php?codigo="+cc;
			}
			
		    }
		}
	    });
	} else {
	    alert('Puede Faltar el Nombre o el Login');
	}	
    }
    // ------------------------ juridico
    function ve_propuesta_field_persona_juridico_link() {
	var tabla = $('#ve_propuesta_juridico_modal_field_tabla');
	var enviar = {}
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/tables/juridico_modal_table.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
	ve_propuesta_juridico_modal_field_clasificacion();
	ve_propuesta_juridico_modal_field_actividad();
	ve_propuesta_juridico_modal_field_grupo();
	ve_propuesta_juridico_modal_field_persona_estado();
	ve_propuesta_juridico_modal_field_referido();
	ve_propuesta_juridico_modal_field_importante();
	var rol_id = $('#ve_propuesta_field_vendedor_rol_id').val();
	if ( rol_id == 2 ) {
	    ve_propuesta_juridico_modal_field_vendedor();
	    $('.ve_propuesta_juridico_modal_field_user').show();
	} else {
	    $('.ve_propuesta_juridico_modal_field_user').hide();
	}
    }
    function ve_propuesta_juridico_modal_field_edit( item ) {
	var prefix = '#ve_propuesta_juridico_modal_field_';
	var datos = {
	    id: $(item).attr('codigo')
	    , razon: $(item).find("td").eq(0).find("span").eq(0).text()
	    , clasificacion_id: $(item).find("td").eq(0).attr('clasificacion_id')
	    , actividad_id: $(item).find("td").eq(0).attr('actividad_id')
	    , grupo_id: $(item).find("td").eq(0).attr('grupo_id')
	    , ruc: $(item).find("td").eq(0).find("span").eq(1).text()
	    , direccion: $(item).find("td").eq(1).text()
	    , telefono: $(item).find("td").eq(0).find("span").eq(2).text()
	    , status: $(item).find("td").eq(0).attr('estado')
	    , vendedor: $(item).find("td").eq(3).attr('vendedor_id')
	    , persona_estado: $(item).find("td").eq(4).attr('persona_estado_id')
    	    , observacion: $(item).find("td").eq(2).text()
	    , importante_id: $(item).find("td").eq(0).attr('importante')
	    , referido: $(item).find("td").eq(0).attr('referido')
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'razon').val( datos.razon );
	$(prefix + 'ruc').val( datos.ruc );
	$(prefix + 'telefono').val( datos.telefono );
	$(prefix + 'direccion').val( datos.direccion );
	$(prefix + 'clasificacion').val( datos.clasificacion_id ).trigger('chosen:updated');
	$(prefix + 'actividad').val( datos.actividad_id ).trigger('chosen:updated');
	$(prefix + 'grupo').val( datos.grupo_id ).trigger('chosen:updated');
	if (datos.status=='1') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='0') {
	    $(prefix + 'status').prop('checked', false);
	}	
	$(prefix + 'vendedor').val( datos.vendedor ).trigger('chosen:updated');	
	$(prefix + 'persona_estado').val( datos.persona_estado ).trigger('chosen:updated');	
	$(prefix + 'observacion').val( datos.observacion );
	$(prefix + 'importante').val( datos.importante_id ).trigger('chosen:updated');	
	$(prefix + 'referido').val( datos.referido ).trigger('chosen:updated');
	$(prefix + 'save').text( 'EDITAR' );	
	$('#lista_juridico_ajax tr').removeClass('edit_item');
	$(item).addClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_cancel() {
	var prefix = '#ve_propuesta_juridico_modal_field_';
	var datos = {
	    id: '0'
	    , razon: ''
	    , clasificacion_id: '0'
	    , actividad_id: '0'
	    , grupo_id: '0'
	    , ruc: ''
	    , direccion: ''
	    , telefono: ''
	    , status: '1'
	    , vendedor: '0'
	    , persona_estado: '1'
    	    , observacion: ''
	    , importante_id: '1'
	    , referido: '0'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'razon').val( datos.razon );
	$(prefix + 'ruc').val( datos.ruc );
	$(prefix + 'telefono').val( datos.telefono );
	$(prefix + 'direccion').val( datos.direccion );
	$(prefix + 'clasificacion').val( datos.clasificacion_id ).trigger('chosen:updated');
	$(prefix + 'actividad').val( datos.actividad_id ).trigger('chosen:updated');
	$(prefix + 'grupo').val( datos.grupo_id ).trigger('chosen:updated');
	if (datos.status=='1') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='0') {
	    $(prefix + 'status').prop('checked', false);
	}	
	$(prefix + 'vendedor').val( datos.vendedor ).trigger('chosen:updated');	
	$(prefix + 'persona_estado').val( datos.persona_estado ).trigger('chosen:updated');	
	$(prefix + 'observacion').val( datos.observacion );
	$(prefix + 'importante').val( datos.importante_id ).trigger('chosen:updated');
	$(prefix + 'referido').val( datos.referido ).trigger('chosen:updated');	

	$('#lista_juridico_ajax tr').removeClass('edit_item');
	$(prefix + 'save').text( 'AÑADIR' );
    }
    function ve_propuesta_juridico_modal_field_save() {
	var prefix = '#ve_propuesta_juridico_modal_field_';
	var enviar = {
            id: $(prefix + 'id').val()
	    , razon: $(prefix + 'razon').val()
	    , ruc: $(prefix + 'ruc').val()
	    , telefono: $(prefix + 'telefono').val()
	    , direccion: $(prefix + 'direccion').val()
	    , clasificacion_id: $(prefix + 'clasificacion').val()
	    , actividad_id: $(prefix + 'actividad').val()
	    , grupo_id: $(prefix + 'grupo').val()
	    , status: $(prefix + 'status').is(':checked')
	    , vendedor: $(prefix + 'vendedor').val()
	    , persona_estado: $(prefix + 'persona_estado').val()
    	    , observacion: $(prefix + 'observacion').val()
	    , importante_id: $(prefix + 'importante').val()
	    , referido: $(prefix + 'referido').val()
	}
	// c(enviar);
	if ( enviar.razon.trim() != '' &&
	     enviar.ruc.trim() != '' &&
	     enviar.clasificacion_id != '' &&
	     enviar.actividad_id != '' &&
	     enviar.persona_estado != ''
	   ) 
	{
	    $.ajax({
	    	type: "POST",
	    	data: enviar, 
	    	url: "./ajax/button/juridico_save_modal_button.php",
	    	success: function(data) {
		    // c(data);
		    if (data.trim()=='Ya Existe Ruc') {
			alert(data.trim());
		    } else {
	    		if ( enviar.id=='0' ) {
	    	    	    // data = '<tr><td colspan="6">' + data + '</td></tr>'; // para pruebas
	    	    	    $( '#lista_juridico_ajax tbody' ).append( data );
	    		} else {
	    	    	    // data = '<td colspan="6">' + data + '</td>'; // para pruebas
	    	    	    $( '#lista_juridico_ajax tbody .item_' + enviar.id ).html( data );
	    		}
	    		ve_propuesta_juridico_modal_field_cancel();			
		    }
	    	}
	    });
	    
	} else 
	{

	    if (enviar.razon.trim() == '')
	    { alert('El campo "Razon" es obligatorio'); }
	    else {
		if (enviar.ruc.trim() == '') { alert('El campo "Ruc" es obligatorio'); }
		else {
		    if (enviar.clasificacion_id.trim() == '') { alert('El campo "Clasificación" es obligatorio'); }
		    else {
			if (enviar.actividad_id.trim() == '') { alert('El campo "Actividad" es obligatorio'); }
			else {			    
			    if (enviar.persona_estado.trim() == '') { alert('El campo "Estado" es obligatorio'); }
			}
		    }
		}
	    }
	}
    }
    // --- combos
    function ve_propuesta_juridico_modal_field_clasificacion() {
	var clasificacion = $('#ve_propuesta_juridico_modal_field_clasificacion');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_juridico_clasificacion_combo_modal.php",
	    success: function(data) {
		clasificacion.html(data);
		clasificacion.trigger('chosen:updated');
	    }
	});
    }
    function ve_propuesta_juridico_modal_field_actividad() {
	var actividad = $('#ve_propuesta_juridico_modal_field_actividad');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_juridico_actividad_combo_modal.php",
	    success: function(data) {
		actividad.html(data);
		actividad.trigger('chosen:updated');
	    }
	});
    }
    function ve_propuesta_juridico_modal_field_grupo() {
	var grupo = $('#ve_propuesta_juridico_modal_field_grupo');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_juridico_grupo_combo_modal.php",
	    success: function(data) {
		grupo.html(data);
		grupo.trigger('chosen:updated');
	    }
	});
    }
    function ve_propuesta_juridico_modal_field_persona_estado() {
	var prefixSubId = '#ve_propuesta_juridico_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'persona_estado').val()
	}
	select_simple( './ajax/select/persona_estado_select.php', prefixSubId+'persona_estado', enviar );
    }
    function ve_propuesta_juridico_modal_field_vendedor() {
	var prefixSubId = '#ve_propuesta_juridico_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'vendedor').val()
	    , coordinador_id: $('#ve_propuesta_field_vendedor_id').val()
	}	
	select_simple( './ajax/select/vendedor_por_coordinador_select.php', prefixSubId+'vendedor', enviar );
    }
    function ve_propuesta_juridico_modal_field_referido() {
	var prefixSubId = '#ve_propuesta_juridico_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'referido').val()
	}	
	select_simple( './ajax/select/referido_select.php', prefixSubId+'referido', enviar );
    }
    function ve_propuesta_juridico_modal_field_importante() {
	var prefixSubId = '#ve_propuesta_juridico_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'importante').val()
	}	
	select_simple( './ajax/select/importante_select.php', prefixSubId+'importante', enviar );
    }
    // --- tablas
    function ve_propuesta_juridico_modal_field_clasificacion_tab_tabla() {
	var tabla = $('#ve_propuesta_juridico_modal_field_clasificacion_tab_tabla');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_juridico_clasificacion_tabla_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});	
    }
    function ve_propuesta_juridico_modal_field_grupo_tab_tabla() {
	var tabla = $('#ve_propuesta_juridico_modal_field_grupo_tab_tabla');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_juridico_grupo_tabla_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});	
    }
    function ve_propuesta_juridico_modal_field_actividad_tab_tabla() {
	var tabla = $('#ve_propuesta_juridico_modal_field_actividad_tab_tabla');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_juridico_actividad_tabla_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    // clasificacion
    function ve_propuesta_juridico_modal_field_clasificacion_tab_edit( item ) {
	var prefix = '#ve_propuesta_juridico_modal_field_clasificacion_tab_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'EDITAR'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	// propio 
	$('#involucrados-juridico-clasificacion-table-ajax tr').removeClass('edit_item');
	$('#involucrados-juridico-clasificacion-table-ajax tr.item_'+datos.id).addClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_clasificacion_tab_cancel() {
	var prefix = '#ve_propuesta_juridico_modal_field_clasificacion_tab_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'AÑADIR'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	// propio 
	$('#involucrados-juridico-clasificacion-table-ajax tr').removeClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_clasificacion_tab_save() {
	var prefix = '#ve_propuesta_juridico_modal_field_clasificacion_tab_';
	var enviar = {
	    id: $(prefix + 'id').val( )
	    , nombre: $(prefix + 'nombre').val( )
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "../cotizacion/ajax/modal/involucrado_juridico/save_juridico_clasificacion_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-clasificacion-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-clasificacion-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    ve_propuesta_juridico_modal_field_clasificacion_tab_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('FALTA LLENAR INFORMACIÓN');
	}

    }
    // actividad
    function ve_propuesta_juridico_modal_field_actividad_tab_edit( item ) {
	var prefix = '#ve_propuesta_juridico_modal_field_actividad_tab_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'EDITAR'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	// propio 
	$('#involucrados-juridico-actividad-table-ajax tr').removeClass('edit_item');
	$('#involucrados-juridico-actividad-table-ajax tr.item_'+datos.id).addClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_actividad_tab_cancel() {
	var prefix = '#ve_propuesta_juridico_modal_field_actividad_tab_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'AÑADIR'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	// propio 
	$('#involucrados-juridico-actividad-table-ajax tr').removeClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_actividad_tab_save() {
	var prefix = '#ve_propuesta_juridico_modal_field_actividad_tab_';
	var enviar = {
	    id: $(prefix + 'id').val( )
	    , nombre: $(prefix + 'nombre').val( )
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "../cotizacion/ajax/modal/involucrado_juridico/save_juridico_actividad_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-actividad-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-actividad-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    ve_propuesta_juridico_modal_field_actividad_tab_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('FALTA LLENAR INFORMACIÓN');
	}

    }
    // grupo
    function ve_propuesta_juridico_modal_field_grupo_tab_edit( item ) {
	var prefix = '#ve_propuesta_juridico_modal_field_grupo_tab_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'EDITAR'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	// propio 
	$('#involucrados-juridico-grupo-table-ajax tr').removeClass('edit_item');
	$('#involucrados-juridico-grupo-table-ajax tr.item_'+datos.id).addClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_grupo_tab_cancel() {
	var prefix = '#ve_propuesta_juridico_modal_field_grupo_tab_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'AÑADIR'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	// propio 
	$('#involucrados-juridico-grupo-table-ajax tr').removeClass('edit_item');
    }
    function ve_propuesta_juridico_modal_field_grupo_tab_save() {
	var prefix = '#ve_propuesta_juridico_modal_field_grupo_tab_';
	var enviar = {
	    id: $(prefix + 'id').val( )
	    , nombre: $(prefix + 'nombre').val( )
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "../cotizacion/ajax/modal/involucrado_juridico/save_juridico_grupo_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-grupo-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-grupo-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    ve_propuesta_juridico_modal_field_grupo_tab_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('FALTA LLENAR INFORMACIÓN');
	}

    }
    // ------------------------ natural
    function ve_propuesta_field_persona_natural_link() {
	var table = $('#tabla_involucrado_natural');
	var enviar = {
	}
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/tables/natural_modal_table.php",
	    success: function(data) {
		table.html(data);
	    }
	});
	var combo = $('#ve_propuesta_natural_modal_field_documento_tipo');
	$.ajax({
	    type: "POST",
	    url: "../cotizacion/ajax/modal/involucrado_natural_combo_modal.php",
	    success: function(data) {
		combo.html(data).trigger('chosen:updated');
	    }
	});
	ve_propuesta_natural_modal_field_persona_estado();
	var rol_id = $('#ve_propuesta_field_vendedor_rol_id').val();
	if ( rol_id == 2 ) {
	    ve_propuesta_natural_modal_field_vendedor();
	    $('.ve_propuesta_natural_modal_field_user').show();
	} else {
	    $('.ve_propuesta_natural_modal_field_user').hide();
	}
	ve_propuesta_natural_modal_field_referido();
	ve_propuesta_natural_modal_field_importante();
    }
    function ve_propuesta_natural_modal_field_cancel() {
	var prefix = '#ve_propuesta_natural_modal_field_';

	var datos = {
	    id: '0'
	    , nombre: ''
	    , documento_tipo_id: '1'
	    , documento_numero: ''
	    , direccion: ''
	    , telefono: ''
	    , correo: ''
	    , activo: '1'
	    , vendedor: '0'
	    , persona_estado: '1'
    	    , observacion: ''
	    , importante_id: '1'
	    , referido: '0'
	}
	// c( datos );
	
	$(prefix+'id').val(datos.id);
	$(prefix+'nombre').val(datos.nombre);
	$(prefix+'documento_tipo').val(datos.documento_tipo_id).trigger('chosen:updated');
	$(prefix+'documento_numero').val(datos.documento_numero);
	$(prefix+'direccion').val(datos.direccion);
	$(prefix+'telefono').val(datos.telefono);
	$(prefix+'correo').val(datos.correo);
	if (datos.activo=='1') {
	    $(prefix+'activo').prop('checked', true);
	} else if (datos.activo=='0') {
	    $(prefix+'activo').prop('checked', false);
	}
	$(prefix + 'vendedor').val( datos.vendedor ).trigger('chosen:updated');	
	$(prefix + 'persona_estado').val( datos.persona_estado ).trigger('chosen:updated');
	$(prefix + 'observacion').val( datos.observacion );
	$(prefix + 'importante').val( datos.importante_id ).trigger('chosen:updated');
	$(prefix + 'referido').val( datos.referido ).trigger('chosen:updated');	

	$('#lista_natural_ajax tr').removeClass('edit_item');
	$(prefix+'save').text( 'AÑADIR' );		
    }
    function ve_propuesta_natural_modal_field_edit(item) {
	var prefix = '#ve_propuesta_natural_modal_field_';
	var datos = {
	    id: $(item).attr('codigo')
	    , nombre: $(item).parent().parent().find("td").eq(0).find("span").eq(0).text()
	    , documento_tipo_id: $(item).parent().parent().find("td").eq(0).attr('documento_tipo_id')
	    , documento_numero: $(item).parent().parent().find("td").eq(0).find("span").eq(1).text()
	    , direccion: $(item).parent().parent().find("td").eq(1).text()
	    , telefono: $(item).parent().parent().find("td").eq(0).find("span").eq(2).text()
	    , correo: $(item).parent().parent().find("td").eq(0).find("span").eq(3).text()
	    , activo: $(item).parent().parent().find("td").eq(0).attr('estado')
	    , vendedor: $(item).parent().parent().find("td").eq(3).attr('vendedor_id')
	    , persona_estado: $(item).parent().parent().find("td").eq(4).attr('persona_estado_id')
    	    , observacion: $(item).parent().parent().find("td").eq(2).text()
	    , importante_id: $(item).parent().parent().find("td").eq(0).attr('importante')
	    , referido: $(item).parent().parent().find("td").eq(0).attr('referido')	    
	}
	// c( datos );
	
	$(prefix+'id').val(datos.id);
	$(prefix+'nombre').val(datos.nombre);
	$(prefix+'documento_tipo').val(datos.documento_tipo_id).trigger('chosen:updated');
	$(prefix+'documento_numero').val(datos.documento_numero);
	$(prefix+'direccion').val(datos.direccion);
	$(prefix+'telefono').val(datos.telefono);
	$(prefix+'correo').val(datos.correo);
	if (datos.activo=='1') {
	    $(prefix+'activo').prop('checked', true);
	} else if (datos.activo=='0') {
	    $(prefix+'activo').prop('checked', false);
	}
	$(prefix + 'vendedor').val( datos.vendedor ).trigger('chosen:updated');	
	$(prefix + 'persona_estado').val( datos.persona_estado ).trigger('chosen:updated');
	$(prefix + 'observacion').val( datos.observacion );
	$(prefix + 'importante').val( datos.importante_id ).trigger('chosen:updated');
	$(prefix + 'referido').val( datos.referido ).trigger('chosen:updated');	
	$(prefix+'save').text( 'EDITAR' );
	$('#lista_natural_ajax tr').removeClass('edit_item');
	$(item).parent().parent().addClass('edit_item');
    }
    function ve_propuesta_natural_modal_field_save() {
	var prefix = '#ve_propuesta_natural_modal_field_';
	var enviar = {
              id: $(prefix+'id').val()
	    , nombre: $(prefix+'nombre').val()
	    , documento_tipo: $(prefix+'documento_tipo').val()
	    , documento_numero: $(prefix+'documento_numero').val()
	    , direccion: $(prefix+'direccion').val()
	    , telefono: $(prefix+'telefono').val()
	    , correo: $(prefix+'correo').val()
	    , status: $(prefix+'activo').is(':checked')
	    , vendedor: $(prefix + 'vendedor').val()
	    , persona_estado: $(prefix + 'persona_estado').val()
    	    , observacion: $(prefix + 'observacion').val()
	    , importante_id: $(prefix + 'importante').val()
	    , referido: $(prefix + 'referido').val()
	}	
	if ( enviar.nombre.trim() != '' 
	     && enviar.documento_numero.trim() != ''
	     && enviar.persona_estado != ''
	   )
	{
	    $.ajax({
	    	type: "POST",
	    	data: enviar, 
	    	url: "./ajax/button/natural_save_modal_button.php",
	    	success: function(data) {
		    // c(data);
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td colspan="6">' + data + '</td></tr>'; // para pruebas
	    	    	$( '#lista_natural_ajax tbody' ).append( data );
	    	    } else {
			// data = '<td colspan="6">' + data + '</td>'; // para pruebas
	    	    	$( '.lista_natural_ajax_item.item_' + enviar.id ).html( data );
	    	    }
                    persona_natural_id();
	            persona_natural_info();
	            ve_propuesta_natural_modal_field_cancel();
	    	}
	    });
	} else {
	    if (enviar.nombre.trim() == '')
	    { alert('EL CAMPO "NOMBRE" ES OBLIGATORIO'); }
	    else {
		if (enviar.documento_numero.trim() == '')
		{ alert('EL CAMPO "NÚMERO DE DOCUMENTO" ES OBLIGATORIO'); }
		else {
		    if (enviar.persona_estado.trim() == '')
		    { alert('EL CAMPO "ESTADO" ES OBLIGATORIO'); }
		}
	    }
	}
    }
    // combos
    function ve_propuesta_natural_modal_field_persona_estado() {
	var prefixSubId = '#ve_propuesta_natural_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'persona_estado').val()
	}
	select_simple( './ajax/select/persona_estado_select.php', prefixSubId+'persona_estado', enviar );
    }
    function ve_propuesta_natural_modal_field_vendedor() {
	var prefixSubId = '#ve_propuesta_natural_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'vendedor').val()
	    , coordinador_id: $('#ve_propuesta_field_vendedor_id').val()
	}
	select_simple( './ajax/select/vendedor_por_coordinador_select.php', prefixSubId+'vendedor', enviar );
    }
    function ve_propuesta_natural_modal_field_referido() {
	var prefixSubId = '#ve_propuesta_natural_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'referido').val()
	}	
	select_simple( './ajax/select/referido_select.php', prefixSubId+'referido', enviar );
    }
    function ve_propuesta_natural_modal_field_importante() {
	var prefixSubId = '#ve_propuesta_natural_modal_field_';
	var enviar = {
	    id: $(prefixSubId+'importante').val()
	}	
	select_simple( './ajax/select/importante_select.php', prefixSubId+'importante', enviar );
    }
    // ------------------------ contacto
    function ve_propuesta_field_persona_contacto_link(tipo) {
	var prefixSubId    = '#ve_propuesta_contacto_modal_field_';
	var prefixSubClass = '.ve_propuesta_contacto_modal_field_';

	if (tipo == 'juridica') {
	    var parent_id = $(prefixId+'persona_juridico_id').val();
	    var msg = 'Selecciona Una Persona Juridica';
	} else if (tipo == 'natural') {
	    var parent_id = $(prefixId+'persona_natural_id').val();
	    var msg = 'Selecciona Una Persona Natural';
	}
	var enviar = {
	    parent_id: parent_id
	    , tipo: tipo
	}
	if (enviar.parent_id!='') {
	    // falta filtrar el cliente
	    $.ajax({
		type: "POST",
		data: enviar,
		url: './ajax/tables/contacto_modal_table.php',
		success: function(data) {
		    if ( data.trim() == 'Sin Permiso' ) {
			$(prefixSubId+'my_mensage').html( data.trim() );
			$(prefixSubId+'my_mensage').show();
			$(prefixSubId+'my_form').hide();
		    } else {
			$(prefixSubId+'my_mensage').hide();
			$(prefixSubId+'my_form').show();
			$(prefixSubId+'parent_id').val(enviar.parent_id);
			$(prefixSubId+'tipo').val(enviar.tipo);
			$(prefixSubId+'tabla').html(data);
		    }
		}
	    });	    
	} else {
	    $(prefixSubId+'my_mensage').html( msg );
	    $(prefixSubId+'my_mensage').show();
	    $(prefixSubId+'my_form').hide();

	}
	// c(enviar);
    }
    function ve_propuesta_contacto_modal_field_cancel() {
	var prefixSubId    = '#ve_propuesta_contacto_modal_field_';
	var prefixSubClass = '.ve_propuesta_contacto_modal_field_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , cargo: ''
	    , telefono: ''
	    , correo: ''
	}
        $(prefixSubId + 'id').val( datos.id );
	$(prefixSubId + 'nombre').val( datos.nombre );
	$(prefixSubId + 'cargo').val( datos.cargo );
	$(prefixSubId + 'telefono').val( datos.telefono );
	$(prefixSubId + 'correo').val( datos.correo );
	$(prefixSubId + 'status').prop('checked', true);
	$('#lista_contacto_ajax tr').removeClass('edit_item');
	$(prefixSubId + 'save').text( 'AÑADIR' );
    }
    function ve_propuesta_contacto_modal_field_edit(item) {
	var prefixSubId    = '#ve_propuesta_contacto_modal_field_';
	var prefixSubClass = '.ve_propuesta_contacto_modal_field_';
	var datos = {
	    id: $(item).attr('codigo')
	    , persona_id: $(item).attr('persona_id')
	    , nombre: $(item).find("td").eq(0).text()
	    , cargo: $(item).find("td").eq(1).text()
	    , telefono: $(item).find("td").eq(2).text()
	    , correo: $(item).find("td").eq(3).text()
	    , status: $(item).find("td").eq(4).text()
	}
	// c(datos);
        $(prefixSubId + 'id').val( datos.id );
        $(prefixSubId + 'persona_id').val( datos.persona_id );
	$(prefixSubId + 'nombre').val( datos.nombre );
	$(prefixSubId + 'cargo').val( datos.cargo );
	$(prefixSubId + 'telefono').val( datos.telefono );
	$(prefixSubId + 'correo').val( datos.correo );
	if (datos.status=='Activo') {
	    $(prefixSubId + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixSubId + 'status').prop('checked', false);
	}
	$('#lista_contacto_ajax tr').removeClass('edit_item');
	$(item).addClass('edit_item');
	$(prefixSubId + 'save').text( 'EDITAR' );	
    }
    function ve_propuesta_contacto_modal_field_delete(item){
	var prefixSubId    = '#ve_propuesta_contacto_modal_field_';
	var prefixSubClass = '.ve_propuesta_contacto_modal_field_';
	
	var enviar = {
	    contacto_id: item.attr('codigo')
	}
	delete_simple( './ajax/delete/contacto_delete.php'
		       , prefixSubId+'tabla .item_'+enviar.contacto_id
		       ,enviar );
    }
    function ve_propuesta_contacto_modal_field_save() {
	var prefixSubId    = '#ve_propuesta_contacto_modal_field_';
	var prefixSubClass = '.ve_propuesta_contacto_modal_field_';
	var enviar = {
	    id: $(prefixSubId + 'id').val()
	    , persona_id: $(prefixSubId + 'parent_id').val()
	    , persona_tipo: $(prefixSubId + 'tipo').val()
	    , nombre: $(prefixSubId + 'nombre').val()
	    , cargo: $(prefixSubId + 'cargo').val()
	    , telefono: $(prefixSubId + 'telefono').val()
	    , correo: $(prefixSubId + 'correo').val()
	    , status: $(prefixSubId + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != '')
	{
	    $.ajax({
	    	type: "POST",
	    	data: enviar, 
	    	url: "./ajax/button/contacto_save_modal_button.php",
	    	success: function(data) {
	    	    if ( enviar.id=='0' ) {
	    		// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#lista_contacto_ajax tbody' ).append( data );
	    	    } else {
	    		// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#lista_contacto_ajax tbody .item_' + enviar.id ).html( data );
	    	    }			
		    ve_propuesta_contacto_modal_field_cancel(); // comentado para prueba
	    	}
	    });   
	}
	// c(enviar);
    }
    // ----------------------------- tipo de servicio
    function ve_propuesta_field_servicio_tipo_link() {
	var prefixSubId    = '#ve_propuesta_servicio_tipo_modal_field_';
	var prefixSubClass = '.ve_propuesta_servicio_tipo_modal_field_';
	var enviar = {
	    propuesta_id: $(prefixId+'id').val()
	    , vendedor_id: $(prefixId+'vendedor_id').val()
	}
	element_simple( './ajax/tree/servicio_tipo_modal_tree.php', prefixSubId+'tabla', enviar );
    }
    function ve_propuesta_servicio_tipo_modal_field_tabla_a( item ) {
	var prefixSubId    = '#ve_propuesta_servicio_tipo_modal_field_';
	var prefixSubClass = '.ve_propuesta_servicio_tipo_modal_field_';

	var display = $( '#servicio_tipo_list_'+item.attr('my_id') ).css('display');
	
	if ( display == 'none' ) {
	    $( '#servicio_tipo_list_'+item.attr('my_id') ).show();	    
	} else if ( display == 'block' ) {
	    $( '#servicio_tipo_list_'+item.attr('my_id') ).hide();

	}
    }
    function ve_propuesta_servicio_tipo_modal_field_tabla_check( item ) {
	var enviar = {
	    estado: item.is(':checked')
	    , servicio_tipo_id: item.attr('my_id')
	    , propuesta_id: $(prefixId+'id').val()
	}
	process_simple( './ajax/checkbox/servicio_tipo_modal_checkbox.php', enviar );
    }

    // ----------------------------------------------------------------------- reutilizables
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
