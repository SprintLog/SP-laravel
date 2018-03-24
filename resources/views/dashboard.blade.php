@extends('layouts.template')
@section('style')
  <style>
  h1 {
      text-align: center;
  }
  h2 {
      text-align: center;
  }
  p {
      text-align: center;
  }
  img{
    display: block;
    margin: 0 auto;
  }

  </style>
@endsection

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
@endsection

@section('content')
  <div class="jumbotron far">
      <!-- show status UCP-->
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">You Have</h2>
              <h1 class="card-title">{{$UCP}}</h1>
              <p class="card-text">UCP</p>

            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">You Need</h2>
              <h1 class="card-title">{{$HUCP}}</h1>
              <p class="card-text">Hours / UCP  </p>
            </div>
          </div>
        </div>
      </div>
      <!-- pass variabel php to javascript-->
          @php
          $nametask = [] ;
          $complexity = [] ;
          $progress=[] ;
          @endphp
          @foreach ($tasks as $tasks)
            @php
              array_push($nametask,$tasks->nametask);
              array_push($complexity,$tasks->complexity);
            @endphp
          @endforeach
          @foreach ($progressProject as $progressProject)
            @php
              array_push($progress,$progressProject);
            @endphp
          @endforeach
          @php
            echo '<script>';
            echo 'var nametask = ' . json_encode($nametask) . ';';
            echo 'var progress = ' . json_encode($progress) . ';';
            echo '</script>';
          @endphp

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Task</th>
            <th scope="col">Time Limit</th>
          </tr>
        </thead>
        <tbody>
          @for ($i=1; $i <= sizeof($nametask); $i++)
            <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$nametask[$i-1]}}</td>
              <td>@if($complexity[$i-1] == 1)
                  {{number_format(5*$TCF*$ECF * $HUCP ,2, '.', ' ')}} Hours
                @elseif($complexity[$i-1] == 2)
                  {{number_format(10*$TCF*$ECF * $HUCP  ,2, '.', ' ') }} Hours
                @else
                  {{number_format(15*$TCF*$ECF * $HUCP  ,2, '.', ' ')}} Hours
              @endif
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
      <!-- $UCP ไม่ใช่ค่าที่ต้องการ ค่าที่ต้องการคือ ค่า UCP ทีี่ทำได้ ซึ่งตอนนี้ยังทำไม่ได้-->
      @if ($UCP > 1)
        <!-- show image status-->
        <div class="card" style="width: 80rem;">
          <img class="card-img-top"  height="100px" width"100px" display= "block"  src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Smile3_no-blur.svg/2000px-Smile3_no-blur.svg.png" alt="Card image cap">
          <div class="card-body">
            <p class="card-text">You can develop the project  within the time limit</p>
          </div>
        </div>
      @else
        <!-- show image status-->
        <div class="card" style="width: 80rem;">
          <img class="card-img-top"  height="100px" width"100px" display= "block"  src="http://www.pngmart.com/files/1/Sad-Emoji-PNG-Clipart.png" alt="Card image cap">
          <div class="card-body">
            <p class="card-text">You can not  develop the project  within the time limit</p>
          </div>
        </div>
      @endif
    <div class="form-group row far">
    <label  class="col-sm-4 col-form-label label label-default">
         Overview
      </label>
      <canvas id="pie-chart" width="40px" height="15px"></canvas>
      <br><br><br>
    <label  class="col-sm-4 col-form-label label label-default">
        Status
    </label>
    <br><br><br>
  <canvas id="pie-chart2" width="40px" height="15px"></canvas>
  <label  class="col-sm-4 col-form-label label label-default">
      Progress
  </label>
  <br><br><br>
  <canvas id="myChart" width="80px" height="80px"></canvas>

  <!-- make grarph-->
  <script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          //labels: ["Task1", "Task2", "Task3", "Task4", "Task5", "Task6"],
          labels: nametask,
          datasets: [{
              label: 'Progress Transaction (%)',
              data: progress,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true
                  }
              }]
          }
      }
  });

  new Chart(document.getElementById("pie-chart2"), {
    type: 'pie',
    data: {
      labels: ["TO DO", "DOING", "DONE"],
      datasets: [{
        label: "Task Status",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
        data: [15,45,30]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Task Status in Project'
      }
    }
});

new Chart(document.getElementById("pie-chart"), {
  type: 'pie',
  data: {
    labels: ["Complete","InComplete"],
    datasets: [{
      label: "Overview Status",
      backgroundColor: ["#c45850", "#e8c3b9"],
      data: [{{$projectComplete}},100-{{$projectComplete}}]
    }]
  },
  options: {
    title: {
      display: true,
      text: 'System Overview'
    }
  }
});

  </script>
    </div>
  </div>
@endsection
