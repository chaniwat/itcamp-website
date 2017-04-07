@extends('backend.layout.master')

@section('content-header')
    Stats Overview <small>ภาพรวมสถิติการเข้าชม</small>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid box-bg-navy">
                <div class="box-header">
                    <h3 class="box-title">กราฟแสดงการเข้าชม</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="position: relative; height: 320px;">
                    <canvas id="viewChart"></canvas>
                </div><!-- /.box-body -->
            </div>
        </div>
        <!-- ./col -->

        <div class="col-md-6">
            <div class="box box-solid box-bg-navy">
                <div class="box-header">
                    <h3 class="box-title">กราฟแสดงอุปกรณ์ที่ใช้เข้าชม</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="position: relative; height: 320px;">
                    <canvas id="platformChart"></canvas>
                </div><!-- /.box-body -->
            </div>
        </div>
        <!-- ./col -->

        <div class="col-md-12">
            <div class="box box-solid box-bg-navy">
                <div class="box-header">
                    <h3 class="box-title">ข้อผิดพลาดล่าสุด</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="150">เมื่อ</th>
                            <th>ข้อความ</th>
                            <th width="90">รหัส</th>
                            <th width="150">Url ที่เรียก</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($errors as $error)
                            <tr>
                                <td>{{ $error->created_at }}</td>
                                <td>{{ $error->error->message }}</td>
                                <td>{{ $error->error->code }}</td>
                                <td>{{ $error->path->path }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
        <!-- ./col -->
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>

<script type="text/javascript">

  /**
   * Default Configuration
   */

  Chart.defaults.global.legend.position = 'bottom';

  /**
   * View Chart
   */

  // --------------------------------------

  var ctx = $("#viewChart");

  var viewDatasets = [
    {
      label: "Views",
      fill: false,
      pointRadius: 6,
      backgroundColor: "#86d0ff",
      borderColor: "#86d0ff",
      data: [{!! implode(', ', array_map(function($val) { return "'".$val."'"; }, $visits_counts)) !!}],
      spanGaps: false,
    },
    {
      label: "Unique views",
      fill: false,
      pointRadius: 6,
      backgroundColor: "#4f47ff",
      borderColor: "#4f47ff",
      data: [{!! implode(', ', array_map(function($val) { return "'".$val."'"; }, $unique_visits_counts)) !!}],
      spanGaps: false,
    }
  ];

  var viewChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [{!! implode(', ', array_map(function($val) { return "'".$val."'"; }, $visits_dates)) !!}],
      datasets: viewDatasets
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: 'index',
        intersect: false
      },
      hover: {
        mode: 'index',
        intersect: false
      },
      scales: {
        yAxes: [{
          ticks: {
            min: 0
          }
        }]
      }
    }
  });

  // --------------------------------------

  /**
   * Platform Chart
   */

  // --------------------------------------

  var ctx = $("#platformChart");

  var colorBarP = {
    Computer: '#4CAF50',
    Phone: '#29B6F6',
    Tablet: '#EC407A',
    Other: '#795548'
  }
  var colorBarPValues = function() {
    var values = [];

    $.each(colorBarP, function (i, v) {
      values.push(v);
    });

    return values;
  }();

  var platformChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [{!! implode(', ', array_map(function($val) { return "'".$val."'"; }, $devices_labels)) !!}],
      datasets: [
        {
          data: [{!! implode(', ', array_map(function($val) { return "'".$val."'"; }, $devices_counts)) !!}],
          spanGaps: false,
          backgroundColor: colorBarPValues,
          hoverBackgroundColor: colorBarPValues
        }
      ]
    },
    options: {
      maintainAspectRatio: false
    }
  });

</script>
@endsection