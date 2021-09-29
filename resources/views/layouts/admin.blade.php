<!DOCTYPE html>
<html lang="en">
  @include('partials.admin.head')
  <body class="nav-md">
    <div class="container body">
        <div class="main_container">

            @include('partials.admin.sidebar')

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('common/images/130247647.jpg') }}" alt="">{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                   
                                    <a href="{{route('logout')}}" class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- page content -->
            <div class="right_col" role="main">
            @yield('content')
            </div>
        </div>
    </div>
    </body> 
 
    @include('partials.admin.footer')
   