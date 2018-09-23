$(document).ready(function() {
    //-------------------------------------------------- eventos
    $("body").on("click", "#co_fecha_solicitud_clear", function(e) {
	$('#co_fecha_solicitud').val('');
	return false;
    });
    $("body").on("click", "#co_fecha_envio_cliente_clear", function(e) {
	$('#co_fecha_envio_cliente').val('');
	return false;
    });
    $("body").on("click", "#co_fecha_finalizado_clear", function(e) {
	$('#co_fecha_finalizado').val('');
	return false;
    });
    //-------------------------------------------------- funciones
});
