<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GLS Dashboard</title>

  <!-- Bootstrap -->
  <link href="{{ asset('common/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('common/fonts/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('common/css/nprogress.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('common/css/custom.min.css') }}" rel="stylesheet">


</head>

<body class="login">

    @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible " role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>Success!</strong> {{ Session::get('message') }}
        </div>
      @endif  

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <h1>Register</h1>

    <div class="form-group">
      <label for="f_name" >First Name <span class="required">*</span></label>
      <input class="block" type="text" name="first_name" value="{{ old('first_name') }}"  />
    @if ($errors->has('first_name')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('first_name') }}</li>
    </ul> 
    @endif
    </div>

    <div class="form-group">
      <label for="name" >Last Name </label>
      <input id="name" class="block" type="text" name="last_name" value="{{ old('last_name') }}"  />
    @if ($errors->has('last_name')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('last_name') }}</li>
    </ul> 
    @endif    
    </div>

    <div class="form-group">
      <label for="email" >Email <span class="required">*</span></label>
      <input class="block" type="email" name="email" value="{{ old('email') }}"  />
    @if ($errors->has('email')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('email') }}</li>
    </ul> 
    @endif
    </div>

    <div class="form-group">
      <label for="password" >Password <span class="required">*</span></label>
      <input class="block" type="password" name="password" value="{{ old('password') }}"   />
     
      @if ($errors->has('password')) 
      <ul class="parsley-errors-list filled" id="parsley-id-13">
        <li class="parsley-required">{{$errors->first('password') }}</li>
      </ul> 
      @endif        
    </div>
  

    <div class="form-group">
      <label for="password_confirm" >Confirm Password <span class="required">*</span></label>
      <input class="block" type="password" name="password_confirm" value="{{ old('password_confirm') }}"  />
    @if ($errors->has('password_confirm')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('password_confirm') }}</li>
    </ul> 
    @endif    
    </div>


    <div class="form-group">
      <label for="register_for" >Register For <span class="required">*</span></label>
      <input type="radio" name="user_role" value="3" @if(old('user_role') == 3 ) checked @endif>
      <label for="advertiser">Advertiser</label>
      <input type="radio" name="user_role" value="2" @if(old('user_role') == 2 ) checked @endif>
      <label for="publisher">Publishers</label>
    @if ($errors->has('user_role')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('user_role') }}</li>
    </ul> 
    @endif    
    </div>


    <div class="form-group">
      <label for="phone_number">Telegram Link <span class="required">*</span></label>
      <input class="block" type="text" name="telegram_link" value="{{ old('telegram_link') }}"  />
    @if ($errors->has('telegram_link')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('telegram_link') }}</li>
    </ul> 
    @endif    
    </div>


    <div class="form-group">
      <label for="phone_number" >Phone Number <span class="required">*</span></label>
      <input class="block" type="number" name="phone_number" value="{{ old('phone_number') }}"  />
    @if ($errors->has('phone_number')) 
    <ul class="parsley-errors-list filled" id="parsley-id-13">
      <li class="parsley-required">{{$errors->first('phone_number') }}</li>
    </ul> 
    @endif    
    </div>

    <input type="submit" name="submit" value="Register">
  </form>
</div>
</body>
</html>
