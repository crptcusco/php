$(document).ready(function() {
    var option_empty='<option value=""></option>';
    // ------------------------------------------- INICIO
    combo_tipo_servicio();
    combo_estado_cotizacion();

    combo_tipo_cotizacion();
    combo_desgloce();
    co_adjunto_view();
    // ------------------------------------------- EVENTO
    $("#content_co_tipo_servicio").on("click", ".cld-icon-search", function(e) {
        modal_tipo_servicio();
        e.preventDefault();
    } );
    $("#modal_co_tipo_servicio").on("click", ".editar", function(e) {
        var nombre = $(this).parent().parent().find("td").eq(0).text();
        var estado = $(this).parent().parent().find("td").eq(1).text();
        var codigo = $(this).attr('codigo');
        if (estado=='Activado') {
            estado=true;
        }
        if (estado=='Desactivado') {
            estado=false;
        }
        $('#co_tipo_servicio_activo').prop('checked', estado);
        $('#co_tipo_servicio_nombre').val(nombre);
        $('#co_tipo_servicio_codigo').val(codigo);
        $('#co_tipo_servicio_button').text('Editar');
        $('#lista_tipo_servicio tr').removeClass('edit_item');
        $(this).parent().parent().addClass('edit_item');
        e.preventDefault();
    } );
    $("#modal_co_tipo_servicio").on("click", "#co_tipo_servicio_button", function(e) {
        var enviar = '';
        var accion = $(this).text();
        var codigo = $('#co_tipo_servicio_codigo').val();
        var estado = '';
        enviar += accion + '!!-!!';
        enviar += codigo + '!!-!!';
        enviar += $('#co_tipo_servicio_nombre').val() + '!!-!!';
        if ($('#co_tipo_servicio_activo').prop('checked') == false) {
            enviar += 'Desactivado';
            estado = 'Desactivado';
        } else {
            enviar += 'Activado';
            estado = 'Activado';
        }
        if ($('#co_tipo_servicio_nombre').val().trim()=='') {
            alert('Campo obligatorio');
        } else {
            $.post("./ajax/modal/tipo_servicios/add_edit.php",{VariablePost: enviar},
                   function(data) {
                       //a(data);
                       // modificando tabla
                       if (accion=='Añadir') {
                           $( '#lista_tipo_servicio' )
                               .append(data);
                       }
                       if (accion=='Editar') {
                           if (data=='error'){
                               alert('Dato Cerrado');
                           } else{
                               $( '.lista_tipo_servicio.item-'+codigo ).html(data);
                           }
                       }                       
                       combo_tipo_servicio();
                   });
            // limpiando formulario
            $('#co_tipo_servicio_activo').prop('checked', true);
            $('#co_tipo_servicio_nombre').val('');
            $('#co_tipo_servicio_codigo').val('0');
            $('#co_tipo_servicio_button').text('Añadir');
            $('#lista_tipo_servicio tr').removeClass('edit_item');
            //console.log(enviar);
        }
        return false;
    } );
    $("#modal_co_tipo_servicio").on("click", "#co_tipo_servicio_cancelar", function(e) {
        // limpiando formulario
        $('#co_tipo_servicio_activo').prop('checked', true);
        $('#co_tipo_servicio_nombre').val('');
        $('#co_tipo_servicio_codigo').val('0');
        $('#co_tipo_servicio_button').text('Añadir');
        $('#lista_tipo_servicio tr').removeClass('edit_item');
        e.preventDefault();
    } );
    $("#co_adjunto_update").ajaxupload( {
        url:'real_ajax_upload.php',
        language: 'it_IT',
        remotePath:'../../../files/cotizacion/adjuntos/',
        data:'asd=asd&qwe=123',
        success:function(file) {
            co_adjunto_update( file );
        },
        beforeUpload: function(filename, fileobj) {
            if( filename.length>350 ) {
                return false; //file will not be uploaded
            }
            else {
                return true; //file will be uploaded
            }
        },
        error:function(txt, obj) {
            alert('Un error a ocurrido '+ txt);
        }
    } );
    // ------------------------------------------- FUNCIONES
    // ------- combo
    function combo_tipo_servicio () {
        var combo = $('#co_tipo_servicio');
        $.ajax({
            type: "POST",
            url: "./ajax/combos/tipo_servicios.php",
            data: "id=" + combo.val(),
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
    function combo_estado_cotizacion () {
        var combo = $('#co_estado_cotizacion');
        $.ajax({
            type: "POST",
            url: "./ajax/combos/estado_cotizacion.php",
            data: "id=" + combo.val(),
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
    //
    function combo_tipo_cotizacion () {
        var combo = $('#co_tipo_cotizacion');
        $.ajax({
            type: "POST",
            url: "./ajax/combos/tipo_cotizacion.php",
            data: "id=" + combo.val(),
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
    function combo_desgloce () {
        var combo = $('#co_desglose');
        $.ajax({
            type: "POST",
            url: "./ajax/combos/desglose.php",
            data: "id=" + combo.val(),
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
    // ------- modal
    function modal_tipo_servicio () {
        var modal = $('#modal_co_tipo_servicio .modal_ajax');
        $.ajax({
            type: "POST",
            url: "./ajax/modal/tipo_servicios.php",
            success: function(data) {
                modal.html(data);
            }
        });
    } // seleccionar_provincia
    // ------- adjunto
    function co_adjunto_view() {
        var div = $('#co_adjunto_view');
        var enviar = {
            cotizacion_id: $("#co_id").val()
        }
        $.ajax({
            type: "POST",
            url: "./ajax/file/general_adjunto_mostrar_file.php",
            data: enviar,
            success: function(data) {
                $('#co_adjunto_view').html(data);
            }
        });
    }
    function co_adjunto_update( file ) {
        var enviar = {
            cotizacion_id: $("#co_id").val()
            , archivo: file
        }
        $.ajax({
            type: "POST",
            url: "./ajax/buttons/general_adjunto_buttons.php",
            data: enviar,
            success: function(data) {
                $('#co_adjunto_update .ax-file-list').html('');
                co_adjunto_view();
            }
        });
    }
});
