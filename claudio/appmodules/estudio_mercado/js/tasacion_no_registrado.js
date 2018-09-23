$(document).ready(function () {
    select_usuario_registra_load();
    
    //FUNCIONES
    function select_usuario_registra_load() {
        var enviar = {id: $('#ta_usuario_registro_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/tasacion_usuario_registra.php', '#ta_usuario_registro_id', enviar);
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
