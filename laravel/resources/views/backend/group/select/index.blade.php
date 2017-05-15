@extends('backend.layout.master')

@section('content-header')
    จัดการผู้สมัคร
@endsection

@section('style')
<style>
    td {
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
            <div class="row">
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
                    <button class="btn btn-primary btn-applicant-pending" data-target="SELECT"><i class="fa fa-bars" aria-hidden="true"></i> แสดงผู้สมัครที่ผ่านการคัดตัวจริง</button>
                    <button class="btn btn-primary btn-applicant-checked" data-target="RESERVE"><i class="fa fa-bars" aria-hidden="true"></i> แสดงผู้สมัครที่ผ่านการคัดตัวสำรอง</button>
                    <button class="btn btn-primary btn-applicant-reject" data-target="REJECT"><i class="fa fa-bars" aria-hidden="true"></i> แสดงผู้สมัครที่ไม่ผ่านการคัด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">จำนวนปัจจุบัน</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Camp</th>
                    <th>Application</th>
                    <th>Game</th>
                    <th>Network</th>
                    <th>IoT</th>
                    <th>Datasci</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>SELECT</td>
                    @foreach($camps as $camp)
                        <td class="{{ $camp->name }}-select">{{ $count[$camp->name][0] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>RESERVE</td>
                    @foreach($camps as $camp)
                        <td class="{{ $camp->name }}-reserve">{{ $count[$camp->name][1] }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>REJECT</td>
                    @foreach($camps as $camp)
                        <td class="{{ $camp->name }}-reject">{{ $count[$camp->name][2] }}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
            <span class="text-info"><b>*แถบสีฟ้า</b></span> ไม่ได้ตอบคำถามรองประธาน <br />
            <span class="text-warning"><b>*แถบสีเหลือง</b></span> เด็กแคมป์เก่า <br />
            <span class="text-danger"><b>*แถบสีแดง</b></span> เด็กแคมป์เก่าและไม่ได้ตอบคำถาม <br />
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered table-hover applicant-table">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>ค่าย</th>
                        <th>สถานะการคัดเลือก</th>
                        <th>ประธาน</th>
                        <th>รองประธาน</th>
                        <th>สันทนาการ</th>
                        <th>ค่ายย่อย</th>
                        <th>รวม</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants as $applicant)
                        <?php
                            $class = '';
                            if(isset($applicant->old_applicant_id) && $applicant->subhead_no_q) {
                                $class = 'danger';
                            } else if(isset($applicant->old_applicant_id)) {
                                $class = 'warning';
                            } else if($applicant->subhead_no_q) {
                                $class = 'info';
                            }

                            $states = ["SELECT", "RESERVE", "REJECT"];
                        ?>
                        <tr class="{{ $class }}">
                            <td>{{ $applicant->applicant->id }}</td>
                            <td><a href="{{ route('view.backend.applicants.detail', ['id' => $applicant->applicant->id]) }}" target="_blank">{{ $applicant->applicant->getDetailValue("p_name").$applicant->applicant->getDetailValue("f_name")." ".$applicant->applicant->getDetailValue("l_name") }}</a></td>
                            <td>@lang("camp.".$applicant->applicant->camp->name)</td>
                            <td>
                                <select class="form-control update-app-state" data-applicantid="{{ $applicant->applicant->id }}" data-camp="{{ $applicant->applicant->camp->name }}" data-state="{{ $applicant->state }}">
                                    @foreach($states as $state)
                                        <option value="{{ $state }}" {{ $applicant->state == $state ? 'selected' : '' }}>{{ $state }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{{ number_format($applicant->head_score, 2) }}</td>
                            <td>{{ number_format($applicant->subhead_score, 2) }}</td>
                            <td>{{ number_format($applicant->recreation_score, 2) }}</td>
                            <td>{{ number_format($applicant->camp_score, 2) }}</td>
                            <td>{{ number_format($applicant->head_score + $applicant->subhead_score + $applicant->recreation_score + $applicant->camp_score, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $('select.update-app-state').change(function (e) {
            var el = $(e.target);

            $.post('{{ url('backend/select') }}/' + el.data('applicantid') + '/state', { state: el.val() })
            .done(function() {
                var o = $("." + el.data('camp') + "-" + el.data('state').toLowerCase());
                o.html(Number(o.html()) - 1);
                var u = $("." + el.data('camp') + "-" + el.val().toLowerCase());
                u.html(Number(u.html()) + 1);

                el.data('state', el.val());
                console.log('Applicant id:' + el.data('applicantid') + ", " + el.val());
            })
            .fail(function() {
                el.val(el.data('state'));
                console.error('Error, Applicant id: ' + el.data('applicantid'));
            })
        });

        var dTable = $("table.applicant-table").DataTable({
            "paging": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $(function() {
            var camp = {
                "camp_app": "@lang("camp.camp_app")",
                "camp_game": "@lang("camp.camp_game")",
                "camp_network": "@lang("camp.camp_network")",
                "camp_iot": "@lang("camp.camp_iot")",
                "camp_datasci": "@lang("camp.camp_datasci")",
            };

            var check = {
                "SELECT": '(SELECT)',
                "RESERVE": '(RESERVE)',
                "REJECT": '(REJECT)',
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
                    dTable.column(3).search(check[e.data('target')], true).draw();
                });
            });
        });
    </script>
@endsection