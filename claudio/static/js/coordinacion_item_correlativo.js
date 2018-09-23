$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#coor_coordinacion_item_field_';
    var prefixClass = '.coor_coordinacion_item_field_';

    // --------------------------------------------------------------- load

    
    // ------------------------------------------------------------ eventos    
    $(prefixId+"codigo_correlativo_trigger").on("click", function(e) {
        coor_coordinacion_item_field_codigo_correlativo_trigger($(this));
	e.preventDefault();
    });
    $(prefixId+"codigo_correlativo_modal_save").on("click", function(e) {
        coor_coordinacion_item_field_codigo_correlativo_modal_save();
	e.preventDefault();
    });
    
    // ---------------------------------------------------------- funciones
    function coor_coordinacion_item_field_codigo_correlativo_trigger(item) {
        $(prefixId+'codigo_correlativo_modal_texto').val(item.text());
    }
    function coor_coordinacion_item_field_codigo_correlativo_modal_save() {
        var enviar = {
            coordinacion_id: $(prefixId+'coordinacion_id').val(),
            texto: $(prefixId+'codigo_correlativo_modal_texto').val()
        }
        // c(enviar);

        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './ajax/buttons/coordinacion_item_coordinacion_correlativo_change.php',
	    success: function(data) {
                if (data == 'errorCodigo'){
                    alert('El codigo ya existe!');
                } else {
                    $(prefixId+'codigo_correlativo_trigger').text(enviar.texto);
                }
            }
	});
        
        
        
    }


    // ------------------------------------------------------ reutilizables
    function none_simple(path, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {}
	});
    }
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
    function tr_td_simple_add( path, componente, enviar ) {
	$.ajax({
	    type: "POST",
	    data: enviar,
	    url: path,
	    success: function(data) {
                $(componente + ' tbody').append(data);
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
                        clearInterval(myVar);
		    }, 2100 );
		}
	    }
	});
    }
});
