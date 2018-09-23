$(document).ready(function() {
    var listado_dataTable = '';
    // ------------------------------------------------
    search();
    // ------------------------------------------------
    
    $("#search-button-ajax").click(function () {
	search();
	return false;
    });
    $("#menu-grilla-datatable a").click(function () {
        draw_table($(this).attr('item'));
	return false;
    });
    $('.table_data table .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            listado_dataTable.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $('.table_data table  .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        listado_dataTable.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });

    $('.table_data table').on("click", 'a.ruta', function(e) {
	var ruta = $(this).attr('ruta');
	//window.open('./ajax/bat.php?ruta='+ruta);
	prompt("Ruta", ruta);
	return false;
    });
    
    $('#grids_ajax').on("click", 'a.ruta', function(e) {
	var ruta = $(this).attr('ruta');
	//window.open('./ajax/bat.php?ruta='+ruta);
	prompt("Ruta", ruta);
	return false;
    });
    $('#grids_ajax').on("click", '.menu-grilla a', function(e) {
	var nodo = $(this).attr('nodo');
	if (nodo !=0){
	    $('.menu-grilla li').removeClass('current');
	    $(this).parent().addClass('current');
	    $('.menu-grilla-item').css('display','none');
	    $('#menu-grilla-item-'+nodo).css('display','block');
	}	
	return false;
    });
    $("#grids_ajax").on('change', "#checkboxSwitch", function() {
	var estado = $(this).attr('estado');
	if (estado=='t') {
	    $(this).attr('estado','em');
	    $('#menu-t').hide();
	    $('#menu-em').show();
	    $('#mensaje-checkboxSwitch').text('Estudio de Mercado');
	} else if (estado=='em') {
	    $(this).attr('estado','t');
	    $('#menu-em').hide();
	    $('#menu-t').show();
	    $('#mensaje-checkboxSwitch').text('Tasación');
	}
	
    });

    
    // ------------------------------------------------
    function search () {
    	var tipo = $('#inm_tipo').val();
	var departamento = $('#inm_departamento').val();	
	var provincia = $('#inm_provincia').val();
	var distrito = $('#inm_distrito').val();
	var fech_ini = $('#inm_fech_ini').val();
	var fech_end = $('#inm_fech_end').val();
	var cliente = $('#inm-cliente').val();
	var direccion = $('#inm-direccion').val();
	var envio = '';
        
        var l = tipo.split('|!|');
        var total = l.length;
        var pestana = $('.tabs-content .content.active').attr('id');
        for (var i = 0; i < total ; i++) {
            $('.menu-grilla .item_'+l[i]).show();
        }
        // c(pestana);
        draw_table(l[0]+'_t');
        
        envio += "departamento="+departamento;
	envio += "&provincia="+provincia;
	envio += "&distrito="+distrito;
        envio += "&tipo="+tipo;
	envio += "&fech_ini="+fech_ini;
	envio += "&fech_end="+fech_end;
	envio += "&cliente="+cliente;
	envio += "&direccion="+direccion;
	// a(envio);
        $.ajax({
    	    type: "POST",
    	    url: "./ajax/search_maps.php",
    	    data: envio,
    	    success: function(ad) {
    		if (ad!='') {
    		    $("#map_ajax").html(ad);
    		}
    	    }
        });

        // // c(envio);        
        // $.ajax({
    	//     type: "POST",
    	//     url: "./ajax/search_grids.php",
    	//     data: envio,
    	//     success: function(ad2) {
    	// 	$("#grids_ajax").html(ad2);
    	//     }
        // });
    }
    function draw_table(name) {
        var datos = '';
        if ($('#inm_departamento').val().trim() == '') datos += ' |---|';
        else datos += $('#inm_departamento').val().trim() + '|---|';

        if ($('#inm_provincia').val().trim() == '') datos += ' |---|';
        else datos += $('#inm_provincia').val().trim() + '|---|';

        if ($('#inm_distrito').val().trim() == '') datos += ' |---|';
        else datos += $('#inm_distrito').val().trim() + '|---|';

        if ($('#inm_fech_ini').val().trim() == '') datos += ' |---|';
        else datos += $('#inm_fech_ini').val().trim() + '|---|';

        if ($('#inm_fech_end').val().trim() == '') datos += ' |---|';
        else datos += $('#inm_fech_end').val().trim() + '|---|';
        
        if ($('#inm-cliente').val().trim() == '') datos += ' |---|';
        else datos += $('#inm-cliente').val().trim() + '|---|';

        if ($('#inm-direccion').val().trim() == '') datos += ' |---|';
        else datos += $('#inm-direccion').val().trim() + '|---|';
        // a(datos);
        
        $('.table_data').hide();
        $('.table_data input')
            .val('')
            .removeClass('active');
        $('#table_'+name+'_div').show();
        // c('#table_'+name);
        listado_dataTable = $('#table_'+name).DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 15,
            'order'      : [ 0, 'asc' ],
            'bDestroy': true,
            'aoColumnDefs': [
                // { 'aTargets': [0,1,2,3,4,5,6,7,8], 'bSortable': false },
                // { 'targets': ver, 'visible': false }
            ],
            'ajax': {
                url : './ajax/datatable/inmueble_' + name + '.php',
                type: 'post',
            },
        });
        $('#table_'+name+'_filter').hide();
        listado_dataTable.columns(0).search(datos).draw();
    }
});
