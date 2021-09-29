
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
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{ route('password.update') }}">
                  @csrf
              <h1>Password Update</h1>
              <ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">  {{ $errors->first('password') }}</li></ul>
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div>
                <input id="email" type="email" name="email" value="{{ $request->email}}" class="form-control"  required="" placeholder="Email" readonly>
              </div>

              <div>
                <input id="password" type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>

              <div>
                <input id="password_confirmation" type="password" name="password_confirmation"  class="form-control" placeholder="Password confirmation" required="" />
              </div>
              <div>
                <button class="btn btn-default submit" >Reset Password</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               <!--  <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

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




