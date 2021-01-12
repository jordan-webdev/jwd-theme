<?php

// Social Media
function google_map_shortcode( $atts , $content = null ) {
  // Attributes
	$atts = shortcode_atts(
		array(
			'lat' => '',
      'long' => '',
		),
		$atts,
		'google-map'
	);

  $lat = $atts['lat'];
  $long = $atts['long'];
  $api_key = get_field("google_maps_api", "options");
  $icon = get_field("google_maps_icon", "options");

  ob_start(); ?>

  <div id="map" class="google-map width-100"></div>
  <script>
    function initMap() {
  	var target = {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>};
  	var map = new google.maps.Map(document.getElementById('map'), {
  	  zoom: 15,
  	  center: target
  	});
  	var marker = new google.maps.Marker({
  	  position: target,
      icon: "<?php echo $icon; ?>",
  	  map: map
  	});
    }
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&callback=initMap">
  </script>


  <?php return ob_get_clean();
}
add_shortcode( 'google-map', 'google_map_shortcode' );
