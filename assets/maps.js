$(function () {
	let latitude = $("#latitude").val();
	let longitude = $("#longitude").val();
	var lat = latitude ? latitude : -6.228812,
		lng = longitude ? longitude : 106.8348401,
		latlng = new google.maps.LatLng(lat, lng),
		image = "http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png";

	var mapOptions = {
			center: new google.maps.LatLng(lat, lng),
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			panControl: true,
			panControlOptions: {
				position: google.maps.ControlPosition.TOP_RIGHT,
			},
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE,
				position: google.maps.ControlPosition.TOP_left,
			},
		},
		map = new google.maps.Map(
			document.getElementById("map_canvas"),
			mapOptions
		),
		marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: image,
			draggable: true,
		});

	var input = document.getElementById("searchTextField");
	var autocomplete = new google.maps.places.Autocomplete(input, {
		types: ["geocode"],
	});

	autocomplete.bindTo("bounds", map);
	var infowindow = new google.maps.InfoWindow();

	google.maps.event.addListener(
		autocomplete,
		"place_changed",
		function (event) {
			infowindow.close();
			var place = autocomplete.getPlace();
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);
			}

			moveMarker(place.name, place.geometry.location);
			$(".MapLat").val(place.geometry.location.lat());
			$(".MapLon").val(place.geometry.location.lng());
		}
	);
	google.maps.event.addListener(map, "click", function (event) {
		const lat = event.latLng.lat();
		const lng = event.latLng.lng();
		$(".MapLat").val(lat);
		$(".MapLon").val(lng);

		var latlng = new google.maps.LatLng(lat, lng);
		// This is making the Geocode request
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({ latLng: latlng }, (results, status) => {
			if (status !== google.maps.GeocoderStatus.OK) {
				alert(status);
			}
			// This is checking to see if the Geoeode Status is OK before proceeding
			if (status == google.maps.GeocoderStatus.OK) {
				var address = results[0].formatted_address;
				moveMarker(address, latlng);

				$("#searchTextField").val(address);
			}
		});
	});

	$("#searchTextField").focusin(function () {
		$(document).keypress(function (e) {
			if (e.which !== 13) {
				// return false;
				infowindow.close();
				var firstResult = $(".pac-container .pac-item:first").text();
				var geocoder = new google.maps.Geocoder();
				geocoder.geocode(
					{
						address: firstResult,
					},
					function (results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							var lat = results[0].geometry.location.lat(),
								lng = results[0].geometry.location.lng(),
								placeName = results[0].address_components[0].long_name,
								latlng = new google.maps.LatLng(lat, lng);

							moveMarker(placeName, latlng);
						}
					}
				);
			}
		});
	});

	function moveMarker(placeName, latlng) {
		marker.setIcon(image);
		marker.setPosition(latlng);
		infowindow.setContent(placeName);
	}
});
