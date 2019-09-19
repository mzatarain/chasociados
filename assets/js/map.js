/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


      // In the following example, markers appear when the user clicks on the map.
      // Each marker is labeled with a single alphabetical character.
      var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var labelIndex = 0;

      function initialize() {
        var mexicali = { lat: 32.624538, lng: -115.452263};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13.5,
          center: mexicali
        });

        // This event listener calls addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function(event) {
          addMarker(event.latLng, map);
        });

        // Add a marker at the center of the map.
        addMarker(mexicali, map);
      }

      // Adds a marker to the map.
      function addMarker(location, map) {
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.
        var marker = new google.maps.Marker({
          position: location,
          label: labels[labelIndex++ % labels.length],
          map: map
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);


function initMap() {
        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
          zoom: 8,
          center: new google.maps.LatLng(-34.397, 150.644)
        });

        // We add a DOM event here to show an alert if the DIV containing the
        // map is clicked.
        google.maps.event.addDomListener(mapDiv, 'click', function() {
          window.alert('Map was clicked!');
        });
      }