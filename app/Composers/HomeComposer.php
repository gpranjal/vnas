<?php namespace App\Composers;
use Jenssegers\Agent\Agent;

class HomeComposer
{
		/* Agent can be used to tell you anything you need to know about the current browser.
	*	$agent->is('Windows');
	*	$agent->is('Firefox');
	*	$agent->is('iPhone');
	*	$agent->is('OS X');
	*	$agent->isAndroidOS();
	*	$agent->isNexus();
	*	$agent->isSafari();
	*	$agent->isMobile();
	*	$agent->isTablet();
	*/
	
    public function compose($view)
    {
    	$agent = new Agent(); 

		$view->with( 'agent' , $agent );
    }
}