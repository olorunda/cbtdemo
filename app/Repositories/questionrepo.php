<?php
namespace App\Repositories;

use App\question;
use App\option;
use App\correct;
use App\result;
use App\studentanswer;
use DB;
use App\User;
class questionrepo{
	
	public function createquestion(array $question){
		$questionid=DB::table('questions')->insertGetId($question);
		
	    return $questionid;
	}
	
	public function ban($type,$id){
		try{
		$ban=User::where('id',$id)
		->update(['locked'=>$type]);
		return response()->json(1);
		}
		catch(\Exception $ex){
			return response()->json($ex);
		}
	}
	
	public function statistics(){
		
		$thirty=User::whereBetween('textscore',[0,30])
					->where('type',0)
						->count('id');
			$fourty=User::whereBetween('textscore',[31,40])
						->where('type',0)
						->count('id');
						$fifty=User::whereBetween('textscore',[41,50])
						->where('type',0)->count('id');
						$sixty=User::whereBetween('textscore',[51,60])
						->where('type',0)->count('id');
						$seventy=User::whereBetween('textscore',[61,70])
						->where('type',0)->count('id');
						$eighty=User::whereBetween('textscore',[71,80])
						->where('type',0)->count('id');
						$ninety=User::whereBetween('textscore',[81,90])
						->where('type',0)->count('id');
						$hundred=User::whereBetween('textscore',[91,100])
						->where('type',0)->count('id');
		
		$range1=["0-30%","31-40%","41-50%","51-60%","61-70%","71-80%","81-90%","91-100%"];
		
		$aggre1=['label'=>"{$range1[0]}",'value'=>$thirty];
		$aggre2=['label'=>"{$range1[1]}",'value'=>$fourty];
		$aggre3=['label'=>"{$range1[2]}",'value'=>$fifty];
		$aggre4=['label'=>"{$range1[3]}",'value'=>$sixty];
		$aggre5=['label'=>"{$range1[4]}",'value'=>$seventy];
		$aggre6=['label'=>"{$range1[5]}",'value'=>$eighty];
		$aggre7=['label'=>"{$range1[6]}",'value'=>$ninety];
		$aggre8=['label'=>"{$range1[7]}",'value'=>$hundred];
		
		$totalaggre=[$aggre1,$aggre2,$aggre3,$aggre4,$aggre5,$aggre6,$aggre7,$aggre8];
		return response()->json($totalaggre,200);
	}
	
	public function createoption(array $option){
		
		
		$option=option::create($option);
		if($option){
		  return 'success';
			
		}else{
			
			return 'failure';
		}
		
	}
	//update question function
	public function updatequestion(array $data1, array $data2,array $data3 ,$questionid){
		$updatequestion=DB::table('questions')
					->where('id',$questionid)
					->update($data1);
					
		$updateoption=DB::table('options')
					->where('question_id',$questionid)
					->update($data2);
					
		$updatecorrect=DB::table('corrects')
					->where('question_id',$questionid)
					->update($data3);
					
		if($updatequestion||$updatecorrect||$updateoption){
			
			return response()->json(['messsage'=>'You have successfully updated Question']);
			
		}
		else{
			return response()->json(['messsage'=>'You have already Updated Question']);	
		}
		
	}
	
	public function createcorrect(array $correct){
		$correct=correct::create($correct);
		if($correct){
			return 'success';
		}
		else{
			return 'failure';
			
		}
	}
	//get all questions
	public function displayquestion(){
		$questions=DB::table('questions')
		->join('options','questions.id','=','options.question_id')
		->join('corrects','questions.id','=','corrects.question_id')
		->select('questions.*','options.*','corrects.*')
		->orderBy('questions.id','desc')
		->paginate(10);
		if($questions){
			return $questions;
		}
		else{
			return response()->json(['message'=>'failure']);
		}
		
	}
	public function showsolution($userid){
		
		$solution=DB::table('questions')
		->join('options','options.question_id','=','questions.id')
		->join('applicantanswers','applicantanswers.question_id','=','questions.id')
		->where('applicantanswers.user_id','=',$userid)
		->distinct('questions.id')
		->paginate(5);
		return $solution;
		
	}
	public function countquestion(){
		
		$questioncount=question::count('id');
		
		return response()->json($questioncount);
	}
	public function displayquestionjson($skip){
		
		$questionall=DB::table('questions')
		->join('options','questions.id','=','options.question_id')
		->join('corrects','questions.id','=','corrects.question_id')
		->select('questions.*','options.*','corrects.*')
		->orderBy(DB::raw('RAND()'))
		->skip($skip)->take(5)
		->get();
		return response()->json($questionall);
	}
	
