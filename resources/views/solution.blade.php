@extends('app')
@section('content')

  <section class="content-header" onLoad="display5()">
          <h1>
            Welcome to C B T Portal
            <small>Electronic Test</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Here</li>
          </ol>
        </section>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading"><b>CBT Text Solution</div>
				<div class="panel-body" >
			<!-- My Jargons there might be a better way to handle this condition but am lazy to explore-->
			    @if(count($solutions)>0)
					@foreach($solutions as $solution)

<br><div class="col-md-12">{{$index++}} )&nbsp;&nbsp;
				  <b>{{$solution->content}}</b><br>
				  @if($solution->selectedoption==1)
					  @if($solution->correctoption==1)
				  <span style="color:green">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="$style3">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="$style4">d.&nbsp;{{$solution->option4}}<br></span>
					@else
							  <span style="color:red">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="$style3">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="$style4">d.&nbsp;{{$solution->option4}}<br></span>
						@endif
				  @elseif($solution->selectedoption==2)
						  @if($solution->correctoption==2)
				  <span style="">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="color:green">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="$style3">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="$style4">d.&nbsp;{{$solution->option4}}<br></span>
					@else
							  <span style="">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="color:red">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="$style3">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="$style4">d.&nbsp;{{$solution->option4}}<br></span>
						@endif
				  	  @elseif($solution->selectedoption==3)
							  @if($solution->correctoption==3)
				  <span style="">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="color:green">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="$style4">d.&nbsp;{{$solution->option4}}<br></span>
					@else
							  <span style="">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="color:red">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="$style4">d.&nbsp;{{$solution->option4}}<br></span>
						@endif
							  @elseif($solution->selectedoption==4)
							  @if($solution->correctoption==4)
				  <span style="">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="$style3">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="color:green">d.&nbsp;{{$solution->option4}}<br></span>
					@else
							  <span style="">a.&nbsp;{{$solution->option1}}<br></span>
					<span style="">b.&nbsp;{{$solution->option2}}<br></span>
					<span style="$style3">c.&nbsp;{{$solution->option3}}<br></span>
					<span style="color:red">d.&nbsp;{{$solution->option4}}<br></span>
						@endif
						@endif
					
					@if($solution->selectedoption==$solution->correctoption)
						You Choose Option {{$solution->selectedoption}} which is correct
					@else
				You Choose Option		{{$solution->selectedoption}}
				The correct Answer is Option	:{{$solution->correctoption}}
			
				@endif
			</div>
	<div class="col-md-12" style="padding-top:10px"></div>
					@endforeach
					@else
						<div class="col-md-12"><b class="text-success" style="font-size:30px;">No Test Has Been Taken</a></div>
					@endif
					
				
					{!! $solutions->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection