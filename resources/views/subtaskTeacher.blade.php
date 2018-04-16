@extends('layouts.template')
@section('style')

@endsection

@section('script')
  {{-- <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"> --}}

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

@endsection

@section('content')
<div class="jumbotron far">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/progress/{{$projectId}}">Tasks</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$taskName}}</li>
    </ol>
  </nav>

  @if (count($subtasks) > 0)

      <div class="row fart">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Desc</th>
              <th scope="col">Date Summit</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subtasks as $subtask)
            <tr>
              <th scope="row">{{$subtask->name}}</th>
              <td>{{$subtask->desc}}</td>
              <td>{{$subtask->updated_at}}</td>
              <td>
                @if ($subtask->completed == false)
                  <button type="submit" class = "btn btn-btn btn-warning">
                  Pending
                  </button>
                @else
                  <button type="submit" class = "btn btn-success">
                  Complete
                  </button>
                @endif
                </form>
            </td>
            </tr>
            @endforeach


          </tbody>
        </table>
      </div>
    @endif


    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
    <div class="panel panel-default">
      <div class="panel-heading"><label class="control-label" for="numberInput"></label>Commet By advisor</div>
      <div class="panel-body">
        <form data-toggle="validator" action="/post/new" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class = "form-group">
            <textarea class="form-control" rows="4" cols="50" name="body" placeholder="Post status" required ></textarea>
          </div>
          <div class = "form-gruop pull-right"><input type="submit" class ="btn btn-primary" value = "post" ></div>
          <div class="help-block with-errors"></div>
          <div class="form-group">

        </form>
      </div>
    </div>
    </div>

  </div>
  <div class="panel panel-default">
    <div class="panel-body">
          <form  action="/upload/image" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="row">
            <div class="fileinput fileinput-new" data-provides="fileinput">
              <span>Image</span>
              <span class="btn btn-default btn-file">
                <input type="file" class = "form-control" name = "image">
                <input type="hidden" name = "projectId" value="{{$projectId}}">
                <input type="hidden" name = "taskId" value="{{$taskId}}">
              </span>
              <span class="fileinput-filename"></span>
            </div>
          <div class = "form-gruop">
              <input type="submit" class = "btn btn-success pull-right" value ="Upload new image">
          </div>
            </div>
          </form>
          <br><br>
          @if (count($images) > 0)
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Image Name</th>
                <th scope="col">Date Summit</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                  @foreach ($images as $image)
                  <tr>
                    <th scope="row">{{$image->fileName}}</th>
                    <td>{{$image->updated_at}}</td>
                    <td>
                        <button type="button" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Delete
                        </button>
                     </td>
                  </tr>
                  @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>

    //for image

      </script>
      <script>
      $("#carousel").carousel();
          .carousel {
          height: 500px;
          margin-bottom: 60px;
      }
      /* Since positioning the image, we need to help out the caption */
       .carousel-caption {
          z-index: 10;
      }
      /* Declare heights because of positioning of img element */
       .carousel .item {
          width: 100%;
          height: 500px;
          background-color: #777;
      }
      .carousel-inner > .item > img {
          position: absolute;
          top: 0;
          left: 0;
          min-width: 100%;
          height: 500px;
        }
      </script>


    @if ($images)
          <div id="carousel" class="carousel slide" data-ride="carousel">
              <!-- Menu -->
              <ol class="carousel-indicators">
                  @for ($i=0; $i < count($images); $i++)
                    @if ($i == 0 )
                      <li data-target="#carousel" data-slide-to="{{$i}}" class="active"></li>
                    @else
                      <li data-target="#carousel" data-slide-to="{{$i}}"></li>
                    @endif
                  @endfor
              </ol>
              <!-- Items -->
              <div class="carousel-inner">
                @for ($i=0; $i < count($images); $i++)
                  @if ($i == 0 )
                  <div class="item active">
                      <img src="{{url('image/'.$projectId.'/' . $taskId .'/' . $images[$i]->fileName )}}"  alt="Slide 1"  class = "img-responsive"/>
                  </div>
                  @else
                  <div class="item">
                      <img src="{{url('image/'.$projectId.'/' . $taskId .'/' . $images[$i]->fileName )}}" alt="Slide {{$i}}" />
                  </div>
                  @endif
                @endfor
              </div>
              <a href="#carousel" class="left carousel-control" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a href="#carousel" class="right carousel-control" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
          </div>
      @endif




@endsection
