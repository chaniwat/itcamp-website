@extends('backend.layout.master')

@section('content-header', 'เพิ่มคำถามใหม่')

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">ฟอร์มเพิ่มคำถามค่าย</h3>
        </div>
        <form class="form-horizontal" action="{{ route("backend.question.camp.create") }}" method="post">
            {{ csrf_field() }}

            <div class="box-body">
                <div class="form-group">
                    <label for="inputQuestion" class="col-sm-2 control-label">คำถาม</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputQuestion" name="question" placeholder="Question" value="{{ old('question') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">คำอธิบายเพิ่มเติม</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" id="inputDescription" name="description" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSection" class="col-sm-2 control-label">ของฝ่าย</label>

                    <div class="col-sm-10">
                        <select class="form-control" id="inputSection" name="section">
                            @foreach($data['sections'] as $section)
                                @if($section->has_question)
                                    <option value="{{ $section->id }}" {{ old('section') == $section->id ? "selected" : "" }}>@lang('section.'.$section->name)</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFieldId" class="col-sm-2 control-label">Field ID</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputFieldId" name="field_id" placeholder="Field ID" value="{{ old('field_id') }}">
                        <p class="help-block" style="margin-bottom: 0;">
                            ถ้าจะเว้นวรรคให้ใช้ "_" (underscore) แทน<br />
                            <span class="text-red">**Field ID แก้ไขไม่ได้ (โปรดตรวจสอบก่อนทำการบันทึก) | เป็นไปได้ถามฝ่ายเว็บก่อนว่าตั้งยังไง</span>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPriority" class="col-sm-2 control-label">Priority</label>

                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputPriority" name="priority" placeholder="Priority" value="{{ old('priority') ? old('priority') : "0" }}">
                        <p class="help-block" style="margin-bottom: 0;">
                            ลำดับความสำคัญในการขึ้นก่อน - หลัง (เลขยิ่งมาก ยิ่งมีความสำคัญสูง - ขึ้นก่อน)
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFieldType" class="col-sm-2 control-label">Field Type</label>

                    <div class="col-sm-10">
                        <select class="form-control" id="inputFieldType" name="field_type">
                            @foreach($data['field_types'] as $fieldType)
                                <option value="{{ $fieldType }}" {{ old('field_type') == $fieldType ? "selected" : "" }}>{{ $fieldType }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFieldSetting" class="col-sm-2 control-label">Field Setting</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="inputFieldSetting" name="field_setting" placeholder="Field_setting" style="font-family: Menlo,Monaco,Consolas,'Courier New',monospace" data-default="{{ old('field_setting') ? "'".old('field_setting')."'" : "" }}"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <pre id="FieldTypeDescribe"></pre>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route("view.backend.question.camp") }}" class="btn btn-default">ยกเลิกการสร้าง</a>
                <button type="submit" class="btn btn-info pull-right">สร้างคำถามใหม่</button>
            </div>
        </form>
    </div>

@endsection

@section('script')
<script src="{{ asset('assets/backend/js/field_type_describe.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        initFieldTypeSettingDescribe($('#inputFieldType'), $('#inputFieldSetting'), $('#FieldTypeDescribe'));
    });
</script>
@endsection
