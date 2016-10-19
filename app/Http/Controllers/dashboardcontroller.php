<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\duration;
use Auth;
use App\User;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct(){
		 
		 $this->middleware('auth');
		 $this->middleware('loginstat');
	 }
	public function index(Request $request)
	{
		if($request->user()->type==1){
		
			return redirect('/managestd');
		}
		 $checkadded=User::where('id',$request->user()->id)
 ->select('time')
->first();
if($checkadded->time==0){ 
  
$time= duration::select('time')
  ->first();
}else{
  $time=user::where('id',$request->user()->id)->select('time')
  ->first();
}  
		return view('taketest',['time'=>$time]);
	}

public function testview()
	{
		return view('test');
	}
	public function about(){
		
		return view('about');
	}

}
