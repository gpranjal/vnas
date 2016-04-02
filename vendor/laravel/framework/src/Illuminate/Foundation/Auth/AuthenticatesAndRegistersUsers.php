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
		$check_id =DB::table('users')->where('email', $data['email'])->pluck('id');
		function oto1($t){
			if($t == 0){
				return 1;
			}else{
				return $t;
			}
		}
		if(!$check_id){
			return "This user does not exist";
		}else {
			// get variables
			$allowed_attempts = DB::table('user_settings')->where('id', 1)->pluck('email_lockout_count');
			$allowed_timeout = DB::table('user_settings')->where('id', 1)->pluck('email_lockout_duration_mins');
			$allowed_timeout = intval($allowed_timeout);

			//calculate diffrence betweet time
			$timestamp = date('Y-m-d G:i:s');
			$last_failed_attempt_time = DB::table('users')->where('email', $data['email'])->pluck('last_failed_attempt');
			$datetime1 = date_create($last_failed_attempt_time);
			$datetime2 = date_create($timestamp);
			$interval = date_diff($datetime1, $datetime2);
			$interval_minutes = intval($interval->format('%i'));
			$interval_hours = intval($interval->format('%h'));
			$interval_days = intval($interval->format('%d'));
			$interval_months = intval($interval->format('%m'));
			$interval_years = intval($interval->format('%y'));

			$total_interval = oto1($interval_minutes) * oto1($interval_hours) * oto1($interval_days) * oto1($interval_months) * oto1($interval_years);
			if ($total_interval >= $allowed_timeout) {
				DB::table('users')->where('email', $data['email'])->update(['failed_attemps' => 1]);
				DB::table('users')->where('email', $data['email'])->update(['lock_user' => 'Y']);
				DB::table('users')->where('email', $data['email'])->update(['last_failed_attempt' => $timestamp]);

			} else {
				DB::table('users')->where('email', $data['email'])->increment('failed_attemps');
				DB::table('users')->where('email', $data['email'])->update(['last_failed_attempt' => $timestamp]);

				$number_of_failed_attempts = DB::table('users')->where('email', $data['email'])->pluck('failed_attemps');
				if ($number_of_failed_attempts >= $allowed_attempts) {
					DB::table('users')->where('email', $data['email'])->update(['lock_user' => 'X']);
					return 'You have been locked due to excessive wrong password attempts. Try logging after 1 hour or call VNA helpdesk at 402-444-4444';
				}
				return 'You have utilized ' . $number_of_failed_attempts . ' out of ' . $allowed_attempts . ' attempts';
			}

			return 'These credentials do not match our records.';
		}
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
