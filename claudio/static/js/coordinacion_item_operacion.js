$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#coor_coordinacion_item_field_';
    var prefixClass = '.coor_coordinacion_item_field_';
    var lista_inspeccion_observaciones = '';
    // --------------------------------------------------------------- load
    coor_coordinacion_item_field_operaciones_inspeccion_modal_departamento_id();
    coor_coordinacion_item_field_operaciones_incidencias();
    // ------------------------------------------------------------ eventos
    $(prefixId+'operaciones_save').on( 'click', function () {
        coor_coordinacion_item_field_operaciones_save();
    });
    // inspeccion
    $(prefixId+'operaciones_inspeccion_edit').on( 'click', function () {
        coor_coordinacion_item_field_operaciones_inspeccion_edit();
    });
    $("body").on("change", prefixId+"operaciones_inspeccion_modal_persona_rol_id", function(e) {
        coor_coordinacion_item_field_operaciones_inspeccion_persona_id(
            $(this).val(),
            $(prefixId+'operaciones_inspeccion_modal_persona_id').val()
        );
	e.preventDefault();
    });    
    $("body").on("change", prefixId+"operaciones_inspeccion_modal_departamento_id", function(e) {
	$(prefixId+'operaciones_inspeccion_modal_provincia_id').val('1');
	coor_coordinacion_item_field_operaciones_inspeccion_modal_provincia_id();
        $(prefixId+'operaciones_inspeccion_modal_distrito_id').val('1');
        coor_coordinacion_item_field_operaciones_inspeccion_modal_distrito_id();
    });
    $("body").on("change", prefixId+"operaciones_inspeccion_modal_provincia_id", function(e) {
        $(prefixId+'operaciones_inspeccion_modal_distrito_id').val('1');
        coor_coordinacion_item_field_operaciones_inspeccion_modal_distrito_id();
    });
    $(prefixId+'operaciones_inspeccion_modal_save').on('click', function () {
        coor_coordinacion_item_field_operaciones_inspeccion_modal_save();
    });
    $(prefixId+'operaciones_inspeccion_incidente_add').on('click', function () {
        coor_coordinacion_item_field_operaciones_inspeccion_incidente_add();
    });
    $(prefixId+'operaciones_inspeccion_modal_est_mostrar').on('click', function () {
        if ( $(this).is(':checked') == true ) {
            $(prefixId+'operaciones_inspeccion_modal_rea_mostrar').prop('checked', false);
        }
    });
    $(prefixId+'operaciones_inspeccion_modal_rea_mostrar').on('click', function () {
        if ( $(this).is(':checked') == true ) {
            $(prefixId+'operaciones_inspeccion_modal_est_mostrar').prop('checked', false);
        }
    });
    //pdf
    $(prefixId+'coordinacion_hoja').on('click', function () {
        // coor_coordinacion_item_field_coordinacion_hoja
        coor_coordinacion_item_field_operaciones_preview($(this));
    });
    // ---------------------------------------------------------- funciones
    function coor_coordinacion_item_field_operaciones_save() {
        var enviar = {
            id: $(prefixId+'informe_id').val()
            , consultor_id: $(prefixId+'operaciones_consultor_id').val()
        }
	$.ajax({
	    type: 'POST',
	    data: enviar,
	    url: './ajax/buttons/save_item_operaciones_buttons.php',
	    success: function(data) {}
	});
    }
    // inspecion
    function coor_coordinacion_item_field_operaciones_incidencias() {
        var enviar = {
            inspeccion_id: $(prefixId+'inspeccion_id').val()
        }
        // c(enviar);
        lista_inspeccion_observaciones = $(prefixId+'operaciones_incidencias_table').DataTable({
	    "processing"  : true,
	    "serverSide"  : true,
            "autoWidth": false,
            
            "bDestroy": true,
            "pageLength": 3,
            "order": [ 0, 'desc' ],
	    "ajax":{  
		url :"./ajax/tables/coordinacion_item_operacion_incidencias_table.php",
		type: "post",
                data: enviar,
	    },
	    // "language": {
	    // 	url: '../../librerias.v2/vendor/data_table/Spanish.json'
	    // }	    
	});
        $(prefixId+'operaciones_incidencias_table_length').css("display","none");
	$(prefixId+'operaciones_incidencias_table_filter').css("display","none");
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_edit() {
        var item  = $(prefixId+'operaciones_inspeccion_table tbody tr').eq(0);
        var item3 = $(prefixId+'operaciones_inspeccion_table tbody tr').eq(3);
        var datos = {
            id                      : $(prefixId+'inspeccion_id').val()
            , perito_id             : item.find("td").eq(0).attr('perito_id')
            , inspector_id          : item.find("td").eq(0).attr('inspector_id')
            , contactos             : item.find("td").eq(1).text()
            , fecha                 : item.find("td").eq(2).text()
            , hora_estimada_ini_ho  : item.find("td").eq(3).attr('est_ini_ho')
            , hora_estimada_ini_mi  : item.find("td").eq(3).attr('est_ini_mi')
            , hora_estimada_ini_me  : item.find("td").eq(3).attr('est_ini_me')
            , hora_estimada_end_ho  : item.find("td").eq(3).attr('est_end_ho')
            , hora_estimada_end_mi  : item.find("td").eq(3).attr('est_end_mi')
            , hora_estimada_end_me  : item.find("td").eq(3).attr('est_end_me')
            , hora_estimada_mostrar : item.find("td").eq(3).attr('est_mostrar')
            , hora_real_ho          : item.find("td").eq(3).attr('rea_ho')
            , hora_real_mi          : item.find("td").eq(3).attr('rea_mi')
            , hora_real_me          : item.find("td").eq(3).attr('rea_me')            
            , hora_real_mostrar     : item.find("td").eq(3).attr('rea_mostrar')            
            , departamento_id       :  item.find("td").eq(4).attr('departamento_id')
            , provincia_id          : item.find("td").eq(4).attr('provincia_id')
            , distrito_id           : item.find("td").eq(4).attr('distrito_id')
            , direccion             : item.find("td").eq(4).find("span.datos").eq(0).text()
            , observacion           : item3.find("td").eq(0).find("span.observacion").eq(0).text()
        }
        // c(datos);
        coor_coordinacion_item_field_operaciones_inspeccion_perito_id(datos.perito_id);
        coor_coordinacion_item_field_operaciones_inspeccion_control_id(datos.inspector_id);
        $(prefixId+'operaciones_inspeccion_modal_contactos').val(datos.contactos);
        $(prefixId+'operaciones_inspeccion_modal_fecha').val(datos.fecha);
        $(prefixId+'operaciones_inspeccion_modal_est_ini_ho').val(datos.hora_estimada_ini_ho);
        $(prefixId+'operaciones_inspeccion_modal_est_ini_mi').val(datos.hora_estimada_ini_mi);
        $(prefixId+'operaciones_inspeccion_modal_est_ini_me').val(datos.hora_estimada_ini_me);
        if (datos.hora_estimada_mostrar == '1') {
            $(prefixId+'operaciones_inspeccion_modal_est_mostrar').prop('checked', true);
        } else if (datos.hora_estimada_mostrar == '0') {
            $(prefixId+'operaciones_inspeccion_modal_est_mostrar').prop('checked', false);
        }

        $(prefixId+'operaciones_inspeccion_modal_est_end_ho').val(datos.hora_estimada_end_ho);
        $(prefixId+'operaciones_inspeccion_modal_est_end_mi').val(datos.hora_estimada_end_mi);
        $(prefixId+'operaciones_inspeccion_modal_est_end_me').val(datos.hora_estimada_end_me);

        $(prefixId+'operaciones_inspeccion_modal_rea_ho').val(datos.hora_real_ho);
        $(prefixId+'operaciones_inspeccion_modal_rea_mi').val(datos.hora_real_mi);
        $(prefixId+'operaciones_inspeccion_modal_rea_me').val(datos.hora_real_me);
        if (datos.hora_real_mostrar == '1') {
            $(prefixId+'operaciones_inspeccion_modal_rea_mostrar').prop('checked', true);
        } else if (datos.hora_real_mostrar == '0') {
            $(prefixId+'operaciones_inspeccion_modal_rea_mostrar').prop('checked', false);
        }

        // coor_coordinacion_item_field_
        $(prefixId+'operaciones_inspeccion_modal_departamento_id')
            .val(datos.departamento_id)
            .trigger('chosen:updated');
        ;
        $(prefixId+'operaciones_inspeccion_modal_provincia_id')
            .html('<option value="'+datos.provincia_id+'"></option>');
        coor_coordinacion_item_field_operaciones_inspeccion_modal_provincia_id();

        $(prefixId+'operaciones_inspeccion_modal_distrito_id')
            .html('<option value="'+datos.distrito_id+'"></option>');
        coor_coordinacion_item_field_operaciones_inspeccion_modal_distrito_id();
        $(prefixId+'operaciones_inspeccion_modal_direccion').val(datos.direccion);

        $(prefixId+'operaciones_inspeccion_modal_observacion').val(datos.observacion);
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_perito_id(id) {
        var enviar = {
            persona_rol_id: 1
            , persona_id: id
        }
        select_simple( './ajax/select/persona_inspeccion_operaciones_coordinacion_item.php'
                       , prefixId+'operaciones_inspeccion_modal_perito_id'
                       , enviar
                     );
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_control_id(id) {
        var enviar = {
            persona_rol_id: 2
            , persona_id: id
        }
        select_simple( './ajax/select/persona_inspeccion_operaciones_coordinacion_item.php'
                       , prefixId+'operaciones_inspeccion_modal_inspector_id'
                       , enviar
                     );
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_modal_departamento_id() {
	var enviar = {
	    departamento_id: $(prefixId+'operaciones_inspeccion_modal_departamento_id').val()
	}
        if ($(prefixId+'coordinacion_id').val() != '' ) {
	    select_simple( '../cotizacion/ajax/combos/bienes_inmueble_departamento_combo.php'
                           , prefixId+'operaciones_inspeccion_modal_departamento_id'
                           , enviar );
        }
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_modal_provincia_id() {
	var enviar = {
	    departamento_id: $(prefixId+'operaciones_inspeccion_modal_departamento_id').val()
	    , provincia_id: $(prefixId+'operaciones_inspeccion_modal_provincia_id').val()
	}
	select_simple( '../cotizacion/ajax/combos/bienes_inmueble_provincia_combo.php'
                       , prefixId+'operaciones_inspeccion_modal_provincia_id'
                       , enviar
                     );
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_modal_distrito_id() {
	var enviar = {
	    departamento_id: $(prefixId+'operaciones_inspeccion_modal_departamento_id').val()
	    , provincia_id: $(prefixId+'operaciones_inspeccion_modal_provincia_id').val()
	    , distrito_id: $(prefixId+'operaciones_inspeccion_modal_distrito_id').val()
	}
	select_simple( '../cotizacion/ajax/combos/bienes_inmueble_distrito_combo.php'
                       , prefixId+'operaciones_inspeccion_modal_distrito_id'
                       , enviar
                     );
    }
    function coor_coordinacion_item_field_operaciones_inspeccion_modal_save() {
        var datos = {
            id                      : $(prefixId+'inspeccion_id').val()
            , rol_user_id           : $(prefixId+'rol').val()
            , perito_id             : $(prefixId+'operaciones_inspeccion_modal_perito_id').val()
            , inspector_id          : $(prefixId+'operaciones_inspeccion_modal_inspector_id').val()
            , contactos             : $(prefixId+'operaciones_inspeccion_modal_contactos').val()
            , fecha                 : $(prefixId+'operaciones_inspeccion_modal_fecha').val()
            , hora_estimada_ini_ho  : $(prefixId+'operaciones_inspeccion_modal_est_ini_ho').val()
            , hora_estimada_ini_mi  : $(prefixId+'operaciones_inspeccion_modal_est_ini_mi').val()
            , hora_estimada_ini_me  : $(prefixId+'operaciones_inspeccion_modal_est_ini_me').val()
            , hora_estimada_end_ho  : $(prefixId+'operaciones_inspeccion_modal_est_end_ho').val()
            , hora_estimada_end_mi  : $(prefixId+'operaciones_inspeccion_modal_est_end_mi').val()
            , hora_estimada_end_me  : $(prefixId+'operaciones_inspeccion_modal_est_end_me').val()
            , hora_estimada_mostrar : $(prefixId+'operaciones_inspeccion_modal_est_mostrar').is(':checked')
            , hora_real_ho          : $(prefixId+'operaciones_inspeccion_modal_rea_ho').val()
            , hora_real_mi          : $(prefixId+'operaciones_inspeccion_modal_rea_mi').val()
            , hora_real_me          : $(prefixId+'operaciones_inspeccion_modal_rea_me').val()
            , hora_real_mostrar     : $(prefixId+'operaciones_inspeccion_modal_rea_mostrar').is(':checked')
            , departamento_id       : $(prefixId+'operaciones_inspeccion_modal_departamento_id').val()
            , provincia_id          : $(prefixId+'operaciones_inspeccion_modal_provincia_id').val()
            , distrito_id           : $(prefixId+'operaciones_inspeccion_modal_distrito_id').val()
            , direccion             : $(prefixId+'operaciones_inspeccion_modal_direccion').val()
            , observacion           : $(prefixId+'operaciones_inspeccion_modal_observacion').val()            
        }
        // c(datos);
	$.ajax({
	    type: "POST",
	    data: datos,
	    url: './ajax/buttons/inspeccion_modal_inspeccion_coordinacion_item.php',
	    success: function(data) {
                // c(data);
                $(prefixId+'operaciones_inspeccion_table').html(data);
	    }
	});
    }
    //
    function coor_coordinacion_item_field_operaciones_preview(item) {
        var coordinacion_id = item.attr('coordinacion_id');
        
        var fileName = 'pdf.php?coordinacion_id='+coordinacion_id;
        // c(fileName);
        var object = "<object data=\"{FileName}\" type=\"application/pdf\" width=\"100%\" height=\"600px\">";
        object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
        object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
        object += "</object>";
        object = object.replace(/{FileName}/g, "./" + fileName);
        $(prefixId+'modal_preview_pdf').html(object);
    }
    //
    function coor_coordinacion_item_field_operaciones_inspeccion_incidente_add() {
        var datos = {
            inspeccion_id: $(prefixId + 'inspeccion_id').val()
            , texto     : $(prefixId + 'operaciones_inspeccion_incidente_text').val()
        }
        // c(datos);
        if (datos.texto.trim() !='') {
            none_simple(
                './ajax/buttons/coordinacion_item_operaciones_incidente_add_button.php'
                , datos
            );
            $(prefixId + 'operaciones_inspeccion_incidente_text').val('')
            coor_coordinacion_item_field_operaciones_incidencias();
        } else {
            alert('Ingrese Observación');
        }        
    }
    // ------------------------------------------------------ reutilizables
    function none_simple( path, enviar ) {
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
