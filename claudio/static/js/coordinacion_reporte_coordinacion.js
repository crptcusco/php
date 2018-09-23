$(document).ready(function() {
    var option_empty  ='<option value=""></option>';
    var prefixId_coordinacion = '#coor_reporte_coordinacion_coordinacion_field_';
    var prefixClass_coordinacion = '.coor_reporte_coordinacion_coordinacion_field_';
    var lista_coordinacion = '';
    var lista_inspeccion_observaciones = ''
    var definiciones_tipo = '';
    // --------------------------------------------------------------- load
    coor_reporte_coordinacion_coordinacion_field_tabla();
    // ------------------------------------------------------------ eventos
    $(prefixId_coordinacion+'tabla_wrapper .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
	var v = $(this).val();

        if (event.which == 13) {            
            lista_coordinacion.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }
    });
    $(prefixId_coordinacion+'tabla_wrapper .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');  
	var v =$(this).val();
        lista_coordinacion.columns(i).search(v).draw();
        if (v=='0') {
            $(this).css('background-color','transparent');
        } else {
            $(this).css('background-color','#D3FFE4');
        }
    });
    $(prefixId_coordinacion+'tabla_wrapper .autocomplete-input-text').on('keyup', function () {
        coor_reporte_coordinacion_coordinacion_field_autoCompletado($(this));
    });
    $(prefixId_coordinacion+'tabla_wrapper').on('click', 'ul.pagination a', function () {
        $('html, body').animate({ scrollTop: 0 }, 0);
    });
    $(prefixId_coordinacion+'tabla_search').on('click', function () {
        lista_coordinacion.draw();
    });
    // ----------------pdf
    $(prefixId_coordinacion+'tabla').on('click', '.hoja', function () {
        coor_reporte_coordinacion_coordinacion_field_preview($(this));
    });
    // ---------------------------------------------------------- funciones
    function coor_reporte_coordinacion_coordinacion_field_tabla() {
        lista_coordinacion = $(prefixId_coordinacion+'tabla').DataTable({
	    "processing" : true,
	    "serverSide" : true,
            "bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength"  : 25,
            "order"       : [ 0, 'desc' ],
            "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 9,12,16 ] } ],
	    "ajax"        : {
		url :"./ajax/tables/coordinacion_reporte_coordinacion_listado_table.php", 
		type: "post",
	    },
	});
        lista_coordinacion_colvis = new $.fn.dataTable.ColVis( lista_coordinacion, {
	    buttonText: '<i class="step fi-wrench size-21"></i>',
        });
        $(lista_coordinacion_colvis.button()).prependTo(prefixId_coordinacion+'tabla_cols');
        $(prefixId_coordinacion+'tabla_length').css("display","none");
        $(prefixId_coordinacion+'tabla_filter').css("display","none");
    }
    function coor_reporte_coordinacion_coordinacion_field_autoCompletado(component) {
        var list = [];
        var datos = {
            code  : component.attr('code')
            , text: component.val()
        }
 	$.ajax({
	    type: "POST",
	    url: "./ajax/select/coordinacion_reporte_inicial_auto_completado.php",
	    data: datos, 
	    success: function(data) {
		list = data.split("!!-!!");
                component.autocomplete({source: list});
	    }
	});
    }

    // ---------------- pdf
    function coor_reporte_coordinacion_coordinacion_field_preview(item) {
        var coordinacion_id = item.attr('coordinacion_id');
        
        var fileName = 'pdf.php?coordinacion_id='+coordinacion_id;
        // c(fileName);
        var object = "<object data=\"{FileName}\" type=\"application/pdf\" width=\"100%\" height=\"600px\">";
        object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
        object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
        object += "</object>";
        object = object.replace(/{FileName}/g, "./" + fileName);
        $(prefixId_coordinacion+'modal_preview_pdf').html(object);
    }
    // ------------------------------------------------------ reutilizables
    function none_simple(path, enviar) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {}
	});
    }
    function select_simple(path, componente, enviar) {
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
    function element_simple(path, componente, enviar) {
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
    function tr_td_simple(path, componente, enviar) {
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
    function delete_simple(path, componente, enviar) {
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
