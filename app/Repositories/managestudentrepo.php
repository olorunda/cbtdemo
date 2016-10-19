<?php

namespace App\Repositories;
use App\User;
class managestudentrepo {

public function liststudent(){
	
	$allstudent=User::where('type','=',0)->paginate(10);
	return $allstudent;
	
}

public function deletestudent($id){
	
	$deletestudent=User::find($id);
	$deletestudent->delete();
	return response()->json(['message'=>'Successfully Deleted Student']);
	
}

	
	public function statdisp(){
		//total applicant
			$total=user::where('type',0)
			->count('id');
			
			//logged in
			$totallogged=user::where('online',1)
				->where('type',0)
						->count('id');
			
			//completed
			//logged in
			$totalcomp=user::where('complete2',1)
					->where('type',0)
						->count('id');
			
			//passthru
			//logged in
			$pass=user::where('textscore','>=',30)
						->where('type',0)
						->count('id');
			
		$allstat=['total'=>$total,'totallogged'=>$totallogged,'totalcomp'=>$totalcomp,'pass'=>$pass];
		return $allstat;
	}
	
	
	
	
	
}