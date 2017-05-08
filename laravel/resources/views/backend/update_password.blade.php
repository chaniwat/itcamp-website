@extends('backend.layout.master')

@section('content-header')
    แก้ไขรหัสผ่านบัญชี
@endsection

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">เปลี่ยนรหัสผ่าน</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.self.password") }}" method="post">
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
                <a href="{{ route("view.backend.index") }}" class="btn btn-default">ยกเลิกการแก้ไข</a>
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