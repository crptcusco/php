// by Claudio
$(document).ready(function() {
	select_marca_load();
	select_tipo_load();
	select_modelo_load();

    // Eventos
    $("#maquinaria_marca_trigger_add").on("click", function(e) {
    	select_marca_modal(0);
    });
    $("#modal_es_maquinaria_marca_save").on("click", function(e) {
    	select_marca_save();
    });

    $("#maquinaria_tipo_trigger_add").on("click", function(e) {
    	select_tipo_modal(0);
    });
    $("#modal_es_maquinaria_tipo_save").on("click", function(e) {
    	select_tipo_save();
    });

    $("#maquinaria_modelo_trigger_add").on("click", function(e) {
    	select_modelo_modal(0);
    });
    $("#modal_es_maquinaria_modelo_save").on("click", function(e) {
    	select_modelo_save();
    });

    // function ----------------------------------
    //TIPO
    function select_tipo_load() {
    	var enviar = {
    		id: $('#maquinaria_tipo_id').val()
    	}
	// console.log(enviar);
	select_simple(
		'../ajax/combos2/maquinaria_tipo.php',
		'#maquinaria_tipo_id',
		enviar
		);
}
function select_tipo_modal(id) {
}
function select_tipo_save() {
	var enviar = {
		'nombre': $('#modal_es_maquinaria_tipo_nombre').val(),
	}
	// console.log(enviar);
	$.ajax({
		type: "POST",
		data: enviar,
		url: '../ajax/save2/maquinaria_tipo.php',
		success: function(data) {
			$('#modal_es_maquinaria_tipo_nombre').val('');
			if (data.trim() == '') {
				select_tipo_load();
			} else {
				alert(data);
			}
			
		}
	});
}

	//MARCA
	function select_marca_load() {
		var enviar = {
			id: $('#maquinaria_marca_id').val()
		}
	// console.log(enviar);
	select_simple(
		'../ajax/combos2/maquinaria_marca.php',
		'#maquinaria_marca_id',
		enviar
		);
}
function select_marca_modal(id) {
}
function select_marca_save() {
	var enviar = {
		'nombre': $('#modal_es_maquinaria_marca_nombre').val(),
	}
	// console.log(enviar);
	$.ajax({
		type: "POST",
		data: enviar,
		url: '../ajax/save2/maquinaria_marca.php',
		success: function(data) {
			$('#modal_es_maquinaria_marca_nombre').val('');
			if (data.trim() == '') {
				select_marca_load();
			} else {
				alert(data);
			}
			
		}
	});
}

    //MODELO
    function select_modelo_load() {
    	var enviar = {
    		id: $('#maquinaria_modelo_id').val()
    	}
	// console.log(enviar);
	select_simple(
		'../ajax/combos2/maquinaria_modelo.php',
		'#maquinaria_modelo_id',
		enviar
		);
}
function select_modelo_modal(id) {
}
function select_modelo_save() {
	var enviar = {
		'nombre': $('#modal_es_maquinaria_modelo_nombre').val(),
	}
	// console.log(enviar);
	$.ajax({
		type: "POST",
		data: enviar,
		url: '../ajax/save2/maquinaria_modelo.php',
		success: function(data) {
			$('#modal_es_maquinaria_modelo_nombre').val('');
			if (data.trim() == '') {
				select_modelo_load();
			} else {
				alert(data);
			}
			
		}
	});
}

    // reutilizable --------------------------------
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
});
