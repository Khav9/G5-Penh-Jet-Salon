document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('search_input');
      const latitudeInput = document.getElementById('latitude');
      const longitudeInput = document.getElementById('longitude');
      const currentLocationBtn = document.getElementById('current_location_btn');

      const defaultLat = 11.549553;
      const defaultLng = 104.8819489;

      let mapInstance = map(defaultLat, defaultLng);

      let marker = new google.maps.Marker({
          position: { lat: defaultLat, lng: defaultLng },
          map: mapInstance,
          draggable: true,
          title: "Drag me!"
      });

      let autocomplete = new google.maps.places.Autocomplete(searchInput, {
          types: ['geocode'],
          componentRestrictions: { country: 'KH' }
      });

      let geocoder = new google.maps.Geocoder();

      google.maps.event.addListener(autocomplete, 'place_changed', function () {
          const place = autocomplete.getPlace();
          if (place.geometry && place.geometry.location) {
              const latitude = place.geometry.location.lat();
              const longitude = place.geometry.location.lng();

              latitudeInput.value = latitude;
              longitudeInput.value = longitude;

              mapInstance.setCenter({ lat: latitude, lng: longitude });
              marker.setPosition({ lat: latitude, lng: longitude });
          }
      });

      google.maps.event.addListener(mapInstance, 'click', function (event) {
          const latitude = event.latLng.lat();
          const longitude = event.latLng.lng();

          latitudeInput.value = latitude;
          longitudeInput.value = longitude;

          marker.setPosition({ lat: latitude, lng: longitude });
          mapInstance.setCenter({ lat: latitude, lng: longitude });

          updateAddress(latitude, longitude);
      });

      google.maps.event.addListener(marker, 'dragend', function (event) {
          const latitude = event.latLng.lat();
          const longitude = event.latLng.lng();

          latitudeInput.value = latitude;
          longitudeInput.value = longitude;

          updateAddress(latitude, longitude);
      });

      currentLocationBtn.addEventListener('click', function () {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (position) {
                  const latitude = position.coords.latitude;
                  const longitude = position.coords.longitude;

                  latitudeInput.value = latitude;
                  longitudeInput.value = longitude;

                  mapInstance.setCenter({ lat: latitude, lng: longitude });
                  marker.setPosition({ lat: latitude, lng: longitude });

                  updateAddress(latitude, longitude);
              });
          } else {
              alert("Geolocation is not supported by this browser.");
          }
      });

      function map(latitude, longitude) {
          return new google.maps.Map(document.getElementById('address-map'), {
              center: { lat: latitude, lng: longitude },
              zoom: 15
          });
      }

      function updateAddress(latitude, longitude) {
          geocoder.geocode({ 'location': { lat: latitude, lng: longitude } }, function (results, status) {
              if (status === 'OK') {
                  if (results[0]) {
                      searchInput.value = results[0].formatted_address;
                  } else {
                      console.log('No results found');
                  }
              } else {
                  console.log('Geocoder failed due to: ' + status);
              }
          });
      }
  });