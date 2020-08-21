function initMap() {
    var locations = []

    for (var i in places) {
        locations.push({
            lat: parseFloat(places[i]['lat']),
            lng: parseFloat(places[i]['lng'])
        })

        var markers = locations.map(function(location, i) {
            return new google.maps.Marker({
                position: {
                    lat: parseFloat(places[i]['lat']),
                    lng: parseFloat(places[i]['lng'])
                },
                title: 'Zona de Riesgo: ' +
                    places[i]['name'] +
                    '\nCasos Positivos: ' +
                    places[i]['cantidad']
            })
        })
    }

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: {
            lat: -9.189967,
            lng: -75.015152
        }
    })

    var markerCluster = new MarkerClusterer(map, markers, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    })
}