	//get question by id
	public function getquestionbyid($id){
		
		$questions=DB::table('questions')
		->join('options','questions.id','=','options.question_id')
		->join('corrects','questions.id','=','corrects.question_id')
		->select('questions.*','options.*','corrects.*')
		->where('questions.id','=',$id)
		->where('options.question_id','=',$id)
		->where('corrects.question_id','=',$id)
		->get();
		if($questions){
			return response()->json($questions);
		}
		else{
			return response()->json(['message'=>'failure']);
		}
		
	}
	
	public function deletequestion($id){
		
		$question=question::find($id);
		$question->delete();
		$option=option::where('question_id',$id);
		$option->delete();
		$correct=correct::where('question_id',$id);
		$correct->delete();
		
		return response()->json(['message'=>'successfully deleted question']);
	}
	//view all result
	public function viewresult(){
		$viewresult=user::orderBy('exam_init','desc')
		->where('type',0)
		
		->paginate(10);
		return $viewresult;
		
	}
	
		public function searchresult($name){
		$viewresult=user::where('f_name','like','%'.$name.'%')
		->where('type',0)
		->orWhere('l_name','like','%'.$name.'%')
		->orWhere('m_name','like','%'.$name.'%')
		
		->orderBy('exam_init','desc')
		
		->paginate(10);
		return $viewresult;
		
	}
	/** function selectcorrect($option){
		$checkcorrect=corrects::where('question_id',$questionid);
		
	} **/
	//get correct option
	public function getcorrect($questionid){
		
	 $getcorrect=correct::where('question_id',$questionid)
				->get();
			foreach($getcorrect as $option){
				
				return $option->correctoption;
			}
	
	}
	//get current users score
	public function getscore($userid){
		$myscore=user::where('id',$userid)
		->select('textscore')
		->first();
		//foreach($score as $myscore){
			
			return $myscore->textscore;
	//	}
		
	}
	/**
	public function resetanswer($userid){
		
		try{
		$delectselectedoption=studentanswer::where('user_id',$userid);
		$delectselectedoption->delete();
		
			$delectresult=result::where('user_id',$userid);
		$delectresult->delete();
		return response()->json(['message'=>'success']);
		}
		catch(\Exception $e){
			
			return response()->json(['message'=>'failure']);
		}
		
	}
	**/
	public function submitanswer(array $data,$questionid,$selectedoption,$userid){
		
		try{
			
			$checkcorrect=questionrepo::getcorrect($questionid);
			$getscore=questionrepo::getscore($userid);
			if($checkcorrect==$selectedoption){
				
				
				
				if($getscore==0){
					
					$createresult=User::where('id',$userid)
					->update(['textscore'=>1]);
				}
				else {
					
				$myscore=$getscore+1;
				$updateresult=User::where('id',$userid)
				->update(['textscore'=>$myscore]);
				}
			}
		/* 	else{
				
				$checkifalreadyanswer=studentanswer::where('question_id',$questionid);
				foreach($checkifalreadyanswer as $getselectedoption){
					$checkexist=$getselectedoption->selectedoption;	
				}
				if($checkexist!=""){
				
					if($getscore!=""){
						$myscore=$getscore-1;
						$updateresult=result::where('user_id',$userid)
					->update(['score'=>$myscore]);
					}
				
				}
				
			} */
			
		$submitanswer=studentanswer::create($data);
			return response()->json(['message'=>'success']);
		}
		catch(\Exception $e){
			try{
				//already exist so do some manipulation	
			$updateanswer=studentanswer::where('question_id',$questionid)
			->update($data);
					return response()->json(['message'=>'success']);
			}
			catch(\Exception $e){
			response()->json(['message'=>'failure']);
			}
			
		
		}
	}
	
	public function getmyresult($id){

		$gettheresult=user::where('id',$id)
		->select('textscore')
		->get();
		return response()->json($gettheresult);
		
		
	}

}







