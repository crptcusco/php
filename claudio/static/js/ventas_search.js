$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#ve_propuesta_field_';
    var prefixClass = '.ve_propuesta_field_';
    var dataTable_lista = '';
    
    // --------------------------------------------------------------- load
    ve_propuesta_field_search();
    
    // ------------------------------------------------------------ eventos
    $('body').on('click', prefixId+'search_update', function(e) {
        dataTable_lista.draw();
    });
    $(prefixId+'search .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            dataTable_lista.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $(prefixId+'search_update .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_lista.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });
    
    $(prefixId+'search').on('click', '.delete' , function(e) {
	ve_propuesta_field_search_delete( $(this) );
    });
    
    // ---------------------------------------------------------- funciones
    function ve_propuesta_field_search() {
        dataTable_lista = $(prefixId+'search').DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 10,
            'order'      : [ 0, 'desc' ],
            'bDestroy': true,
            'aoColumnDefs': [
                { 'aTargets': [0,1,2,3,4,5,6,7,8], 'bSortable': false },
                // { 'targets': ver, 'visible': false }
            ],
            'ajax': {
                url : './ajax/tables/search_propuestas.php',
                type: 'post',
            },
        });
        $(prefixId+'search_filter').hide();
    }
    function ve_propuesta_field_search_delete( item ) {
	var enviar = {
	    propuesta_id: item.attr('propuesta_id')
	}
        
        // c(enviar);
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './ajax/delete/propuesta_delete.php',
	    success: function(data) {
                
		if (data.trim() =='SIN PERMISO') {
		    alert( data.trim() );		    
		} else {
                    dataTable_lista.draw();
		}                
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
