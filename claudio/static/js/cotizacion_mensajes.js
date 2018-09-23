$(function() {
    mensaje_llenar_tabla();
    

    $("#co_mensaje_clear_content").on("click", "#co_mensaje_clear", function(e){
	$('#co_mensaje_texto').val('');
	$('#co_mensaje_fecha').val('');
	return false;
    });
    $("#co_mensaje_save_content").on("click", "#co_mensaje_save", function(e){
        mensaje_save();
        return false;
    });
    $('#co_mensaje_texto, #co_mensaje_cotizacion_finalizada').focus(function() {
        mensaje_texto_auto($(this));
    });
    function mensaje_llenar_tabla() {
	var tabla = $('#co_mensajes_tabla');
	var enviar = '';
	enviar += 'id='+ $('#co_id').val() + '&';
	enviar += 'estado='+ $('#co_estado_cotizacion').val();
	
	// a(enviar);
        $.ajax({
	    type: "POST",
	    url: "./ajax/tables/mensajes-tables.php",
	    data: enviar,
	    success: function( data ) {		
		tabla.html( data );
	    }
        });
    }    
    function mensaje_texto_auto(item) {
        item.autocomplete({
            source: './ajax/auto-complete/mensajes_texto.php',
            minLength: 0,
            search: function( event, ui ) {
                item.removeClass('active');
            },
            select: function( event, ui ) {
                item.val(ui.item.label).addClass('active');
                return false;
            }
        });
    }
    function mensaje_save() {
	var texto = $("#co_mensaje_texto").val();
	var enviar = '';
	enviar += 'co_id='+$("#co_id").val() + '&';
	enviar += 'texto='+ texto + '&';
	enviar += 'fecha='+$("#co_mensaje_fecha").val() + '&';
	enviar += 'estado_cotizacion='+$("#co_estado_cotizacion").val();
	var table = $('#co_mensajes_tabla table tbody');
	if (texto.trim()!='') {
	    //c(enviar);
	    $.ajax({
		type: "POST",
		url: "./ajax/buttons/mensajes-buttons.php",
		data: enviar,
		success: function( data ) {
		    table.prepend( data );
		}
            });
	    // mensaje_texto_auto();
	} else {
	    alert('El mensaje es obligatorio');
	}
	// limpiando cajas
	$("#co_mensaje_texto").val('');
	$("#co_mensaje_fecha").val('');
    }

});
