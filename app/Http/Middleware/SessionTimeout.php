<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;
use App\UserSettings;

    class SessionTimeout {
    
    protected $session;
	
    protected $timeout=60;//This is to convert minutes to seconds.  The default from the user_settings table is 15 minutes or 900

    public function __construct(Store $session){
        $this->session=$session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$myTimeout = UserSettings::getUserSettingsSessionTimeout(); // This setting comes from the table USER_SETTINGS
    	
        if(!$this->session->has('lastActivityTime'))
            $this->session->put('lastActivityTime',time());
        elseif(time() - $this->session->get('lastActivityTime') > ( $this->timeout * $myTimeout ) ){
            $this->session->forget('lastActivityTime');
            Auth::logout();
            return redirect('auth/login')->with(array('warnings' => 'You had not activity in '.$this->timeout*$myTimeout .' minutes ago.'));
            //return redirect('auth/login')->withErrors(['error' => 'You had not activity in '.$this->timeout*$myTimeout .' minutes ago.']);//$e->getMessage()
        }
        
        
        $this->session->put('lastActivityTime',time());
        return $next($request);
    }

}