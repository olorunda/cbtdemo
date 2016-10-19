<?php namespace App\Http\Controllers;
use App\User;
use App\duration;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\questionrepo;
use Illuminate\Http\Request;

class questioncontroller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 protected $questionrepo;
	 

	public function __construct(questionrepo $questionrepo)
	{
			$this->questionrepo=$questionrepo;
		$this->middleware('auth');
		
		 $this->middleware('loginstat');
	
	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
			try{
			$createandgetid=$this->questionrepo->createquestion(['content'=>$request->question]);
			$optioncreate=$this->questionrepo->createoption(['question_id'=>$createandgetid,'option1'=>$request->option1,'option2'=>$request->option2,'option3'=>$request->option3,'option4'=>$request->option4,'correctoption'=>$request->answer]);
			if($optioncreate=='success'){
				
				$correctoptioncreate=$this->questionrepo->createcorrect(['question_id'=>$createandgetid,'correctoption'=>$request->answer]);
				if($correctoptioncreate=='success'){
					return response()->json(['success'=>'success']);
				}
				else{
					return response()->json(['failure'=>'failure']);
				}
			}
			else {
				
	           return response()->json(['failure'=>'failure']);
			}
			}
			catch(\Exception $e){
			  return response()->json(['failure'=>'You have already Added this question']);
				
			}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function displayquestion()
	{
		$index=1;
	$selectallquestion=$this->questionrepo->displayquestion();
	return view('question',['allquestion'=>$selectallquestion,'index'=>$index]);
	
	}
	public function updatequestion(Request $request){
	 
			$data1=['content'=>$request->question];
			$data2=['option1'=>$request->option1,'option2'=>$request->option2,'option3'=>$request->option3,'option4'=>$request->option4,'correctoption'=>$request->answer];
			$data3=['correctoption'=>$request->answer];
			
			/**
			 $data1=['content'=>'jkbfhdfgjdsthisiidghs'];
			$data2=['option1'=>'gfgsrg','option2'=>'faewrrrfer','option3'=>'dfdfefew','option4'=>'dwwffefe'];
			$data3=['correctoption'=>3]; **/
		$modifiedquest=$this->questionrepo->updatequestion($data1,$data2,$data3,$request->id);
		
		return $modifiedquest;
		
		
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function questionbyid($id)
	{
		$getquestionbyid=$this->questionrepo->getquestionbyid($id);
		return $getquestionbyid;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function displayquestionjson($num)
	{
		$getallquestion=$this->questionrepo->displayquestionjson($num);
		return $getallquestion;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function viewresult()
	{
		$index=1;
		$gettime=duration::select('time')
  ->first();
		$allresult=$this->questionrepo->viewresult();
		return view('viewresult',['result'=>$allresult,'index'=>$index,'time'=>$gettime]);
	}
	
	public function search(Request $request){
		 //searchresult
		 $index=1;
		 $gettime=duration::select('time')
  ->first();
		$allresult=$this->questionrepo->searchresult($request->table_search);
		return view('viewresult',['result'=>$allresult,'index'=>$index,'time'=>$gettime]);
		
		
	}

	public function statistics(){
		$stat=$this->questionrepo->statistics();
		return $stat;
	}
	
	public function ban($type,$id){
		
		$banned=$this->questionrepo->ban($type,$id);
		return $banned;
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function countquestion(){
		 $questcount=$this->questionrepo->countquestion();
		 return $questcount;
		 
	 }
	 public function displaytest(){
		 	 $checkadded=User::where('id',\Auth::user()->id)
 ->select('time')
->first();
if($checkadded->time==0){ 
  
$time= duration::select('time')
  ->first();
}else{
  $time=user::where('id',\Auth::user()->id)->select('time')
  ->first();
}  
		 return view('taketest',['time'=>$time]);
	 }
	public function deletequestion($id)
	{
		$deletequestion=$this->questionrepo->deletequestion($id);
		return $deletequestion;
	}
	public function submittest($userid,$questionid,$selectedoption){
		//return $userid.' '.$questionid.' '.$selectedoption;
  $submitanswer=$this->questionrepo->submitanswer(['user_id'=>$userid,'question_id'=>$questionid,'selectedoption'=>$selectedoption],$questionid,$selectedoption,$userid);
	return $submitanswer; }
	
	public function viewstudentresult($id){
		
		$getmyresult=$this->questionrepo->getmyresult($id);
		return $getmyresult;
		//return view('studentresult',['result'=>$getmyresult]);
	}
public function resetanswer($userid){
	$reset=$this->questionrepo->resetanswer($userid);
	return $reset;
	
}
public function showsolution($userid){
	$solution=$this->questionrepo->showsolution($userid);
	//return $solution;
	$index=1;
	return view('solution',['solutions'=>$solution,'index'=>$index]);
	
}
public function completed(){
	$date=date('Y-m-d H:i:s');
	$complete=User::where('id',\Auth::user()->id)
	->update(['complete2'=>1,'submissiontime'=>$date]);
}


public function duration(){
	
  $checkadded=User::where('id',\Auth::user()->id)
 ->select('time')
->first();
if($checkadded->time==0){ 
  
 return duration::select('time')
  ->first();
}
 return user::where('id',\Auth::user()->id)->select('time')
  ->first();	
}

public  function addtime($userid,$timetoadd){
	try{
	$gettime=duration::select('time')
  ->first();
 
  $totaltime=$gettime->time + $timetoadd;
  $addtime=User::where('id',$userid)
  ->update(['time'=>$totaltime]);
  return response()->json("1");
	}
	catch(\Exception $ex){
		return response()->json($ex);

	}
	
}

}
