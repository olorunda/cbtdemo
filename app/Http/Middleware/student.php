<?php namespace App\Http\Middleware;

use Closure;

class student {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if($request->user()->type=="1"){
			return redirect('/managestd');
		}
		return $next($request);
	}

}
