$('.chosen-select').chosen({allow_single_deselect: true, width: "100%"});
$(document).ready(function() {
    var option_empty='<option value=""></option>';
    /********************* inmuembles ***************************/
    seleccionar_provincia ();
    seleccionar_distrito ();

    $("#inm_departamento_conteiner").on('change', "#inm_departamento", function(){	
	seleccionar_provincia ();
	//seleccionar_distrito ();
	$("#inm_distrito").html(option_empty);
	$("#inm_distrito").trigger('chosen:updated');
    });
    $("#inm_provincia_conteiner").on('change', "#inm_provincia", function(){
	seleccionar_distrito ();
    });
    /********************* No-inmuembles ***************************/
    var tipo_maquinaria = $("#nin_tipo_maquinaria").val();
    //alert('tipo maquinaria: '+tipo_maquinaria);
    var marca_maquinaria = $("#nin_marca_maquinaria").val();
    //alert('marca maquinaria: '+marca_maquinaria);
    var modelo_maquinaria = $("#nin_modelo_maquinaria").val();
    //alert('modelo maquinaria: '+modelo_maquinaria);

    seleccionar_marca('maquinaria');
    seleccionar_modelo('maquinaria');

    var tipo_vehiculo = $("#nin_tipo_vehiculo").val();
    //alert('tipo vehiculo: '+tipo_vehiculo);
    var marca_vehiculo = $("#nin_marca_vehiculo").val();
    //alert('marca vehiculo: '+marca_vehiculo);
    var modelo_vehiculo = $("#nin_modelo_vehiculo").val();
    //alert('modelo vehiculo: '+modelo_vehiculo);

    seleccionar_marca('vehiculo');
    seleccionar_modelo('vehiculo');

    $("#nin_tipo_maquinaria_conteiner").on('change', "#nin_tipo_maquinaria", function(){
	var categoria = 'maquinaria';
	seleccionar_marca(categoria);
	$("#nin_modelo_" + categoria).html(option_empty);
	$("#nin_modelo_" + categoria).trigger('chosen:updated');
    });
    $("#nin_marca_maquinaria_conteiner").on('change', "#nin_marca_maquinaria", function(){
	var categoria = 'maquinaria';
	seleccionar_modelo(categoria);
    });

    $("#nin_tipo_vehiculo_conteiner").on('change', "#nin_tipo_vehiculo", function(){	
	var categoria = 'vehiculo';
	seleccionar_marca(categoria);
	$("#nin_modelo_" + categoria).html(option_empty);
	$("#nin_modelo_" + categoria).trigger('chosen:updated');
    });
    $("#nin_marca_vehiculo_conteiner").on('change', "#nin_marca_vehiculo", function(){
	var categoria = 'vehiculo';
	seleccionar_modelo(categoria);
    });

    // ------------------------------------------------
    function seleccionar_provincia () {
	var departamento = $('#inm_departamento').val();
	var provincia = $('#inm_provincia').val();

	if (departamento!='') {
            $.ajax({
		type: "POST",
		url: "./ajax/departamentos.php",
		data: "departamento=" + departamento+"&provincia=" + provincia,
		success: function(ad) {

		    if (ad!='') {		    
			$("#inm_provincia").html(ad);
			$("#inm_provincia").trigger('chosen:updated');
		    }
		    else {
			$("#inm_provincia").html(option_empty);
			$("#inm_provincia").trigger('chosen:updated');
		    }
		}
            });
	} else {
	    $("#inm_provincia").html(option_empty);
	    $("#inm_provincia").trigger('chosen:updated');
	}

    } // seleccionar_provincia
    function seleccionar_distrito () {
	var provincia = $('#inm_provincia').val();
	var distrito = $('#inm_distrito').val();
	if (provincia!='') {
            $.ajax({
		type: "POST",
		url: "./ajax/provincias.php",
		data: "provincia=" + provincia+"&distrito=" + distrito,
		success: function(ad) {
		    if (ad!='') {
			$("#inm_distrito").html(ad);
			$("#inm_distrito").trigger('chosen:updated');
		    }else {
			$("#inm_distrito").html(option_empty);
			$("#inm_distrito").trigger('chosen:updated');
		    }
		}
            });	
	} else {
	    $("#inm_distrito").html(option_empty);
	    $("#inm_distrito").trigger('chosen:updated');
	}	
    } // seleccionar_distrito

    function seleccionar_marca(categoria) {
	var tipo = $("#nin_tipo_"+categoria).val();
	var marca = $("#nin_marca_"+categoria).val();
	var enviar = './ajax/combos/'+categoria+'_marca.php';

        $.ajax({
	    type: "POST",
	    url: enviar,
	    data: "tipo=" + tipo+"&marca="+marca,
	    success: function(ad) {		
		if (ad!='') {
		    $("#nin_marca_" + categoria).html(ad);
		    $("#nin_marca_" + categoria).trigger('chosen:updated');
		}
		else {
		    $("#nin_marca_" + categoria).html(option_empty);
		    $("#nin_marca_" + categoria).trigger('chosen:updated');
		}
	    }
        });
        // else {
	//     $("#nin_marca_" + categoria).html(option_empty);
	//     $("#nin_marca_" + categoria).trigger('chosen:updated');
	// }

    }
    function seleccionar_modelo(categoria) {
	var tipo = $("#nin_tipo_"+categoria).val();	
	var marca = $("#nin_marca_"+categoria).val();
	var modelo = $("#nin_modelo_"+categoria).val();
	//a('tipo:'+tipo+' marca:'+marca+' modelo:'+modelo);
	if (marca!='') {
            $.ajax({
		type: "POST",
		url: './ajax/combos/'+categoria+'_modelo.php',
		data: "tipo="+tipo+"&marca="+marca+"&modelo=" + modelo,
		success: function(ad) {
		    if (ad!='') {
			//a(ad);
			$("#nin_modelo_" + categoria).html(ad);
			$("#nin_modelo_" + categoria).trigger('chosen:updated');
		    }
		    else {
			$("#nin_modelo_" + categoria).html(option_empty);
			$("#nin_modelo_" + categoria).trigger('chosen:updated');
		    }
		}
            });
	} else {
	    $("#nin_modelo_" + categoria).html(option_empty);
	    $("#nin_modelo_" + categoria).trigger('chosen:updated');
	}
    }
});
