@extends('admin')

@section('content')

<script src="<?php echo asset('templates/sb-admin-2/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo asset('templates/sb-admin-2/bower_components/bootstrap/dist/js/bootstrap.js')?>"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ count($users) }}</div>
                        <div>Users logged in the last week!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ count($errors) }}</div>
                        <div>Errors logged in the last week!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-line-chart-o fa-fw"></i> Page Views for the Last Week
                <!--<div class="pull-right">
                    <div class="btn-group">

                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                       
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                        </ul>
                   
                    </div>
                </div>
                 -->
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

               <script type="text/javascript">
                    $(function() {
                        console.log( "ready!" );

                        Morris.Line({
                        element: 'morris-line-chart',
                            data: [

                            <?php $count = 1 ?>
                            @foreach ($pageViews as $pageView)

                            
                                {y: '{{ $pageView->date  }}', a: '{{ $pageView->total }}'},

                            <?php $count=$count+1 ?>
                            @endforeach                            
                            
                               
                            ],
                            xkey: 'y',
                            ykeys: ['a'],
                            labels: ['Page views'],
                            xLabels: ['day']
                        });

                        console.log( "After graph!" );
                    });
                    
                </script>
                <div id="morris-line-chart">

                </div>

             

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->


    </div>
</div>
<!-- /.row -->



@stop