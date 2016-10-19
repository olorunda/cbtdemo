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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$statdisp['total']}}</h3>

              <p>All Applicant</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
  <a href="/viewresult" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
        </div>
		 <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$statdisp['totallogged']}}<sup style="font-size: 20px"></sup></h3>

              <p>Logged In</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/viewresult" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$statdisp['totalcomp']}}</h3>

              <p>Completed</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
                   </div>
    <a href="/viewresult" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$statdisp['pass']}}</h3>

              <p>Pass</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/viewresult" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
       <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Percentage Score <button id="refresh" class="btn"><i class="fa fw fa-refresh"></i></button></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
		<script>
		 $(function () {
   
	
$.get('/statistics',function(data,status,xhr){
       donut =Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["red", "#ccbb2a", "#95c197","#70c374","#41c547","#20bb27","#20bb27","green"],
      data: data,
      hideHover: 'auto'
    });
});

function updatechat(){
$.get('/statistics',function(data,status,xhr){
	donut.setData(data);
	});
}

$('#refresh').click(function(){
	
	updatechat();
	
});

	});
		
		</script>
@endsection