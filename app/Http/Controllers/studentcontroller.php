<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Repositories\managestudentrepo;

class studentcontroller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 protected $student;
	 public function __construct(managestudentrepo $student){
		 $this->middleware('auth');
		 
		 $this->middleware('loginstat');
		 $this->student=$student;
		 
	 }
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function liststudent()
	{
		$allstudent=$this->student->liststudent();
		$statdisp=$this->student->statdisp();
		$index=1;
		return view('managestd',['allstd'=>$allstudent,'statdisp'=>$statdisp,'index'=>$index]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
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
	public function deletestudent($id)
	{
	$deletestudent=$this->student->deletestudent($id);
	return $deletestudent;
	}

}
