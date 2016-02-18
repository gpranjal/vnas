<?php namespace Illuminate\Routing\Matching;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\Matching\ValidatorInterface;

class CaseInsensitiveUriValidator implements ValidatorInterface {

	/**
	 * Validate a given rule against a route and request.
	 *
	 * @param  \Illuminate\Routing\Route  $route
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	public function matches(Route $route, Request $request)
	{
		$path = $request->path() == '/' ? '/' : '/'.$request->path();

		return preg_match(preg_replace('/$/','i', $route->getCompiled()->getRegex()), rawurldecode($path));
	}

}
