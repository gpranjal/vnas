<?php 



	var_dump( $visitor->client_ip );
	
	var_dump( $visitor->device->is_mobile );
	
	var_dump( $visitor->device->platform );
	
	var_dump( $visitor );
	
// 	var_dump( $visitor->geoIp->city );
	
	var_dump(AppGeoIP::getLocation($visitor->client_ip));
	
?>