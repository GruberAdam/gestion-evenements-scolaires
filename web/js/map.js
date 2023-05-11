var geocoder = new google.maps.Geocoder(); // initialize google map object
var address = document.getElementById("address").textContent
geocoder.geocode( { 'address': address}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        var myCenter=new google.maps.LatLng(latitude,longitude);
        function initialize()
        {
            var mapProp = {
                center:myCenter,
                zoom:7,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map=new google.maps.Map(document.getElementById("map"),mapProp);

            var marker=new google.maps.Marker({
                position:myCenter,
            });

            marker.setMap(map);
            map.setZoom(17)
            map.panTo(curmarker.position);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    }
});