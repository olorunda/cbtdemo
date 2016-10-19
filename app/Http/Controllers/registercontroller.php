<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\registerstudentrepo;
use Illuminate\Http\Request;

class registercontroller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 protected $register;
	 public function __construct(registerstudentrepo $register){
		 $this->register=$register;
		 
	 }
	public function index()
	{
		return view('register');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'image' => 'required|mimes:jpg,png,jpeg',
			'matric'=>'required|min:6'
		]);
	
		$imgname=rand(1111,5555).'.'.$request->file('image')->getClientOriginalExtension();
		
		if(is_dir('upload')){
			
		}
		else{
		mkdir('upload');
		}
		$request->file('image')->move('upload',$imgname);

		$registerstudent=$this->register->addstudent(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password),'image'=>$imgname,'matric'=>$request->matric]);
		if($registerstudent=='success'){
			
			return view('register',['message'=>'You have successfully Registered, Please click on the- login tab to login']);
		}
		else{
			return view('register',['message'=>'Some error Occured']);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
