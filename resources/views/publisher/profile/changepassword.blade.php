@extends('layouts.user')
@section('content')

   <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Change Password</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                   
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">   

              @if(Session::get('message_success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> {{ Session::get('message_success') }}
                </div>
              @endif    

              @if(Session::get('message'))
                <div class="alert alert-danger alert-dismissible " role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>Error!</strong> {{ Session::get('message') }}
                </div>
              @endif     
          <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">  {{ $errors->first('newpassword') }}</li></ul>               
                  
                        <form id="demo-form" method="post" action="{{route('user.update-password')}}">

                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Old Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="oldpassword" type="password" name="oldpassword" class="form-control" placeholder="Old Password" required="" />
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >New Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="newpassword" type="password" name="newpassword" class="form-control" placeholder="New Password" required="" />
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Confirm Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="confirmpassword" type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required="" />
                                </div>
                            </div>

                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            
                            <div class="ln_solid"></div>
                        </form>
                    
                </div>
            </div>
        </div>   
    </div>
@endsection