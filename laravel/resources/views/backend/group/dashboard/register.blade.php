@inject('codeHelper', 'App\Services\CodeHelperService')

@extends('backend.layout.master')

@section('content-header')
    Dashboard <small>ภาพรวมการสมัคร</small>
@endsection

@section('content')

    {!! $codeHelper->makeAlertStatus() !!}

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid box-bg-navy">
                <div class="box-header">
                    <h3 class="box-title">จำนวนผู้สมัครของแต่ละค่าย</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <?php
                                        $rNumReg = 0;
                                        $rNumApp = rand(1, 500);
                                        $rNumReg += $rNumApp;
                                    ?>
                                    <h3>{{ $rNumApp }} / 30</h3>

                                    <p>Appersky</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-social-codepen"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped bg-blue progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($rNumApp / 30) * 100) > 100 ? 100 : ($rNumApp / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumApp / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box" style="background-color: #d35400; color: white;">
                                <div class="inner">
                                    <?php
                                        $rNumGame = rand(1, 500);
                                        $rNumReg += $rNumGame;
                                    ?>
                                    <h3>{{ $rNumGame }} / 30</h3>

                                    <p>Gamesoft</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-football"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($rNumGame / 30) * 100) > 100 ? 100 : ($rNumGame / 30) * 100) }}%; background-color: #d35400;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumGame / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <?php
                                        $rNumNW = rand(1, 500);
                                        $rNumReg += $rNumNW;
                                    ?>
                                    <h3>{{ $rNumNW }} / 30</h3>

                                    <p>Network Defender</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-wifi"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped bg-purple progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($rNumNW / 30) * 100) > 100 ? 100 : ($rNumNW / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumNW / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <?php
                                        $rNumIot = rand(1, 500);
                                        $rNumReg += $rNumIot;
                                    ?>
                                    <h3>{{ $rNumIot }} / 30</h3>

                                    <p>IoTech</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-outlet"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped bg-teal progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($rNumIot / 30) * 100) > 100 ? 100 : ($rNumIot / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumIot / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <?php
                                        $rNumDataSci = rand(1, 500);
                                        $rNumReg += $rNumDataSci;
                                    ?>
                                    <h3>{{ $rNumDataSci }} / 30</h3>

                                    <p>Data Cyber</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cube"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped bg-maroon progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($rNumDataSci / 30) * 100) > 100 ? 100 : ($rNumDataSci / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumDataSci / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-9 col-xs-12">
                            <!-- small box -->
                            <div class="small-box" style="background-color: #2c3e50; color: white;">
                                <div class="inner">
                                    <?php
                                        $rNumPassApp = rand(round($rNumApp / 2), $rNumApp);
                                        $rNumPassGame = rand(round($rNumGame / 2), $rNumGame);
                                        $rNumPassNW = rand(round($rNumNW / 2), $rNumNW);
                                        $rNumPassIot = rand(round($rNumIot / 2), $rNumIot);
                                        $rNumPassDataSci = rand(round($rNumDataSci / 2), $rNumDataSci);
                                        $rNumBase = $rNumPassApp + $rNumPassGame + $rNumPassNW + $rNumPassIot + $rNumPassDataSci;
                                    ?>
                                    <h3>{{ $rNumBase }} / {{ $rNumReg }}</h3>

                                    <p>จำนวนที่ตรวจใบสมัครแล้ว / จำนวนผู้สมัครทั้งหมด</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", ($rNumBase / $rNumReg) * 100) }}%; background-color: #2c3e50;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumBase / $rNumReg) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <?php
                                        $rNumPass = $rNumBase;
                                    ?>
                                    <h3>{{ $rNumPass }}</h3>

                                    <p>จำนวนใบสมัครที่ผ่าน</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-round"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-green" style="margin-bottom: 0;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid box-bg-navy">
                <div class="box-header">
                    <h3 class="box-title">รายละเอียดการสมัคร</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                $rNumAppBoy = rand(round($rNumApp / 2), $rNumApp);
                                $rNumGameBoy = rand(round($rNumGame / 2), $rNumGame);
                                $rNumNWBoy = rand(round($rNumNW / 2), $rNumNW);
                                $rNumIotBoy = rand(round($rNumIot / 2), $rNumIot);
                                $rNumDataSciBoy = rand(round($rNumDataSci / 2), $rNumDataSci);
                                $rNumAllBoy = $rNumAppBoy + $rNumGameBoy + $rNumNWBoy + $rNumIotBoy + $rNumDataSciBoy;
                            ?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ค่าย</th>
                                        <th>ชาย</th>
                                        <th>หญิง</th>
                                        <th>รวม</th>
                                        <th width="120">ใบสมัครผ่าน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Appersky</td>
                                        <td>{{ $rNumAppBoy }}</td>
                                        <td>{{ $rNumApp - $rNumAppBoy }}</td>
                                        <td>{{ $rNumApp }}</td>
                                        <td>{{ $rNumPassApp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gamesoft</td>
                                        <td>{{ $rNumGameBoy }}</td>
                                        <td>{{ $rNumGame - $rNumGameBoy }}</td>
                                        <td>{{ $rNumGame }}</td>
                                        <td>{{ $rNumPassGame }}</td>
                                    </tr>
                                    <tr>
                                        <td>Network Defender</td>
                                        <td>{{ $rNumNWBoy }}</td>
                                        <td>{{ $rNumNW - $rNumNWBoy }}</td>
                                        <td>{{ $rNumNW }}</td>
                                        <td>{{ $rNumPassNW }}</td>
                                    </tr>
                                    <tr>
                                        <td>IoTech</td>
                                        <td>{{ $rNumIotBoy }}</td>
                                        <td>{{ $rNumIot - $rNumIotBoy }}</td>
                                        <td>{{ $rNumIot }}</td>
                                        <td>{{ $rNumPassIot }}</td>
                                    </tr>
                                    <tr>
                                        <td>Data Cyber</td>
                                        <td>{{ $rNumDataSciBoy }}</td>
                                        <td>{{ $rNumDataSci - $rNumDataSciBoy }}</td>
                                        <td>{{ $rNumDataSci }}</td>
                                        <td>{{ $rNumPassDataSci }}</td>
                                    </tr>
                                    <tr>
                                        <td align="right">รวม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $rNumAllBoy }}</td>
                                        <td>{{ $rNumReg - $rNumAllBoy }}</td>
                                        <td>{{ $rNumReg }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- ./col -->
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid box-bg-navy">
                <div class="box-header">
                    <h3 class="box-title">การตรวจคำตอบ</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- small box -->
                            <div class="small-box" style="background-color: #16a085; color: white; margin-bottom: 0;">
                                <div class="inner">
                                    <?php
                                        $rNumCheckAll = rand(round($rNumBase / 1.5), $rNumBase);
                                    ?>
                                    <h3>{{ $rNumCheckAll }} / {{ $rNumPass }}</h3>

                                    <p>จำนวนที่ตรวจคำตอบแล้ว / จำนวนผู้สมัครที่ใบสมัครผ่าน</p>
                                    <h4><span class="label bg-black">ประธานค่าย</span></h4>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-chatboxes"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", ($rNumBase / $rNumReg) * 100) }}%; background-color: #16a085;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($rNumBase / $rNumReg) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
        <!-- ./col -->
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $(document).ready(function() {
                $(".progress-bar").each(function(i, e) {
                    if($(e).width() < 39) {
                        $(e).find('.progress-bar-text').html('');
                    }
                });
            });
        }());
    </script>
@endsection