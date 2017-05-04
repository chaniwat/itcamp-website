@extends('backend.layout.master')

@section('content-header')
    แก้ไขบัญชีผู้ใช้ <span class="label label-primary">{{ $staff->user->username }}</span> <small>กลุ่ม Staff</small>
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ฟอร์มบัญชีผู้ใช้สำหรับ Staff</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.account.staff.update", ['id' => $staff->id]) }}" method="post">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="{{ $staff->user->username }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ $staff->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSection" class="col-sm-2 control-label">ฝ่าย</label>

                    <div class="col-sm-10">
                        <select class="form-control" id="inputSection" name="section_id">
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ $staff->section->id == $section->id ? "selected" : "" }}>@lang('section.'.$section->name)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_head" {{ $staff->is_head ? "checked" : "" }}> เป็นเฮดฝ่าย?
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_admin" {{ $staff->is_admin ? "checked" : "" }}> เป็นผู้ดูแลระบบ?
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route("view.backend.account.staff") }}" class="btn btn-default">ยกเลิกการแก้ไข</a>
                <button type="submit" class="btn btn-info pull-right">บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">เปลี่ยนรหัสผ่าน</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.account.staff.update.password", ['id' => $staff->id]) }}" method="post">
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