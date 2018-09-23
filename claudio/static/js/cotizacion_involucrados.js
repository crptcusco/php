$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var dataTable_juridico = '';
    var dataTable_natural = '';
    // --------------------------------------------------------------- load
    cargar_tabla_involucrado();
    combo_involucrados_juridico_razon_social();
    combo_involucrados_natural_nombre();
    combo_involucrados_vendedor ();
    // --------------------------------------------------------------- eventos
    $("body").on("change", ".co_involucrados_tipo", function(e) {
	var tipo_persona = $(this).val();
	pestana_involucrados_tipo_persona( tipo_persona );
    });
    $("#co_involucrados_tabla .ajax").on("click", " .edit", function(e) {
	co_involucrados_edit( $(this) );
	e.preventDefault();
    });
    $("#co_involucrados_tabla .ajax").on("click", ".delete", function(e) {
	co_involucrados_delete( $(this) );
	e.preventDefault();
    });
    // ----------- juridico
    $("body").on('change', "#co_involucrados_juridico_razon_social", function() {
	combo_involucrados_juridico_contacto();
	combo_involucrados_juridico_contacto_datos_clear();
    });
    $("body").on("click", "#co_involucrados_juridico_cancel", function(e) {
	co_involucrados_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_involucrados_juridico_save", function(e) {
	co_involucrados_juridico_save();
	e.preventDefault();
    });    
    // --- modal
    $("body").on("click", "#link_modal_co_involucrado_juridico", function(e) {
	modal_co_involucrado_juridico();
	e.preventDefault();
    });
    $('#modal_co_involucrado_juridico_field_tabla .search-input-text').on('keyup click', function (event) {
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
    $('#modal_co_involucrado_juridico_field_tabla .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_juridico.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });
    
    $("#modal_co_involucrado_juridico_field_tabla").on("click", ".editar", function(e) {
	modal_co_involucrado_juridico_edit( $(this) );
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_cancel", function(e) {
	modal_co_involucrado_juridico_cancel( );
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_save", function(e) {
	modal_co_involucrado_juridico_save();       
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#modal_co_involucrado_juridico[data-reveal]', function () {
    });
    // tabs
    $("body").on("click", "#modal_co_involucrado_juridico_field_tabs-link-1", function(e) {
        $('#modal_co_involucrado_juridico_field_tabla_wrapper').hide();
	modal_co_involucrado_juridico_field_clasificacion_tab_tabla();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_tabs-link-2", function(e) {
        $('#modal_co_involucrado_juridico_field_tabla_wrapper').hide();
	modal_co_involucrado_juridico_field_grupo_tab_tabla();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_tabs-link-3", function(e) {
        $('#modal_co_involucrado_juridico_field_tabla_wrapper').hide();
	modal_co_involucrado_juridico_field_actividad_tab_tabla();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_tabs-link-4", function(e) {
        $('#modal_co_involucrado_juridico_field_tabla_wrapper').show();
	modal_co_involucrado_juridico_field_clasificacion();
	modal_co_involucrado_juridico_field_actividad();
	modal_co_involucrado_juridico_field_grupo();
    });
    // clasificacion
    $("body").on("click", "#involucrados-juridico-clasificacion-table-ajax .edit", function(e) {
	modal_co_involucrado_juridico_field_clasificacion_tab_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_clasificacion_tab_cancel", function(e) {
	modal_co_involucrado_juridico_field_clasificacion_tab_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_clasificacion_tab_save", function(e) {
	modal_co_involucrado_juridico_field_clasificacion_tab_save();
	e.preventDefault();
    });
    // actividad
    $("body").on("click", "#involucrados-juridico-actividad-table-ajax .edit", function(e) {
	modal_co_involucrado_juridico_field_actividad_tab_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_actividad_tab_cancel", function(e) {
	modal_co_involucrado_juridico_field_actividad_tab_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_actividad_tab_save", function(e) {
	modal_co_involucrado_juridico_field_actividad_tab_save();
	e.preventDefault();
    });
    // grupo
    $("body").on("click", "#involucrados-juridico-grupo-table-ajax .edit", function(e) {

	modal_co_involucrado_juridico_field_grupo_tab_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_grupo_tab_cancel", function(e) {
	modal_co_involucrado_juridico_field_grupo_tab_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_field_grupo_tab_save", function(e) {
	modal_co_involucrado_juridico_field_grupo_tab_save();
	e.preventDefault();
    });

    // ----------- juridico contacto
    $("body").on('change', "#co_involucrados_juridico_contacto", function() {
	combo_involucrados_juridico_contacto_datos();	
    });
    // modal
    $("body").on("click", "#link_modal_co_involucrado_juridico_contacto", function(e) {
	modal_co_involucrado_juridico_contacto();
	//a('aqui');
	e.preventDefault();
    });
    $("body").on("click", "#involucrados-juridico-contacto-table-ajax .edit", function(e) {
	modal_co_involucrado_juridico_contacto_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_contacto_field_cancel", function(e) {
	modal_co_involucrado_juridico_contacto_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_juridico_contacto_field_save", function(e) {
	modal_co_involucrado_juridico_contacto_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#modal_co_involucrado_juridico_contacto[data-reveal]', function () {
    });

    // ----------- natural
    $("body").on('change', "#co_involucrados_natural_nombre", function() {
	combo_involucrados_natural_datos();
    });
    $('#tabla_involucrado_natural .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            dataTable_natural.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $('#tabla_involucrado_natural .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_natural.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });
    $("body").on("click", "#co_involucrados_natural_cancel", function(e) {
	co_involucrados_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_involucrados_natural_save", function(e) {
	co_involucrados_natural_save();
	e.preventDefault();
    }); 
    // --- modal
    $("body").on("click", "#link_modal_co_involucrado_natural", function(e) {
	modal_co_involucrado_natural();
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_natural_save", function(e) {
	modal_co_involucrado_natural_save();
	e.preventDefault();
    });
    $("body").on("click", "#modal_co_involucrado_natural_cancel", function(e) {
	modal_co_involucrado_natural_cancel();
	e.preventDefault();
    });
    $("#modal_co_involucrado_natural").on("click", ".editar", function(e) {
	modal_co_involucrado_natural_edit( $(this) );
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#modal_co_involucrado_natural[data-reveal]', function () {
    });

    // ----------- vendedor
    // ---- modal
    $("body").on("click", "#link_modal_co_vendedor", function(e) {
	// modal_involucrados_vendedor ();
    	e.preventDefault();
    });
    $("#modal_co_vendedor").on("click", ".editar", function(e) {
	// var item = $(this);
	// involucrados_vendedor_edit(item);
     	e.preventDefault();
    });
    $("#modal_co_vendedor").on("click", "#modal_co_vendedor_cancel", function(e) {
	// involucrados_vendedor_clear();
     	e.preventDefault();
    });
    $("#modal_co_vendedor").on("click", "#modal_co_vendedor_save", function(e) {
	// involucrados_vendedor_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#modal_co_vendedor[data-reveal]', function () {
	// combo_involucrados_vendedor ();
    });
    // ----------------------------------------------------------------------- funciones   
    function cargar_tabla_involucrado() {
	var tbody = $('#co_involucrados_tabla .ajax');
	$.ajax({
	    type: "POST",
	    data: "cid="+ $('#co_id').val(), 
	    url: "./ajax/tables/involucrados-tables.php",
	    success: function(data) {
		tbody.html( data );
	    }
	});	
    }
    function pestana_involucrados_tipo_persona( tipo_persona ) {
	if ( tipo_persona == 'juridico') {
	    $("#co_involucrados_juridico").show();
	    $("#co_involucrados_natural").hide();
	}
	if ( tipo_persona == 'natural') {
	    $("#co_involucrados_juridico").hide();
	    $("#co_involucrados_natural").show();	    
	}
    }
    function co_involucrados_cancel() {
	var datos = {
	    id: 0
	    , persona_id: 0
	    , contacto_id: 0	    
	    , save: 'Añadir'
	}
	$('#co_involucrados_rol_cliente')
	    .prop('checked', false)
	    .removeAttr('disabled');
	$('#co_involucrados_rol_solicitante')
	    .prop('checked', false)
	    .removeAttr('disabled');
	$('#co_involucrados_rol_propietario')
	    .prop('checked', false)
	    .removeAttr('disabled');
	$('#co_involucrados_id')
	    .val(datos.id);
	$('#co_involucrados_juridico_razon_social')
	    .val(datos.persona_id)
	    .trigger('chosen:updated');
	$('#co_involucrados_juridico_contacto')
	    .val(datos.contacto_id)
	    .trigger('chosen:updated');
	$('#co_involucrados_juridico_contacto_datos')
	    .html('');
	$('#co_involucrados_natural_nombre')
	    .val(datos.persona_id)
	    .trigger('chosen:updated');
	$('#co_involucrados_natural_datos')
	    .html('');
	
	$('#co_involucrados_juridico_save').text( datos.save );
	$('#co_involucrados_natural_save').text( datos.save );
	
	$('#co_involucrados_tabla .ajax tr').removeClass('edit_item');	
    }
    function co_involucrados_edit( item ) {
	var l = item.attr('codigos').split("!!-!!")
	var datos = {
	    id: l[0]
	    , rol_id: l[1]
	    , tipo_id: l[2]
	    , persona_id : l[3]
	    , contacto_id: l[4]    
	    , save: 'Editar'
	}
	$('#co_involucrados_rol_cliente')
	    .prop('checked', false)
	    .attr('disabled', '');
	$('#co_involucrados_rol_solicitante')
	    .prop('checked', false)
	    .attr('disabled', '');
	$('#co_involucrados_rol_propietario')
	    .prop('checked', false)
	    .attr('disabled', '');
	if( datos.rol_id == 1 ) {
	    $('#co_involucrados_rol_cliente').prop('checked', true);
	} else if ( datos.rol_id == 2 ) {
	    $('#co_involucrados_rol_solicitante').prop('checked', true);
	} else if ( datos.rol_id == 3 ) {
	    $('#co_involucrados_rol_propietario').prop('checked', true);
	}
	if (datos.tipo_id==1) {
	    $('#co_involucrados_natural_nombre').html('<option value="' + datos.persona_id + '"></option>');
	    combo_involucrados_natural_nombre();
	    combo_involucrados_natural_datos();	    
	    datos.tipo_nombre ='natural';
	    $('#co_involucrados_tipo_natural')
	    	.prop( "checked", true )
	    	.click();
	} else if (datos.tipo_id==2) {
	    $('#co_involucrados_juridico_razon_social').html('<option value="' + datos.persona_id + '"></option>');
	    $('#co_involucrados_juridico_contacto').html('<option value="' + datos.contacto_id + '"></option>');
	    combo_involucrados_juridico_razon_social();
	    combo_involucrados_juridico_contacto();
	    combo_involucrados_juridico_contacto_datos()
	    
	    datos.tipo_nombre ='juridico';
	    $('#co_involucrados_tipo_juridico')
	    	.prop( "checked", true )
	    	.click();	    
	}
	pestana_involucrados_tipo_persona( datos.tipo_nombre );
	$('#co_involucrados_natural_save').text( datos.save );
	$('#co_involucrados_juridico_save').text( datos.save );
	$('#co_involucrados_id')
	    .val(datos.id);
	$('#co_involucrados_tabla .ajax tr' ).removeClass('edit_item');
	$('#co_involucrados_tabla .ajax tr.item-' + datos.id).addClass('edit_item');
    }
    function co_involucrados_delete( item ) {
	var codigos = item.attr('codigos');
	var enviar = {
              id: item.attr('codigo')
	}
	var div = $('#co_involucrados_tabla .ajax tr.item-' + enviar.id);
	div.css( 'background-color', '#FEC7C7' );
        $.ajax({
	    type: "POST",
	    url: "./ajax/delete/involucrados_delete.php",
	    data: enviar,
	    success: function( data ) {
		co_involucrados_cancel();
	    }
	});	
	var myVar = setInterval( function() {
	    div.remove();
	}, 3000 );
    }
    // ----- juridico
    function combo_involucrados_juridico_razon_social( ) {
	var combo = $('#co_involucrados_juridico_razon_social');
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
    function co_involucrados_juridico_save() {
	var datos = {
	    id: $('#co_involucrados_id').val()
            , cotizacion_id: $('#co_id').val()
	    , cliente: $('#co_involucrados_rol_cliente').is(':checked')
	    , solicitante: $('#co_involucrados_rol_solicitante').is(':checked')
	    , propietario: $('#co_involucrados_rol_propietario').is(':checked')
	    , persona_tipo: 'Juridica'
	    , persona_id: $('#co_involucrados_juridico_razon_social').val()
	    , contacto_id: $('#co_involucrados_juridico_contacto').val()
	}
	var involucrados = 0;
	if (datos.cliente ==true)
	    involucrados++;
	if (datos.solicitante ==true)
	    involucrados++;
	if (datos.propietario ==true)
	    involucrados++;
	if (involucrados>0 && datos.persona_id!='' && datos.persona_id!=null)
	{
	    co_involucrados_ajax(datos);
	}
	    
	else 
	    alert('Falta Seleccionar Información');
    }
    // --- modal
    function modal_co_involucrado_juridico() {
        dataTable_juridico = $('#modal_co_involucrado_juridico_field_tabla').DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 5,
            'order'      : [ 0, 'asc' ],
            'bDestroy': true,
            'aoColumnDefs': [
                { 'aTargets': [0,1,2,3,4,5,6,7,8], 'bSortable': false },
                // { 'targets': ver, 'visible': false }
            ],
            'ajax': {
                url : './ajax/modal/involucrado_juridico_tabla_modal.php',
                type: 'post',
            },
        });
        $('#modal_co_involucrado_juridico_field_tabla_filter').hide();
        
	modal_co_involucrado_juridico_field_clasificacion();
	modal_co_involucrado_juridico_field_actividad();
	modal_co_involucrado_juridico_field_grupo();
    }
    function modal_co_involucrado_juridico_edit(item) {
	var prefix = '#modal_co_involucrado_juridico_field_';
        var enviar = {
            id: item.attr('codigo')
        }
	$.ajax({
	    type: "POST",
            data: enviar,
	    url: "./ajax/buttons/involucrados-juridico-modal-juridico.php",
	    success: function(data) {
                var datos = jQuery.parseJSON( data );
                // c(datos);
                $(prefix + 'id').val( datos.id );
	        $(prefix + 'razon').val( datos.razon );
	        $(prefix + 'ruc').val( datos.ruc );
	        $(prefix + 'telefono').val( datos.telefono );
	        $(prefix + 'direccion').val( datos.direccion );
	        $(prefix + 'clasificacion')
	            .val( datos.clasificacion_id )
	            .trigger('chosen:updated');
	        $(prefix + 'actividad')
	            .val( datos.actividad_id )
	            .trigger('chosen:updated');
	        $(prefix + 'grupo')
	            .val( datos.grupo_id )
	            .trigger('chosen:updated');
	        if (datos.status=='1') {
	            $(prefix + 'status').prop('checked', true);
	        } else if (datos.status=='0') {
	            $(prefix + 'status').prop('checked', false);
	        }                
	        $('#modal_co_involucrado_juridico_field_tabla tr').removeClass('edit_item');
	        $(item).parent().parent().addClass('edit_item');
	        $(prefix + 'save').text( 'Editar' );
                
	    }
	}); 
    }
    function modal_co_involucrado_juridico_cancel() {
	var prefix = '#modal_co_involucrado_juridico_field_';
        $(prefix + 'id').val( '0' );
	$(prefix + 'razon').val( '' );
	$(prefix + 'ruc').val( '' );
	$(prefix + 'telefono').val( '' );
	$(prefix + 'direccion').val( '' );
	$(prefix + 'clasificacion')
	    .val( '' )
	    .trigger('chosen:updated');
	$(prefix + 'actividad')
	    .val( '' )
	    .trigger('chosen:updated');
	$(prefix + 'grupo')
	    .val( '' )
	    .trigger('chosen:updated');
	$(prefix + 'status').prop('checked', true);
	$('#modal_co_involucrado_juridico_field_tabla tr').removeClass('edit_item');
	$(prefix + 'save').text( 'Añadir' );
    }
    function modal_co_involucrado_juridico_save() {
	var prefix = '#modal_co_involucrado_juridico_field_';
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
	}
	if ( enviar.razon.trim() != ''
	   )
	{
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/modal/involucrado_juridico/save_juridico_modal.php",
		success: function(data) {
                    // c(data);
                    dataTable_juridico
                        .search(data)
                        .draw();
                    dataTable_juridico
                        .search('');
                    var timerId = setInterval(function () {
                        $('#modal_co_involucrado_juridico_field_tabla tbody td a').each(function(){
                            if (data == $(this).attr('codigo')) {
                                $(this).parent().parent().css('background-color', '#FFD6A2');                            
                            }
	                });                                    
                         clearInterval(timerId);
                    }, 500);
                    modal_co_involucrado_juridico_cancel();
                    combo_involucrados_juridico_razon_social();
                    combo_involucrados_juridico_contacto();
	            combo_involucrados_juridico_contacto_datos();
		}
	    });

	} else 
	{
	    alert('Falta Seleccionar Información');
	}
    }
    // --- combos
    function modal_co_involucrado_juridico_field_clasificacion() {
	var clasificacion = $('#modal_co_involucrado_juridico_field_clasificacion');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_juridico_clasificacion_combo_modal.php",
	    success: function(data) {
		clasificacion.html(data);
		clasificacion.trigger('chosen:updated');
	    }
	});
    }
    function modal_co_involucrado_juridico_field_actividad() {
	var actividad = $('#modal_co_involucrado_juridico_field_actividad');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_juridico_actividad_combo_modal.php",
	    success: function(data) {
		actividad.html(data);
		actividad.trigger('chosen:updated');
	    }
	});
    }
    function modal_co_involucrado_juridico_field_grupo() {
	var grupo = $('#modal_co_involucrado_juridico_field_grupo');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_juridico_grupo_combo_modal.php",
	    success: function(data) {
		grupo.html(data);
		grupo.trigger('chosen:updated');
	    }
	});
    }
    // --- tablas
    function modal_co_involucrado_juridico_field_clasificacion_tab_tabla() {
	var tabla = $('#modal_co_involucrado_juridico_field_clasificacion_tab_tabla');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_juridico_clasificacion_tabla_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});	
    }
    function modal_co_involucrado_juridico_field_grupo_tab_tabla() {
	var tabla = $('#modal_co_involucrado_juridico_field_grupo_tab_tabla');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_juridico_grupo_tabla_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});	
    }
    function modal_co_involucrado_juridico_field_actividad_tab_tabla() {
	var tabla = $('#modal_co_involucrado_juridico_field_actividad_tab_tabla');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_juridico_actividad_tabla_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});	
    }
    // clasificacion
    function modal_co_involucrado_juridico_field_clasificacion_tab_edit( item ) {
	var prefix = '#modal_co_involucrado_juridico_field_clasificacion_tab_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'Editar'
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
    function modal_co_involucrado_juridico_field_clasificacion_tab_cancel() {
	var prefix = '#modal_co_involucrado_juridico_field_clasificacion_tab_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'Añadir'
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
    function modal_co_involucrado_juridico_field_clasificacion_tab_save() {
	var prefix = '#modal_co_involucrado_juridico_field_clasificacion_tab_';
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
		url: "./ajax/modal/involucrado_juridico/save_juridico_clasificacion_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-clasificacion-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-clasificacion-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    modal_co_involucrado_juridico_field_clasificacion_tab_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('Falta Llenar Información');
	}

    }
    // actividad
    function modal_co_involucrado_juridico_field_actividad_tab_edit( item ) {
	var prefix = '#modal_co_involucrado_juridico_field_actividad_tab_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'Editar'
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
    function modal_co_involucrado_juridico_field_actividad_tab_cancel() {
	var prefix = '#modal_co_involucrado_juridico_field_actividad_tab_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'Añadir'
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
    function modal_co_involucrado_juridico_field_actividad_tab_save() {
	var prefix = '#modal_co_involucrado_juridico_field_actividad_tab_';
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
		url: "./ajax/modal/involucrado_juridico/save_juridico_actividad_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-actividad-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-actividad-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    modal_co_involucrado_juridico_field_actividad_tab_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('Falta Llenar Información');
	}

    }
    // grupo
    function modal_co_involucrado_juridico_field_grupo_tab_edit( item ) {
	var prefix = '#modal_co_involucrado_juridico_field_grupo_tab_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'Editar'
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
    function modal_co_involucrado_juridico_field_grupo_tab_cancel() {
	var prefix = '#modal_co_involucrado_juridico_field_grupo_tab_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'Añadir'
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
    function modal_co_involucrado_juridico_field_grupo_tab_save() {
	var prefix = '#modal_co_involucrado_juridico_field_grupo_tab_';
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
		url: "./ajax/modal/involucrado_juridico/save_juridico_grupo_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-grupo-table-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-grupo-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    modal_co_involucrado_juridico_field_grupo_tab_cancel(); // descomentar despues de pruebas
		}
	    });

	} else {
	    alert('Falta Llenar Información');
	}

    }
    // ----- juridico contacto
    function combo_involucrados_juridico_contacto() {
	var combo = $('#co_involucrados_juridico_contacto');
	var juridico = $('#co_involucrados_juridico_razon_social');
        $.ajax({
	    type: "POST",
	    data: "id=" + combo.val() + "&juridico_id=" + juridico.val(),
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
    function combo_involucrados_juridico_contacto_datos() {
	var combo = $('#co_involucrados_juridico_contacto');
	if ( combo.val() == 0 ) {
	    combo_involucrados_juridico_contacto_datos_clear();
	}else{
	    var div = $('#co_involucrados_juridico_contacto_datos');
            $.ajax({
		type: "POST",
		url: "./ajax/combos/involucrados_juridico_contacto_datos.php",
		data: "id=" + combo.val(),
		success: function(data) {
		    if (data != '') {
			div.html(data);
		    }
		}
            });
	}
    }
    function combo_involucrados_juridico_contacto_datos_clear() {
	$('#co_involucrados_juridico_contacto_datos').html('');
    }
    // --- modal
    function modal_co_involucrado_juridico_contacto() {
	var prefix = 'modal_co_involucrado_juridico_contacto_field_';
	var tabla = $('#'+prefix+'tabla');	
	var enviar = {
            juridico_id: $('#co_involucrados_juridico_razon_social').val()
	}
	$('#' + prefix + 'juridica_id').val(enviar.juridico_id);
	if (enviar.juridico_id=='') {
	    $('#' + prefix + 'juridica_id').val('0');
	}
	
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/modal/involucrado_juridico_contacto_table_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    function modal_co_involucrado_juridico_contacto_field_edit( item ) {
	var prefix = '#modal_co_involucrado_juridico_contacto_field_';
	var datos = {
	    id: $(item).attr('codigo')
	    , juridico_id: $(item).attr('juridico_id')
	    , nombre: $(item).find("td").eq(0).text()
	    , cargo: $(item).find("td").eq(1).text()
	    , telefono: $(item).find("td").eq(2).text()
	    , correo: $(item).find("td").eq(3).text()
	    , status: $(item).find("td").eq(4).text()
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'juridica_id').val( datos.juridico_id );
	$(prefix + 'nombre').val( datos.nombre );
	$(prefix + 'cargo').val( datos.cargo );
	$(prefix + 'telefono').val( datos.telefono );
	$(prefix + 'correo').val( datos.correo );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$('#involucrados-juridico-contacto-table-ajax tr').removeClass('edit_item');
	$(item).addClass('edit_item');
	$(prefix + 'save').text( 'Editar' );
    };
    function modal_co_involucrado_juridico_contacto_field_cancel( ) {
	var prefix = '#modal_co_involucrado_juridico_contacto_field_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , cargo: ''
	    , telefono: ''
	    , correo: ''
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	$(prefix + 'cargo').val( datos.cargo );
	$(prefix + 'telefono').val( datos.telefono );
	$(prefix + 'correo').val( datos.correo );
	$(prefix + 'status').prop('checked', true);
	$('#involucrados-juridico-contacto-table-ajax tr').removeClass('edit_item');
	$(prefix + 'save').text( 'Añadir' );
    };
    function modal_co_involucrado_juridico_contacto_field_save() {
	var prefix = '#modal_co_involucrado_juridico_contacto_field_';
	var enviar = {
	    id: $(prefix + 'id').val()
	    , juridico_id: $(prefix + 'juridica_id').val()
	    , nombre: $(prefix + 'nombre').val()
	    , cargo: $(prefix + 'cargo').val()
	    , telefono: $(prefix + 'telefono').val()
	    , correo: $(prefix + 'correo').val()
	    , status: $(prefix + 'status').is(':checked')
	}
	// c(enviar);
 	if ( enviar.nombre.trim() != '' &&
	     enviar.juridico_id != '0'
	   ) {
	    $.ajax({
	    	type: "POST",
	    	data: enviar, 
	    	url: "./ajax/modal/involucrado_juridico_contacto/save_juridico_contacto_modal.php",
	    	success: function(data) {
	    	    if ( enviar.id=='0' ) {
	    		// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#involucrados-juridico-contacto-table-ajax tbody' ).append( data );
	    	    } else {
	    		// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#involucrados-juridico-contacto-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
	    	    modal_co_involucrado_juridico_contacto_field_cancel(); // comentado para prueba
	            var prefix = '#modal_co_involucrado_juridico_contacto_field_';
	            $(prefix + 'juridica_id').val('0');
	            combo_involucrados_juridico_contacto();
	            combo_involucrados_juridico_contacto_datos();	
	    	}
	    });
            
            

	} else {
	    if ( enviar.juridico_id != '0' ) {
		alert('Falta Seleccionar Información');
	    } else {
		alert('Selecciono la Razon Social Primero');
	    }

	}
    };

    // ----- natural
    function combo_involucrados_natural_nombre() {
	var combo = $('#co_involucrados_natural_nombre');
        $.ajax({
	    type: "POST",
	    data: "id=" + combo.val(),
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
    function combo_involucrados_natural_datos() {
	var combo = $('#co_involucrados_natural_nombre');
	var div = $('#co_involucrados_natural_datos');
	if ( combo.val() == '') {
	    combo_involucrados_natural_datos_clear();
	} else {

	    var combo = $('#co_involucrados_natural_nombre');
            $.ajax({
		type: "POST",
		data: "id=" + combo.val(),
		url: "./ajax/combos/involucrados_natural_datos.php",
		success: function(data) {
		    if (data != '') {
			div.html(data);
		    }
		}
            });		    
	}
    }
    function combo_involucrados_natural_datos_clear() {
	$('#co_involucrados_natural_datos').html('');
    }
    function co_involucrados_natural_save() {
	var datos = {
	    id: $('#co_involucrados_id').val()
            , cotizacion_id: $('#co_id').val()
	    , accion: $('#co_involucrados_accion').val()
	    , cliente: $('#co_involucrados_rol_cliente').is(':checked')
	    , solicitante: $('#co_involucrados_rol_solicitante').is(':checked')
	    , propietario: $('#co_involucrados_rol_propietario').is(':checked')
	    , persona_tipo: 'Natural'
	    , persona_id: $('#co_involucrados_natural_nombre').val()
	    , contacto_id: ''
	}
	var involucrados = 0;
	if (datos.cliente ==true)
	    involucrados++;
	if (datos.solicitante ==true)
	    involucrados++;
	if (datos.propietario ==true)
	    involucrados++;

	if (involucrados > 0 && datos.persona_id != '' && datos.persona_id!=null)
	{
	    co_involucrados_ajax(datos);
	}
	else 
	    alert('Falta Seleccionar Información');
    }
    // --- modal
    function modal_co_involucrado_natural() {
        dataTable_natural = $('#tabla_involucrado_natural').DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 5,
            'order'      : [ 0, 'asc' ],
            'bDestroy': true,
            'aoColumnDefs': [
                { 'aTargets': [0,1,2,3,4,5,6,7], 'bSortable': false },
                // { 'targets': ver, 'visible': false }
            ],
            'ajax': {
                url : './ajax/modal/involucrado_natural_tabla_modal.php',
                type: 'post',
            },
        });
        $('#tabla_involucrado_natural_filter').hide();
	var combo = $('#modal_co_involucrado_natural #modal_co_involucrado_natural_documento_tipo');
	$.ajax({
	    type: "POST",
	    url: "./ajax/modal/involucrado_natural_combo_modal.php",
	    success: function(data) {
		combo.html(data);
		combo.trigger('chosen:updated');
	    }
	});

    }
    function modal_co_involucrado_natural_cancel() {
	$('#modal_co_involucrado_natural_id').val('0');
	$('#modal_co_involucrado_natural_nombre').val('');
	$('#modal_co_involucrado_natural_documento_tipo')
	    .val(1)
	    .trigger('chosen:updated');
	$('#modal_co_involucrado_natural_documento_numero').val('');
	$('#modal_co_involucrado_natural_direccion').val('');
	$('#modal_co_involucrado_natural_telefono').val('');
	$('#modal_co_involucrado_natural_correo').val('');
	$('#modal_co_involucrado_natural_activo').prop('checked', true);

	$('#tabla_involucrado_natural tr').removeClass('edit_item');
	$('#modal_co_involucrado_natural_save').text( 'Añadir' );	
    }
    function modal_co_involucrado_natural_edit(item) {
	var datos = {
	    id: $(item).attr('codigo')
	    , nombre: $(item).parent().parent().find("td").eq(0).text()
	    , documento_numero: $(item).parent().parent().find("td").eq(2).text()
	    , direccion: $(item).parent().parent().find("td").eq(3).text()
	    , telefono: $(item).parent().parent().find("td").eq(4).text()
	    , correo: $(item).parent().parent().find("td").eq(5).text()
	    , activo: $(item).parent().parent().find("td").eq(6).text()
	}
	$('#modal_co_involucrado_natural_id').val(datos.id);
	$('#modal_co_involucrado_natural_nombre').val(datos.nombre);
	$('#modal_co_involucrado_natural_documento_numero').val(datos.documento_numero);
	$('#modal_co_involucrado_natural_direccion').val(datos.direccion);
	$('#modal_co_involucrado_natural_telefono').val(datos.telefono);
	$('#modal_co_involucrado_natural_correo').val(datos.correo);
	if (datos.activo=='Activo') {
	    $('#modal_co_involucrado_natural_activo').prop('checked', true);
	} else if (datos.activo=='Desactivo') {
	    $('#modal_co_involucrado_natural_activo').prop('checked', false);
	}
	$('#lista_natural_ajax tr').removeClass('edit_item');
	$(item).parent().parent().addClass('edit_item');
	$('#modal_co_involucrado_natural_save').text( 'Editar' );

    }
    function modal_co_involucrado_natural_save() {
	var datos = {
              id: $('#modal_co_involucrado_natural_id').val()
	    , nombre: $('#modal_co_involucrado_natural_nombre').val()
	    , documento_tipo: $('#modal_co_involucrado_natural_documento_tipo').val()
	    , documento_numero: $('#modal_co_involucrado_natural_documento_numero').val()
	    , direccion: $('#modal_co_involucrado_natural_direccion').val()
	    , telefono: $('#modal_co_involucrado_natural_telefono').val()
	    , correo: $('#modal_co_involucrado_natural_correo').val()
	    , status: $('#modal_co_involucrado_natural_activo').is(':checked')
	}

	if ( datos.nombre.trim() != '' 
	   )
	{
	    $.ajax({
		type: "POST",
		data: datos, 
		url: "./ajax/modal/involucrado_natural/save_natural.php",
		success: function(data) {
                    dataTable_natural
                        .search(data)
                        .draw();
                    dataTable_natural
                        .search('');
                    var timerId = setInterval(function () {
                        $('#tabla_involucrado_natural tbody td a').each(function(){
                            if (data == $(this).attr('codigo')) {
                                $(this).parent().parent().css('background-color', '#FFD6A2');                            
                            }
	                });
                         clearInterval(timerId);
                    }, 500);
	    	    modal_co_involucrado_natural_cancel();
                    combo_involucrados_natural_nombre();
	            combo_involucrados_natural_datos();
		}
	    });	    
	} else {
	    alert('Falta Ingresar Datos');
	}
    }

    // ----- save natural/juridico
    function co_involucrados_ajax(datos) {
	$.ajax({
	    type: "POST",
	    data: datos, 
	    url: "./ajax/buttons/involucrados-buttons.php",
	    success: function(data) {
		if ( datos.id=='0' ) {
		    // data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    $( '#co_involucrados_tabla .ajax').append( data );
	    	} else {
		    // data = '<td>' + data + '</td>'; // para pruebas
	    	    $( '#co_involucrados_tabla .ajax tr.item-' + datos.id ).html( data );
	    	}
		co_involucrados_cancel();		
	    }
	});
    }    
    // ----- vendedor
    function combo_involucrados_vendedor () {
	var combo = $('#co_involucrados_vendedor');
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/involucrados_vendedor.php",
	    data: "id=" + combo.val(),
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
    function modal_involucrados_vendedor () {
	// var modal = $('#modal_co_vendedor .modal_ajax');
        // $.ajax({
	//     type: "POST",
	//     url: "./ajax/modal/modal_ajax_involucrados_vendedor.php",
	//     success: function(data) {
	// 	modal.html(data);
	//     }
        // });
    }
    function involucrados_vendedor_clear () {
	// $('#modal_co_vendedor_codigo').val(0);
	// $('#modal_co_vendedor_nombre').val('');
	// $('#modal_co_vendedor_telefono').val('');
	// $('#modal_co_vendedor_correo').val('');
	// $('#modal_co_vendedor_activo').prop('checked', true);
	// $('#modal_co_vendedor_save').text('Añadir');
	// $('#lista_vendedores tr').removeClass('edit_item');
    }
    function involucrados_vendedor_edit( item ) {
	// var dato = {
	//     codigo: $(item).attr('codigo')
	//     , nombre: $(item).parent().parent().find("td").eq(0).text()
	//     , telefono: $(item).parent().parent().find("td").eq(1).text()
	//     , correo: $(item).parent().parent().find("td").eq(2).text()
	//     , status: $(item).parent().parent().find("td").eq(3).text()
	// }
	// $('#modal_co_vendedor_codigo').val(dato.codigo);
	// $('#modal_co_vendedor_nombre').val(dato.nombre);
	// $('#modal_co_vendedor_telefono').val(dato.telefono);
	// $('#modal_co_vendedor_correo').val(dato.correo);
	// if (dato.status=='Activado') {
	//     $('#modal_co_vendedor_activo').prop('checked', true);
	// }
	// if (dato.status=='Desactivado') {
	//     $('#modal_co_vendedor_activo').prop('checked', false);
	// }
	// $('#modal_co_vendedor_save').text('Editar');
	// $('#lista_vendedores tr').removeClass('edit_item');
	// $(item).parent().parent().addClass('edit_item');
    }
    function involucrados_vendedor_save() {
    // 	var enviar = {
    // 	    accion: $('#modal_co_vendedor_save').text()
    // 	    , co_id: $('#co_id').val()
    // 	    , codigo: $('#modal_co_vendedor_codigo').val()
    // 	    , nombre: $('#modal_co_vendedor_nombre').val()
    // 	    , telefono: $('#modal_co_vendedor_telefono').val()
    // 	    , correo: $('#modal_co_vendedor_correo').val()
    // 	    , activo: $('#modal_co_vendedor_activo').prop('checked')
    // 	}

    // 	if (enviar.nombre.trim()!='' || enviar.telefono.trim()!='' || enviar.correo.trim()!='')
    // 	    {
    // 		$.ajax({
    // 		    type: "POST",
    // 		    data: enviar,
    // 		    url: "./ajax/modal/modal_ajax_involucrados_vendedor/save-vendedor.php",
    // 		    success: function(data) {
    // 			if (data!='') {
    // 			    if (enviar.accion=='Añadir') {
    // 				$('#lista_vendedores tbody').append(data);
    // 			    }
    // 			    if (enviar.accion=='Editar') {
    // 				$('.lista_vendedores_item.item-'+enviar.codigo).html(data);
    // 			    }
    // 			}
    // 		    }
    // 		});
    // 		involucrados_vendedor_clear();		
    // 	    }
    // 	else 
    // 	    {
    // 		alert('No se permite espacios en Blanco');
    // 	    }
    }
});
