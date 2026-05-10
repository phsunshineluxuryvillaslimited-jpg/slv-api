function successCallback(position, title) {
  const userLatLng = { 
    lat: position.coords.latitude, 
    lng: position.coords.longitude 
  };

  // Add a marker for the exact point
  new google.maps.Marker({
    position: userLatLng,
    map: map,
    title: title
  });

  // Add a circle to show the accuracy radius
  new google.maps.Circle({
    center: userLatLng,
    radius: position.coords.accuracy, // Radius in meters
    map: map,
    fillColor: '#1A73E8',
    fillOpacity: 0.2,
    strokeColor: '#1A73E8',
    strokeOpacity: 0.5,
    strokeWeight: 1
  });
}