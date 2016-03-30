<?php namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait AuthenticatesAndRegistersUsers {

	/**
	 * The Guard implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Guard
	 */
	protected $auth;

	/**
	 * The registrar implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->auth->login($this->registrar->create($request->all()));

		return redirect($this->redirectPath());
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
			->withInput($request->only('email', 'remember'))
			->withErrors([
				'email' => $this->getFailedLoginMessage($credentials),
			]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage($data)
	{
		DB::table('users')->where('email',$data['email'])->increment('failed_attemps');

		//calculate diffrence betweet time
		$timestamp = date('Y-m-d G:i:s');
		$last_failed_attempt_time = DB::table('users')->where('email', $data['email'])->pluck('last_failed_attempt');
		$datetime1 = date_create($last_failed_attempt_time);
		$datetime2 = date_create($timestamp);
		$interval = date_diff($datetime1, $datetime2);
		$interval_hours = intval($interval->format( '%h' ));
//		$interval_days = intval($interval->format( '%d' ));
//		$interval_months = intval($interval->format( '%h' ));
//		$interval_years = intval($interval->format( '%y' ));
		$total_interval = $interval_hours ;
		if($total_interval >= 1){
			DB::table('users')->where('email',$data['email'])->update(['failed_attemps'=>1]);
			DB::table('users')->where('email', $data['email'])->update(['last_failed_attempt'=>$timestamp]);

		}else{
			DB::table('users')->where('email', $data['email'])->update(['last_failed_attempt'=>$timestamp]);

			$number_of_failed_attempts = DB::table('users')->where('email', $data['email'])->pluck('failed_attemps');
			if($number_of_failed_attempts >=5){
				DB::table('users')->where('email', $data['email'])->update(['lock_user'=>'X']);
			}
		}

//		DB::table('users')->where('email',$data['email'])->increment('failed_attemps');
//		$number_of_failed_attempts = DB::table('users')->where('email', $data['email'])->pluck('failed_attemps');
//		if($number_of_failed_attempts >=5){
//			DB::table('users')->where('email', $data['email'])->update(['lock_user'=>'X']);
//		}
//		$timestamp = date('Y-m-d G:i:s');
//		DB::table('users')->where('email', $data['email'])->update(['last_failed_attempt'=>$timestamp]);
//
//		$last_failed_attempt_time = DB::table('users')->where('email', $data['email'])->pluck('last_failed_attempt');
//		$datetime1 = date_create($last_failed_attempt_time);
//		$datetime2 = date_create('2009-10-13 09:23:23');
//		$interval = date_diff($datetime1, $datetime2);
//		$interval_hours = intval($interval->format( '%h' ));
//		$interval_days = intval($interval->format( '%d' ));
//		$interval_months = intval($interval->format( '%h' ));
//		$interval_years = intval($interval->format( '%y' ));
//		$total_interval = $interval_days + $interval_hours + $interval_months + $interval_years;
//		DB::table('users')->where('email', $data['email'])->update(['lock_user'=>$total_interval]);

		return 'These credentials do not match our records.';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
	}

}
