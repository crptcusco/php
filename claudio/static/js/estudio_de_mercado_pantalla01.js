$(document).ready(function() {

    /********************* categorias ***************************/
    var cat = $("#categorias input:checked").val();
    var tip = $("#categorias input:checked").attr('tip');
    seleccionar_categoria (cat, tip);
    $("#categorias input").click(function () {
	var cat = $(this).val();
	var tip = $(this).attr('tip');
        // c(cat+'-'+tip);
	seleccionar_categoria(cat, tip);
    });
    $("#categorias #categoria_inmuebles").click(function () {
	categoria_inmuebles();
	seleccionar_categoria (0, 1)
    });
    $('.categoria').click(function () {
	var value = $(this).val();
	
	if (value=='maquinaria' || value=='vehiculo') {
	    $('.categoria').prop('checked', false);
	    $(this).prop('checked', true);
	} else {
	    $('#categoria_maquinaria').prop('checked', false);
	    $('#categoria_vehiculo').prop('checked', false);

	     	
	    var i=0;
	    $(".categoria:checked").each(function(){
		i++;
	    });
            if (i==0){
		$(this).prop('checked', true);
	    } 
	}
    });    
    
    // ------------------------------------------------
    function seleccionar_categoria (cat, tip) {
	if (tip==1) {
	    $('#inmueble').css('display','block');
	    $('#no-inmueble').css('display','none');
	    $('form').attr('action','inmuebles.php');
            $('#ingreso').attr('action','ingreso.php');
	} else if(tip==2) {
	    $('#inmueble').css('display','none');
	    $('#no-inmueble').css('display','block');	    
	    $('form').attr('action','no-inmuebles.php');
            $('#ingreso').attr('action','ingreso.php');
	    if ( cat == 'maquinaria'){
		$('#nin_tipo_maquinaria_conteiner').css('display','block');
		$('#nin_tipo_vehiculo_conteiner').css('display','none');

		$('#nin_marca_maquinaria_conteiner').css('display','block');
		$('#nin_modelo_maquinaria_conteiner').css('display','block');

		$('#nin_marca_vehiculo_conteiner').css('display','none');
		$('#nin_modelo_vehiculo_conteiner').css('display','none');

	    } else if ( cat == 'vehiculo'){
		$('#nin_tipo_maquinaria_conteiner').css('display','none');
		$('#nin_tipo_vehiculo_conteiner').css('display','block');

		$('#nin_marca_maquinaria_conteiner').css('display','none');
		$('#nin_modelo_maquinaria_conteiner').css('display','none');

		$('#nin_marca_vehiculo_conteiner').css('display','block');
		$('#nin_modelo_vehiculo_conteiner').css('display','block');
	    }
	    //
	    
	}
    }
    function categoria_inmuebles () {
	$('#categorias input').prop('checked', true);
	$('#categoria_maquinaria').prop('checked', false);
	$('#categoria_vehiculo').prop('checked', false);
    }
});
