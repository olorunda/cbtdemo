@extends('app')
@section('content')

  <section class="content-header" onLoad="display5()">
          <h1>
            Welcome to C B T Portal
            <small>Electronic Test</small>
          </h1>
          <ol class="breadcrumb">
         <!--   <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Here</li>
          </ol> -->
        </section>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="">
			<div class="panel panel-success" >
				<div class="panel-heading"><b>CBT Test (Duration {{$time->time}} Minute) @if(Auth::user()->complete2==0)<b style="float:right;" id="timer"></b>@endif</div>
				<div class="panel-body" >
				<div id="question">
				@if(Auth::user()->complete2==0)
				<div id="displayquestion">
				</div>
				@endif
				
				@if(Auth::user()->complete2==0)
		
				 <input type="hidden"  value="0" id="count" > 
				 <input type="hidden"  value="0" id="max" >
				 <input type="hidden"  value="{{Auth::user()->id}}" id="userid" >
				  
				 <div class="col-md-6"><button style="display:none" class="btn btn-primary btn-md fixed-buttom" id="prev" >Previous</button>  </div>
				 <div class="col-md-3"><button class="btn btn-primary btn-md fixed-buttom span-left" style="float:left;" id="next" >Next</button></div>
				 <div class="col-md-3"><button class="btn btn-success btn-md fixed-buttom span-left" style="float:left;" id="submit" >Submit</button></div>
						@endif
						
					</div>
						@if(Auth::user()->complete2==0)
					<div id="submittted">
					<b style="font-size:30px;" class="text success">Your Answer Has Been Submitted  <br>
					<div class="col-md-12">Your Test Score is:&nbsp;&nbsp;<span id="score"></span></b></div>
					</div>
					@endif
					@if(Auth::user()->complete2==1)
							<div>
					<b style="font-size:30px;" class="text success">Your Answer Has Been Submitted  <br>
					<div class="col-md-12">Your Test Score is:&nbsp;&nbsp;{{Auth::user()->textscore}} %</b></div>
					</div>
				@endif
						
				</div>
			</div>
		</div>
	</div>
</div>
@endsection