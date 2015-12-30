/**
 * Created by Matic-ProBook on 24. 10. 2015.
 */
$(document).ready(function () {
    /* ========================================================================
     Zemljevid
     ========================================================================== */
    function initialize() {
        var myLatlng = new google.maps.LatLng(46.0500176, 14.4668417);
        var mapOptions = {
            center: myLatlng,
            zoom: 16,
            scrollwheel: true,
            draggable: true,
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true,
            rotateControl: true,
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        var contentString = '<div id="content">'+
            '<h1 class="map-naslov">Fakulteta za ra&#269unalni&#353tvo in informatiko<br />Ve&#269na pot 113<br />1000 Ljubljana<br /></h1>'+
            '<span class="glyphicon glyphicon-phone"></span><span class="map-contact">(01) 479 8000</span> &emsp; &emsp; &emsp; &emsp;' +
            '<a href="mailto:it@fri.uni-lj.si"><span class="glyphicon glyphicon-envelope"></span></a> &emsp; &emsp;' +
            '<a href="http://www.fri.uni-lj.si/" target="_blank"><span class="glyphicon glyphicon-globe"></span></a>' +
        '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: myLatlng,
            title: 'FRI'
        });
        infowindow.open(map, marker);
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

});

