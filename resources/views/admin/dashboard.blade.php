@extends('layouts.admin')
@section('content')

          <!-- top tiles -->
          <div class="row dashboarddiv" style="display: inline-block;" >
          <div class="tile_count">
       

            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Appraisals</span>
              <div class="count">{{$totalappraisals}}</div>
             
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Not Started Appraisals</span>
              <div class="count">{{$notstartedappraisals}}</div>  
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> In-Progress Appraisals</span>
              <div class="count green">{{$inprogressappraisals}}</div>
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Completed Appraisals</span>
              <div class="count">{{$compeateappraisals}}</div>            
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">{{$users}}</div>              
            </div>
           
            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Companies</span>
              <div class="count green">{{$companies}}</div>              
            </div>

            <div class="col-md-2 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Jewelry Types</span>
              <div class="count">{{$jewelryTypes}}</div>            
            </div>
           
          </div>
        </div>
       


@endsection