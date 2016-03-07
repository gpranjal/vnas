@extends('app')

@section('content')

<style>
	#floating-panel {
		
		top: 50px;
		background-color: #fff
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div class="panel panel-default">
				<div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
					<h4>Map Directions to "{{ $addr  }}"</h4>
				</div>

				<div id="map_canvas" style="width:100%; height:300px"></div>
				<div id="floating-panel">
					<form action="#" onSubmit="calcRoute();return false;" id="routeForm">
						<div class="form-group">
							<table>
								<tr>
									<td><label class="col-sm-1 control-label">From:</label> </td>
									<td><input type="text" id="routeStart" value="My Location"></td>
									
									<td><label class="col-sm-1 control-label">To:</label></td>
									<td><input type="text" id="routeEnd" value="{{ $addr  }}"></td>
									
									<td><label class="col-sm-1 control-label">Mode:</label></td>
									<td>
										<select name="travelMode">
											<option value="DRIVING" selected="selected">Driving</option>
											<option value="BICYCLING">Bicylcing</option>
											<option value="TRANSIT">Public transport</option>
											<option value="WALKING">Walking</option>
										</select>
									</td>

									<td>
										<label class="col-sm-2 control-label">
											<input type="submit" class="btn btn-default btn-primary" value="Recalculate">
										</label>
									</td>
								</tr>
							</table>
						</div>
						
					</form>
				</div>

				<div id="directionsPanel" class="panel panel-default">
					Enter a starting point and click "Calculate route".
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDmiNBfyHfzHnDS5u_I7Luhr0M_BkwxVDc"></script>

<script type="text/javascript">
			// This page was create based on the tutorial found at:
			// http://www.dreamdealer.nl/tutorials/using_geolocation_to_automatically_generate_a_route_and_directions_in_google_maps.html

			var directionDisplay, map;
			var directionsService = new google.maps.DirectionsService();
			var geocoder = new google.maps.Geocoder();

			function initialize() {
				// set the default center of the map
				var latlng = new google.maps.LatLng(41.2500,96.0000);
				// set route options (draggable means you can alter/drag the route in the map)
				var rendererOptions = { draggable: false };
				directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
				// set the display options for the map
				var myOptions = {
					zoom: 9,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: true
				};
				// add the map to the map placeholder
				map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
				// bind the map to the directions
				directionsDisplay.setMap(map);
				// point the directions to the container for the direction details
				directionsDisplay.setPanel(document.getElementById("directionsPanel"));
				// start the geolocation API
				if (navigator.geolocation) {
					// when geolocation is available on your device, run this function
					navigator.geolocation.getCurrentPosition(foundYou, notFound);
				} else {
					// when no geolocation is available, alert this message
					alert('Geolocation not supported or not enabled.');
				}
			}

			function notFound(msg) {  
				alert('Could not find your location :(')
			}

			function foundYou(position) {
				// convert the position returned by the geolocation API to a google coordinate object
				var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				// then try to reverse geocode the location to return a human-readable address
				geocoder.geocode({'latLng': latlng}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						// if the geolocation was recognized and an address was found
						if (results[0]) {
							// add a marker to the map on the geolocated point
							marker = new google.maps.Marker({
								position: latlng,
								map: map
							});
							// compose a string with the address parts
							var address = results[0].address_components[1].long_name+' '+results[0].address_components[0].long_name+', '+results[0].address_components[3].long_name
							
							$('#routeStart').val(address); // Set the address to current location
							var myTmp = calcRoute(); // Calculate route

						}
					} else {
						// if the address couldn't be determined, alert and error with the status message
						alert("Geocoder failed due to: " + status);
					}
				});
			}

			function calcRoute() {
				// get the travelmode, startpoint and via point from the form   
				var travelMode = $('select[name="travelMode"]').val();
				var start = $("#routeStart").val();
				var end = $("#routeEnd").val();
				// compose a array with options for the directions/route request
				var request = {
					origin: start,
					destination: end,
					unitSystem: google.maps.UnitSystem.IMPERIAL,
					travelMode: google.maps.DirectionsTravelMode[travelMode]
				};
				// call the directions API
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						// directions returned by the API, clear the directions panel before adding new directions
						$('#directionsPanel').empty();
						// display the direction details in the container
						directionsDisplay.setDirections(response);
					} else {
						// alert an error message when the route could nog be calculated.
						if (status == 'ZERO_RESULTS') {
							alert('No route could be found between the origin and destination.');
						} else if (status == 'UNKNOWN_ERROR') {
							alert('A directions request could not be processed due to a server error. The request may succeed if you try again.');
						} else if (status == 'REQUEST_DENIED') {
							alert('This webpage is not allowed to use the directions service.');
						} else if (status == 'OVER_QUERY_LIMIT') {
							alert('The webpage has gone over the requests limit in too short a period of time.');
						} else if (status == 'NOT_FOUND') {
							alert('At least one of the origin, destination, or waypoints could not be geocoded.');
						} else if (status == 'INVALID_REQUEST') {
							alert('The DirectionsRequest provided was invalid.');         
						} else {
							alert("There was an unknown error in your request. Requeststatus: nn"+status);
						}
					}
				});
			}

			//document.addEventListener("deviceready", initialize(), false);

			//document.addEventListener("deviceready", initialize(), false);

			/*

				$("body").on("click",".routemap",function(){
				navAddress = $(this).attr("address");
				navigator.geolocation.getCurrentPosition(getPosition);//get the current position for google maps linking purposes.
				});
				*/
			</script>



			@stop
