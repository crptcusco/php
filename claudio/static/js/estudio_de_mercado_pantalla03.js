$(document).ready(function() {
    
    search();
    $("#search-button-ajax").click(function () {
	//a('test');
	search();
	return false;
    });
    $('#grid_ajax').on("click", 'a.ruta', function(e) {
	var ruta = $(this).attr('ruta');
	//window.open('./ajax/bat.php?ruta='+ruta);
	prompt("Ruta", ruta);
	return false;
    });
    $('#grid_ajax').on("click", '.menu-grilla a', function(e) {
	var nodo = $(this).attr('nodo');
	if (nodo !=0){
	    $('.menu-grilla li').removeClass('current');
	    $(this).parent().addClass('current');
	    $('.menu-grilla-item').css('display','none');
	    $('#menu-grilla-item-'+nodo).css('display','block');
	}
	return false;
    });
    // ------------------------------------------------
    function search () {
	var cat =  $('#nin_categoria').val();
	var tipo = $('#nin_tipo_'+cat).val();
	var marca = $('#nin_marca_'+cat).val();
	var modelo = $('#nin_modelo_'+cat).val();
	var tas_ini = $('#data-picker-ini').text();
	var tas_end = $('#data-picker-end').text();
	var cliente = $('#inm-cliente').val(); 
	var anio_fabr = $('#nin_anio').val(); 
	var envio ="";
	envio += "cat="+cat;
	envio += "&tipo="+tipo;
	envio += "&marca="+marca;
	envio += "&modelo="+modelo;
	envio += "&tas_ini="+tas_ini;
	envio += "&tas_end="+tas_end;
	envio += "&cliente="+cliente;
	envio += "&anio_fabr="+anio_fabr;
        $.ajax({
    	    type: "POST",
    	    url: "./ajax/search_grid_maquinaria_vehiculo.php",
    	    data: envio,
    	    success: function(ad) {
    		if (ad!='') {
    		    $("#grid_ajax").html(ad);
    		}
    	    }
        });
        $.ajax({
    	    type: "POST",
    	    url: "./ajax/search_grids.php",
    	    data: envio,
    	    success: function(ad2) {
    		$("#grids_ajax").html(ad2);
    	    }
        });
    }
});
