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
     	$myGeoIpData = AppGeoIP::getLocation($addr); /* Changed by Zach: Added this to actually get geo info */

    	
        //return $this->geoIp->searchAddr($addr); /* Changed by Zach: This was providing any data. */
     	
     	 
     	//return $this->geoIp->searchAddr($addr);
     	
     	//      	'latitude' => $this->geoIpData->location->latitude,
     	//      	'longitude' => $this->geoIpData->location->longitude,
     	//      	'country_code' => $this->geoIpData->country->isoCode,
     	//      	'country_code3' => null,
     	//      	'country_name' => $this->geoIpData->country->name,
     	//      	'region' => $this->geoIpData->continent->code,
     	//      	'city' => $this->geoIpData->city->name,
     	//      	'postal_code' => $this->geoIpData->postal->code,
     	//      	'area_code' => null,
     	//      	'dma_code' => null,
     	//      	'metro_code' => $this->geoIpData->location->metroCode,
     	//      	'continent_code' => $this->geoIpData->continent->code,
     	
     	/* The info above is what the package is expecting, I "translated" it below */
     	
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
