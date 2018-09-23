$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#cotizacion_listado_';
    var prefixClass = '.cotizacion_listado_';
    var dataTable_listado = '';
   
    // --------------------------------------------------------------- LOAD
    cotizacion_listado_tabla();
    cotizacion_listado_combos();
    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'campanias').on( 'change', function () {
        var url = './index.php?campania=' + $(this).val();   
        window.location = url;
    });
    $(prefixId+'tabla .reload').on('click', function (event) {
        cotizacion_listado_reload();
    });
    //
    $(prefixId+'tabla .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            dataTable_listado.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $(prefixId+'tabla .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_listado.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });

    // ---------------------------------------------------------- FUNCIONES
    function cotizacion_listado_tabla() {
        var enviar = {
            'perfil':   $(prefixId+'perfiles').val() ,
            'campania': $(prefixId+'campanias').val() ,
        };
        // c(enviar);
        var unsortable = [0,1,2,3,4,5,6,7,8,9,10];
        dataTable_listado = $(prefixId+'tabla').DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 10,
            'order'      : [ 0, 'desc' ],
            'aoColumnDefs': [
                { 'aTargets': unsortable, 'bSortable': false },
                // { 'targets': ver, 'visible': false }
            ],
            'ajax': {
                url : './ajax/tables/cotizacion_listado_datatable.php',
                type: 'post',
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
    function cotizacion_listado_reload() {
        dataTable_listado.draw();
    }
    //
    function cotizacion_listado_combos() {
	var combo = $('#tipo_servicio2');
	$.ajax({
	    type: "POST",
	    url: "./ajax/combos/tipo_servicios.php",
	    data: "id=" + combo.val(),
	    success: function(data) {
		if (data != '') {
		    combo.html(data);
		}
		else {
		    combo.html(option_empty);
		}	
	    }
	});
        
	$.ajax({
	    type: "POST",
	    url: "./ajax/combos/estado_cotizacion.php",
	    data: "id=" + combo.val(),
	    success: function(data) {
		if (data != '') {
		    $('#estado_cotizacion2').html(data);
		}
		else {
		    $('#estado_cotizacion2').html(option_empty);
		}	
	    }
	});

        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/involucrados_coordinador.php",
	    data: "id=" + combo.val(),
	    success: function(data) {
		if (data != '') {
		    $('#involucrados_coordinador2').html(data);
		}
		else {
		    $('#involucrados_coordinador2').html(option_empty);
		}	
	    }
	});

        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/involucrados_vendedor.php",
	    data: "id=" + combo.val(),
	    success: function(data) {
		if (data != '') {
		    $('#involucrados_vendedor2').html(data);
		}
		else {
		    $('#involucrados_vendedor2').html(option_empty);
		}	
	    }
	});
    }
});
