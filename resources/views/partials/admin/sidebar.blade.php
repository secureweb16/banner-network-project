<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{URL::to('/admin/dashboard')}}" class="site_title">
        <img src="{{ asset('common/images/small-logo.png') }}"></a>
    </div>

    <div class="clearfix"></div>

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="{{URL::to('/admin/dashboard')}}"><i class="fa fa-columns"></i> Dashboard <span class="fa fa-chevron-down"></span></a></li>

          <li><a href="{{URL::to('/admin/companies')}}"><i class="fa fa-building"></i> Companies <span class="fa fa-chevron-down"></span></a></li>

          <li><a href="{{URL::to('/admin/users')}}"><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a></li>          

          <li><a href="{{URL::to('/admin/appraisals')}}"><i class="fa fa-file-pdf-o"></i> Appraisals <span class="fa fa-chevron-down"></span></a></li>

          <li><a href="{{URL::to('/admin/jewelry-type')}}"><i class="fa fa-diamond"></i> Jewelry Type <span class="fa fa-chevron-down"></span></a></li>           

          <li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{URL::to('/admin/change-password')}}">Change Password </a></li>
            </ul>
          </li>       

        </ul>
      </div>
     
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
     
      <a href="{{route('logout')}}" data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>