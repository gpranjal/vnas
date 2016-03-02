@extends('app')

@section('content')

    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      #right-panel {
        height: 100%;
        float: right;
        width: 390px;
        overflow: auto;
      }
      #map {
        margin-right: 400px;
      }
      #floating-panel {
        background: #fff;
        padding: 5px;
        font-size: 14px;
        font-family: Arial;
        border: 1px solid #ccc;
        box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
        display: none;
      }
      @media print {
        #map {
          height: 500px;
          margin: 0;
        }
        #right-panel {
          float: none;
          width: auto;
        }
      }
    </style>
  </head>
  <body>

    
   
    <div id="floating-panel">
      <strong>Mode of Travel: </strong>
      <select id="mode">
        <option value="DRIVING">Driving</option>
        <option value="WALKING">Walking</option>
        <option value="BICYCLING">Bicycling</option>
        <option value="TRANSIT">Transit</option>
      </select>
      <strong>Start:</strong>
      <select id="start">
        <option value ="" selected="selected">Select one</option>
        <option value="7802 N 159th St, Omaha, NE 68007">Home</option>
        <option value="st louis, mo">St Louis</option>
        <option value="joplin, mo">Joplin, MO</option>
        <option value="oklahoma city, ok">Oklahoma City</option>
        <option value="amarillo, tx">Amarillo</option>
        <option value="gallup, nm">Gallup, NM</option>
        <option value="flagstaff, az">Flagstaff, AZ</option>
        <option value="winona, az">Winona</option>
        <option value="kingman, az">Kingman</option>
        <option value="barstow, ca">Barstow</option>
        <option value="san bernardino, ca">San Bernardino</option>
        <option value="los angeles, ca">Los Angeles</option>
      </select>
      <br>
      <strong>End:</strong>
      <select id="end">

        <option value="1400 Douglas St, Omaha, NE">Work</option>
        <option value="st louis, mo">St Louis</option>
        <option value="joplin, mo">Joplin, MO</option>
        <option value="oklahoma city, ok">Oklahoma City</option>
        <option value="amarillo, tx">Amarillo</option>
        <option value="gallup, nm">Gallup, NM</option>
        <option value="flagstaff, az">Flagstaff, AZ</option>
        <option value="winona, az">Winona</option>
        <option value="kingman, az">Kingman</option>
        <option value="barstow, ca">Barstow</option>
        <option value="san bernardino, ca">San Bernardino</option>
        <option value="los angeles, ca">Los Angeles</option>
      </select>
    </div>

    <div id="right-panel"></div>
    <div id="map"></div>
    <script>

    function initMap() {
      var directionsDisplay = new google.maps.DirectionsRenderer;
      var directionsService = new google.maps.DirectionsService;
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: {lat: 41.85, lng: -87.65}
      });
      directionsDisplay.setMap(map);
      directionsDisplay.setPanel(document.getElementById('right-panel'));

      var control = document.getElementById('floating-panel');
      control.style.display = 'block';
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

      //calculateAndDisplayRoute(directionsService, directionsDisplay);
      
      
      var onChangeHandler = function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      };
      document.getElementById('start').addEventListener('change', onChangeHandler);
      document.getElementById('end').addEventListener('change', onChangeHandler);
      document.getElementById('mode').addEventListener('change', function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      });
    
    }




    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
      var selectedMode = document.getElementById('mode').value;

      

      var start = tryGetLoca();
      console.log( "Trying to use start: " + start );
      var end = document.getElementById('end').value;
      directionsService.route({
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode[selectedMode]
      }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    }

     function tryGetLoca()
      {
        var start = "";
        var latitude = "";
        var longitude = "";

        if (navigator.geolocation) // Check if current browser supports geolocation
          { 
              navigator.geolocation.getCurrentPosition(function (position) {
                console.log( "You have browser geolocation!" );
                latitude = position.coords.latitude;                    //users current
                longitude = position.coords.longitude;                 //location
                start = new google.maps.LatLng(latitude, longitude);
                console.log( "latitude: " + latitude );
                console.log( "longitude: " + longitude );
                console.log( "startTmp: " + start );
                
                console.log( 'Returning: ' + latitude + ', ' + longitude );
                //return latitude + ', ' + longitude;
                return '41.330144999999995, -96.16438269999998';
            });
          }
          else
          {
            // Do something else...for now, use the select box
            start = document.getElementById('start').value;
          }

      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmiNBfyHfzHnDS5u_I7Luhr0M_BkwxVDc&sensor=false&callback=initMap">
    </script>


@stop
