$(document).ready(function() {

    var prefijo ='almacen-proveedor';
    var url_procesar='./05_02_tabla_dinamica_admin.php';
    var url_remplazar='./acciones/remplazar_proveedor.php';
    var contenedor_1 = '#'+prefijo+' ';
    var componente1 = '#'+prefijo+'-add';
    var com1 = $(componente1);
    var componente2 = '.'+prefijo+'-edit';
    var com2 = $(componente2);
    var componente3 = '#'+prefijo+'-cancel';
    var com3 = $(componente3);
    var componente4 = '.'+prefijo+'-delete';
    var com4 = $(componente4);
    var componente5 = '#'+prefijo+'-delete-warning-modal-realize';
    var com5 = $(componente5);

    var razon =     $('#'+prefijo+'-razon');
    var ruc =       $('#'+prefijo+'-ruc');
    var direccion = $('#'+prefijo+'-direccion');

    var enviar = '';
    // ----------------------------------------------------- componente 1 
    // add
    $(contenedor_1).on("click", componente1, function(e) {
        e.preventDefault();
        if (razon.val().trim() != "" && ruc.val().trim() != 0 && direccion.val().trim() != 0) {
            enviar = $(this).val() + '!!-!!'
                    + razon.val().trim() + '!!-!!'
                    + ruc.val().trim() + '!!-!!'
                    + direccion.val().trim() + '!!-!!'
                    + $(this).attr('accion')
                    ;
             // c(enviar); //---------------- solo pruebas          

            if ($(this).attr('accion') == 1) {
                var table = $('#'+prefijo+'-table');
                $.post(url_procesar,{VariableEnviarPost: enviar}, 
                function(data) {
                    table.append(data);
                });
                // table.append('<tr><td>create</td><tr>');
            } else if ($(this).attr('accion') == 2) {
                var tr = $('#'+prefijo+'-tr-' + $(this).val());
                $.post(url_procesar,{VariableEnviarPost: enviar}, 
                function(data) {
                    tr.html(data);
                });                
                //tr.html('<tr><td>update</td><tr>');
            }

            limpiar_proveedor();
        } else {
            alert('inserte datos');
        }

    });
    // ----------------------------------------------------- componente 2
    // edit
    $(contenedor_1).on("click", componente2, function(e) {
        e.preventDefault();
        com1.val(
                $(this).val()
                );
        razon.val(
                $(this).parent().parent().find("td").eq(0).text()
                );
        ruc.val(
                $(this).parent().parent().find("td").eq(1).text()
                );
        direccion.val(
                $(this).parent().parent().find("td").eq(2).text()
                );        
        com1.attr(
                'accion', '2'
                );
        com1.text('Editar');
    });
    // ----------------------------------------------------- componente 3
    // cancel
    $(contenedor_1).on("click", componente3, function(e) {
        e.preventDefault();
        limpiar_proveedor();
    });
    // ----------------------------------------------------- componente 4
    // delete
    $(contenedor_1).on("click", componente4, function(e) {
        e.preventDefault();
        var my = $(this);
        enviar = my.val() + '!!-!!0!!-!!0!!-!!0!!-!!0';
        // c(enviar); //---------------- solo pruebas
        my.parent().parent().css('background-color', '#FEC7C7');
        var myVar = setInterval(function() {
            $.post(url_procesar,{VariableEnviarPost: enviar}, 
            function(data) {
                if (data!='exito'){                    
                    my.parent().parent().css('background-color', 'transparent');
                    $('#'+prefijo+'-delete-warning-modal .modal-body').html(data);
                    $('#'+prefijo+'-delete-warning-trigger').click();
                } else {
                    my.parent().parent().remove();
                }
            });
            limpiar_proveedor();
            clearInterval(myVar);

        }, 1000);

    });
    // ----------------------------------------------------- componente 5
    // warning
    $(contenedor_1).on("click", componente5, function(e) {
        e.preventDefault();
        var id0 =$('#'+prefijo+'-delete-warning-modal-replace-old');
        var id1 =$('#'+prefijo+'-delete-warning-modal-replace-new');        
        if (id1.val()!=0){
            enviar = id0.val() +'!'+id1.val();

            $.post(url_remplazar,{VariableEnviarPost: enviar}, 
            function(data) {
                if (data=='exito') {
                    var tr = $('#'+prefijo+'-tr-'+id0.val());
                    tr.css('background-color', '#FEC7C7');
                    var myVar = setInterval(function() {
                        clearInterval(myVar);
                        tr.remove();
                    }, 1000);                    
                }
            });            

            // c(enviar);//------------------------- solo pruebas
        } else {
            alert('Necesita seleccionar Proveedor');
        }        

    });  

    // ----------------------------------------------------- funciones
    function limpiar_proveedor() {
        razon.val('');
        ruc.val('');
        direccion.val('');
        com1.attr('accion', '1');
        com1.val('0');
        com1.text('Nuevo');
    }
});