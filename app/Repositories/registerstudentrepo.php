<?php
namespace App\Repositories;
use App\User;

class registerstudentrepo{
	
	public function addstudent(array $data){
		
		$createuser=User::create($data);
		if($createuser){
			
			return 'success';
		}
		else{
			return 'failure';
		}
		
	}
	
	
	
}