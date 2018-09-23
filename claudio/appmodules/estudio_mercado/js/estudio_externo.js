$(document).ready(function () {
//MOSTRAR ELEMENTOS DEL FORMULARIO
//Quitar la vista local id
$('#vista_local_id').hide();
$("#tipo_propiedad").hide();
$("#categoria").change(function () {
    switch ($("#categoria").val()) {
        case("em_departamento"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').show();
        $('#departamento_tipo_id').show();
        $('#areas_complementarias').show();
        $('#piso_ubicacion').show();
        $('#vista_local_id').show();
        $("#tipo_propiedad").hide();
        break;
        case("em_oficina"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').show();
        $('#departamento_tipo_id').show();
        $('#areas_complementarias').show();
        $('#piso_ubicacion').show();
        $('#vista_local_id').show();
        $("#tipo_propiedad").show();
        break;
        case("em_local_comercial"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').hide();
        $('#departamento_tipo_id').hide();
        $('#areas_complementarias').hide();
        $('#piso_ubicacion').hide();
        $('#vista_local_id').show();
        $("#tipo_propiedad").hide();
        break;
        case("em_local_industrial"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').hide();
        $('#departamento_tipo_id').hide();
        $('#areas_complementarias').hide();
        $('#piso_ubicacion').hide();
        $('#vista_local_id').hide();
        $("#tipo_propiedad").hide();
        break;
        case("em_terreno"):
        $('#edificacion_area').hide();
        $('#piso_cantidad').hide();
        $('#estacionamiento_cantidad').hide();
        $('#departamento_tipo_id').hide();
        $('#areas_complementarias').hide();
        $('#piso_ubicacion').hide();
        $('#vista_local_id').hide();
        $("#tipo_propiedad").hide();
        break;
        case("em_casa"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').hide();
        $('#departamento_tipo_id').hide();
        $('#areas_complementarias').hide();
        $('#piso_ubicacion').hide();
        $('#vista_local_id').hide();
        $("#tipo_propiedad").hide();
        break;
        default:
        break;
    }
}); 

$("#tipo_propiedad").change(function () {
    switch ($("#tipo_propiedad").val()) {
        case("EXCLUSIVA"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').hide();
        $('#departamento_tipo_id').hide();
        $('#areas_complementarias').hide();
        $('#piso_ubicacion').hide();
        $('#vista_local_id').hide();
        break;  
        case("HORIZONTAL"):
        $('#edificacion_area').show();
        $('#piso_cantidad').show();
        $('#estacionamiento_cantidad').show();
        $('#departamento_tipo_id').show();
        $('#areas_complementarias').show();
        $('#piso_ubicacion').show();
        $('#vista_local_id').show();
        break; 
        default:
        break;
    }
});  
//MOSTRAR FECHA DE REGISTRO
//$('#estudio_fecha').prop("disabled", true);
var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear() + "-" + (month) + "-" + (day);
$('#estudio_fecha').val(today);
//DIVISION DE DOS NUMEROS
    //$(".division").on("keydown keyup", function () {
    //    var valor = $("#valor_comercial").val() / $("#terreno_area").val();
    //    $("#terreno_valorunitario").val(parseFloat(valor).toFixed(2));
    //});        
//DESHABILITAR COMBOS UBICACION
$('#provincias').prop("disabled", true);
$('#distritos').prop("disabled", true);
//COMBOS DINAMICOS UBICACION
$("#departamentos").change(function () {
    $("#departamentos option:selected").each(function () {
        id_departamento = $(this).val();
        $.post('../modelo/combos.php?opcion=provincias', {id_departamento: id_departamento}, function (data) {
            $("#provincias").html(data);
        });
    });
    $('#provincias').prop("disabled", false);
    $('#distritos').prop("disabled", true);
});
$("#provincias").change(function () {
    $("#provincias option:selected").each(function () {
        id_provincia = $(this).val();
        $.post('../modelo/combos.php?opcion=distritos', {id_provincia: id_provincia}, function (data) {
            $("#distritos").html(data);
        });
    });
    $('#distritos').prop("disabled", false);
});
});