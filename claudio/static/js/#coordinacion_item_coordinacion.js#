$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#coor_coordinacion_item_field_';
    var prefixClass = '.coor_coordinacion_item_field_';
    var lista_coordinaciones = '';
    var lista_persona_juridica = '';
    var lista_persona_natural = '';
    var lista_contacto = '';
    var lista_modalidad = '';
    var lista_tipo2 = '';
    var lista_cambio = '';
    // --------------------------------------------------------------- load
    coor_coordinacion_item_field_coordinaciones_por_cotizacion();
    coor_coordinacion_item_field_coordinaciones_coordinacion_estado_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_cliente_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_modalidad_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_tipo2_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_cambio_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_bien_id();
    coor_coordinacion_item_field_coordinaciones_coordinacion_moneda_id();
    
    // ------------------------------------------------------------ eventos    
    // info
    $("body").on("click", prefixId+"coordinacion_solicitante_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_link();
	e.preventDefault();
    });
    $("body").on("click", prefixId+"coordinacion_solicitante_contacto_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_link();
	e.preventDefault();
    });
    $("body").on("click", prefixId+"coordinacion_cliente_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_cliente_link();
	e.preventDefault();
    });
    $("body").on("change", prefixId+"coordinacion_solicitante_id", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_id();
	e.preventDefault();
    });
    // -------------------------- modals
    // persona
    $("body").on("click", prefixId+"coordinacion_persona_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_persona_link($(this));
	e.preventDefault();
    });
    $("body").on("change", prefixId+"coordinacion_persona_modal_tipo_juridica", function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_table();
	e.preventDefault();
    });
    $("body").on("change", prefixId+"coordinacion_persona_modal_tipo_natural", function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_table();
	e.preventDefault();
    });
    $(prefixId+'coordinacion_persona_modal_juridica_tabla .search-input-text').on( 'keyup click', function () {
	    // for text boxes
	    var i =$(this).attr('data-column');  // getting column index
	    var v =$(this).val();  // getting search input value
	    lista_persona_juridica.columns(i).search(v).draw();
    } );
    $(prefixId+'coordinacion_persona_modal_natural_tabla .search-input-text').on( 'keyup click', function () {
	    // for text boxes
	    var i =$(this).attr('data-column');  // getting column index
	    var v =$(this).val();  // getting search input value
	    lista_persona_natural.columns(i).search(v).draw();
	} );
    $(prefixId+'coordinacion_persona_modal').on("click", '.select', function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_select($(this));
	e.preventDefault();
    });
    $("body").on("click", prefixId+"coordinacion_persona_modal_juridica_form_cancel", function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_cancel();
    });
    $("body").on("click", prefixId+ "coordinacion_persona_modal_natural_form_cancel", function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_cancel();
    });
    $("body").on("click", prefixId+"coordinacion_persona_modal_juridica_form_save", function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_save();
    });
    $("body").on("click", prefixId+ "coordinacion_persona_modal_natural_form_save", function(e) {
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_save();
    });
    // contacto
    $("body").on("click", prefixId+"coordinacion_solicitante_contacto_link2", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_link2();
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_cancel();
	e.preventDefault();
    });
    $(prefixId+'coordinacion_solicitante_contacto_modal2_tabla .search-input-text').on( 'keyup click', function () {
	    // for text boxes
	    var i =$(this).attr('data-column');  // getting column index
	    var v =$(this).val();  // getting search input value
	    lista_contacto.columns(i).search(v).draw();
	} );
    $(prefixId+'coordinacion_solicitante_contacto_modal2_tabla').on('click', ".edit", function() {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_edit($(this));
	// lista_contacto.draw();
    });
    $(prefixId+'coordinacion_solicitante_contacto_modal2_cancel').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_cancel();
    } );
    $(prefixId+'coordinacion_solicitante_contacto_modal2_save').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_save();
        coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_id();
    } );
    $('#contacto-tab-panel1 a').on( 'click', function () {
        lista_contacto.draw();
    } );
    // modalidad
    $("body").on("click", prefixId+"coordinacion_modalidad_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_modalidad_link();
	coor_coordinacion_item_field_coordinaciones_modalidad_modal_cancel();
	e.preventDefault();
    });
    $(prefixId+'coordinacion_modalidad_modal_tabla .search-input-text').on( 'keyup click', function () {
	// for text boxes
	var i =$(this).attr('data-column');
	var v =$(this).val();
	lista_modalidad.columns(i).search(v).draw();
    } );
    $(prefixId+'coordinacion_modalidad_modal_tabla').on('click', ".edit", function() {
	coor_coordinacion_item_field_coordinaciones_modalidad_modal_edit($(this));
	// lista_contacto.draw();
    });
    $(prefixId+'coordinacion_modalidad_modal_cancel').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_modalidad_modal_cancel();
    } );
    $(prefixId+'coordinacion_modalidad_modal_save').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_modalidad_modal_save();
        coor_coordinacion_item_field_coordinaciones_coordinacion_modalidad_id()
    } );
    $('#modalidad-tab-panel1 a').on( 'click', function () {
        lista_modalidad.draw();
    } );
    // tipo2
    $("body").on("click", prefixId+"coordinacion_tipo2_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_tipo2_link();
        coor_coordinacion_item_field_coordinaciones_tipo2_modal_cancel();
	e.preventDefault();
    });
    $(prefixId+'coordinacion_tipo2_modal_tabla .search-input-text').on( 'keyup click', function () {
	// for text boxes
	var i =$(this).attr('data-column');
	var v =$(this).val();
	lista_tipo2.columns(i).search(v).draw();
    } );
    $(prefixId+'coordinacion_tipo2_modal_tabla').on('click', ".edit", function() {
	coor_coordinacion_item_field_coordinaciones_tipo2_modal_edit($(this));
    });
    $(prefixId+'coordinacion_tipo2_modal_cancel').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_tipo2_modal_cancel();
    } );
    $(prefixId+'coordinacion_tipo2_modal_save').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_tipo2_modal_save();
        coor_coordinacion_item_field_coordinaciones_coordinacion_tipo2_id()
    } );
    $('#tipo2-tab-panel1 a').on( 'click', function () {
        lista_tipo2.draw();
    } );
    // cambio
    $("body").on("click", prefixId+"coordinacion_cambio_link", function(e) {
	coor_coordinacion_item_field_coordinaciones_coordinacion_cambio_link();
        coor_coordinacion_item_field_coordinaciones_cambio_modal_cancel();
	e.preventDefault();
    });
    $(prefixId+'coordinacion_cambio_modal_tabla .search-input-text').on( 'keyup click', function () {
	// for text boxes
	var i =$(this).attr('data-column');
	var v =$(this).val();
	lista_cambio.columns(i).search(v).draw();
    } );
    $(prefixId+'coordinacion_cambio_modal_tabla').on('click', ".edit", function() {
	coor_coordinacion_item_field_coordinaciones_cambio_modal_edit($(this));
    });
    $(prefixId+'coordinacion_cambio_modal_cancel').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_cambio_modal_cancel();
    } );
    $(prefixId+'coordinacion_cambio_modal_save').on( 'click', function () {
	coor_coordinacion_item_field_coordinaciones_cambio_modal_save();
        coor_coordinacion_item_field_coordinaciones_coordinacion_cambio_id()
    } );
    $('#cambio-tab-panel1 a').on( 'click', function () {
        lista_cambio.draw();
    } );
    // --------- bienes
    $(prefixId+'coordinacion_bien_add').on( 'click', function () {
	coor_coordinacion_item_field_coordinacion_bien_add();
    } );
    $(prefixId+'coordinacion_bien_tabla').on( 'click', '.delete', function () {
	coor_coordinacion_item_field_coordinacion_bien_delete($(this).parent().parent());
    } );
    // -------------------------- save
    $("body").on("click", prefixId+"coordinacion_save", function(e) {
	coor_coordinacion_item_field_coordinacion_save();
	e.preventDefault();
    });

    // cambiar correlativo
    $(prefixId+"codigo_correlativo_trigger").on("click", function(e) {
        coor_coordinacion_item_field_codigo_correlativo_trigger($(this));
	e.preventDefault();
    });
    $(prefixId+"codigo_correlativo_modal_save").on("click", function(e) {
        coor_coordinacion_item_field_codigo_correlativo_modal_save();
	e.preventDefault();
    });    
    // ---------------------------------------------------------- funciones

    function coor_coordinacion_item_field_coordinaciones_por_cotizacion() {
        var enviar = {
	    "codigo_cotizacion": $(prefixId+'cotiazacion_codigo').attr('valor')
            , 'coordinacion_id': $(prefixId+'coordinacion_id').val()
	};
        lista_coordinaciones = $(prefixId+'cotiazacion_codigo').DataTable({
	    "processing"  : true,
	    "serverSide"  : true,
            "displayStart": $(prefixId+'startDataTable').val(),
            "pageLength": 5,
	    "ajax":{
		url :"./ajax/tables/lista_coordinaciones_por_cotizacion.php", 
		type: "post",
		data: enviar
	    },
	    // "language": {
	    // 	url: '../../librerias.v2/vendor/data_table/Spanish.json'
	    // }	    
	});
  	$(prefixId+'cotiazacion_codigo_length').css("display","none");
	$(prefixId+'cotiazacion_codigo_filter').css("display","none");
	$(prefixId+'cotiazacion_codigo_info').parent().removeClass("small-6");
	$(prefixId+'cotiazacion_codigo_info').parent().addClass("small-12");
	$(prefixId+'cotiazacion_codigo_paginate').parent().removeClass("small-6");
	$(prefixId+'cotiazacion_codigo_paginate').parent().addClass("small-12");
    }
    // ----------- select
    function coor_coordinacion_item_field_coordinaciones_coordinacion_estado_id() {
	var enviar = {
	    id: $(prefixId+'coordinacion_estado_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '') {
            select_simple('./ajax/select/estado_id_select_item.php'
                          , prefixId+'coordinacion_estado_id'
                          , enviar
                         );
        }        
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_id() {
	var enviar = {
	    cotizacion_id: $(prefixId+'cootizacion_id').val()
	    , id: $(prefixId+'coordinacion_solicitante_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '' ) {
            select_simple( './ajax/select/solicitante_id_select_item.php', prefixId+'coordinacion_solicitante_id', enviar );
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_id() {
	var enviar = {
	    cotizacion_id: $(prefixId+'cootizacion_id').val()
	    , solicitante_id: $(prefixId+'coordinacion_solicitante_id').val()
	    , id: $(prefixId+'coordinacion_solicitante_contacto_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '' ) {
	    select_simple( './ajax/select/solicitante_contacto_id_select_item.php', prefixId+'coordinacion_solicitante_contacto_id', enviar );
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_cliente_id() {
	var enviar = {
	    cotizacion_id: $(prefixId+'cootizacion_id').val()
	    , id: $(prefixId+'coordinacion_cliente_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '' ) {
	    select_simple( './ajax/select/cliente_id_select_item.php', prefixId+'coordinacion_cliente_id', enviar );
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_modalidad_id() {
	var enviar = {
	    id: $(prefixId+'coordinacion_modalidad_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '' ) {
	    select_simple( './ajax/select/modalidad_id_select_item.php', prefixId+'coordinacion_modalidad_id', enviar );
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_tipo2_id() {
	var enviar = {
	    id: $(prefixId+'coordinacion_tipo2_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '' ) {
	    select_simple( './ajax/select/tipo2_id_select_item.php'
                           , prefixId+'coordinacion_tipo2_id'
                           , enviar
                         );
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_bien_id() {
        var enviar = {
	    cotizacion_id: $(prefixId+'cootizacion_id').val()
            , coordinacion_id: $(prefixId+'coordinacion_id').val()
            , id: $(prefixId+'coordinacion_bien_id').val()
            , modo: $(prefixId+'mode').val()
	}
        c(enviar);
        if ($(prefixId+'coordinacion_id').val() != '') {
            if ($(prefixId+'mode').val() == 'edit' ) {
                select_simple('./ajax/select/bien_coordinacion_item_select.php',
                              prefixId+'coordinacion_bien_id',
                              enviar
                             );
            }
            element_simple('./ajax/tables/bien_coordinacion_item_tabla.php',
                           prefixId+'coordinacion_bien_tabla tbody',
                           enviar
                          );
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_moneda_id() {
        if ($(prefixId+'mode').val() == 'edit') {
            var moneda_id = $(prefixId+'coordinacion_bien_moneda').val();
            $(prefixId+'coordinacion_bien_moneda_id')
                .val(moneda_id);
            
        }
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_cambio_id() {
        var enviar = {
	    id: $(prefixId+'coordinacion_cambio_id').val()
	}
        if ($(prefixId+'mode').val() == 'edit' && $(prefixId+'coordinacion_id').val() != '' ) {
	    select_simple( './ajax/select/cambio_id_select_item.php'
                           , prefixId+'coordinacion_cambio_id'
                           , enviar
                         );
        }
    }
    // ---------- info
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_link() {
	var enviar = {
	    solicitante_id: $(prefixId+'coordinacion_solicitante_id').val()
	}
	// c(enviar);
	element_simple( './ajax/tables/solicitante_cliente_info.php', prefixId+'coordinacion_solicitante_info table', enviar );	
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_link() {
	var enviar = {
	    solicitante_id: $(prefixId+'coordinacion_solicitante_id').val()
	    , contacto_id: $(prefixId+'coordinacion_solicitante_contacto_id').val()
	}
	// c(enviar);
	element_simple( './ajax/tables/solicitante_contacto_info.php', prefixId+'coordinacion_solicitante_contacto_info table', enviar );
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_cliente_link() {
	var enviar = {
	    solicitante_id: $(prefixId+'coordinacion_cliente_id').val()
	}
	element_simple( './ajax/tables/solicitante_cliente_info.php', prefixId+'coordinacion_cliente_info table', enviar );	
    }
    // ---------- modal persona
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_link(item) {
        $(prefixId+'coordinacion_persona_modal_rol').val(item.attr('tipo'));
        $(prefixId+'coordinacion_persona_modal_tipo_juridica').prop('checked', true);
        $(prefixId+'coordinacion_persona_modal_tipo_natural').prop('checked', false);        
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_table();
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_table() {
        $(prefixClass+'coordinacion_persona_modal_juridica_tabla_div').css('display','block');
        $(prefixClass+'coordinacion_persona_modal_natural_tabla_div').css('display','none');
	lista_persona_juridica = $(prefixId+'coordinacion_persona_modal_juridica_tabla').DataTable({
	    "processing": true,
	    "serverSide": true,
	    "bDestroy": true,
            "pageLength": 5,
	    "ajax":{
		url :"./ajax/tables/persona_juridica_table_modal_item.php", 
		type: "post"
	    }
	});
        $(prefixId+'coordinacion_persona_modal_juridica_tabla_length').parent().parent().css("display","none");

        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_clasificacion();
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_actividad();
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_grupo();
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_clasificacion() {
        select_simple(
            '../cotizacion/ajax/modal/involucrado_juridico_clasificacion_combo_modal.php',
            prefixId+'coordinacion_persona_modal_juridica_form_clasificacion',
            ''
        );        
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_actividad() {
        select_simple(
            '../cotizacion/ajax/modal/involucrado_juridico_actividad_combo_modal.php',
            prefixId+'coordinacion_persona_modal_juridica_form_actividad',
            ''
        );
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_grupo() {
        select_simple(
            '../cotizacion/ajax/modal/involucrado_juridico_grupo_combo_modal.php',
            prefixId+'coordinacion_persona_modal_juridica_form_grupo',
            ''
        );
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_cancel() {
	var datos = {
	    id: '0'
	    , razon: ''
	    , ruc: ''
	    , telefono: ''
	    , direccion: ''
            , clasificacion: '0'
            , actividad: '0'
            , grupo: '0'
            , status: true
            , save: 'Añadir'
	}
        $(prefixId + 'coordinacion_persona_modal_juridica_form_id').val(datos.id);
	$(prefixId + 'coordinacion_persona_modal_juridica_form_razon').val(datos.razon);
	$(prefixId + 'coordinacion_persona_modal_juridica_form_ruc').val(datos.ruc);
	$(prefixId + 'coordinacion_persona_modal_juridica_form_telefono').val(datos.telefono);
	$(prefixId + 'coordinacion_persona_modal_juridica_form_direccion').val(datos.direccion);
	$(prefixId + 'coordinacion_persona_modal_juridica_form_clasificacion')
	    .val(datos.clasificacion).trigger('chosen:updated');
	$(prefixId + 'coordinacion_persona_modal_juridica_form_actividad')
	    .val(datos.actividad).trigger('chosen:updated');
	$(prefixId + 'coordinacion_persona_modal_juridica_form_grupo')
	    .val(datos.grupo).trigger('chosen:updated');
	$(prefixId + 'coordinacion_persona_modal_juridica_form_status').prop('checked', datos.status);
	$(prefixId + 'coordinacion_persona_modal_juridica_form_save').text(datos.save);
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_save() {
	var datos = {
	    id             : $(prefixId + 'coordinacion_persona_modal_juridica_form_id').val()
	    , razon        : $(prefixId + 'coordinacion_persona_modal_juridica_form_razon').val()
	    , ruc          : $(prefixId + 'coordinacion_persona_modal_juridica_form_ruc').val()
	    , telefono     : $(prefixId + 'coordinacion_persona_modal_juridica_form_telefono').val()
	    , direccion    : $(prefixId + 'coordinacion_persona_modal_juridica_form_direccion').val()
            , clasificacion_id: $(prefixId + 'coordinacion_persona_modal_juridica_form_clasificacion').val()
            , actividad_id    : $(prefixId + 'coordinacion_persona_modal_juridica_form_actividad').val()
            , grupo_id        : $(prefixId + 'coordinacion_persona_modal_juridica_form_grupo').val()
            , status       : $(prefixId + 'coordinacion_persona_modal_juridica_form_status').is(':checked')
	}	
        if ( datos.razon.trim() != '' &&
	     datos.ruc.trim() != '' &&
	     datos.clasificacion_id != '' &&
	     datos.actividad_id != ''
	   ) 
	{
	    $.ajax({
		type: "POST",
		data: datos, 
		url: "../cotizacion/ajax/modal/involucrado_juridico/save_juridico_modal.php",
		success: function(data) {
                    coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_juridica_cancel();
		}
	    });

	} else 
	{
	    alert('Falta Seleccionar Información');
	}
    }
    
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_table() {
        $(prefixClass+'coordinacion_persona_modal_juridica_tabla_div').css('display','none');
        $(prefixClass+'coordinacion_persona_modal_natural_tabla_div').css('display','block');
	lista_persona_natural = $(prefixId+'coordinacion_persona_modal_natural_tabla').DataTable({
	    "processing": true,
	    "serverSide": true,
	    "bDestroy": true,
            "pageLength": 5,
	    "ajax":{
		url :"./ajax/tables/persona_natural_table_modal_item.php", 
		type: "post"
	    }
	});
        $(prefixId+'coordinacion_persona_modal_natural_tabla_length').parent().parent().css("display","none");
        coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_documento_tipo();
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_documento_tipo() {
        select_simple(
            '../cotizacion/ajax/modal/involucrado_natural_combo_modal.php',
            prefixId+'coordinacion_persona_modal_natural_form_documento_tipo',
            ''
        );        
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_cancel() {
	var datos = {
	    id: '0'
	    , nombre: ''
            , documento_tipo: ''
	    , documento_numero: ''
	    , direccion: ''
	    , telefono: ''
            , correo: ''
            , activo: true
            , save: 'Añadir'
	}
	$(prefixId+'coordinacion_persona_modal_natural_form_id').val(datos.id);
	$(prefixId+'coordinacion_persona_modal_natural_form_nombre').val(datos.nombre);
	$(prefixId+'coordinacion_persona_modal_natural_form_documento_numero').val(datos.documento_numero);
	$(prefixId+'coordinacion_persona_modal_natural_form_direccion').val(datos.direccion);
	$(prefixId+'coordinacion_persona_modal_natural_form_telefono').val(datos.telefono);
	$(prefixId+'coordinacion_persona_modal_natural_form_correo').val(datos.correo);
	$(prefixId+'coordinacion_persona_modal_natural_form_activo').prop('checked', datos.activo);
	$(prefixId+'coordinacion_persona_modal_natural_form_save').text(datos.save);	
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_save() {
        var datos = {
	    id                : $(prefixId+'coordinacion_persona_modal_natural_form_id').val()
	    , nombre          : $(prefixId+'coordinacion_persona_modal_natural_form_nombre').val()
            , documento_tipo  : $(prefixId+'coordinacion_persona_modal_natural_form_documento_tipo').val()
	    , documento_numero: $(prefixId+'coordinacion_persona_modal_natural_form_documento_numero').val()
	    , direccion       : $(prefixId+'coordinacion_persona_modal_natural_form_direccion').val()
	    , telefono        : $(prefixId+'coordinacion_persona_modal_natural_form_telefono').val()
            , correo          : $(prefixId+'coordinacion_persona_modal_natural_form_correo').val()
            , status          : $(prefixId+'coordinacion_persona_modal_natural_form_activo').is(':checked')
	}
	if ( datos.nombre.trim() != '' 
	     && datos.documento_numero.trim() != '' 
	     && datos.direccion.trim() != '' 
	     && datos.telefono.trim() != '' 
	     && datos.correo.trim() != '' 
	   )
	{
	    $.ajax({
		type: "POST",
		data: datos, 
		url: "../cotizacion/ajax/modal/involucrado_natural/save_natural.php",
		success: function(data) {
                    coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_natural_cancel();
		}
	    });	    
	} else {
	    alert('Falta Ingresar Datos');
	}        

    }
    
    function coor_coordinacion_item_field_coordinaciones_coordinacion_persona_modal_select(item) {
        var datos = {
            persona_id     : item.attr('codigo')
            , cotizacion_id: $(prefixId+'cootizacion_id').val()
            , persona_rol  : $(prefixId+'coordinacion_persona_modal_rol').val()
            , juridica     : $(prefixId+'coordinacion_persona_modal_tipo_juridica').is(':checked')
            , natural      : $(prefixId+'coordinacion_persona_modal_tipo_natural').is(':checked')
        }
        // c(datos);
	$.ajax({
	    type: "POST",
	    data: datos,
	    url: './ajax/buttons/select_persona_coordinacion_item_buttons.php',
	    success: function(data) {
                if (datos.persona_rol=='cliente') {
                    $(prefixId+'coordinacion_cliente_id').html('<option value="'+data.trim()+'"></option>')
                    coor_coordinacion_item_field_coordinaciones_coordinacion_cliente_id();
                    
                }
                else if (datos.persona_rol=='solicitante') {
                    $(prefixId+'coordinacion_solicitante_id').html('<option value="'+data.trim()+'"></option>')
                    coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_id();
                    coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_contacto_id();
                } 
	    }
	});
    }
    // ---------- modal contacto    
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_link2() {
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-tab-panel2').removeClass('active');
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-tab-panel1').addClass('active');
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-panel2').removeClass('active');
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-panel1').addClass('active');
	
	var enviar = {
	    "solicitante_id": $(prefixId+'coordinacion_solicitante_id').val()
	};
	lista_contacto = $(prefixId+'coordinacion_solicitante_contacto_modal2_tabla').DataTable({
	    "processing": true,
	    "serverSide": true,
	    "bDestroy": true,
	    "ajax":{
		url :"./ajax/tables/contacto_table_modal_item.php", 
		type: "post",
		data: enviar
	    }
	});
	$(prefixId+'coordinacion_solicitante_contacto_modal2_tabla_length').parent().parent().css("display","none");
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_edit(item) {
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-tab-panel1').removeClass('active');
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-tab-panel2').addClass('active');
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-panel1').removeClass('active');
	$(prefixId+'coordinacion_solicitante_contacto_modal2 #contacto-panel2').addClass('active');

	var datos = {
	    codigo  :   item.attr('codigo')
	    , nombre:   item.parent().parent().find("td").eq(0).text()
	    , cargo:    item.parent().parent().find("td").eq(1).text()
	    , telefono: item.parent().parent().find("td").eq(2).text()
	    , correo:   item.parent().parent().find("td").eq(3).text()
	    , status:   item.parent().parent().find("td").eq(4).text()
	    , save:     'Editar'
	}
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_nombre').val(datos.nombre);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_cargo').val(datos.cargo);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_telefono').val(datos.telefono);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_correo').val(datos.correo);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_solicitante_contacto_modal2_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_solicitante_contacto_modal2_status').prop('checked', false);
	}
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_save').text( datos.save );
	item.parent().parent().parent().children().removeClass('edit_item');
	item.parent().parent().addClass('edit_item');
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_cancel() {
	var datos = {
	    codigo  :   '0'
	    , nombre:   ''
	    , cargo:    ''
	    , telefono: ''
	    , correo:   ''
	    , status:   ''
	    , save:     'Añadir'
	}
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_nombre').val(datos.nombre);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_cargo').val(datos.cargo);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_telefono').val(datos.telefono);
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_correo').val(datos.correo);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_solicitante_contacto_modal2_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_solicitante_contacto_modal2_status').prop('checked', false);
	}
	$(prefixId + 'coordinacion_solicitante_contacto_modal2_save').text(datos.save);
	$(prefixId+'coordinacion_solicitante_contacto_modal2_tabla tr').removeClass('edit_item');
    }
    function coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_save() {
	var datos = {
	    id:           $(prefixId + 'coordinacion_solicitante_contacto_modal2_codigo').val()
            , persona_id: $(prefixId + 'coordinacion_solicitante_id').val()
	    , nombre:     $(prefixId + 'coordinacion_solicitante_contacto_modal2_nombre').val()
	    , cargo:      $(prefixId + 'coordinacion_solicitante_contacto_modal2_cargo').val()
	    , telefono:   $(prefixId + 'coordinacion_solicitante_contacto_modal2_telefono').val()
	    , correo:     $(prefixId + 'coordinacion_solicitante_contacto_modal2_correo').val()
	    , status:     $(prefixId + 'coordinacion_solicitante_contacto_modal2_status').is(':checked')
	}
	if ( datos.nombre.trim() != '' &&
             datos.persona_id != '0'
           )
        {
	    $.ajax({
	    	type: "POST",
	    	data: datos, 
	    	url: "./ajax/buttons/contacto_coordinacion_buttons.php",
	    	success: function(data) {
                    coor_coordinacion_item_field_coordinaciones_coordinacion_solicitante_modal2_cancel();
                }
	    });
	} else {
            if (datos.nombre.trim() != '') 
	        alert('El Nombre es obligatorio');
            if (datos.persona_id == '0')
                alert('Selecciona a la Persona');
	}
    }
    // ---------- modal modalidad
    function coor_coordinacion_item_field_coordinaciones_coordinacion_modalidad_link() {
	$(prefixId+'coordinacion_modalidad_modal #modalidad-tab-panel2').removeClass('active');
	$(prefixId+'coordinacion_modalidad_modal #modalidad-tab-panel1').addClass('active');
	$(prefixId+'coordinacion_modalidad_modal #modalidad-panel2').removeClass('active');
	$(prefixId+'coordinacion_modalidad_modal #modalidad-panel1').addClass('active');
	
	lista_modalidad = $(prefixId+'coordinacion_modalidad_modal_tabla').DataTable({
	    "processing": true,
	    "serverSide": true,
	    "bDestroy": true,
	    "ajax":{
		url :"./ajax/tables/modalidad_table_modal_item.php", 
		type: "post",
		// data: enviar
	    }
	});
	$(prefixId+'coordinacion_modalidad_modal_tabla_length').parent().parent().css("display","none");	
    }
    function coor_coordinacion_item_field_coordinaciones_modalidad_modal_edit(item) {
	$(prefixId+'coordinacion_modalidad_modal #modalidad-tab-panel1').removeClass('active');
	$(prefixId+'coordinacion_modalidad_modal #modalidad-tab-panel2').addClass('active');
	$(prefixId+'coordinacion_modalidad_modal #modalidad-panel1').removeClass('active');
	$(prefixId+'coordinacion_modalidad_modal #modalidad-panel2').addClass('active');
	var datos = {
	    codigo  :   item.attr('codigo')
	    , nombre:   item.parent().parent().find("td").eq(0).text()
	    , status:    item.parent().parent().find("td").eq(1).text()
	    , save:     'Editar'
	}
	$(prefixId + 'coordinacion_modalidad_modal_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_modalidad_modal_nombre').val(datos.nombre);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_modalidad_modal_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_modalidad_modal_status').prop('checked', false);
	}
	$(prefixId + 'coordinacion_modalidad_modal_save').text( datos.save );
	item.parent().parent().parent().children().removeClass('edit_item');
	item.parent().parent().addClass('edit_item');
    }
    function coor_coordinacion_item_field_coordinaciones_modalidad_modal_cancel() {
	var datos = {
	    codigo  :   '0'
	    , nombre:   ''
	    , status:    ''
	    , save:     'Añadir'
	}
	$(prefixId + 'coordinacion_modalidad_modal_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_modalidad_modal_nombre').val(datos.nombre);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_modalidad_modal_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_modalidad_modal_status').prop('checked', false);
	}
	$(prefixId + 'coordinacion_modalidad_modal_save').text( datos.save );
	$(prefixId+'coordinacion_modalidad_modal_tabla tr').removeClass('edit_item');
    }
    function coor_coordinacion_item_field_coordinaciones_modalidad_modal_save() {
	var datos = {
	    id      :  $(prefixId + 'coordinacion_modalidad_modal_codigo').val()
	    , nombre:  $(prefixId + 'coordinacion_modalidad_modal_nombre').val()
	    , status:  $(prefixId + 'coordinacion_modalidad_modal_status').is(':checked')
	}
        // c(datos);
        if (datos.nombre.trim() != '')
        {
            $.ajax({
	    	type: "POST",
	    	data: datos, 
	    	url: "./ajax/buttons/modalidad_coordinacion_buttons.php",
	    	success: function(data) {
                    coor_coordinacion_item_field_coordinaciones_modalidad_modal_cancel();
                }
	    });
        } else {
            alert('el Nombre es obligatorio');
        }
	
    }
    // ---------- modal tipo2
    function coor_coordinacion_item_field_coordinaciones_coordinacion_tipo2_link() {
	$(prefixId+'coordinacion_tipo2_modal #tipo2-tab-panel2').removeClass('active');
	$(prefixId+'coordinacion_tipo2_modal #tipo2-tab-panel1').addClass('active');
	$(prefixId+'coordinacion_tipo2_modal #tipo2-panel2').removeClass('active');
	$(prefixId+'coordinacion_tipo2_modal #tipo2-panel1').addClass('active');
	
	lista_tipo2 = $(prefixId+'coordinacion_tipo2_modal_tabla').DataTable({
	    "processing": true,
	    "serverSide": true,
	    "bDestroy": true,
	    "ajax":{
		url :"./ajax/tables/tipo2_table_modal_item.php", 
		type: "post",
		// data: enviar
	    }
	});
	$(prefixId+'coordinacion_tipo2_modal_tabla_length').parent().parent().css("display","none");	
    }
    function coor_coordinacion_item_field_coordinaciones_tipo2_modal_edit(item) {
	$(prefixId+'coordinacion_tipo2_modal #tipo2-tab-panel1').removeClass('active');
	$(prefixId+'coordinacion_tipo2_modal #tipo2-tab-panel2').addClass('active');
	$(prefixId+'coordinacion_tipo2_modal #tipo2-panel1').removeClass('active');
	$(prefixId+'coordinacion_tipo2_modal #tipo2-panel2').addClass('active');
	var datos = {
	    codigo  :   item.attr('codigo')
	    , nombre:   item.parent().parent().find("td").eq(0).text()
	    , status:    item.parent().parent().find("td").eq(1).text()
	    , save:     'Editar'
	}
	$(prefixId + 'coordinacion_tipo2_modal_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_tipo2_modal_nombre').val(datos.nombre);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_tipo2_modal_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_tipo2_modal_status').prop('checked', false);
	}
	$(prefixId + 'coordinacion_tipo2_modal_save').text( datos.save );
	item.parent().parent().parent().children().removeClass('edit_item');
	item.parent().parent().addClass('edit_item');        
    }
    function coor_coordinacion_item_field_coordinaciones_tipo2_modal_cancel() {
	var datos = {
	    codigo  :   '0'
	    , nombre:   ''
	    , status:    'Activo'
	    , save:     'Añadir'
	}
	$(prefixId + 'coordinacion_tipo2_modal_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_tipo2_modal_nombre').val(datos.nombre);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_tipo2_modal_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_tipo2_modal_status').prop('checked', false);
	}
	$(prefixId+'coordinacion_tipo2_modal_save').text( datos.save );
	$(prefixId+'coordinacion_tipo2_modal_tabla tr').removeClass('edit_item');        
    }
    function coor_coordinacion_item_field_coordinaciones_tipo2_modal_save() {
	var datos = {
	    id      :  $(prefixId + 'coordinacion_tipo2_modal_codigo').val()
	    , nombre:  $(prefixId + 'coordinacion_tipo2_modal_nombre').val()
	    , status:  $(prefixId + 'coordinacion_tipo2_modal_status').is(':checked')
	}
        // c(datos);
        if (datos.nombre.trim() != '')
        {
            $.ajax({
	    	type: "POST",
	    	data: datos, 
	    	url: "./ajax/buttons/tipo2_coordinacion_buttons.php",
	    	success: function(data) {
                    coor_coordinacion_item_field_coordinaciones_tipo2_modal_cancel();
                }
	    });
        } else {
            alert('el Nombre es obligatorio');
        }        
    }
    // ---------- modal cambio
    function coor_coordinacion_item_field_coordinaciones_coordinacion_cambio_link() {
	$(prefixId+'coordinacion_cambio_modal #cambio-tab-panel2').removeClass('active');
	$(prefixId+'coordinacion_cambio_modal #cambio-tab-panel1').addClass('active');
	$(prefixId+'coordinacion_cambio_modal #cambio-panel2').removeClass('active');
	$(prefixId+'coordinacion_cambio_modal #cambio-panel1').addClass('active');
	
	lista_cambio = $(prefixId+'coordinacion_cambio_modal_tabla').DataTable({
	    "processing": true,
	    "serverSide": true,
	    "bDestroy": true,
	    "ajax":{
		url :"./ajax/tables/cambio_table_modal_item.php", 
		type: "post",
		// data: enviar
	    }
	});
	$(prefixId+'coordinacion_cambio_modal_tabla_length').parent().parent().css("display","none");
    }
    function coor_coordinacion_item_field_coordinaciones_cambio_modal_edit(item) {
	$(prefixId+'coordinacion_cambio_modal #cambio-tab-panel1').removeClass('active');
	$(prefixId+'coordinacion_cambio_modal #cambio-tab-panel2').addClass('active');
	$(prefixId+'coordinacion_cambio_modal #cambio-panel1').removeClass('active');
	$(prefixId+'coordinacion_cambio_modal #cambio-panel2').addClass('active');
	var datos = {
	    codigo  :   item.attr('codigo')
	    , nombre:   item.parent().parent().find("td").eq(0).text()
	    , status:    item.parent().parent().find("td").eq(1).text()
	    , save:     'Editar'
	}
	$(prefixId + 'coordinacion_cambio_modal_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_cambio_modal_nombre').val(datos.nombre);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_cambio_modal_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_cambio_modal_status').prop('checked', false);
	}
	$(prefixId + 'coordinacion_cambio_modal_save').text( datos.save );
	item.parent().parent().parent().children().removeClass('edit_item');
	item.parent().parent().addClass('edit_item');        
    }
    function coor_coordinacion_item_field_coordinaciones_cambio_modal_cancel() {
	var datos = {
	    codigo  :   '0'
	    , nombre:   ''
	    , status:    'Activo'
	    , save:     'Añadir'
	}
	$(prefixId + 'coordinacion_cambio_modal_codigo').val(datos.codigo);
	$(prefixId + 'coordinacion_cambio_modal_nombre').val(datos.nombre);
	if (datos.status=='Activo') {
	    $(prefixId + 'coordinacion_cambio_modal_status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefixId + 'coordinacion_cambio_modal_status').prop('checked', false);
	}
	$(prefixId+'coordinacion_cambio_modal_save').text( datos.save );
	$(prefixId+'coordinacion_cambio_modal_tabla tr').removeClass('edit_item');        
    }
    function coor_coordinacion_item_field_coordinaciones_cambio_modal_save() {
	var datos = {
	    id      :  $(prefixId + 'coordinacion_cambio_modal_codigo').val()
	    , nombre:  $(prefixId + 'coordinacion_cambio_modal_nombre').val()
	    , status:  $(prefixId + 'coordinacion_cambio_modal_status').is(':checked')
	}
        // c(datos);
        if (datos.nombre.trim() != '')
        {
            $.ajax({
	    	type: "POST",
	    	data: datos, 
	    	url: "./ajax/buttons/cambio_coordinacion_buttons.php",
	    	success: function(data) {
                    coor_coordinacion_item_field_coordinaciones_cambio_modal_cancel();
                }
	    });
        } else {
            alert('el Nombre es obligatorio');
        }        
    }
    // ---------- bien
    function coor_coordinacion_item_field_coordinacion_bien_add() {
        var enviar = {
	    cotizacion_id: $(prefixId+'cootizacion_id').val()
            , coordinacion_id: $(prefixId+'coordinacion_id').val()
            , id: $(prefixId+'coordinacion_bien_id').val()
            , modo: $(prefixId+'mode').val()
        }
        // c(enviar);
        if (enviar.id!='' && enviar.id != null) {
            $.ajax({
	        type: "POST",
	        data: enviar,
	        url: './ajax/buttons/bien_coordinacion_item_add.php',
	        success: function(data) {
                    element_simple('./ajax/tables/bien_coordinacion_item_tabla.php',
                                   prefixId+'coordinacion_bien_tabla tbody',
                                   enviar
                                  );
                }
	    });
            coor_coordinacion_item_field_coordinaciones_coordinacion_bien_id();
        } else {
            alert('Seleccionar Bien');
        }        
    }
    function coor_coordinacion_item_field_coordinacion_bien_delete(item) {
        var enviar = {
            coordinacion_id: $(prefixId+'coordinacion_id').val()
            , id: item.attr('codigo')
        }
        // c(enviar);
        delete_simple( './ajax/delete/bien_coodrinacion_item_delete.php'
                       , prefixId+'coordinacion_bien_tabla tbody tr.item_'+enviar.id
                       , enviar )
        coor_coordinacion_item_field_coordinaciones_coordinacion_bien_id();
    }
    // ---------- save
    function coor_coordinacion_item_field_coordinacion_save() {
	var enviar = {
	    id                                 : $(prefixId+'coordinacion_id').val()
            , estado_id                        : $(prefixId+'coordinacion_estado_id').val()
	    , solicitante_id                   : $(prefixId+'coordinacion_solicitante_id').val()
	    , solicitante_contacto_id          : $(prefixId+'coordinacion_solicitante_contacto_id').val()
	    , solicitante_fecha                : $(prefixId+'coordinacion_solicitud_fecha').val()
            , entrega_por_operaciones_fecha    : $(prefixId+'coordinacion_entrega_por_operaciones_fecha').val()
            , entrega_al_cliente_fecha         : $(prefixId+'coordinacion_entrega_al_cliente_fecha').val()
	    , cliente_id                       : $(prefixId+'coordinacion_cliente_id').val()
	    , sucursal                         : $(prefixId+'coordinacion_sucursal').val()
	    , modalidad_id                     : $(prefixId+'coordinacion_modalidad_id').val()
            , tipo2_id                         : $(prefixId+'coordinacion_tipo2_id').val()
            , cambio_id                        : $(prefixId+'coordinacion_cambio_id').val()
	    , tipo_id_1                        : $(prefixId+'coordinacion_tipo_1').is(':checked')
	    , tipo_id_2                        : $(prefixId+'coordinacion_tipo_2').is(':checked')
	    , tipo_id_3                        : $(prefixId+'coordinacion_tipo_3').is(':checked')
	    , observacion                      : $(prefixId+'coordinacion_observacion').val()
            // , bien_id                          : $(prefixId+'coordinacion_bien_id').val()
            // , bien_monto                       : $(prefixId+'coordinacion_bien_monto').val()
            // , bien_moneda_id                   : $(prefixId+'coordinacion_bien_moneda_id').val()
	}
        c(enviar);
	$.ajax({
	    type: 'POST',
	    data: enviar,
	    url: './ajax/buttons/coordinacion_coordinacion_buttons.php',
	    success: function(data) {
		$('#tab-panel1').removeClass('active');
		$('#tab-panel2').addClass('active');
		$('#panel1').removeClass('active');
		$('#panel2').addClass('active');
                lista_coordinaciones.draw();
	    }
	});
    }
    // ---------- cambiar correlativo
    function coor_coordinacion_item_field_codigo_correlativo_trigger(item) {
        $(prefixId+'codigo_correlativo_modal_texto').val(item.text());
    }
    function coor_coordinacion_item_field_codigo_correlativo_modal_save() {
        var enviar = {
            coordinacion_id: $(prefixId+'coordinacion_id').val(),
            texto: $(prefixId+'codigo_correlativo_modal_texto').val()
        }
        // c(enviar);

        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './ajax/buttons/coordinacion_item_coordinacion_correlativo_change.php',
	    success: function(data) {
                if (data == 'errorCodigo'){
                    alert('El codigo ya existe!');
                } else {
                    $(prefixId+'codigo_correlativo_trigger').text(enviar.texto);
                    lista_coordinaciones.draw();
                }
            }
	});
        
        
        
    }
    
    // ------------------------------------------------------ reutilizables
    function none_simple(path, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {}
	});
    }
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
    function tr_td_simple( path, componente, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
                if (enviar.id=='0') {
                    $(componente + ' tbody').append(data);
                } else {
                    $(componente+' tbody .item_' + enviar.id).html(data);
                }
	    }
	});
    }
    function tr_td_simple_add( path, componente, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
                $(componente + ' tbody').append(data);
	    }
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
                        clearInterval(myVar);
		    }, 2100 );
		}
	    }
	});
    }
});
