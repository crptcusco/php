$(document).ready(function () {
    select_pagina_categoria_load();

    //EVENTOS
    $("#pagina_categoria_add").on("click", function(e) {
        select_tipo_cultivo_modal(0);
    });
    $("#modal_pagina_categoria_save").on("click", function(e) {
        select_tipo_cultivo_save();
    });

    //FUNCIONES
    function select_pagina_categoria_load() {
        var enviar = {id: $('#pagina_categoria_id').val()};
        // console.log(enviar);
        select_simple('../ajax/combos2/pagina_categoria.php', '#pagina_categoria_id', enviar);
    }

    function select_tipo_cultivo_modal(id) {
    }
    function select_tipo_cultivo_save() {
        var enviar = {
            'nombre': $('#modal_es_pagina_categoria_nombre').val(),
        }
    // console.log(enviar);
    $.ajax({
        type: "POST",
        data: enviar,
        url: '../ajax/save2/pagina_categoria.php',
        success: function(data) {
            $('#modal_es_pagina_categoria_nombre').val('');
            if (data.trim() == '') {
                select_pagina_categoria_load();
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