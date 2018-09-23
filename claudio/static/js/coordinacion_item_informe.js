$(document).ready(function() {
    
    var option_empty='<option value=""></option>';
    var prefixId = '#coor_coordinacion_item_field_';
    var prefixClass = '.coor_coordinacion_item_field_';
    // --------------------------------------------------------------- load    
    coor_coordinacion_item_field_informe_fechas_tabla();
    coor_coordinacion_item_field_informe_documentacion_tabla();
    coor_coordinacion_item_field_informe_firma_tabla();
    coor_coordinacion_item_field_informe_fechas_modal_tipo();
    
    // ------------------------------------------------------------ eventos
    $(prefixId+'informe_save').on( 'click', function () {
        coor_coordinacion_item_field_informe_save()
    });
    // fechas entregas
    $(prefixId+'informe_fechas_add').on( 'click', function () {
	coor_coordinacion_item_field_informe_fechas_add();
    });
    $(prefixId+'informe_fechas_tabla').on("click", ".edit", function(e) {
        coor_coordinacion_item_field_informe_fechas_edit($(this).parent().parent());
    });
    $('body').on("click", prefixId+'informe_fechas_modal_save', function(e) {
        coor_coordinacion_item_field_informe_fechas_modal_save();
    });
    $(prefixId+'informe_fechas_tabla').on("click", ".delete", function(e) {
        coor_coordinacion_item_field_informe_fechas_delete($(this).parent().parent());
    });
    // documenatacion
    $('body').on("click", prefixId+'informe_documentacion_add', function(e) {
        coor_coordinacion_item_field_informe_documentacion_add();
    });
    $(prefixId+'informe_documentacion_tabla').on("click", ".edit", function(e) {
        coor_coordinacion_item_field_informe_documentacion_edit($(this).parent().parent());
    });
    $(prefixId+'informe_documentacion_tabla').on("click", ".copy", function(e) {
        coor_coordinacion_item_field_informe_documentacion_copy($(this));
    });
    $('body').on("click", prefixId+'informe_documentacion_modal_save', function(e) {
        coor_coordinacion_item_field_informe_documentacion_modal_save();
    });
    $(prefixId+'informe_documentacion_tabla').on("click", ".delete", function(e) {
        coor_coordinacion_item_field_informe_documentacion_delete($(this).parent().parent());
    });
    $('body').on("click", prefixId+'informe_documentacion_observacion_edit', function(e) {
        coor_coordinacion_item_field_informe_documentacion_observacion_edit();
    });
    $('body').on("click", prefixId+'informe_documentacion_observacion_modal_save', function(e) {
        coor_coordinacion_item_field_informe_documentacion_observacion_modal_save();
    });
    // firma
    $(prefixId+'informe_firma_add').on( 'click', function () {
        coor_coordinacion_item_field_informe_firma_add();
    });
    $(prefixId+'informe_firma_tabla').on("click", ".delete", function(e) {
        coor_coordinacion_item_field_informe_firma_delete($(this).parent().parent());
    });
    $(prefixId+'informe_firma_modal_save').on( 'click', function () {
        coor_coordinacion_item_field_informe_firma_modal_save();
    });
    // ---------------------------------------------------------- funciones
    function coor_coordinacion_item_field_informe_save() {
        var datos = {
            informe_id: $(prefixId+'informe_id').val()
            , ruta: $(prefixId+'informe_ruta').val()
        }
        // c(datos);
	$.ajax({
	    type: "POST",
	    data: datos,
	    url: './ajax/buttons/save_informe_coordinacion_item_buttons.php',
	    success: function(data) {
	    }
	});
    }
    // fechas de entrega
    function coor_coordinacion_item_field_informe_fechas_tabla() {
	var enviar = {
	    informe_id: $(prefixId+'informe_id').val()
	    , rol_user: $(prefixId+'rol').val()
            , mode: $(prefixId+'mode').val()
	}
        if ($(prefixId+'coordinacion_id').val() != '' ) {
	    element_simple( './ajax/tables/fechasEntrega_informe_item_table.php'
			    , prefixId+'informe_fechas_tabla tbody'
			    , enviar 
		          );
        }
    }
    function coor_coordinacion_item_field_informe_fechas_add() {
	var datos = {
            id               : 0
            , fecha          : ''
            , informe_tipo_id: 1
            , save           : 'Añadir'
        }
        // c(datos);
        $(prefixId+'informe_fechas_modal_id').val(datos.id);
        $(prefixId+'informe_fechas_modal_fecha').val(datos.fecha);
        $(prefixId+'informe_fechas_modal_tipo_informe_id')
            .val(datos.informe_tipo_id)
            .trigger('chosen:updated');
        $(prefixId+'informe_fechas_modal_save').text(datos.save);
    }
    function coor_coordinacion_item_field_informe_fechas_edit(item) {
	var datos = {
            id               : item.attr('entrega_id')
            , fecha          : item.find("td").eq(0).text()
            , informe_tipo_id: item.find("td").eq(1).attr('tipo_id')
            , save           : 'Editar'
        }
        $(prefixId+'informe_fechas_modal_id').val(datos.id)
        $(prefixId+'informe_fechas_modal_fecha').val(datos.fecha)
        $(prefixId+'informe_fechas_modal_tipo_informe_id')
            .val(datos.informe_tipo_id)
            .trigger('chosen:updated');
        $(prefixId+'informe_fechas_modal_save').text(datos.save)    
    }
    function coor_coordinacion_item_field_informe_fechas_modal_tipo() {
        if ($(prefixId+'rol').val() == 'Coordinador' && $(prefixId+'coordinacion_id').val() != '') {
            var enviar = {id: $(prefixId+'informe_fechas_modal_tipo_informe_id').val()}
	    select_simple( './ajax/select/tipoInforme_fechasDeEntrega_informe_item_select.php'
                           , prefixId+'informe_fechas_modal_tipo_informe_id'
                           , enviar );
        }
    }
    function coor_coordinacion_item_field_informe_fechas_modal_save() {
	var datos = {
            id               : $(prefixId+'informe_fechas_modal_id').val()
            , informe_id     : $(prefixId+'informe_id').val()
            , fecha          : $(prefixId+'informe_fechas_modal_fecha').val()
            , informe_tipo_id: $(prefixId+'informe_fechas_modal_tipo_informe_id').val()
            , rol_user: $(prefixId+'rol').val()
            , mode: $(prefixId+'mode').val()
        }
        // c(datos);
        tr_td_simple( './ajax/buttons/save_fechaDeEntrega_imforme_item_buttons.php'
                      , prefixId+'informe_fechas_tabla'
                      , datos
                    );

    }
    function coor_coordinacion_item_field_informe_fechas_delete(item) {
        var datos = {
            id: item.attr('entrega_id')
        }
        delete_simple(
            './ajax/delete/fechasDeEntrega_informe_item_delete.php'
            , prefixId + 'informe_fechas_tabla .item_'+datos.id
            , datos
        );
    }
    // documentacion
    function coor_coordinacion_item_field_informe_documentacion_tabla() {
	var enviar = {
	    informe_id: $(prefixId+'informe_id').val()
	    , rol_user: $(prefixId+'rol').val()
            , mode: $(prefixId+'mode').val()
	}
        if ( $(prefixId+'coordinacion_id').val() != '' ) {
	    element_simple( './ajax/tables/documentacion_informe_item_table.php'
			    , prefixId+'informe_documentacion_tabla tbody'
			    , enviar 
		          );
        }
    }
    function coor_coordinacion_item_field_informe_documentacion_add() {
	var datos = {
            id            : '0'
            , ruta        : ''
            , descripcion : ''
            , save        : 'Añadir'
        }
        $(prefixId+'informe_documentacion_modal_id').val(datos.id)
        $(prefixId+'informe_documentacion_modal_ruta').val(datos.ruta)
        $(prefixId+'informe_documentacion_modal_descripcion').val(datos.descripcion)
        $(prefixId+'informe_documentacion_modal_save').text(datos.save)        
    }
    function coor_coordinacion_item_field_informe_documentacion_edit(item) {
	var datos = {
            id            : item.attr('documentacion_id')
            , ruta        : item.find("td a").eq(0).attr('href')
            , descripcion : item.find("td").eq(1).text()
            , save        : 'Editar'
        }
        $(prefixId+'informe_documentacion_modal_id').val(datos.id)
        $(prefixId+'informe_documentacion_modal_ruta').val(datos.ruta)
        $(prefixId+'informe_documentacion_modal_descripcion').val(datos.descripcion)
        $(prefixId+'informe_documentacion_modal_save').text(datos.save)
    }
    function coor_coordinacion_item_field_informe_documentacion_copy(item) {
        $(prefixId+'informe_documentacion_enlace_modal_texto').val(item.attr('title'));
    }
    function coor_coordinacion_item_field_informe_documentacion_delete(item) {
        var datos = {
            id: item.attr('documentacion_id')
        }
        delete_simple(
            './ajax/delete/documentacion_informe_item_delete.php'
            , prefixId + 'informe_documentacion_tabla .item_'+datos.id
            , datos
        );        
    }
    function coor_coordinacion_item_field_informe_documentacion_modal_save() {
	var datos = {
            id            : $(prefixId+'informe_documentacion_modal_id').val()
            , informe_id     : $(prefixId+'informe_id').val()
            , ruta        : $(prefixId+'informe_documentacion_modal_ruta').val()
            , descripcion : $(prefixId+'informe_documentacion_modal_descripcion').val()
            , rol_user: $(prefixId+'rol').val()
            , mode: $(prefixId+'mode').val()            

        }
        // c(datos);
        tr_td_simple( './ajax/buttons/save_documentacion_informe_item_buttons.php'
                      , prefixId+'informe_documentacion_tabla'
                      , datos
                    );
    }
    function coor_coordinacion_item_field_informe_documentacion_observacion_edit() {
        var datos = {
            observacion: $(prefixId+'informe_documentacion_observacion').text()
        }
        $(prefixId+'informe_documentacion_observacion_modal_texto')
            .val(datos.observacion);
    }
    function coor_coordinacion_item_field_informe_documentacion_observacion_modal_save() {
        var datos = {
            informe_id: $(prefixId+'informe_id').val()
            , observacion: $(prefixId+'informe_documentacion_observacion_modal_texto').val()
        }
        element_simple(
            './ajax/buttons/save_observacion_documentacion_informe_item_buttons.php'
            , prefixId+'informe_documentacion_observacion'
            , datos
        );
    }
    // firma
    function coor_coordinacion_item_field_informe_firma_tabla() {
	var enviar = {
	    informe_id: $(prefixId+'informe_id').val()
	    , rol_user: $(prefixId+'rol').val()
            , mode: $(prefixId+'mode').val()
	}
        if ( $(prefixId+'coordinacion_id').val() != '' ) {
	    element_simple( './ajax/tables/firma_informe_item_table.php'
			    , prefixId+'informe_firma_tabla tbody'
			    , enviar 
		          );
        }
    }
    function coor_coordinacion_item_field_informe_firma_add() {
        var enviar = {
            id: 0
            , informe_id: $(prefixId+'informe_id').val()
        }
	select_simple( './ajax/select/firmanteNoAnadido_informe_item_select.php'
                       , prefixId+'informe_firma_modal_firmante_id'
                       , enviar );        
    }
    function coor_coordinacion_item_field_informe_firma_delete(item) {
        var datos = {
            id: item.attr('firma_id')
        }
        c(datos);
        delete_simple(
            './ajax/delete/firma_informe_item_delete.php'
            , prefixId + 'informe_firma_tabla .item_'+datos.id
            , datos
        );
    }
    function coor_coordinacion_item_field_informe_firma_modal_save() {
        var datos = {
            id            : 0
            , informe_id  : $(prefixId+'informe_id').val()
            , firmante_id : $(prefixId+'informe_firma_modal_firmante_id').val()

            , rol_user: $(prefixId+'rol').val()
            , mode: $(prefixId+'mode').val()            
        }
        tr_td_simple(
            './ajax/buttons/save_firma_informe_item_buttons.php'
            , prefixId+'informe_firma_tabla'
            , datos
        );

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
		    }, 2100 );
		}
	    }
	});
    }
});
