$('.chosen-select').chosen({allow_single_deselect: true, width: "100%"});
$(document).ready(function() {
    var option_empty='<option value=""></option>';
    /********************* inmuembles ***************************/
    var departamento = $('#inm_departamento').val();
    //a('departento: '+departamento);
    var provincia = $('#inm_provincia').val();
    //a('provincia: '+provincia);
    var distrito = $('#inm_distrito').val();
    //a('distrito: '+distrito);

    seleccionar_provincia (departamento);
    $('#inm_provincia').val(provincia);
    $('#inm_provincia').trigger("chosen:updated");

    seleccionar_distrito (provincia);
    $('#inm_distrito').val(distrito);
    $('#inm_distrito').trigger("chosen:updated");

    $("#inm_departamento_conteiner").on('change', "#inm_departamento", function(){
	var departamento = $(this).val();
	var provincia = '';
	
	seleccionar_provincia (departamento);
	seleccionar_distrito (provincia);
    });
    $("#inm_provincia_conteiner").on('change', "#inm_provincia", function(){
	var provincia = $(this).val();
	seleccionar_distrito (provincia);
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
    function seleccionar_provincia (departamento) {
	var provincia = $('#inm_provincia').val();
        $.ajax({
	    type: "POST",
	    url: "./ajax/departamentos.php",
	    data: "departamento=" + departamento+"&provincia=" + provincia,
	    success: function(ad) {		
		if (ad!='') {
		    //a(ad);
		    $("#inm_provincia").html(ad);
		    $("#inm_provincia").trigger('chosen:updated');
		}
		else {
		    $("#inm_provincia").html(option_empty);
		    $("#inm_provincia").trigger('chosen:updated');
		}
	    }
        });
    } // seleccionar_provincia
    function seleccionar_distrito (provincia) {
	var distrito = $('#inm_distrito').val();
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
    } // seleccionar_distrito

    function seleccionar_marca(categoria) {
	var tipo = $("#nin_tipo_"+categoria).val();
	var marca = $("#nin_marca_"+categoria).val();
	if (tipo!='') {
            $.ajax({
		type: "POST",
		url: './ajax/combos/'+categoria+'_marca.php',
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
	} else {
	    $("#nin_marca_" + categoria).html(option_empty);
	    $("#nin_marca_" + categoria).trigger('chosen:updated');
	}

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
