<?php namespace App\Http\Middleware;

use Closure;
use App\User;
class loginstat {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		/**if(session('in')==1)
		{}
	    else{ **/
		$date=date('Y-m-d H:i:s');
		User::where('id',$request->user()->id)->update(['online'=>1,'logintime'=>$date]);
		session(['in'=>1]);
	 //  }
		return $next($request);
	}

}
