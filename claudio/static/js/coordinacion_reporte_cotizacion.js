$(document).ready(function() {
    var option_empty ='<option value=""></option>';
    var prefixId_cotizacion = '#coor_reporte_coordinacion_cotizacion_field_';
    var prefixClass_cotizacion = '.coor_reporte_coordinacion_cotizacion_field_';
    var lista_cotizacion = '';
    var lista_cotizacion_colvis = '';

    // --------------------------------------------------------------- load
    coor_reporte_coordinacion_cotizacion_field_tabla();
    // ------------------------------------------------------------ eventos
    $(prefixId_cotizacion+'tabla_wrapper .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
	var v = $(this).val();

        if (event.which == 13) {
            lista_cotizacion.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }

        
    });
    $(prefixId_cotizacion+'tabla_wrapper .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');  
	var v =$(this).val();
        lista_cotizacion.columns(i).search(v).draw();
        if (v=='0') {
            $(this).css('background-color','transparent');
        } else {
            $(this).css('background-color','#D3FFE4');
        }
    });
    $(prefixId_cotizacion+'tabla_wrapper .autocomplete-input-text').on('keyup', function () {
        coor_reporte_coordinacion_cotizacion_field_autoCompletado($(this));
    });
    $(prefixId_cotizacion+'tabla_wrapper').on('click', 'ul.pagination a', function () {
        $('html, body').animate({ scrollTop: 0 }, 0);
    });
    
    $(prefixId_cotizacion+'tabla_search').on('click', function () {
        lista_cotizacion.draw();
    });
    
    // ---------------------------------------------------------- funciones
    function coor_reporte_coordinacion_cotizacion_field_tabla() {
        lista_cotizacion = $(prefixId_cotizacion+'tabla').DataTable({
	    "processing" : true,
	    "serverSide" : true,
            "bAutoWidth" : false,

            "scrollY": false,
            "scrollX": true,
            
            "pageLength" : 25,
            "order"      : [ 0, 'desc' ],
            "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4, 5, 6, ] } ],
	    "ajax":{
		url :"./ajax/tables/coordinacion_reporte_cotizacion_listado_table.php", 
		type: "post",
	    },
	});
        lista_cotizacion_colvis = new $.fn.dataTable.ColVis( lista_cotizacion, {
	    buttonText: '<i class="step fi-wrench size-21"></i>',
        });
        $(lista_cotizacion_colvis.button()).prependTo(prefixId_cotizacion+'tabla_cols');
        $(prefixId_cotizacion+'tabla_length').css("display","none");
        $(prefixId_cotizacion+'tabla_filter').css("display","none");
        
    }
    function coor_reporte_coordinacion_cotizacion_field_autoCompletado(component) {
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
