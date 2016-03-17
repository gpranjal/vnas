<?php 

	$visitor = Tracker::currentSession();

	var_dump( $visitor->client_ip );

	var_dump( $visitor->device->is_mobile );

	var_dump( $visitor->device->platform );

	var_dump( $visitor->geoIp->city );
?>