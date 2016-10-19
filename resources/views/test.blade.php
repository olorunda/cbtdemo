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
		<div class="form-horizontal" role="form" id="form" style="padding-top:100px;">
						
<input type="hidden" name="_token" id="ccc" value="{{ csrf_token() }}">
						<div class="form-group">
						
							<label class="col-md-4 control-label">Question</label>
							<div class="col-md-6">
								<textarea type="text" class="form-control" id="questions" ></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Option 1</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="option1" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Option 2</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="option2" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Option 3</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="option3" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Option 4</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="option4" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Select Answer</label>
							<div class="col-md-6">
								<select class="form-control" id="answer" >
								
								<option value='1'>Option One </option>
								<option value='2'>Option Two </option>
								<option value='3'>Option Three </option>
								<option value='4'>Option Four </option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button  class="btn btn-primary"  id="addquestion">
									Add Question
								</button>
									<a  href='{{ url("/managestd/allquestion") }}' class="btn btn-primary" id="managetests" >
									Manage Test
								</a>
							</div>
						</div>
						
					</div>
				
@endsection