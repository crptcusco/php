$(document).ready(function() {
    var componente_1 = "#demo1";
    var componente_2 = "#demo2";
    var contador1 = 0;
    var contador2 = 10;
    var myVar1 = setInterval(function() {
        $.ajax({
            type: "POST",
            url: "./04_02_recargar_divs_con_ajax.php",
            data: "contador=" + contador1,
            success: function(a) {
                $(componente_1).html(a);
                contador1 = contador1 + 1;
                if (contador1 > 10) {
                    contador1 = 0;
                }
            }
        });
    }, 1000);
    var myVar2 = setInterval(function() {
        $.ajax({
            type: "POST",
            url: "./04_02_recargar_divs_con_ajax.php",
            data: "contador=" + contador2,
            success: function(a) {
                $(componente_2).html(a);
                contador2 = contador2 - 1;
                if (contador2 == -1) {
                    clearInterval(myVar2);
                }

            }
        });
    }, 1000);

});