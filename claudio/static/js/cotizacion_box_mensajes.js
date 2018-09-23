$(function() {
    $("#co_box_mensajes").on("click", "a.caja", function(e){
	co_box_mensajes_caja( $(this) );
	e.preventDefault();
    });
    $("#co_box_mensajes").on("click", "a.linkBoxMensajes", function(e){
	co_box_mensajes_modal( $(this) );
	e.preventDefault();
    });
    
    // --------------------------
    function co_box_mensajes_caja(item) {
	if (item.attr('estado') == 'close') {
	    item.attr('estado', 'open');
	    item.parent().find(".box3").css('display','block');
	    item.find(".box2").html('-');
	} else if (item.attr('estado') == 'open') {
	    item.attr('estado', 'close');
	    item.parent().find(".box3").css('display','none');
	    item.find(".box2").html('+');
	}
    }
    function co_box_mensajes_modal( item ) {
	var enviar = {
	    'intervalo':item.attr( 'intervalo' )
	}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: "./ajax/tables/search_box_mensajes.php",
	    success: function(data) {
		$('#modalBoxMensajes table tbody.ajax').html( data );

	    }
        });
    }
});
