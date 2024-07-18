<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DoctorMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next) {
		if (session()->has('loggedTherapist')) {
			return $next($request);
		} else {
			return redirect('/')->with('error', 'You are not therapist');
		}
	}
}
