jQuery(function($) {
    // Asynchronously Load the map API
    var script = document.createElement('script');
    script.src = "//maps.googleapis.com/maps/api/js?key= AIzaSyAxSUg_eIIxvaRgdO_d-_bSp9sPCzbXvgI&sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = [
        ['MINISO Ukraine, Kyiv', 50.442869,30.521574],
        ['Lavina Mall, Kyiv', 50.495094,30.362086],
        ['New Way, Kyiv', 50.415143,30.650212,14]
    ];

    var addedMarkers = [];

    // Info Window Content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>MINISO Украина</h3>' +
        '<p>Улица Крещатик, 29/1. Время работы: с 10:00 до 22:00</p>' +
        '</div>'],
        ['<div class="info_content">' +
        '<h3>ТРЦ &laquo;Lavina Mall&raquo;</h3>' +
        '<p>Улица Берковецкая, 6Д. Время работы: с 10:00 до 22:00</p>' +
        '</div>'],
        ['<div class="info_content">' +
        '<h3>ТРЦ &laquo;NewWay&raquo;</h3>' +
        '<p>Улица Архитектора Вербицкого,1. Время работы: с 10:00 до 22:00</p>' +
        '</div>']
    ];

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0],
            icon: '/app/assets/img/common/miniso-marker.png'
        });

        addedMarkers.push(marker);

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                var latLng = marker.getPosition(); // returns LatLng object
                map.setCenter(latLng); // setCenter takes a LatLng object
                map.setZoom(15);
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen

        map.fitBounds(bounds);
        map.panToBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        //this.setZoom(11);
        google.maps.event.removeListener(boundsListener);
    });

    $('.shop-item').click(function() {
        var markerIndex = $(this).attr('data-marker') * 1;
        google.maps.event.trigger(addedMarkers[markerIndex], 'click');
    });

    $(window).resize(function() {
        map.fitBounds(bounds);
        map.panToBounds(bounds);
    });
}

$(document).ready(function () {
    $('.shop-item').matchHeight();
});
