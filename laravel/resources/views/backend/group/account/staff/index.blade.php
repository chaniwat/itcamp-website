@extends('backend.layout.master')

@section('content-header')
    บัญชีผู้ใช้ <small>กลุ่ม Staff</small>
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
            <a href="{{ route('view.backend.account.staff.create') }}" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มบัญชีผู้ใช้ใหม่สำหรับ Staff</a>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>ฝ่าย</th>
                        <th>ตำแหน่ง</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $staff)
                        <tr>
                            <td>{{ $staff->user->id }}</td>
                            <td>{{ $staff->user->username }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>@lang('section.'.$staff->section->name)</td>
                            <td>{{ $staff->is_head ? 'Head' : 'Staff' }}</td>
                            <td>@if($staff->user->id != 1)<a href="{{ route('view.backend.account.staff.update', ['id' => $staff->user->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-wrench" aria-hidden="true"></i> แก้ไข</a>@endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection