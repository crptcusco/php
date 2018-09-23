$(function () {

    $('.datapicker-simple').fdatepicker({
        format: 'dd-mm-yyyy'
        , language: 'es'
        , weekStart: 1
    });
    $('body').on('click', ".datapicker-simple-clear", function(e) {
        $('#'+$(this).attr('data-picker')).val('');
    });    
});
