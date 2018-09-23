$(document).ready(function() {
    var dataTable = $('#example').DataTable({
	"processing": true,
	"serverSide": true,
	"ajax":{
	    url :"./ajax/tables/employee-grid-data.php", // json datasource
	    type: "post",  // method  , by default get
	    error: function(){
		// error handling
		$(".employee-grid-error").html("");
		$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
		$("#employee-grid_processing").css("display","none");	     
	    }
	}
    });
    $("#example_filter").css("display","none");
    $("#example_length").css("display","none");
    $('#example .search-input-text').on( 'keyup click', function () {
	// for text boxes
	var i =$(this).attr('data-column');  // getting column index
	var v =$(this).val();  // getting search input value
	dataTable.columns(i).search(v).draw();
    } );
    $('#example .search-input-select').on( 'change', function () {
	// for select box
	var i =$(this).attr('data-column');  
	var v =$(this).val();  
	dataTable.columns(i).search(v).draw();
    } );

});
$(document).ready(function() {
    $('#example').DataTable();
} );