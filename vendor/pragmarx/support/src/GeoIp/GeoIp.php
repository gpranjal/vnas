<?php

namespace PragmaRX\Support\GeoIp;

use GeoIp2\Database\Reader as GeoIpReader;
use AppGeoIP;
use Tracker;

class GeoIp
{
    private $geoIp;

    public function __construct() {
        $this->geoIp = $this->getGeoIpInstance();
    }

    public function searchAddr($addr) {
    	/* Changed by Zach: Added this to actually get geo info */
     	$myGeoIpData = AppGeoIP::getLocation($addr); 

     	/* Changed by Zach: This is the default value and it wasn't providing any data. */
        //return $this->geoIp->searchAddr($addr); 
     	
     	// Added by Zach: This is the data, the tracker package is expecting all of these values
     	return [
     	'latitude' => $myGeoIpData['lat'],
     	'longitude' => $myGeoIpData['lon'],
     	'country_code' => $myGeoIpData['isoCode'],
     	'country_code3' => null,
     	'country_name' => $myGeoIpData['country'],
     	'region' => $myGeoIpData['state'],
     	'city' => $myGeoIpData['city'],
     	'state' => $myGeoIpData['state'],
     	'postal_code' => $myGeoIpData['postal_code'],
     	'area_code' => null,
     	'dma_code' => null,
     	'metro_code' => null,
     	'continent_code' => $myGeoIpData['continent'],
     	];
    }

    /**
     * @return boolean
     */
    public function isEnabled() {
        return $this->geoIp->isEnabled();
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled) {
        return $this->geoIp->setEnabled($enabled);
    }

    public function isGeoIpAvailable() {
        return $this->geoIp->isGeoIpAvailable();
    }

    private function getGeoIpInstance() {
        if (class_exists('GeoIpReader'))
        {
            return new GeoIp2();
        }

        return new GeoIp1();
    }
}
