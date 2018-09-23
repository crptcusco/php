$(document).ready(function() {
    /////////////////////////////////////
    var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 12, 
	// center: new google.maps.LatLng(-12.0842292,-76.886481),
	center: new google.maps.LatLng(-12.047043,-77.044401),
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
    // Add the markers and infowindows to the map
    var total = locations.length
    //alert('Se encontraron: '+total);
    for (var i = 0; i < total; i++) {
    	marker = new  MarkerWithLabel({
    	    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
    	    map: map,
    	    latitude:locations[i][0],
    	    longitude:locations[i][1],
            id:locations[i][3],
            labelContent: locations[i][2],
	    labelAnchor: new google.maps.Point(22, 0),
            labelClass: "labels",
    	});
    	markers.push(marker);
    	google.maps.event.addListener(marker, 'click', (function(marker, i) {
    	    return function() {
		//$('#list-item .item').hide();
		//$('#list-item #item-'+marker.id).show();
		$('#list-item #item-'+marker.id).foundation('reveal','open');
    	    }
    	})(marker, i));
    }
    //var markerCluster = new MarkerClusterer(map, markers);

});


