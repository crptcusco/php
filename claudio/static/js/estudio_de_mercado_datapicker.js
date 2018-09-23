$(function () {
    $('#data-picker-ini').text($('#data-picker-ini').data('date'));
    $('#data-picker-end').text($('#data-picker-end').data('date'));

    var start_str = $('#data-picker-ini').text();
    var start_arr = start_str.split('-');
    start_arr[2] = parseInt(start_arr[2]);
    start_arr[1] = parseInt(start_arr[1]) -1;
    start_arr[0] = parseInt(start_arr[0]);

    var end_str = $('#data-picker-end').text();
    var end_arr = end_str.split('-');
    end_arr[2] = parseInt(end_arr[2]);
    end_arr[1] = parseInt(end_arr[1]) -1;
    end_arr[0] = parseInt(end_arr[0])

    var startDate = new Date(start_arr[2], start_arr[1], start_arr[0]);
    //a(startDate);
    var endDate = new Date(end_arr[2], end_arr[1], end_arr[0]);
    //a(endDate);
    $('#data-picker-ini').fdatepicker().on('changeDate', function (ev) {
	if (ev.date.valueOf() > endDate.valueOf()) {
	    $(this).fdatepicker( 'update', $('#data-picker-ini').text() );
	    alert('La fecha de INICIO no puede ser MAYOR a la fecha de FIN');
	} else {
	    $('#data-picker-ini').text($('#data-picker-ini').data('date'));
	    startDate = new Date(ev.date);
	}
	$('#data-picker-ini').fdatepicker('hide');
    });
    $('#data-picker-end').fdatepicker().on('changeDate', function (ev) {
	if (ev.date.valueOf() < startDate.valueOf()) {
	    $(this).fdatepicker( 'update', $('#data-picker-end').text() );
	    alert('La fecha de FIN no puede ser INFERIOR a la fecha de INICIO');
	} else {
	    $('#data-picker-end').text($('#data-picker-end').data('date'));
	    endDate = new Date(ev.date);
	}
	$('#data-picker-end').fdatepicker('hide');
    });
    
});
