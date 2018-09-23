$(document).ready(function () {
    select_vehiculo_tipo_load();
    select_vehiculo_marca_load();
    select_vehiculo_modelo_load();
    select_vehiculo_traccion_load();
    select_usuario_registra_load();

    //EVENTOS
    $("#vehiculo_tipo_trigger_add").on("click", function(e) {
        //select_vehiculo_tipo_modal(0);
    });
    $("#modal_ta_vehiculo_tipo_save").on("click", function(e) {
        select_vehiculo_tipo_save();
    });

    $("#vehiculo_marca_trigger_add").on("click", function(e) {
        //select_vehiculo_marca_modal(0);
    });
    $("#modal_ta_vehiculo_marca_save").on("click", function(e) {
        select_vehiculo_marca_save();
    });

    $("#vehiculo_modelo_trigger_add").on("click", function(e) {
        //select_vehiculo_modelo_modal(0);
    });
    $("#modal_ta_vehiculo_modelo_save").on("click", function(e) {
        select_vehiculo_modelo_save();
    });

    $("#vehiculo_traccion_trigger_add").on("click", function(e) {
        //select_vehiculo_traccion_modal(0);
    });
    $("#modal_ta_vehiculo_traccion_save").on("click", function(e) {
        select_vehiculo_traccion_save();
    });

    //FUNCIONES
    function select_usuario_registra_load() {
        var enviar = {id: $('#ta_usuario_registro_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/tasacion_usuario_registra.php', '#ta_usuario_registro_id', enviar);
    }
    
    function select_vehiculo_tipo_load() {
        var enviar = {id: $('#tasacion_vechiculo_tipo_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/vehiculo_tipo.php', '#tasacion_vehiculo_tipo_id', enviar);
    }

    function select_vehiculo_marca_load() {
        var enviar = {id: $('#tasacion_vehiculo_marca_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/vehiculo_marca.php', '#tasacion_vehiculo_marca_id', enviar);
    }

    function select_vehiculo_modelo_load() {
        var enviar = {id: $('#tasacion_vehiculo_modelo_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/vehiculo_modelo.php', '#tasacion_vehiculo_modelo_id', enviar);
    }

    function select_vehiculo_traccion_load() {
        var enviar = {id: $('#tasacion_vehiculo_traccion_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/vehiculo_traccion.php', '#tasacion_vehiculo_traccion_id', enviar);
    }

    function select_vehiculo_traccion_save() {
        var enviar = {
            'nombre': $('#modal_ta_vehiculo_traccion_nombre').val(),
        }
        $.ajax({
            type: "POST",
            data: enviar,
            url: '../ajax/save2/vehiculo_traccion.php',
            success: function(data) {
                $('#modal_ta_vehiculo_traccion_nombre').val('');
                if (data.trim() == '') {
                    select_vehiculo_traccion_load();
                } else {
                    alert(data);
                }
            }
        });
    }

    function select_vehiculo_modelo_save() {
        var enviar = {
            'nombre': $('#modal_ta_vehiculo_modelo_nombre').val(),
        }
        $.ajax({
            type: "POST",
            data: enviar,
            url: '../ajax/save2/vehiculo_modelo.php',
            success: function(data) {
                $('#modal_ta_vehiculo_modelo_nombre').val('');
                if (data.trim() == '') {
                    select_vehiculo_modelo_load();
                } else {
                    alert(data);
                }
            }
        });
    }

    function select_vehiculo_marca_save() {
        var enviar = {
            'nombre': $('#modal_ta_vehiculo_marca_nombre').val(),
        }
        $.ajax({
            type: "POST",
            data: enviar,
            url: '../ajax/save2/vehiculo_marca.php',
            success: function(data) {
                $('#modal_ta_vehiculo_marca_nombre').val('');
                if (data.trim() == '') {
                    select_vehiculo_marca_load();
                } else {
                    alert(data);
                }
            }
        });
    }

    function select_vehiculo_tipo_save() {
        var enviar = {
            'nombre': $('#modal_ta_vehiculo_tipo_nombre').val(),
        }
        $.ajax({
            type: "POST",
            data: enviar,
            url: '../ajax/save2/vehiculo_tipo.php',
            success: function(data) {
                $('#modal_ta_vehiculo_tipo_nombre').val('');
                if (data.trim() == '') {
                    select_vehiculo_tipo_load();
                } else {
                    alert(data);
                }
            }
        });
    }


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