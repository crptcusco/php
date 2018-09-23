$(document).ready(function() {    
    var option_empty = '<option value=""></option>';
    var prefixId_inspeccion     = '#coor_reporte_coordinacion_inspeccion_field_';
    var prefixClass_inspeccion  = '.coor_reporte_coordinacion_inspeccion_field_';
    // listas
    var lista_inspeccion = '';
    var lista_inspeccion_colvis = '';

    // coor_coordinacion_inspeccion_field_
    // --------------------------------------------------------------- load    
    coor_reporte_coordinacion_inspeccion_field_lista();
    
    // ------------------------------------------------------------ eventos
    $(prefixId_inspeccion+'').on( 'click', function () {
    });
    $(prefixId_inspeccion+'').on("click", ".", function(e) {
    });
    $('body').on("click", prefixId_inspeccion+'', function(e) {
    });
    
    $(prefixId_inspeccion+'tabla_wrapper .search-input-text').on('keyup click', function (event) {
	var i = $(this).attr('data-column');
	var v = $(this).val();
        if (event.which == 13) {
            lista_inspeccion.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }
    });
    $(prefixId_inspeccion+'tabla_wrapper .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');  
	var v =$(this).val();
        lista_inspeccion.columns(i).search(v).draw();
        if (v=='0') {
            $(this).css('background-color','transparent');
        } else {
            $(this).css('background-color','#D3FFE4');
        }
    });
    $(prefixId_inspeccion+'tabla_wrapper .autocomplete-input-text').on('keyup', function () {
        coor_reporte_coordinacion_inspeccion_field_autoCompletado($(this));
    });
    $(prefixId_inspeccion+'tabla_search').on('click', function () {
        lista_inspeccion.draw();
    });
    // ---------------------------------------------------------- funciones
    function coor_reporte_coordinacion_inspeccion_field_lista() {
        lista_inspeccion = $(prefixId_inspeccion+'tabla').DataTable({
            "processing" : true,
	    "serverSide" : true,
            "bAutoWidth" : false,

            "scrollY": 200,
            "scrollX": true,
            
            "pageLength" : 5,
            "order"      : [ 0, 'desc' ],
	    "ajax":{
		url :"./ajax/tables/coordinacion_reporte_inspeccion_listado_table.php", 
		type: "post",
	    },
            // "columnDefs": [
            //     { visible: false, targets: [ 1, 2, 3, 4, 5 ] }
            // ],

        });
        lista_inspeccion_colvis = new $.fn.dataTable.ColVis( lista_inspeccion, {
	    buttonText: '<i class="step fi-wrench size-21"></i>',
        });
        $(prefixId_inspeccion+'tabla_length').parent().parent().css("display","none");	
        $(lista_inspeccion_colvis.button()).prependTo(prefixId_inspeccion+'tabla_cols');
            
       
    }
    function coor_reporte_coordinacion_inspeccion_field_autoCompletado(component) {
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


