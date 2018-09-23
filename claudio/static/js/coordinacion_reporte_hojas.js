var timestamp = 0;
var lista_hojas = '';
var lista_hojas_colvis = '';

function cargar_push() {
    // console.log(timestamp);
    var enviar = {
        'timestamp': timestamp
    }   
    $.ajax({
        async:true, 
        type: "POST",
        url: "./ajax/httpush.php",
        data: enviar,
        dataType:"html",
        success: function(data) {            
            timestamp2 = data.trim();
            if(timestamp != timestamp2) {
                timestamp = timestamp2;
                cargar_data();
            }
            setTimeout('cargar_push()',6000);
        }
    });
}
function cargar_data() {
    $.ajax({
        async:true, 
        type: "POST",
        url: "./ajax/httpush_data.php",
        data: "",
        dataType:"html",
        success: function(data) {
            $('.sin-imprimir b').html(data);
            lista_hojas.draw();
        }
    });
}
$(document).ready(function() {
    var option_empty       = '<option value=""></option>';
    var prefixId_hojas     = '#coor_reporte_coordinacion_hojas_field_';
    var prefixClass_hojas  = '.coor_reporte_coordinacion_hojas_field_';


    // --------------------------------------------------------------- load
    coor_reporte_coordinacion_hojas_field_tabla();
    cargar_push();
    // ------------------------------------------------------------ eventos
    $(prefixId_hojas+'tabla_wrapper .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
	var v = $(this).val();

        if (event.which == 13) {
            lista_hojas.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }

        
    });
    $(prefixId_hojas+'tabla_wrapper .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');  
	var v =$(this).val();
        lista_hojas.columns(i).search(v).draw();
        if (v=='0') {
            $(this).css('background-color','transparent');
        } else {
            $(this).css('background-color','#D3FFE4');
        }
    });
    $(prefixId_hojas+'tabla_wrapper .autocomplete-input-text').on('keyup', function () {
        coor_reporte_coordinacion_hojas_field_autoCompletado($(this));
    });
    $(prefixId_hojas+'tabla_wrapper').on('click', 'ul.pagination a', function () {
        $('html, body').animate({ scrollTop: 0 }, 0);
    });    
    $(prefixId_hojas+'tabla_search').on('click', function () {
        lista_hojas.draw();
    });
    $(prefixId_hojas+'tabla_wrapper').on('click', '.hoja', function () {
        coor_reporte_coordinacion_hojas_field_hoja_preview($(this));
    });
    // impreso
    $(prefixId_hojas+'modal_preview_impreso_si').on('click', function () {
        if ( $(this).is(':checked') == true ) {
            $(prefixId_hojas+'modal_preview_impreso_no').prop('checked', false);
            coor_reporte_coordinacion_hojas_field_hoja_impreso(1);
            // lista_hojas.draw();
        } else {
            $(prefixId_hojas+'modal_preview_impreso_si').prop('checked', true);
        }
    });
    $(prefixId_hojas+'modal_preview_impreso_no').on('click', function () {
        if ( $(this).is(':checked') == true ) {
            $(prefixId_hojas+'modal_preview_impreso_si').prop('checked', false);
            coor_reporte_coordinacion_hojas_field_hoja_impreso(0);
            // lista_hojas.draw();
        } else {
            $(prefixId_hojas+'modal_preview_impreso_no').prop('checked', true);
        }
    });
    // ---------------------------------------------------------- funciones
    function coor_reporte_coordinacion_hojas_field_tabla() {
        lista_hojas = $(prefixId_hojas+'tabla').DataTable({
	    "processing" : true,
	    "serverSide" : true,
            //"bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength" : 25,
            "order"      : [ 0, 'desc' ],
            "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ] } ],
	    "ajax": {
		url :"./ajax/tables/coordinacion_reporte_hojas_listado_table.php", 
		type: "post",
	    },
	});
        lista_hojas_colvis = new $.fn.dataTable.ColVis( lista_hojas, {
	    buttonText: '<i class="step fi-wrench size-21"></i>',
        });
        $(lista_hojas_colvis.button()).prependTo(prefixId_hojas+'tabla_cols');
        $(prefixId_hojas+'tabla_length').css("display","none");
        $(prefixId_hojas+'tabla_filter').css("display","none");
    }
    function coor_reporte_coordinacion_hojas_field_autoCompletado(component) {
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
    function coor_reporte_coordinacion_hojas_field_hoja_preview(item) {
        var coordinacion_id = item.attr('coordinacion_id');
        // a(item.attr('coordinacion_id'));
        var enviar = {
            'coordinacion_id': coordinacion_id
        }
        $(prefixId_hojas+'modal_preview_impreso_coordinacion_id').val(coordinacion_id);
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: './ajax/buttons/coordinacion_reporte_hojas_verHojas.php',
	    success: function(data) {
                impreso = data.trim();
                if ( impreso == '1') {
                    $(prefixId_hojas+'modal_preview_impreso_si').prop('checked', true);
                    $(prefixId_hojas+'modal_preview_impreso_no').prop('checked', false);
                } else if ( impreso == '0') {
                    $(prefixId_hojas+'modal_preview_impreso_no').prop('checked', true);
                    $(prefixId_hojas+'modal_preview_impreso_si').prop('checked', false);
                }
	    }
	});        
        var fileName = 'pdf.php?coordinacion_id='+coordinacion_id;
        c(fileName);
        var object = "<object data=\"{FileName}\" type=\"application/pdf\" width=\"100%\" height=\"600px\">";
        object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
        object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
        object += "</object>";
        object = object.replace(/{FileName}/g, "./" + fileName);
        $(prefixId_hojas+'modal_preview_pdf').html(object);
    }
    function coor_reporte_coordinacion_hojas_field_hoja_impreso(impreso) {
        var enviar = {
            "coordinacion_id": $(prefixId_hojas+'modal_preview_impreso_coordinacion_id').val()
            , "impreso": impreso
        }
        none_simple(
            './ajax/buttons/coordinacion_reporte_hojas_cambiarImpreso.php'
            , enviar
        );
        // c(enviar);
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
