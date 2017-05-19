@extends('backend.layout.master')

@section('content-header')
    แก้ไขบัญชีผู้ใช้ <span class="label label-primary">{{ $applicant->user->username }}</span> <small>กลุ่ม Applicant</small>
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ฟอร์มบัญชีผู้ใช้สำหรับ Staff</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.account.applicant.update", ['id' => $applicant->id]) }}" method="post">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">User ID</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="{{ $applicant->user->id }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="{{ $applicant->user->username }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">Applicant ID</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="{{ $applicant->id }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCamp" class="col-sm-2 control-label">ค่าย</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCamp" name="camp" placeholder="Camp" value="@lang("camp.".$applicant->camp->name)" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('view.backend.applicants.detail', ['id' => $applicant->id]) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-wrench" aria-hidden="true"></i> ดูรายละเอียดผู้สมัคร</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCamp" class="col-sm-2 control-label">สถานะผู้สมัคร</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputCamp" name="camp" placeholder="Camp" value="{{ $applicant->state }}" disabled>
                    </div>
                </div>
                @if($applicant->isSelect() || $applicant->isReserve())
                    <div class="form-group">
                        <label for="inputCamp" class="col-sm-2 control-label">สถานะบัญชี</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCamp" name="camp" placeholder="Camp" value="{{ $applicant->user->active ? 'เปิดใช้งาน' : 'ยังไม่เปิดใช้งาน' }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            @if(!$applicant->user->active)
                                <a href="{{ route('backend.account.applicant.active', ['id' => $applicant->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-wrench" aria-hidden="true"></i> เปิดการใช้งานบัญชี</a>
                            @else
                                <a href="{{ route('backend.account.applicant.deactive', ['id' => $applicant->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-wrench" aria-hidden="true"></i> ปิดการใช้งานบัญชี</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{--<div class="box-footer">--}}
                {{--<a href="{{ route("view.backend.account.staff") }}" class="btn btn-default">ยกเลิกการแก้ไข</a>--}}
                {{--<button type="submit" class="btn btn-info pull-right">บันทึกการแก้ไข</button>--}}
            {{--</div>--}}
        </form>
    </div>

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">เปลี่ยนรหัสผ่าน</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.account.applicant.update.password", ['id' => $applicant->id]) }}" method="post">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-block" id="generate-password">Generate</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCPassword" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputCPassword" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route("view.backend.account.staff") }}" class="btn btn-default">ยกเลิกการแก้ไข</a>
                <button type="submit" class="btn btn-info pull-right">เปลี่ยนรหัสผ่าน</button>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
      $("#generate-password").click(function() {
        var randPassword = randomString(12);
        $("#inputPassword").attr('type', 'text');
        $("#inputCPassword").attr('readonly', 'readonly');
        $("#inputPassword").val(randPassword);
        $("#inputCPassword").val(randPassword);
      });
    </script>
@endsection