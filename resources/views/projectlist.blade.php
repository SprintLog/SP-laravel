@extends('layouts.template')
@section('style')
  <link rel="stylesheet" href="/css/EJ-kanban.css">
@endsection

@section('script')
@endsection

@section('content')
  <div class="jumbotron far">
    <div class="form-group row far">
      User Project List

<!-- listProject Exam data -->
<br><hr style="width: 100%; color: black; height: 1px; background-color:black;" />
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Project SE</h5>
              <p class="card-text">Fuckking Markkie</p>
              <i class="fa fa-user"></i><br><br>
              <a href="#" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Project SE2</h5>
              <p class="card-text">Sleep With me Free Wifi</p>
              <i class="fa fa-user"></i><br><br>
              <a href="#" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Kuyyy</h5>
              <p class="card-text">www.javdie.net</p>
              <i class="fa fa-user"></i><br><br>
              <a href="#" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
        <!-- listProject from DB-->
        @foreach ($project as $project )
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $project -> eng_name}}</h5>
                <p class="card-text">{{ $project -> thai_name}}</p>
                <i class="fa fa-user"></i><br><br>
                <a href="#" class="btn btn-primary">View</a>
              </div>
            </div>
          </div>
        @endforeach

      </div><br>
      <a href="#" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> Create New Project
    </a>

    </div>
  </div>
@endsection