@extends('backend.layout.master')

@section('content-header')
    Dashboard <small>ภาพรวมการสมัคร</small>
@endsection

@section('content')

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
                            <div class="small-box bg-section-camp_app">
                                <div class="inner">
                                    <h3>{{ $count['app']['total'] }} / 30</h3>

                                    <p>@lang('camp.camp_app')</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-social-codepen"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($count['app']['total'] / 30) * 100) > 100 ? 100 : ($count['app']['total'] / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($count['app']['total'] / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-section-camp_game">
                                <div class="inner">
                                    <h3>{{ $count['game']['total'] }} / 30</h3>

                                    <p>@lang('camp.camp_game')</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-football"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($count['game']['total'] / 30) * 100) > 100 ? 100 : ($count['game']['total'] / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($count['game']['total'] / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-section-camp_network">
                                <div class="inner">
                                    <h3>{{ $count['network']['total'] }} / 30</h3>

                                    <p>@lang('camp.camp_network')</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-wifi"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($count['network']['total'] / 30) * 100) > 100 ? 100 : ($count['network']['total'] / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($count['network']['total'] / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-section-camp_iot">
                                <div class="inner">
                                    <h3>{{ $count['iot']['total'] }} / 30</h3>

                                    <p>@lang('camp.camp_iot')</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-outlet"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($count['iot']['total'] / 30) * 100) > 100 ? 100 : ($count['iot']['total'] / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($count['iot']['total'] / 30) * 100) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-15-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-section-camp_datasci">
                                <div class="inner">
                                    <h3>{{ $count['datasci']['total'] }} / 30</h3>

                                    <p>@lang('camp.camp_datasci')</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cube"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", (($count['datasci']['total'] / 30) * 100) > 100 ? 100 : ($count['datasci']['total'] / 30) * 100) }}%;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", ($count['datasci']['total'] / 30) * 100) }}%</span>
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
                                    <h3>{{ $count['checked'] }} / {{ $count['total'] }}</h3>

                                    <p>จำนวนที่ตรวจใบสมัครแล้ว / จำนวนผู้สมัครทั้งหมด</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                    <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                        <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", $count['total'] != 0 ? ($count['checked'] / $count['total']) * 100 : 0) }}%; background-color: #2c3e50;">
                                            <span class="progress-bar-text">{{ sprintf("%.2f", $count['total'] != 0 ? ($count['checked'] / $count['total']) * 100 : 0) }}%</span>
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
                                    <h3>{{ $count['approve'] }}</h3>

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

        @if($staff->section->has_question)
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
                                <div class="small-box bg-section-{{ $staff->section->name }}" style="margin-bottom: 0;">
                                    <div class="inner">
                                        <h3>{{ $finish_amount }} / {{ $section_total_amount }}</h3>

                                        <p>จำนวนที่ตรวจคำตอบแล้ว / จำนวนผู้สมัครที่ใบสมัครผ่าน</p>
                                        <h4><span class="label bg-black">@lang('section.'.$staff->section->name)</span></h4>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-chatboxes"></i>
                                    </div>
                                    <div class="small-box-footer" style="padding: 0; border-top: 5px solid whitesmoke;">
                                        <div class="progress progress-ms bg-gray active" style="margin-bottom: 0;">
                                            <div class="progress-bar progress-bar-striped progress-bar-fCamp" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ sprintf("%.2f", $count['approve'] != 0 ? ($finish_amount / $count['approve']) * 100 : 0) }}%;">
                                                <span class="progress-bar-text">{{ sprintf("%.2f", $section_total_amount != 0 ? ($finish_amount / $section_total_amount) * 100 : 0) }}%</span>
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
        @endif

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
                                        <td>{{ $count['app']['boy'] }}</td>
                                        <td>{{ $count['app']['girl'] }}</td>
                                        <td>{{ $count['app']['total'] }}</td>
                                        <td>{{ $count['app']['approve'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gamesoft</td>
                                        <td>{{ $count['game']['boy'] }}</td>
                                        <td>{{ $count['game']['girl'] }}</td>
                                        <td>{{ $count['game']['total'] }}</td>
                                        <td>{{ $count['game']['approve'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Network Defender</td>
                                        <td>{{ $count['network']['boy'] }}</td>
                                        <td>{{ $count['network']['girl'] }}</td>
                                        <td>{{ $count['network']['total'] }}</td>
                                        <td>{{ $count['network']['approve'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>IoTech</td>
                                        <td>{{ $count['iot']['boy'] }}</td>
                                        <td>{{ $count['iot']['girl'] }}</td>
                                        <td>{{ $count['iot']['total'] }}</td>
                                        <td>{{ $count['iot']['approve'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Data Cyber</td>
                                        <td>{{ $count['datasci']['boy'] }}</td>
                                        <td>{{ $count['datasci']['girl'] }}</td>
                                        <td>{{ $count['datasci']['total'] }}</td>
                                        <td>{{ $count['datasci']['approve'] }}</td>
                                    </tr>
                                    <tr>
                                        <td align="right">รวม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{ $count['boy'] }}</td>
                                        <td>{{ $count['girl'] }}</td>
                                        <td>{{ $count['total'] }}</td>
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