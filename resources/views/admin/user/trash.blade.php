@extends('layouts.admin')
@section('content')
    <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Users <small>List</small></h3>
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

            @if(Session::get('message'))
              <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Success!</strong> {{ Session::get('message') }}
              </div>
            @endif  


            <div class="x_panel">
              <div class="x_title">
                <h2>Users</h2>                 
                <div class="clearfix"></div>
              </div>
              <div class="x_content tblcontent">

                <table class="table" id="datatable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Comapny</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($users as $user)
                      <tr>
                        <th scope="row">#{{$user->id}}</th>
                        <td>{{@$user->name}}</td>
                        <td>{{@$user->company->usercompany->name}}</td>
                        <td>{{@$user->email }}</td>
                        <td>{{@$user->mobile_phone }}</td>
                        <td>
                          <form action="{{route('admin.restore-users',$user->id)}}" method="post">
                             @csrf
                            <button type="submit" class="btn btn-success">Restore</button>
                          </form>
                          
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td>No users exit!</td>
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