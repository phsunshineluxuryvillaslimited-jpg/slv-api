  function initMap() {
    map = new google.maps.Map(document.getElementById("gmap"), {
        center: {
            lat: 51.505,
            lng: -0.09,
        },
        zoom: 15
    });

    map.addListener("click", function(event) {
        mapClicked(event);
    });
    // initMarkers();
}


 /* --------------------------- Initialize Markers --------------------------- */
  function initMarkers() {
      const initialMarkers = {};

      for (let index = 0; index < initialMarkers.length; index++) {
          const markerData = initialMarkers[index];
          const marker = new google.maps.Marker({
              position: markerData.position,
              label: markerData.label,
              draggable: markerData.draggable,
              map
          });
          markers.push(marker);

          const infowindow = new google.maps.InfoWindow({
              content: `<b>${markerData.position.lat}, ${markerData.position.lng}</b>`,
          });
          marker.addListener("click", (event) => {
              if(activeInfoWindow) {
                  activeInfoWindow.close();
              }
              infowindow.open({
                  anchor: marker,
                  shouldFocus: false,
                  map
              });
              activeInfoWindow = infowindow;
              markerClicked(marker, index);
          });

          marker.addListener("dragend", (event) => {
              markerDragEnd(event, index);
          });
      }
  }

  /* ------------------------- Handle Map Click Event ------------------------- */
  function mapClicked(event) {
      document.getElementById('latitude').value=event.latLng.lat();
      document.getElementById('longtitude').value=event.latLng.lng();

      const geocoder = new google.maps.Geocoder();
      const latlng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
      geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
          console.log(results[0].formatted_address);
        }
      });
  }

  /* ------------------------ Handle Marker Click Event ----------------------- */
  function markerClicked(marker, index) {
      console.log(map);
      console.log(marker.position.lat());
      console.log(marker.position.lng());
  }

  /* ----------------------- Handle Marker DragEnd Event ---------------------- */
  function markerDragEnd(event, index) {
      console.log(map);
      console.log(event.latLng.lat());
      console.log(event.latLng.lng());
  }


// async function init() {
//     // Request needed libraries.
//     const { InfoWindow } = await google.maps.importLibrary('maps');

//     // Set up the map.
//     const mapElement = document.querySelector('gmp-map');
//     const innerMap = mapElement.innerMap;

//     // Get the initial center of the map.
//     const position = innerMap.getCenter();

//     // Create the initial InfoWindow.
//     let infoWindow = new InfoWindow({
//         content: 'Click the map to get Lat/Lng!',
//         position,
//     });

//     infoWindow.open(innerMap);

//     // Configure the click listener.
//     innerMap.addListener('click', (mapsMouseEvent) => {
//         // Close the current InfoWindow.
//         infoWindow.close();

//         // Create a new InfoWindow.
//         infoWindow = new InfoWindow({
//             position: mapsMouseEvent.latLng,
//         });
//         infoWindow.setContent(
//             JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
//         );
//         infoWindow.open(innerMap);
//     });
// }

// void init();
