$(document).ready(function () {
    
    select_zonificacion_load();
    select_usuario_registra_load();
    //select_tipo_cultivo_load();
    //EVENTOS
    //$("#terreno_tipo_cultivo_trigger_add").on("click", function(e) {
    //    select_tipo_cultivo_modal(0);
    //});
    //$("#modal_ta_terreno_tipo_cultivo_save").on("click", function(e) {
    //    select_tipo_cultivo_save();
    //});

    //FUNCIONES
    function select_usuario_registra_load() {
        var enviar = {id: $('#ta_usuario_registro_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/tasacion_usuario_registra.php', '#ta_usuario_registro_id', enviar);
    }
    
    
    function select_zonificacion_load() {
        var enviar = {id: $('#tasacion_zonificacion_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/tasacion_zonificacion.php', '#tasacion_zonificacion_id', enviar);
    }

    //function select_tipo_cultivo_load() {
    //    var enviar = {id: $('#tasacion_tipo_cultivo_id').val()};
    //    // console.log(enviar);
    //    select_simple('../ajax/combos2/tasacion_tipo_cultivo.php', '#tasacion_tipo_cultivo_id', enviar);
    //}

    //function select_tipo_cultivo_modal(id) {
    //}
    //function select_tipo_cultivo_save() {
    //    var enviar = {
    //        'nombre': $('#modal_ta_terreno_tipo_cultivo_nombre').val(),
    //    }
    //// console.log(enviar);
    //$.ajax({
    //    type: "POST",
    //    data: enviar,
    //    url: '../ajax/save2/terreno_tipo_cultivo.php',
    //    success: function(data) {
    //        $('#modal_ta_terreno_tipo_cultivo_nombre').val('');
    //        if (data.trim() == '') {
    //            select_tipo_cultivo_load();
    //        } else {
    //            alert(data);
    //        }
    //            
    //        }
    //    });
    //    }
    // reutilizable --------------------------------
    function select_simple(path, componente, enviar) {
        var select = $(componente);
        $.ajax({
            type: "POST",
            data: enviar,
            url: path,
            success: function (data) {
                select.html(data);
                select.trigger('chosen:updated');
            }
        });
    }
});

//DIVISION DE DOS NUMEROS
//$(".division").on("keydown keyup", function () {
//    var valor = $("#valor_comercial").val() / $("#terreno_area").val();
//    $("#terreno_valorunitario").val(parseFloat(valor).toFixed(2));
//});

//DESHABILITAR COMBOS UBICACION
$('#ubi_provincia_id').prop("disabled", true);
$('#ubi_distrito_id').prop("disabled", true);

//COMBOS DINAMICOS UBICACION
$("#ubi_departamento_id").change(function () {
    $("#ubi_departamento_id option:selected").each(function () {
        id_departamento = $(this).val();
        $.post('../modelo/combos.php?opcion=provincias', {id_departamento: id_departamento}, function (data) {
            $("#ubi_provincia_id").html(data);  
        });
    });
    $('#ubi_provincia_id').prop("disabled", false);
    $('#ubi_distrito_id').prop("disabled", true);
});
$("#ubi_provincia_id").change(function () {
    $("#ubi_provincia_id option:selected").each(function () {
        id_provincia = $(this).val();
        $.post('../modelo/combos.php?opcion=distritos', {id_provincia: id_provincia}, function (data) {
            $("#ubi_distrito_id").html(data);
        });
    });
    $('#ubi_distrito_id').prop("disabled", false);
});