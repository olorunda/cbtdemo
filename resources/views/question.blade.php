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
        </section>
		<div style="padding-top:30px;">
		<table class="table table-inverse" >
		<thead>
    <tr>
      <th>#</th>
      <th>Question</th>
      <th>Option 1</th>
      <th>Option 2</th>
      <th>Option 3</th>
      <th>Option 4</th>
      <th>Answer</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @if(count($allquestion) > 0) 
	<tr id="all">
	  @foreach($allquestion as $questions)
      
    <tr >
	 <td scope="row"></th>
      <td scope="row">{{$questions->content}}</th>
     
      <td>{{$questions->option1}}</td>
      <td>{{$questions->option2}}</td>
      <td>{{$questions->option3}}</td>
      <td>{{$questions->option4}}</td>
      <td>Option {{$questions->correctoption}} is correct</td>
      <td><button class="btn btn-primary btn-md" onClick="edit({{$questions->question_id}})">Edit</button></td>
      <td><button class="btn btn-primary btn-md" onClick="deleted({{$questions->question_id}})">Delete</button></td>
    </tr>
	@endforeach
</tr>
	@else
		 <tr >
	 <th class="text-info">No </th>
      <th class="text-info">question</th>
     
      <td class="text-info"><b>In</b></td>
      <td class="text-info"><b>The</b></td>
      <td class="text-info"><b>Database</b></td>
    </tr>
	
	@endif
   <tr  id="editfield">
	 <td scope="row"></th>
      <td scope="row">
	  <input type="hidden" name="_token" id="ccc" value="{{ csrf_token() }}"><textarea class="form-control" id="questions" ></textarea></th>
     
      <td><input type="text"  class="form-control" id="option1"/>
	  <input type="hidden"  class="form-control" id="id"/></td>
      <td><input type="text"  class="form-control" id="option2"/></td>
      <td><input type="text"  class="form-control" id="option3"/></td>
      <td><input type="text"  class="form-control" id="option4"/></td>
      <td><select class="form-control" id="answer" >
								
								<option value='1'>Option One </option>
								<option value='2'>Option Two </option>
								<option value='3'>Option Three </option>
								<option value='4'>Option Four </option>
								</select></td>
      <td><button class="btn btn-primary btn-md" id="update">Update</button></td>
    </tr>
  </tbody>
</table>
</div>
  	<div class="col-md-9"></div>{!! $allquestion->render() !!}
        </section>
@endsection