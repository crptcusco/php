$(document).ready( function() {
    var prefix = "#asistencia_reporte ";
    var option_empty='<option value=""></option>';

    // -------------------------------------------------------- LOAD
    asistencia_reporte_persona();

    // -------------------------------------------------------- EVENTOS
    $(prefix).on("click", ".field_mostrar", function(e) {
	asistencia_reporte_field_table();
	e.preventDefault();
    });    

    // -------------------------------------------------------- FUNCIONES
    function asistencia_reporte_persona() {
	var combo = $(prefix+'.field_persona');
        $.ajax({
	    type: "POST",
	    data: "id=" + combo.val(),
	    url: "./ajax/combos/asistencia_reporte_personas_combo.php",
	    success: function(data) {		
		if (data != '') {
		    combo.html(data);
		    combo.trigger('chosen:updated');
		}
		else {
		    combo.html(option_empty);
		    combo.trigger('chosen:updated');
		}
	    }
        });	
    }
    function asistencia_reporte_field_table(){
	var tabla = $(prefix+'.tabla');
	var enviar = {
            ini: $(prefix+'.field_ini').val()
	    , end: $(prefix+'.field_end').val()
	    , persona_id: $(prefix+'.field_persona').val()
	}
	if (enviar.ini!='' && 
	    enviar.end!='' 
	   ) 
	{
	    $.ajax({
		type: "POST",
		data: enviar,
		url: "./ajax/tables/asistencia_reporte_yanet.php",
		success: function(data) {
		    tabla.html(data);
		}
	    });	    
	} else 
	{
	    alert('Falta llenar fechas');
	}
    }
});
