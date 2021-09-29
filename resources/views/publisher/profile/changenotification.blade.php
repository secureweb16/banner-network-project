@extends('layouts.user')
@section('content')
   <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Change Notification Preference</h3>
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
                  
                        <form id="demo-form" method="post" action="{{route('user.update-notification-preference')}}">

                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" >Notification Preference <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select id="changepreference" class="form-control" name="notification_preference">
                                        <option value="" disabled="">Select Preference</option>
                                        <option value="Email" @if(Auth::user()->notification_preference == 'Email') selected @endif selected="">Email</option>
                                        <option value="Sms" @if(Auth::user()->notification_preference == 'Sms') selected @endif>Sms</option>
                                        <option value="Both" @if(Auth::user()->notification_preference == 'Both') selected @endif>Both</option>
                                    </select>
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