
function initMap() {
    const center = { 
        lat: 51.505, 
        lng: -0.09 
    };
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
    const inputLatitude = document.getElementById('latitude');
    inputLatitude.value = event.latLng.lat();
    inputLatitude.dispatchEvent(new Event('input', { bubbles: true }));

    const inputLongitude = document.getElementById('longitude');
    inputLongitude.value = event.latLng.lng();
    inputLongitude.dispatchEvent(new Event('input', { bubbles: true }))

    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            const mapAddress = document.getElementById('mapAddress')
            mapAddress.value = results[0].formatted_address;
            mapAddress.dispatchEvent(new Event('input', { bubbles: true }));
        }
    });
}

/* ------------------------ Handle Marker Click Event ----------------------- */
function markerClicked(marker, index) {
    const inputLatitude = document.getElementById('latitude');
    inputLatitude.value = marker.position.lat();
    inputLatitude.dispatchEvent(new Event('input', { bubbles: true }));

    const inputLongitude = document.getElementById('longitude');
    inputLongitude.value = marker.position.lng();
    inputLongitude.dispatchEvent(new Event('input', { bubbles: true }));

    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: marker.position.lat(), lng: marker.position.lng() };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            const mapAddress = document.getElementById('mapAddress')
            mapAddress.value = results[0].formatted_address;
            mapAddress.dispatchEvent(new Event('input', { bubbles: true }));
        }
    });
}

/* ----------------------- Handle Marker DragEnd Event ---------------------- */
function markerDragEnd(event, index) {
    const inputLatitude = document.getElementById('latitude');
    inputLatitude.value = event.latLng.lat();
    inputLatitude.dispatchEvent(new Event('input', { bubbles: true }));

    const inputLongitude = document.getElementById('longitude');
    inputLongitude.value = event.latLng.lng();
    inputLongitude.dispatchEvent(new Event('input', { bubbles: true }));

    // document.getElementById('latitude').value=event.latLng.lat();
    // document.getElementById('longtitude').value=event.latLng.lng();

    const geocoder = new google.maps.Geocoder();
    const latlng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            const mapAddress = document.getElementById('mapAddress')
            mapAddress.value = results[0].formatted_address;
            mapAddress.dispatchEvent(new Event('input', { bubbles: true }));
        }
    });
}

/* ------------------------ Recognize inputs -------------------------------- */

