@extends('app')
@section('content')
  <section class="content-header">
          <h1>
            Welcome to C B T Portal
            <small>Electronic Test</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Here</li>
          </ol>
		 
	 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>All Applicants</b></h3>

              <form method="get" action="search" class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" value="{{old('table_search')}}" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
			  @if(count($result) > 0) 
	
	
      
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                <th>#</th>
      <th></th>
      <th>Full Name</th>
      <th>Login Time</th>
      <th>Submission Time</th>
      <th>Status</th>
      <th>Score</th>
      <th>lock/unlock</th>
	       <th>Time Added</th>
      <th>Add Time</th>
                </tr>
				  @foreach($result as $allstudentresult)
                <tr >
	 <th scope="row">{{$index++}}</th>
      <th scope="row"><img style="height:50px; width:50px;" src='{{url ("upload/$allstudentresult->image") }}'></img></th>
     
      <td>{{$allstudentresult->f_name}} {{$allstudentresult->l_name}}</td>
      <td>{{$allstudentresult->logintime->diffForHumans()}}</td>
      <td>{{$allstudentresult->submissiontime->diffForHumans()}}</td>
      <td>@if($allstudentresult->locked==1) <span class="label label-danger">banned</span> @else <span class="label label-success">clean</span> @endif</td>
      <td>{{$allstudentresult->textscore}}</td>
         <td>@if($allstudentresult->locked==1) <button onclick="ban(0,'{{$allstudentresult->id}}')" class="btn btn-success">Unban</button> @else <button class="btn btn-danger" onclick="ban(1,'{{$allstudentresult->id}}')">Ban</button> @endif</td>
       <?php $addedtime=$allstudentresult->time-$time->time;
			if($addedtime <= 0) { $addedtimes=0;} else {$addedtimes=$addedtime;} ?>
	   <td>{{$addedtimes}}  minute</td>
         <td><button id="addtime" class="btn btn-success" onclick="addtime({{$allstudentresult->id}})" >Add time</button></td>
       </tr>
		 @endforeach


              </table>
            </div>
				@else
					
				No Result Found
				@endif
					<div class="col-md-9"></div>{!! $result->render() !!}
	
	
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
  
	
	
        </section>
		<script>
		function ban(type,id){
			if(type==1){
					text="banned";
					text2="ban";
				}
				else{
					text="unbanned";
					text2="unban";
				}
			 swal({   title: "Are you sure?",  
 text: "You are about to "+text2+" Applicant!",  
 type: "warning",  
 showCancelButton: true,  
 confirmButtonColor: "#DD6B55",  
 confirmButtonText: "Yes, "+text2+" Applicant!", 
 cancelButtonText: "No, cancel!",  
 closeOnConfirm: false,  
 closeOnCancel: false },
 function(isConfirm){  
 if (isConfirm) {  
			$.get('/ban/'+type+'/'+id,function(data,status,xhr){
				
				if(data=="1"){
					swal('success','successfully '+text+' applicant','success');
					window.location.reload();
				}
				else{
					
					swal('error','some error occurred','error');
				}
				
			});
 }
 else{
	 
					swal('cancelled','No Changes Made','error');
 }
 });
		}
			
		function addtime(id){
			
			swal({   title: "Input Time ", 
			text: "Time Should be in this format (for example 40min as 40):",
			type: "input",   showCancelButton: true, 
			closeOnConfirm: false, 
			animation: "slide-from-top", 
			inputPlaceholder: "example 40" },
			function(inputValue){  
			if (inputValue === false) 
				return false;     
			if (inputValue === "") { 
			swal.showInputError("You need to write something!");
			return false   }
            $.get('/addtime/'+id+'/'+inputValue,function(data,status,xhr){
				if(data==1){
				swal("Added", "Time Successfully Added " , "success"); 
				window.location.reload();
				}
				else{
					swal("Error", "Error Adding Time " , "error"); 
			
				}
				
			});			
				});
			
			
		}	
	
		
		</script>
@endsection