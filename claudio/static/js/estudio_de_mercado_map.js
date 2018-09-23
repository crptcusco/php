$(document).ready(function() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8, 
        center: new google.maps.LatLng(-12.0842292,-76.886481),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        streetViewControl: false,
        panControl: false,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM
	}
    });
    
    var marker;
    var markers = new Array();
    var iconCounter = 0;
    var images = new Array();
    images['t'] = {
        url: '../../static/img/marker-red.png',
        // size: new google.maps.Size(20, 32),  // width,height        
        // origin: new google.maps.Point(0, 0),
        // anchor: new google.maps.Point(0, 32)
    }
    images['em'] = {
        url: '../../static/img/marker-green.png',
    }

    // Add the markers and infowindows to the map
    var total = locations.length
    //alert('Se encontraron: '+total);
    for (var i = 0; i < total; i++) {
    	marker = new google.maps.Marker({
    	    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
    	    map: map,
    	    latitude:locations[i][0],
    	    longitude:locations[i][1],
            icon: images[ locations[i][2] ]
    	});
    	markers.push(marker);
    	google.maps.event.addListener(marker, 'click', (function(marker, i) {
    	    return function() {
    		explorer(marker.latitude,marker.longitude);
    	    }
    	})(marker, i));
    }
    var markerCluster = new MarkerClusterer(map, markers);

    function explorer(latitud, longitud) {
	var enviar='';
	enviar+= 'latitud='+latitud;
	enviar+= '&longitud='+longitud;
	enviar+= '&categorias='+$('#listado-categorias').text();
	$.ajax({
	    type: "POST",
	    url: "./ajax/popup.php",
	    data: enviar,
	    success: function(data) {
		//a(enviar);
		$('#myModal-marker .ajax').html(data);

                jQuery('#myModal-marker-trigger')[0].click();
                $(function() { 
                    $("#myModal-marker-trigger").change(function() {
                    });
                });
                jQuery(document).ready(function() {
                    jQuery('#myModal-marker-trigger').on('click');
                });
	    }
	});
    }
    // function AutoCenter() {
    // 	//  Create a new viewpoint bound
    // 	var bounds = new google.maps.LatLngBounds();
    // 	markers.forEach(function(marker) {
    // 	    bounds.extend(marker.position);
    // 	});
    // 	//  Fit these bounds to the map
    // 	map.fitBounds(bounds);
    // }
    //AutoCenter();

});


