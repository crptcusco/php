$(document).ready(function() {
    var prefix = "co_bienes_field_";
    var option_empty='<option value=""></option>';
    co_bienes_field_sub_categoria_mueble_tipo();
    co_bienes_field_sub_categoria_inmueble();
    co_bienes_field_sub_categoria_inmueble_departamento();
    co_bienes_field_sub_categoria_inmueble_provincia();
    co_bienes_field_sub_categoria_inmueble_distrito();
    co_bienes_field_sub_tabla();
    // -------------------------------------------- eventos
    // ---- categoria
    $("body").on("click", "#" + prefix + "categoria_mueble_radio", function(e) {
	co_bienes_field_categoria_mueble_radio();
    });
    $("body").on("click", "#" + prefix + "categoria_inmueble_radio", function(e) {
	co_bienes_field_categoria_inmueble_radio();
    });
    $("body").on("click", "#" + prefix + "categoria_masivo_radio", function(e) {
	co_bienes_field_categoria_masivo_radio();
    });
    // ----subcategoria
    $("body").on("change", "#" + prefix + "sub_categoria_mueble", function(e) {
	co_bienes_field_sub_categoria_mueble( $(this).val() );
    });
    // modales
    $("body").on("click", "#" + prefix + "sub_categoria_inmueble_link", function(e) {
	co_bienes_field_sub_categoria_inmueble_link();
        c('aa');
	e.preventDefault();
    });
    $("body").on("click", "#bienes-inmubles-table-ajax .edit", function(e) {
	co_bienes_field_sub_categoria_inmueble_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click","#co_bienes_field_sub_categoria_inmueble_modal_field_cancel" , function(e) {
	co_bienes_field_sub_categoria_inmueble_modal_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_inmueble_modal_field_save", function(e) {
	co_bienes_field_sub_categoria_inmueble_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#co_bienes_field_sub_categoria_inmueble_modal[data-reveal]', function () {
    });
    // ---- listas
    // tipo
    $("body").on("change", "#" + prefix + "sub_categoria_mueble_tipo", function(e) {
	co_bienes_field_sub_categoria_mueble_marca();
	var combo = $('#'+prefix+'sub_categoria_mueble_modelo');
	combo.html(option_empty);	    		
	combo.trigger('chosen:updated');

    });
    $("body").on("click", "#" + prefix + "sub_categoria_mueble_tipo_link", function(e) {
	co_bienes_field_sub_categoria_mueble_tipo_link();
	e.preventDefault();
    });
    $("body").on("click", "#bienes-mueble-tipo-tabla-ajax .edit", function(e) {
	co_bienes_field_sub_categoria_mueble_tipo_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_mueble_tipo_modal_field_cancel", function(e) {
	co_bienes_field_sub_categoria_mueble_tipo_modal_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_mueble_tipo_modal_field_save", function(e) {
	co_bienes_field_sub_categoria_mueble_tipo_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#co_bienes_field_sub_categoria_mueble_tipo_modal[data-reveal]', function () {
    });
    // marca
    $("body").on("change", "#" + prefix + "sub_categoria_mueble_marca", function(e) {
	co_bienes_field_sub_categoria_mueble_modelo();
    });
    $("body").on("click", "#" + prefix + "sub_categoria_mueble_marca_link", function(e) {
	co_bienes_field_sub_categoria_mueble_marca_link();
	e.preventDefault();
    });
    $("body").on("click", "#bienes-mueble-marca-tabla-ajax .edit", function(e) {
	co_bienes_field_sub_categoria_mueble_marca_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_mueble_marca_modal_field_cancel", function(e) {
	co_bienes_field_sub_categoria_mueble_marca_modal_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_mueble_marca_modal_field_save", function(e) {
	co_bienes_field_sub_categoria_mueble_marca_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#co_bienes_field_sub_categoria_mueble_marca_modal[data-reveal]', function () {
    });
    // modelo
    $("body").on("click", "#" + prefix + "sub_categoria_mueble_modelo_link", function(e) {
	co_bienes_field_sub_categoria_mueble_modelo_link();
	e.preventDefault();
    });
    $("body").on("click", "#bienes-mueble-modelo-tabla-ajax .edit", function(e) {
	co_bienes_field_sub_categoria_mueble_modelo_modal_field_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_mueble_modelo_modal_field_cancel", function(e) {
	co_bienes_field_sub_categoria_mueble_modelo_modal_field_cancel();
	e.preventDefault();
    });
    $("body").on("click", "#co_bienes_field_sub_categoria_mueble_modelo_modal_field_save", function(e) {
	co_bienes_field_sub_categoria_mueble_modelo_modal_field_save();
	e.preventDefault();
    });
    $("body").on('closed.fndtn.reveal', '#co_bienes_field_sub_categoria_mueble_modelo_modal[data-reveal]', function () {
    });
    // departamento
    $("body").on("change", "#" + prefix + "sub_categoria_inmueble_departamento", function(e) {
	$('#'+prefix+'sub_categoria_inmueble_provincia').val('0');
	co_bienes_field_sub_categoria_inmueble_provincia( );
	var combo = $('#'+prefix+'sub_categoria_inmueble_distrito');
	combo.html(option_empty);
	combo.trigger('chosen:updated');
    });
    // provincia
    $("body").on("change", "#" + prefix + "sub_categoria_inmueble_provincia", function(e) {
	co_bienes_field_sub_categoria_inmueble_distrito();
    });
    // distrito

    $("#" + prefix + "categoria_masivo").ajaxupload({
	url:'real_ajax_upload.php',
	language: 'it_IT',
	remotePath:'../../../files/cotizacion/bienes/',
	data:'asd=asd&qwe=123',

	// autoStart:true, 
	// finish:function(files, filesObj) {         
        //     console.log( 'Todos los archivos an sido subido correctamente:' + filesObj );
	// },
	success:function(file) {
	    co_bienes_field_categoria_masivo( file );
	},
	beforeUpload: function(filename, fileobj) {
            if( filename.length>550 ) {
		return false; //file will not be uploaded
            }
            else {
		return true; //file will be uploaded
            }
	},
	error:function(txt, obj) {
            alert('Un error a ocurrido '+ txt);
	}
    });
    // ---- listados

    // ---- eventos 
    $("body").on("click", "#" + prefix + "sub_categoria_mueble_add", function(e) {
	co_bienes_field_sub_categoria_mueble_add();
	e.preventDefault();
    });
    $("body").on("click", "#" + prefix + "sub_categoria_mueble_clear", function(e) {
	co_bienes_field_sub_categoria_mueble_clear();
	e.preventDefault();
    });
    $("body").on("click", "#bienes-table-ajax .edit", function(e) {
	co_bienes_field_sub_categoria_edit( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#bienes-table-ajax .delete", function(e) {
	co_bienes_field_sub_categoria_delete( $(this).parent().parent() );
	e.preventDefault();
    });
    $("body").on("click", "#" + prefix + "sub_categoria_inmueble_add", function(e) {
	co_bienes_field_sub_categoria_inmueble_add();
	e.preventDefault();
    });
    $("body").on("click", "#" + prefix + "sub_categoria_inmueble_clear", function(e) {
	co_bienes_field_sub_categoria_inmueble_clear();
	e.preventDefault();
    });
    $("body").on("click", "#" + prefix + "categoria_masivo_clear", function(e) {
	co_bienes_field_categoria_masivo_clear();
	e.preventDefault();
    });
    $("body").on("click", "#" + prefix + "categoria_masivo_save", function(e) {
	co_bienes_field_categoria_masivo_save();
	e.preventDefault();
    });
    // -------------------------------------------- funciones
    // categoria
    function co_bienes_field_categoria_mueble_radio() {
	$('.'+prefix+'categoria_content').hide();
	$('#'+prefix+'categoria_mueble_content').show();
	$('.'+prefix+'sub_categoria_content').hide();
	$('#'+prefix+'sub_categoria_muebles_content').show();
    }
    function co_bienes_field_categoria_inmueble_radio() {
	$('.'+prefix+'categoria_content').hide();
	$('#'+prefix+'categoria_inmueble_content').show();
	$('.'+prefix+'sub_categoria_content').hide();
	$('#'+prefix+'sub_categoria_inmuebles_content').show();
    }
    function co_bienes_field_categoria_masivo_radio() {
	$('.'+prefix+'categoria_content').hide();
	$('#'+prefix+'categoria_masivo_content').show();
	$('.'+prefix+'sub_categoria_content').hide();
	$('#'+prefix+'sub_categoria_masivo_content').show();
    }
    // --- sub-categoria
    function co_bienes_field_sub_categoria_mueble( id ) {
	if ( id == '4' ) {
	    $('#'+prefix+'sub_categoria_mueble_marca_content').hide();
	    $('#'+prefix+'sub_categoria_mueble_modelo_content').hide();
	    co_bienes_field_sub_categoria_mueble_tipo();
	} else {
	    $('#'+prefix+'sub_categoria_mueble_marca_content').show();
	    $('#'+prefix+'sub_categoria_mueble_modelo_content').show();	    
	    $('#'+prefix+'sub_categoria_mueble_marca')
		.html(option_empty)  		
		.trigger('chosen:updated');
	    $('#'+prefix+'sub_categoria_mueble_modelo')
		.html(option_empty)  		
		.trigger('chosen:updated');
	    co_bienes_field_sub_categoria_mueble_tipo();
	}
    }
    function co_bienes_field_sub_categoria_inmueble() {
	var combo = $('#co_bienes_field_sub_categoria_inmueble');
	var enviar = {
	    id: combo.val()
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/combos/bienes_inmueble_combo.php",
	    success: function(data) {		
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    // modales
    function co_bienes_field_sub_categoria_inmueble_link() {
	var tabla = $('#co_bienes_field_sub_categoria_inmueble_modal_field_tabla');
	var enviar = {
	}
	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/modal/bienes_inmueble.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    function co_bienes_field_sub_categoria_inmueble_modal_field_edit(item) {
	var prefix = '#co_bienes_field_sub_categoria_inmueble_modal_field_';
	var datos = {
	    id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: $(item).find("td").eq(1).text()
	    , save: 'Editar'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	$('#bienes-inmubles-table-ajax tr').removeClass('edit_item');
	$('#bienes-inmubles-table-ajax tr.item_'+datos.id).addClass('edit_item');
    }
    function co_bienes_field_sub_categoria_inmueble_modal_field_cancel() {
	var prefix = '#co_bienes_field_sub_categoria_inmueble_modal_field_';
	var datos = {
	    id: '0'
	    , nombre: ''
	    , status: 'Activo'
	    , save: 'Añadir'
	}
        $(prefix + 'id').val( datos.id );
	$(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$(prefix + 'save').text( datos.save );
	$('#bienes-inmubles-table-ajax tr').removeClass('edit_item');
    }
    function co_bienes_field_sub_categoria_inmueble_modal_field_save() {
	var prefix = '#co_bienes_field_sub_categoria_inmueble_modal_field_';
	var enviar = {
            id: $(prefix + 'id').val()
	    , nombre: $(prefix + 'nombre').val()
	    , status: $(prefix + 'status').is(':checked')
	}
	//c( enviar );
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/modal/bienes_inmueble/save_sub_categoria_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			//data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#bienes-inmubles-table-ajax tbody' ).append( data );
	    	    } else {
			//data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#bienes-inmubles-table-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    co_bienes_field_sub_categoria_inmueble_modal_field_cancel(); // descomentar despues de pruebas
                    co_bienes_field_sub_categoria_inmueble();
		}
	    });

	} else {
	    alert('Falta LLenar Información');
	}
    }
    // --- listas
    // --- tipo
    function co_bienes_field_sub_categoria_mueble_tipo() {
	var combo = $('#'+prefix+'sub_categoria_mueble_tipo');
	var enviar = {
	    mueble_tipo_id : $('#'+prefix+'sub_categoria_mueble').val()
	    , tipo_id: $('#'+prefix+'sub_categoria_mueble_tipo').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_mueble_tipo_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else 
		    combo.html(option_empty);	    		
		combo.trigger('chosen:updated');
	    }
        });	
    }
    function co_bienes_field_sub_categoria_mueble_tipo_link() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_tipo_modal_field_';
	var tabla = $(prefix+'tabla');
	var enviar = {
            sub_categoria_id: $('#co_bienes_field_sub_categoria_mueble').val()
	}
	$(prefix + 'sub_categoria_id').val(enviar.sub_categoria_id);
	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/modal/bienes_mueble_tipo_table_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    function co_bienes_field_sub_categoria_mueble_tipo_modal_field_edit( item ) {
	var prefix = '#co_bienes_field_sub_categoria_mueble_tipo_modal_field_';
	var datos = {
	      id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: item.find("td").eq(1).text()
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$('#bienes-mueble-tipo-tabla-ajax tr').removeClass('edit_item');
	item.addClass('edit_item');
	$(prefix + 'save').text( 'Editar' );
    }
    function co_bienes_field_sub_categoria_mueble_tipo_modal_field_cancel() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_tipo_modal_field_';
	var datos = {
	      id: '0'
	    , nombre: ''
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
	$(prefix + 'status').prop('checked', true);

	$('#bienes-mueble-tipo-tabla-ajax tr').removeClass('edit_item');
	$(prefix + 'save').text( 'Añadir' );
    }
    function co_bienes_field_sub_categoria_mueble_tipo_modal_field_save() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_tipo_modal_field_';
	var enviar = {
	    sub_categoria_id: $(prefix + 'sub_categoria_id').val()
	    , id: $(prefix + 'id').val()
	    , nombre: $(prefix + 'nombre').val()
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/modal/bienes_mueble_tipo/save_mueble_tipo_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#bienes-mueble-tipo-tabla-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#bienes-mueble-tipo-tabla-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    co_bienes_field_sub_categoria_mueble_tipo_modal_field_cancel(); // descomentar despues de pruebas
                    co_bienes_field_sub_categoria_mueble_tipo();
	            co_bienes_field_sub_categoria_mueble_marca();
	            co_bienes_field_sub_categoria_mueble_modelo();
		}
	    });

	} else {
	    alert('Falta LLenar Información');
	}
    }
    // marca
    function co_bienes_field_sub_categoria_mueble_marca() {
	var combo = $('#'+prefix+'sub_categoria_mueble_marca');
	var enviar = {
	      mueble_tipo_id : $('#'+prefix+'sub_categoria_mueble').val()
	    , tipo_id : $('#'+prefix+'sub_categoria_mueble_tipo').val()
	    , marca_id : $('#'+prefix+'sub_categoria_mueble_marca').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_mueble_marca_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });	
    }
    function co_bienes_field_sub_categoria_mueble_marca_link() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_marca_modal_field_';
	var tabla = $(prefix+'tabla');
	var enviar = {
            sub_categoria_id: $('#co_bienes_field_sub_categoria_mueble').val()
	    , tipo_id: $('#co_bienes_field_sub_categoria_mueble_tipo').val()
	}
	$(prefix + 'sub_categoria_id').val(enviar.sub_categoria_id);
	$(prefix + 'tipo_id').val(enviar.tipo_id);
	if (enviar.tipo_id=="") {
	    $(prefix + 'tipo_id').val('0');
	} else {
	    $(prefix + 'tipo_id').val(enviar.tipo_id);
	}

	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/modal/bienes_mueble_marca_table_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    function co_bienes_field_sub_categoria_mueble_marca_modal_field_edit(item) {
	var prefix = '#co_bienes_field_sub_categoria_mueble_marca_modal_field_';
	var datos = {
	      id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: item.find("td").eq(1).text()
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$('#bienes-mueble-marca-tabla-ajax tr').removeClass('edit_item');
	item.addClass('edit_item');
	$(prefix + 'save').text( 'Editar' );

    }
    function co_bienes_field_sub_categoria_mueble_marca_modal_field_cancel() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_marca_modal_field_';
	var datos = {
	      id: '0'
	    , nombre: ''
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
	$(prefix + 'status').prop('checked', true);

	$('#bienes-mueble-marca-tabla-ajax tr').removeClass('edit_item');
	$(prefix + 'save').text( 'Añadir' );
    }
    function co_bienes_field_sub_categoria_mueble_marca_modal_field_save() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_marca_modal_field_';
	var enviar = {
	    sub_categoria_id: $(prefix + 'sub_categoria_id').val()
	    , id: $(prefix + 'id').val()
	    , tipo_id: $(prefix + 'tipo_id').val()
	    , nombre: $(prefix + 'nombre').val()
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/modal/bienes_mueble_marca/save_mueble_marca_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#bienes-mueble-marca-tabla-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#bienes-mueble-marca-tabla-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    co_bienes_field_sub_categoria_mueble_marca_modal_field_cancel(); // descomentar despues de pruebas
                    co_bienes_field_sub_categoria_mueble_marca();
	            co_bienes_field_sub_categoria_mueble_modelo();
		}
	    });

	} else {
	    alert('Falta LLenar Información');
	}
    }
    // modelo
    function co_bienes_field_sub_categoria_mueble_modelo() {
	var combo = $('#'+prefix+'sub_categoria_mueble_modelo');
	var enviar = {
	      mueble_tipo_id : $('#'+prefix+'sub_categoria_mueble').val()
	    , tipo_id : $('#'+prefix+'sub_categoria_mueble_tipo').val()
	    , marca_id : $('#'+prefix+'sub_categoria_mueble_marca').val()
	    , modelo_id : $('#'+prefix+'sub_categoria_mueble_modelo').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_mueble_modelo_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });	
    }
    function co_bienes_field_sub_categoria_mueble_modelo_link() {
	var prefix = '#co_bienes_field_sub_categoria_mueble_modelo_modal_field_';
	var tabla = $(prefix+'tabla');
	var enviar = {
            sub_categoria_id: $('#co_bienes_field_sub_categoria_mueble').val()
	    , tipo_id: $('#co_bienes_field_sub_categoria_mueble_tipo').val()
	    , marca_id: $('#co_bienes_field_sub_categoria_mueble_marca').val()
	}
	$(prefix + 'sub_categoria_id').val(enviar.sub_categoria_id);
	$(prefix + 'tipo_id').val(enviar.tipo_id);
	$(prefix + 'marca_id').val(enviar.marca_id);
	if (enviar.tipo_id=="") {
	    $(prefix + 'tipo_id').val('0');
	} else {
	    $(prefix + 'tipo_id').val(enviar.tipo_id);
	}
	if (enviar.marca_id=="") {
	    $(prefix + 'marca_id').val('0');
	} else {
	    $(prefix + 'marca_id').val(enviar.marca_id);
	}
	$.ajax({
	    type: "POST",
	    data:enviar,
	    url: "./ajax/modal/bienes_mueble_modelo_table_modal.php",
	    success: function(data) {
		tabla.html(data);
	    }
	});
    }
    function co_bienes_field_sub_categoria_mueble_modelo_modal_field_edit(item) { 
	var prefix = '#co_bienes_field_sub_categoria_mueble_modelo_modal_field_';
	var datos = {
	      id: item.attr('codigo')
	    , nombre: item.find("td").eq(0).text()
	    , status: item.find("td").eq(1).text()
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
	if (datos.status=='Activo') {
	    $(prefix + 'status').prop('checked', true);
	} else if (datos.status=='Desactivo') {
	    $(prefix + 'status').prop('checked', false);
	}
	$('#bienes-mueble-modelo-tabla-ajax tr').removeClass('edit_item');
	item.addClass('edit_item');
	$(prefix + 'save').text( 'Editar' );
    }
    function co_bienes_field_sub_categoria_mueble_modelo_modal_field_cancel() { 
	var prefix = '#co_bienes_field_sub_categoria_mueble_modelo_modal_field_';
	var datos = {
	      id: '0'
	    , nombre: ''
	}
        $(prefix + 'id').val( datos.id );
        $(prefix + 'nombre').val( datos.nombre );
	$(prefix + 'status').prop('checked', true);

	$('#bienes-mueble-modelo-tabla-ajax tr').removeClass('edit_item');
	$(prefix + 'save').text( 'Añadir' );
    }
    function co_bienes_field_sub_categoria_mueble_modelo_modal_field_save() { 
	var prefix = '#co_bienes_field_sub_categoria_mueble_modelo_modal_field_';
	var enviar = {
	    sub_categoria_id: $(prefix + 'sub_categoria_id').val()
	    , id: $(prefix + 'id').val()
	    , tipo_id:  $(prefix + 'tipo_id').val()
	    , marca_id:  $(prefix + 'marca_id').val()
	    , nombre: $(prefix + 'nombre').val()
	    , status: $(prefix + 'status').is(':checked')
	}
	if ( enviar.nombre.trim() != ''
	   ) {
	    $.ajax({
		type: "POST",
		data: enviar, 
		url: "./ajax/modal/bienes_mueble_modelo/save_mueble_modelo_modal.php",
		success: function(data) {
	    	    if ( enviar.id=='0' ) {
			// data = '<tr><td>' + data + '</td></tr>'; // para pruebas
	    	    	$( '#bienes-mueble-modelo-tabla-ajax tbody' ).append( data );
	    	    } else {
			// data = '<td>' + data + '</td>'; // para pruebas
	    	    	$( '#bienes-mueble-modelo-tabla-ajax tbody .item_' + enviar.id ).html( data );
	    	    }
		    co_bienes_field_sub_categoria_mueble_modelo_modal_field_cancel(); // descomentar despues de pruebas
                    co_bienes_field_sub_categoria_mueble_modelo();
		}
	    });

	} else {
	    alert('Falta LLenar Información');
	}
    }
    // departamento
    function co_bienes_field_sub_categoria_inmueble_departamento () {
	var combo = $('#'+prefix+'sub_categoria_inmueble_departamento');
	var enviar = {
	    departamento_id: $('#'+prefix+'sub_categoria_inmueble_departamento').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_inmueble_departamento_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });	
    }
    // provincia
    function co_bienes_field_sub_categoria_inmueble_provincia () {
	var combo = $('#'+prefix+'sub_categoria_inmueble_provincia');
	var enviar = {
	      departamento_id: $('#'+prefix+'sub_categoria_inmueble_departamento').val()
	    , provincia_id: $('#'+prefix+'sub_categoria_inmueble_provincia').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_inmueble_provincia_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    // distrito
    function co_bienes_field_sub_categoria_inmueble_distrito () {
	var combo = $('#'+prefix+'sub_categoria_inmueble_distrito');
	var enviar = {
	      departamento_id: $('#'+prefix+'sub_categoria_inmueble_departamento').val()
	    , provincia_id: $('#'+prefix+'sub_categoria_inmueble_provincia').val()
	    , distrito_id: $('#'+prefix+'sub_categoria_inmueble_distrito').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/combos/bienes_inmueble_distrito_combo.php",
	    data: enviar,
	    success: function(data) {
		if (data != '')
		    combo.html(data);
		else
		    combo.html(option_empty);
		combo.trigger('chosen:updated');
	    }
        });
    }
    // eventos
    function co_bienes_field_sub_categoria_mueble_add() {
	var enviar = {
	      categoria_id: '1'
            , cotizacion_id: $("#co_id").val()
	    , id: $("#" + prefix + "sub_categoria_muebles_id").val()
	    , sub_categoria_id: $("#" + prefix + "sub_categoria_mueble").val()
	    , tipo_id: $("#" + prefix + "sub_categoria_mueble_tipo").val()
	    , marca_id: $("#" + prefix + "sub_categoria_mueble_marca").val()
	    , modelo_id: $("#" + prefix + "sub_categoria_mueble_modelo").val()
	    , descripcion: $("#" + prefix + "sub_categoria_mueble_descripcion").val()
	}
	if (enviar.sub_categoria_id!=4) {
	    if ( 
		enviar.tipo_id != '' &&
		enviar.descripcion.trim() != ''
	    ) {
		co_bienes_field_sub_categoria_mueble_add_ajax(enviar);
	    } else {
		alert('Falta llenar un datos');
	    }	    
	} else {
	    if ( 
		enviar.tipo_id != '' &&
		    enviar.descripcion.trim() != ''
	    ) {
		co_bienes_field_sub_categoria_mueble_add_ajax(enviar);
		
	    } else {
		alert('Falta llenar un datos');
	    }	    
	}
    }
    function co_bienes_field_sub_categoria_mueble_add_ajax(enviar) {
        $.ajax({
	    type: "POST",
	    url: "./ajax/buttons/bienes_muebles_save_buttons.php",
	    data: enviar,
	    success: function(data) {
		if (enviar.id==0) {
		    var tabla = $('#bienes-table-ajax tbody');
		    tabla.append( data );
		    co_bienes_field_sub_categoria_mueble_clear()
		} else {
		    var tr = $( '#bienes-table-ajax tbody .item_bien.item_' + enviar.categoria_id + '-' + enviar.id );
		    tr.html( data );

		    var codigos = '';
		    codigos += enviar.categoria_id;
		    codigos += '-'+ enviar.sub_categoria_id;
		    codigos += '-'+ enviar.id;

		    if (enviar.tipo_id=='') { codigos += '-0'; }
		    else { codigos += '-'+ enviar.tipo_id; }

		    if (enviar.marca_id=='') { codigos += '-0'; }
		    else { codigos += '-'+ enviar.marca_id; }

		    if (enviar.modelo_id=='') { codigos += '-0'; }
		    else { codigos += '-'+ enviar.modelo_id; }

		    tr.attr('codigos', codigos)
		    co_bienes_field_sub_categoria_mueble_clear();
		}
	    }
        });
    }
    function co_bienes_field_sub_categoria_mueble_clear() {
	$('#'+prefix+'sub_categoria_muebles_id').val(0);
	$("#" + prefix + "sub_categoria_mueble_tipo")
	    .val('')
	    .trigger('chosen:updated');
	$("#" + prefix + "sub_categoria_mueble_marca")
	    .val('')
	    .trigger('chosen:updated');
	$("#" + prefix + "sub_categoria_mueble_modelo")
	    .val('')
	    .trigger('chosen:updated');
	$("#" + prefix + "sub_categoria_mueble_descripcion").val('');
	$('#'+prefix+'sub_categoria_mueble_add').text('Añadir');
	$('#bienes-table-ajax tr').removeClass( 'edit_item' );
    }
    function co_bienes_field_sub_categoria_inmueble_add() {
	var enviar = {
	      categoria_id: '2'
	    , cotizacion_id: $("#co_id").val()
 	    , id: $("#" + prefix + "sub_categoria_inmuebles_id").val()
	    , sub_categoria_id: $("#" + prefix + "sub_categoria_inmueble").val()
	    , departamento_id: $("#" + prefix + "sub_categoria_inmueble_departamento").val()
	    , provincia_id: $("#" + prefix + "sub_categoria_inmueble_provincia").val()
	    , distrito_id: $("#" + prefix + "sub_categoria_inmueble_distrito").val()
	    , direccion: $("#" + prefix + "sub_categoria_inmueble_direccion").val()
	    , descripcion: $("#" + prefix + "sub_categoria_inmueble_descripcion").val()
	}
	if (
            enviar.sub_categoria_id != '' &&
	    enviar.departamento_id != '' &&
	    enviar.provincia_id != '' &&
	    // enviar.distrito_id != '' &&
	    enviar.direccion.trim() != ''
	) 
	{
            $.ajax({
		type: "POST",
		url: "./ajax/buttons/bienes_inmuebles_save_buttons.php",
		data: enviar,
		success: function(data) {
		    if (enviar.id==0) {
		    	var tabla = $('#bienes-table-ajax tbody');
		    	tabla.append( data );
		    	co_bienes_field_sub_categoria_inmueble_clear()
		    } else {
		    	var tr = $( '#bienes-table-ajax tbody .item_bien.item_'+enviar.categoria_id + '-' + enviar.id );
		    	tr.html( data );

			var codigos = '';
			codigos += enviar.categoria_id;
			codigos += '-'+ enviar.sub_categoria_id;
			codigos += '-'+ enviar.id;

			if (enviar.departamento_id=='') { codigos += '-0'; }
			else { codigos += '-'+ enviar.departamento_id; }

			if (enviar.provincia_id=='') { codigos += '-0'; }
			else { codigos += '-'+ enviar.provincia_id; }

			if (enviar.distrito_id=='') { codigos += '-0'; }
			else { codigos += '-'+ enviar.distrito_id; }
			tr.attr('codigos', codigos)
		    	co_bienes_field_sub_categoria_inmueble_clear();
		    }
		}
            });
	} else {
	    if (enviar.sub_categoria_id =='') {
		alert('Selecciona el Tipo de categoria');
	    }
	    if (enviar.departamento_id == '') {
		alert('Selecciona Departamento');
	    } 
	    if (enviar.provincia_id == '') {
		alert('Selecciona Provincia');
	    }
	    // if (enviar.distrito_id == '') {
	    //     alert('Selecciona Distrito');
	    // }
	    if (enviar.direccion.trim() == '') {
		alert('LLenar Direccion');
	    }


	}
    }
    function co_bienes_field_sub_categoria_inmueble_clear() {
	$('#'+prefix+'sub_categoria_inmuebles_id').val(0);
	$("#" + prefix + "sub_categoria_inmueble_direccion").val('');
	$("#" + prefix + "sub_categoria_inmueble_descripcion").val('');
	$('#'+prefix+'sub_categoria_inmueble_add').text('Añadir');
	$('#bienes-table-ajax tr').removeClass( 'edit_item' );
    }
    function co_bienes_field_categoria_masivo_clear() {
	$('#'+prefix+'categoria_masivo_id').val('0');
	$('#'+prefix+'categoria_masivo_descripcion').val('');
	$('#'+prefix+'categoria_masivo_save').text('Añadir');
	$('#'+prefix+'categoria_masivo_save').attr('disabled','');
	$('#'+prefix+'categoria_masivo_clear').attr('disabled','');
	$('#'+prefix+'categoria_masivo_label').html('[Nuevo]');
	$('#bienes-table-ajax tr').removeClass( 'edit_item' );
    }
    function co_bienes_field_categoria_masivo_save() {
	var enviar = {
	      id: $("#co_bienes_field_categoria_masivo_id").val()
	    , descripcion: $("#co_bienes_field_categoria_masivo_descripcion").val()
	    , tipo: 'no-file'
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/buttons/bienes_mazivo_save_buttons.php",
	    data: enviar,
	    success: function(data) {
		$( '#bienes-table-ajax tbody .item_3-' +  + enviar.id ).html( data );
		$('#co_bienes_field_categoria_masivo .ax-file-list').html('');
		co_bienes_field_categoria_masivo_clear();
	    }
        });
    }
    function co_bienes_field_sub_categoria_edit( item ) {
	var codigos = item.attr('codigos');
	var l = codigos.split('-'); 
	if ( l[0] == "1" ) { // muebles
	    var texto = item.find("td").eq(0).children('span').text();
	    var datos = {
		categoria_id: l[0]
		, sub_categoria_id: l[1]
		, id: l[2]
		, tipo_id: l[3]
		, marca_id: l[4]
		, modelo_id: l[5]
		, descripcion: texto
	    }
	    $('#bienes-table-ajax tr').removeClass( 'edit_item' );
	    $('#bienes-table-ajax .item_'+datos.categoria_id+'-'+datos.id).addClass( 'edit_item' );
	    $('#'+prefix+'sub_categoria_muebles_id')
		.val(datos.id)
	    ;
	    $('#'+prefix+'categoria_mueble_radio')
	    	.prop( "checked", true )
	    	.click();
	    // $('#'+prefix+'sub_categoria_mueble option').removeAttr( 'selected' );
	    // $('#'+prefix+'sub_categoria_mueble option[value=' + datos.sub_categoria_id + ']').attr( 'selected', 'selected' );
	    $('#'+prefix+'sub_categoria_mueble')
	    	.val( datos.sub_categoria_id )
	    	.trigger('chosen:updated');

	    if (datos.sub_categoria_id == '4') {
		$('#'+prefix+'sub_categoria_mueble_marca_content').hide();
		$('#'+prefix+'sub_categoria_mueble_modelo_content').hide();
	    } else {
		$('#'+prefix+'sub_categoria_mueble_marca_content').show();
		$('#'+prefix+'sub_categoria_mueble_modelo_content').show();
	    }

	    $('#'+prefix+'sub_categoria_mueble_tipo').html('<option value="' + datos.tipo_id + '"></option>');
	    $('#'+prefix+'sub_categoria_mueble_marca').html('<option value="' + datos.marca_id + '"></option>');
	    $('#'+prefix+'sub_categoria_mueble_modelo').html('<option value="' + datos.modelo_id + '"></option>');    
	    co_bienes_field_sub_categoria_mueble_tipo();
	    co_bienes_field_sub_categoria_mueble_marca();
	    co_bienes_field_sub_categoria_mueble_modelo();
	    $('#'+prefix+'sub_categoria_mueble_descripcion').val(datos.descripcion);
	    $('#'+prefix+'sub_categoria_mueble_add').text('Editar');
	    
	}
	if ( l[0] == "2" ) { // inmuebles
	    var direccion_cld = item.find("td").eq(0).children('span').eq(0).text();
	    var descripcion_cld = item.find("td").eq(0).children('span').eq(1).text();
	    var datos = {
		categoria_id: l[0]
		, sub_categoria_id: l[1]
		, id: l[2]
		, departamento_id: l[3]
		, provincia_id: l[4]
		, distrito_id: l[5]
		, direccion: direccion_cld
		, descripcion: descripcion_cld
	    }
	    $('#bienes-table-ajax tr').removeClass( 'edit_item' );
	    $('#bienes-table-ajax .item_'+datos.categoria_id+'-'+datos.id).addClass( 'edit_item' );
	    $('#'+prefix+'sub_categoria_inmuebles_id').val(datos.id);
	    $('#'+prefix+'categoria_inmueble_radio')
	    	.prop( "checked", true )
	    	.click();
	    $('#'+prefix+'sub_categoria_inmueble')
	    	.val( datos.sub_categoria_id )
	    	.trigger('chosen:updated')
	    	.change();
	    $('#'+prefix+'sub_categoria_inmueble_departamento').html('<option value="' + datos.departamento_id + '"></option>');
	    $('#'+prefix+'sub_categoria_inmueble_provincia').html('<option value="' + datos.provincia_id + '"></option>');
	    $('#'+prefix+'sub_categoria_inmueble_distrito').html('<option value="' + datos.distrito_id + '"></option>');    
	    co_bienes_field_sub_categoria_inmueble_departamento();
	    co_bienes_field_sub_categoria_inmueble_provincia();
	    co_bienes_field_sub_categoria_inmueble_distrito();
	    $('#'+prefix+'sub_categoria_inmueble_direccion').val(datos.direccion);
	    $('#'+prefix+'sub_categoria_inmueble_descripcion').val(datos.descripcion);
	    $('#'+prefix+'sub_categoria_inmueble_add').text('Editar');
	}
	if ( l[0] == "3" ) { // inmuebles
	    var file_cld = item.find("td").eq(0).children('.view').attr('href');
	    var descripcion_cld = item.find("td").eq(0).children('span').text();
	    var datos = {
		categoria_id: l[0]
		, sub_categoria_id: l[1]
		, id: l[2]
		, file: file_cld
		, descripcion: descripcion_cld
	    }
	    $('#'+prefix+'categoria_masivo_radio')
	    	.prop( "checked", true )
	    	.click();	    
	    // 
	    $('#'+prefix+'categoria_masivo_id').val(datos.id);
	    $('#'+prefix+'categoria_masivo_descripcion').val(datos.descripcion);
	    $('#'+prefix+'categoria_masivo_save').text('Editar');
	    $('#'+prefix+'categoria_masivo_save').removeAttr('disabled');
	    $('#'+prefix+'categoria_masivo_clear').removeAttr('disabled');
	    $('#'+prefix+'categoria_masivo_label').html('<a href="'+datos.file+'" target="_blank">Ver Arhivo</a>');
	    $('#bienes-table-ajax tr').removeClass( 'edit_item' );
	    $('#bienes-table-ajax .item_'+datos.categoria_id+'-'+datos.id).addClass( 'edit_item' );   	    
	}

    }
    function co_bienes_field_categoria_masivo(file) {
	var enviar = {
	      categoria_id: '3'
	    , sub_categoria_id: '11'
            , cotizacion_id: $("#co_id").val()
	    , id: $("#co_bienes_field_categoria_masivo_id").val()
	    , descripcion: $("#co_bienes_field_categoria_masivo_descripcion").val()
	    , archivo: file
	    , tipo: 'file'
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/buttons/bienes_mazivo_save_buttons.php",
	    data: enviar,
	    success: function(data) {
	    	if ( enviar.id=='0' ) {
	    	    $( '#bienes-table-ajax tbody' ).append( data );
	    	} else {
	    	    $( '#bienes-table-ajax tbody .item_3-' +  + enviar.id ).html( data );
	    	}
		$('#co_bienes_field_categoria_masivo .ax-file-list').html('');
		co_bienes_field_categoria_masivo_clear();
	    }
        });
    }
    function co_bienes_field_sub_categoria_delete( item ) {
	var codigos = item.attr('codigos');
	var l = codigos.split('-');
	var enviar = {
              cotizacion_id: $("#co_id").val()
	    , categoria_id: l[0]
	    , sub_categoria_id: l[1]
	    , id: l[2]
	}
	var div = $( '#bienes-table-ajax tbody .item_bien.item_'+enviar.categoria_id + '-' + enviar.id );
	div.css( 'background-color', '#FEC7C7' );
        $.ajax({
	    type: "POST",
	    url: "./ajax/delete/bienes_delete.php",
	    data: enviar,
	    success: function( data ) {
		co_bienes_field_sub_categoria_mueble_clear();
		co_bienes_field_sub_categoria_inmueble_clear();
	    }
	});	
	var myVar = setInterval( function() {
	    div.remove();
	}, 3000 );

    }
    // lista
    function co_bienes_field_sub_tabla() {
	var tabla = $('#' + prefix + 'tabla');
	var enviar = {
	      cotizacion_id: $('#co_id').val()
	}
        $.ajax({
	    type: "POST",
	    url: "./ajax/tables/bienes_tables.php",
	    data: enviar,
	    success: function(data) {
		tabla.html( data );
	    }
        });
    }
});
