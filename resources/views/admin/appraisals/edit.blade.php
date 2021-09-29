@extends('layouts.admin')
@section('content')
   <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Update Appraisal</h3>
            </div>
            {{-- <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
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
                          @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="demo-form" method="post" enctype=multipart/form-data  data-parsley-validate class="form-horizontal form-label-left" action="{{route('admin.appraisals.update',$appraisal->id)}}">

                            @csrf
                            {{ method_field('PUT') }}
                            <div class="item form-group">
                                
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="appraisal_no" >Appraisal No
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="appraisal_no" value="{{$appraisal->appraisal_no}}"  name="appraisal_no"  class="form-control">
                                    @if ($errors->has('appraisal_no')) 
                                      <div class="alert alert-danger"> {{$errors->first('appraisal_no') }} </div>
                                    @endif
                                </div>
                            </div>
                             <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="company_id" >User <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="company_id">
                                        <option>Select Comapny</option>
                                        @forelse($companies as $company)
                                            <option value="{{$company->id}}" {{ $appraisal->company_id == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if ($errors->has('company_id')) 
                                        <div class="alert alert-danger"> {{$errors->first('company_id') }} </div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jewelry_type" >Jewelry Type <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="jewelry_type">
                                        <option>Select Jewelry Type</option>
                                        @forelse($jewelryTypes as $jewelryType)
                                            <option value="{{$jewelryType->id}}"  {{ $appraisal->jewelry_type == $jewelryType->id ? 'selected' : '' }} >{{$jewelryType->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @if ($errors->has('jewelry_type')) 
                                        <div class="alert alert-danger"> {{$errors->first('jewelry_type') }} </div>
                                    @endif
                                </div>
                            </div>


                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description (10 chars min, 100 max) : 
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea id="description"  class="form-control" name="description" data-parsley-trigger="keyup" >{{$appraisal->description }} </textarea>
                                    @if ($errors->has('description')) 
                                        <div class="alert alert-danger"> {{$errors->first('description') }} </div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="owner_name" >Owner Name 
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="owner_name" value="{{$appraisal->owner_name}}"   name="owner_name"  class="form-control">
                                    @if ($errors->has('owner_name')) 
                                        <div class="alert alert-danger"> {{$errors->first('owner_name') }} </div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="owner_address">Owner Address (10 chars min, 100 max) : 
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea id="owner_address" class="form-control" name="owner_address" data-parsley-trigger="keyup" data-parsley-minlength-message="Come on! You need to enter at least a 10 caracters long address.." data-parsley-validation-threshold="10">{{$appraisal->owner_address}} </textarea>
                                    @if ($errors->has('owner_address')) 
                                        <div class="alert alert-danger"> {{$errors->first('owner_address') }} </div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status" >Status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control" name="status">
                                        <option value="" disabled="">Select Status</option>
                                        <option value="0" {{ $appraisal->status == 0 ? 'selected' : '' }}>Not Started</option>
                                        <option value="1" {{ $appraisal->status == 1 ? 'selected' : '' }}>In Progress</option>
                                        <option value="2" {{ $appraisal->status == 2 ? 'selected' : '' }} >Completed</option>
                                    </select>
                                    @if ($errors->has('status')) 
                                        <div class="alert alert-danger"> {{$errors->first('status') }} </div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">    
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="pdf_path" >PDF
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="file" id="pdf_path"  name="pdf_path"  class="form-control" accept="application/pdf">
                                    @if($appraisal->pdf_path)
                                        <a class="btn btn-app m-2" target="_new" href="{{asset($appraisal->pdf_path)}}">
                                            <i class="fa fa-eye"></i> View uploded pdf
                                        </a>
                                    @endif
                                    @if ($errors->has('pdf_path')) 
                                        <div class="alert alert-danger"> {{$errors->first('pdf_path') }} </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="ln_solid"></div>

                             <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a href="{{URL::to('/admin/appraisals')}}">
                                        <button class="btn btn-primary" type="button">Cancel</button>  
                                    </a>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>



                           
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>
@endsection