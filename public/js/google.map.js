
function initMap() {
    const center = { lat: 51.505, lng: -0.09 };
    const map = new google.maps.Map(document.getElementById("gmap"), {
        center: center,
        zoom: 15
    });

    map.addListener("click", function(event) {
        mapClicked(event);
    });

    const marker = new google.maps.Marker({
        position: center,
        map: map,
        draggable: true
    });

    marker.addListener('dragend', function(event) {
        markerDragEnd(event);
    });

    map.addListener('click', function(event) {

        marker.setPosition(event.latLng);
        markerClicked(marker);
    });
}


/* ------------------------- Handle Map Click Event ------------------------- */
function mapClicked(event) {
    document.getElementById('latitude').value=event.latLng.lat();
    document.getElementById('longtitude').value=event.latLng.lng();

    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            document.getElementById('mapAddress').value = results[0].formatted_address;
        }
    });
}

/* ------------------------ Handle Marker Click Event ----------------------- */
function markerClicked(marker, index) {
    document.getElementById('latitude').value=marker.position.lat();
    document.getElementById('longtitude').value=marker.position.lng();

    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: marker.position.lat(), lng: marker.position.lng() };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            document.getElementById('mapAddress').value = results[0].formatted_address;
        }
    });
}

/* ----------------------- Handle Marker DragEnd Event ---------------------- */
function markerDragEnd(event, index) {
    document.getElementById('latitude').value=event.latLng.lat();
    document.getElementById('longtitude').value=event.latLng.lng();

    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            document.getElementById('mapAddress').value = results[0].formatted_address;
        }
    });
}

