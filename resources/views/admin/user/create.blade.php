@extends('layouts.admin')
@section('content')
   <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Create Company</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><small>Please fill following fields:</small></h2>
                        {{-- <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="#">Settings 1</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul> --}}
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="demo-form" method="post" data-parsley-validate class="form-horizontal form-label-left" action="{{route('admin.users.store')}}">
                       
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="name"  name="name" required="required" class="form-control "  value="{{old('name')}}" data-parsley-required-message="Company name is required!">
                                    
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="email" id="email"  name="email" required="required" class="form-control "  value="{{old('email')}}" data-parsley-required-message="Company email is required!">
                                    <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">  {{ $errors->first('email') }}</li></ul>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Phone Number 
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="number" id="phoneNumber"  name="phoneNumber" class="form-control " value="{{old('phoneNumber')}}"  >
                                     <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">  {{ $errors->first('phoneNumber') }}</li></ul>
                                </div>                                
                            </div>
   
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Select Company <span class="required">*</span>
                                </label>
                                 <div class="col-md-6 col-sm-6 ">
                                   <select class="select2_group form-control" name="company_id">
                                      <option value="">Select Company</option>
                                        @forelse($companies as $company)
                                            <option value="{{$company->id}}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if ($errors->has('company_id')) 
                                     <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required"> {{$errors->first('company_id') }} </li></ul>
                                    @endif
                                </div>                                
                            </div>  

                            <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align" >Notification Preference <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="notification_preference">
                                        <option value="" disabled="">Select Preference</option>
                                        <option value="Email" selected="">Email</option>
                                        <option value="Sms">Sms</option>
                                        <option value="Both">Both</option>
                                    </select>
                                    <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required"> {{$errors->first('notification_preference') }} </li></ul>
                                  </div>
                            </div>
                          
                            <div class="ln_solid"></div>                      

                             <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>
@endsection