@extends('backend.layout.master')

@section('content-header')
    จัดการผู้สมัคร
@endsection

@section('style')
<style>
    td {
        vertical-align: middle !important;
    }
</style>
@endsection

@section('content')

    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">กล่องควบคุม</h3>
        </div>
        <div class="box-body">
            <a href="javascript:;" class="btn btn-primary btn-campapp"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_app')</a>
            <a href="javascript:;" class="btn btn-primary btn-campgame"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_game')</a>
            <a href="javascript:;" class="btn btn-primary btn-campnetwork"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_network')</a>
            <a href="javascript:;" class="btn btn-primary btn-campiot"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_iot')</a>
            <a href="javascript:;" class="btn btn-primary btn-campdatasci"><i class="fa fa-bars" aria-hidden="true"></i> แสดงค่าย @lang('camp.camp_datasci')</a>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>ค่าย</th>
                        <th>สถานะการสมัคร</th>
                        <th>วันที่สมัคร</th>
                        <th width="80">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants as $applicant)
                        <?php

                        $p_name = null;
                        $p_name_key = json_decode($applicant->applicantDetails->find('p_name')->pivot->answer, True)['value'];
                        $p_name_setting = json_decode(\App\ApplicantDetailKey::find('p_name')->field_setting, True)['lists'];
                        foreach ($p_name_setting as $item) {
                            if($p_name_key == $item['key']) {
                                $p_name = $item['text'];
                                break;
                            }
                        }

                        $f_name = json_decode($applicant->applicantDetails->find('f_name')->pivot->answer, True)['value'];
                        $l_name = json_decode($applicant->applicantDetails->find('l_name')->pivot->answer, True)['value'];
                        ?>

                        <tr>
                            <td>{{ $applicant->id }}</td>
                            <td>{{ ($p_name != 'อื่นๆ' ? $p_name : '').$f_name." ".$l_name }}</td>
                            <td>@lang("camp.".$applicant->camp->name)</td>
                            <td>{{ $applicant->state }}</td>
                            <td>{{ $applicant->created_at }}</td>
                            <td><a href="{{ route('view.backend.applicants.detail', ['id' => $applicant->id]) }}" class="btn btn-info btn-flat btn-sm"><i class="fa fa-wrench" aria-hidden="true"></i> แก้ไข</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $("table.table").DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
    </script>
@endsection