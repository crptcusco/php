$(document).ready(function () {
    var componente_1 = '#miDisparador ';
    var componente_2 = '#miTabla ';
    $(componente_1).on("click", "a", function (e) {
        e.preventDefault();
        var output = '<tr><td>datos</td><td><a class="delete" href="#">Delete</a></td></tr>';
        $(componente_2 + " tbody").append(output);
    });

    $(componente_2).on("click", ".delete", function (e) {
        e.preventDefault();
        var my = $(this)
        my.parent().parent().css('background-color', '#FEC7C7');
        var myVar = setInterval(function () {
            clearInterval(myVar);
            my.parent().parent().remove();
            c('a');
        }, 1000);
    });

});