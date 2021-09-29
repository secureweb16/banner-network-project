@extends('layouts.admin')
@section('content')
    <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Companies <small>List</small></h3>
          </div>

          <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
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

        <div class="row" style="display: block;">
          <div class="col-md-12 col-sm-6  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Companies</h2>
                 <ul class="nav navbar-right panel_toolbox">
                    <li><a class="add-company"><i class="fa fa-plus"></i> Add Company</a>
                    </li>
                </ul>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>   

@endsection@extends('layouts.admin')
@section('content')
    <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Companies <small>List</small></h3>
          </div>

          <div class="title_right">
            <div class="col-md-5 col-sm-5   form-group pull-right top_search">
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

        <div class="row" style="display: block;">
          <div class="col-md-12 col-sm-6  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Companies</h2>
                 <ul class="nav navbar-right panel_toolbox">
                    <li><a class="add-company"><i class="fa fa-plus"></i> Add Company</a>
                    </li>
                </ul>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>   

@endsection