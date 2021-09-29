@extends('layouts.user')
@section('content')
    <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Appraisals <small>List</small></h3>
          </div>

         {{--  <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div> --}}
        </div>

        <div class="clearfix"></div>

        <div class="row clearfix" style="display: block;">
          <div class="col-md-12 col-sm-6  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Appraisals</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content tblcontent">
                <table class="table" id="datatable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Appraisal no</th>
                      <!-- <th>User</th> -->
                      <th>Jewelry Type</th>
                      <th>Description</th>
                      <th>Owner Name</th>
                      <th>Owner Address</th>
                      <th>Status</th>
                      <th>Pdf</th>
                    </tr>
                  </thead>
                  <tbody>

                    @forelse($appraisals as $appraisal)

                      <tr>
                        <th scope="row">#{{$appraisal->id}}</th>
                        <td>{{$appraisal->appraisal_no}}</td>
                        <td>{{$appraisal->jewelryType->name}}</td>
                        <td>{{$appraisal->description}}</td>
                        <td>{{$appraisal->owner_name}}</td>
                        <td>{{$appraisal->owner_address}}</td>
                        <td>@if($appraisal->status == 0)Not Started @elseif($appraisal->status == 1)In Progress @elseif($appraisal->status == 2)Completed @endif</td>
                        
                        <td>
                          
                            @if(@$appraisal->pdf->uuid) @if($appraisal->status == 2) <a href="{{ route('pdf.download', $appraisal->pdf->uuid) }}">View PDF</a> @else <a href="javascript:void(0);">View PDF</a> @endif @endif  </td>
                    
                      </tr>
                    @empty
                      <tr>
                        <td>No appraisals exit!</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>   

@endsection