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
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>login</h1>
            <ul class="parsley-errors-list filled" id="parsley-id-5">
              <li class="parsley-required">  {{ $errors->first('email') }}</li>
            </ul>
            <div>
              <input id="email" type="email" name="email" value="{{old('email')}}" class="form-control"  required="" placeholder="Email"/>               
            </div>

            <div>
              <input id="password" type="password" name="password" class="form-control" placeholder="Password" required="" />
            </div>

            <div>
              <button class="btn btn-default submit" >Log in</button>
              <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
            </div>

            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <br />
              <div>                   
                <p>Copyright © 2020</p>
              </div>
            </div>
          </form>
        </section>
      </div>

    </div>
  </div>
</body>
</html>
