@extends('backend.layout.master')

@section('content-header')
    ตรวจคำตอบ
@endsection

@section('style')
    <style>
        th, td {
            text-align: center;
            vertical-align: middle !important;
        }

        .dataTables_filter {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">กล่องควบคุม</h3>
        </div>
        <div class="box-body">
            @if($mode == "CHECKER")
                <div class="row">
                    <div class="col-xs-12" style="margin-bottom: 0.8rem;">
                        <h1 style="margin: 0 0 10px;">โหมดผู้ตรวจคำตอบ</h1>
                    </div>
                    <div class="col-xs-12" style="margin-bottom: 0.8rem;">
                        <a href="{{ route('view.backend.answers.check') }}" class="btn btn-info"><i class="fa fa-bars" aria-hidden="true"></i> เริ่มตรวจคำตอบ</a>

                        @can('view_overall_answer', \App\Answer::class)
                            <a href="{{ route('view.backend.answers.overall') }}" class="btn btn-info"><i class="fa fa-bars" aria-hidden="true"></i> ดูภาพรวม</a>
                        @endcan
                    </div>
                </div>
            @elseif($mode == "INSPECTOR")
                <div class="row">
                    <div class="col-xs-12" style="margin-bottom: 0.8rem;">
                        <h1 style="margin: 0 0 10px;">โหมดผู้ตรวจสอบภาพรวม</h1>
                    </div>
                    <div class="col-xs-12" style="margin-bottom: 0.8rem;">
                        <button class="btn btn-info" id="btn-clear-search" data-target="all"><i class="fa fa-bars" aria-hidden="true"></i> แสดงผู้สมัครทั้งหมด</button>
                    </div>
                    <div class="col-xs-12" id="camp-control" style="margin-bottom: 0.8rem;">
                        <button class="btn btn-primary btn-campapp" data-target="camp_app"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_app')</button>
                        <button class="btn btn-primary btn-campgame" data-target="camp_game"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_game')</button>
                        <button class="btn btn-primary btn-campnetwork" data-target="camp_network"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_network')</button>
                        <button class="btn btn-primary btn-campiot" data-target="camp_iot"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_iot')</button>
                        <button class="btn btn-primary btn-campdatasci" data-target="camp_datasci"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_datasci')</button>
                    </div>
                    <div class="col-xs-12" id="status-control">
                        <button class="btn btn-primary btn-applicant-pending" data-target="INCOMPLETE"><i class="fa fa-bars" aria-hidden="true"></i> แสดงผู้สมัครที่ยังตรวจไม่ครบ</button>
                        <button class="btn btn-primary btn-applicant-checked" data-target="COMPLETE"><i class="fa fa-bars" aria-hidden="true"></i> แสดงผู้สมัครที่ตรวจครบแล้ว</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                @if($mode == "CHECKER")
                    <tr>
                        <th width="60">ID</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>ค่าย</th>
                        <th style="padding: 8px;">สถานะการตรวจ</th>
                    </tr>
                    @elseif($mode == "INSPECTOR")
                    <tr>
                        <th rowspan="2" width="60">ID</th>
                        <th rowspan="2">ชื่อ - นามสกุล</th>
                        <th rowspan="2">ค่าย</th>
                        <th colspan="4">สถานะการตรวจ</th>
                    </tr>
                    <tr>
                        <th style="padding: 8px;">สถานะ</th>
                        <th style="padding: 8px;">ประธาน</th>
                        <th style="padding: 8px;">รองประธาน</th>
                        <th style="padding: 8px;">สันทนาการ</th>
                        <th style="padding: 8px;">ค่ายย่อย</th>
                    </tr>
                @endif
                </thead>
                <tbody>
                @foreach($applicants as $applicant)
                    <tr>
                        <td>{{ $applicant->id }}</td>
                        <td>{{ $applicant->getDetailValue("p_name").$applicant->getDetailValue("f_name")." ".$applicant->getDetailValue("l_name") }}</td>
                        <td>@lang("camp.".$applicant->camp->name)</td>
                        @if($mode == "CHECKER")
                            <td>
                                @for ($i = 0; $i < $applicant->getAnswerCheckerAmount($section); $i++)
                                    <span class="answer-check {{ $section->name }} checked"></span>
                                @endfor
                                @for ($i = 0; $i < $checker_amount - $applicant->getAnswerCheckerAmount($section); $i++)
                                    <span class="answer-check {{ $section->name }}"></span>
                                @endfor
                            </td>
                        @elseif($mode == "INSPECTOR")
                            <?php
                                $head_checked_amount = $applicant->getAnswerCheckerAmount($section['head']);
                                $sub_head_checked_amount = $applicant->getAnswerCheckerAmount($section['sub_head']);
                                $recreation_checked_amount = $applicant->getAnswerCheckerAmount($section['recreation']);
                                $camp_checked_amount = $applicant->getAnswerCheckerAmount($applicant->camp->section);
                            ?>

                            <td>@if($applicant->isComplete()) ตรวจครบ @else ตรวจยังไม่ครบ @endif</td>

                            <td>
                                @for ($i = 0; $i < $head_checked_amount; $i++)
                                    <span class="answer-check head checked"></span>
                                @endfor

                                @for ($i = 0; $i < $checkers['head'] - $head_checked_amount; $i++)
                                    <span class="answer-check head"></span>
                                @endfor
                            </td>

                            <td>
                                @for ($i = 0; $i < $head_checked_amount; $i++)
                                    <span class="answer-check sub_head checked"></span>
                                @endfor

                                @for ($i = 0; $i < $checkers['sub_head'] - $head_checked_amount; $i++)
                                    <span class="answer-check sub_head"></span>
                                @endfor
                            </td>

                            <td>
                                @for ($i = 0; $i < $recreation_checked_amount; $i++)
                                    <span class="answer-check recreation checked"></span>
                                @endfor

                                @for ($i = 0; $i < $checkers['recreation'] - $recreation_checked_amount; $i++)
                                    <span class="answer-check recreation"></span>
                                @endfor
                            </td>

                            <td>
                                @for ($i = 0; $i < $camp_checked_amount; $i++)
                                    <span class="answer-check {{ $applicant->camp->section->name }} checked"></span>
                                @endfor

                                @for ($i = 0; $i < $checkers[$applicant->camp->section->name] - $camp_checked_amount; $i++)
                                    <span class="answer-check {{ $applicant->camp->section->name }}"></span>
                                @endfor
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        var dTable = $("table.table").DataTable({
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columns": [
                null,
                null,
                null,
                @if($mode == "INSPECTOR")
                    { "orderable": false },
                    { "orderable": false },
                    { "orderable": false },
                    { "orderable": false },
                    { "orderable": false },
                @elseif($mode == "CHECKER")
                    { "orderable": false },
                @endif
            ]
        });

        $(function() {
            @if($mode == "INSPECTOR")
                var camp = {
                    "camp_app": "@lang("camp.camp_app")",
                    "camp_game": "@lang("camp.camp_game")",
                    "camp_network": "@lang("camp.camp_network")",
                    "camp_iot": "@lang("camp.camp_iot")",
                    "camp_datasci": "@lang("camp.camp_datasci")",
                };

                var check = {
                    "INCOMPLETE": 'ตรวจยังไม่ครบ',
                    "COMPLETE": 'ตรวจครบ',
                }

                var clearSearch = function() {
                    dTable.column(2).search('').draw();
                    dTable.column(3).search('').draw();
                };

                $("#btn-clear-search").click(function() {
                    clearSearch();
                });

                $("#camp-control button.btn").each(function(i, e) {
                    e = $(e);
                    e.click(function() {
                        clearSearch();
                        dTable.column(2).search(camp[e.data('target')]).draw();
                    });
                });

                $("#status-control button.btn").each(function(i, e) {
                    e = $(e);
                    e.click(function() {
                        clearSearch();
                        dTable.column(3).search(check[e.data('target')]).draw();
                    });
                });
            @endif
        });
    </script>
@endsection