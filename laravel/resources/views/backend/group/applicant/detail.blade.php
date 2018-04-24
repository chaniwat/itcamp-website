@extends('backend.layout.master')

@section('content-header')
    รายละเอียดผู้สมัคร ID: {{ $applicant->id }}
@endsection

@section('style')
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')

    <div class="box box-solid box-info">
        <div class="box-header with-border">
            <h3 class="box-title">กล่องควบคุม</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 1rem;">
                    <form action="{{ route('backend.applicants.go_to_id') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group" style="width: 250px; margin-bottom: 0.8rem;">
                            <input type="text" class="form-control" placeholder="Applicant ID" name="id">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Go to ID</button>
                            </span>
                        </div>
                    </form>
                    @if(isset($previousId))
                        <a href="{{ route('view.backend.applicants.detail', ['id' => $previousId]) }}" class="btn btn-primary"><< Previous Applicant</a>
                    @else
                        <a href="javascript:;" class="btn btn-primary disabled"><< Previous Applicant</a>
                    @endif
                    @if(isset($nextId))
                        <a href="{{ route('view.backend.applicants.detail', ['id' => $nextId]) }}" class="btn btn-primary">Next Applicant >></a>
                    @else
                        <a href="javascript:;" class="btn btn-primary disabled">Next Applicant >></a>
                    @endif
                </div>
                <div class="col-xs-12">
                    <hr style="margin: 1rem 0; border-width: 3px;" />
                </div>
                <div class="col-xs-12">
                    <h2 style="margin-top: 0;">Status: @lang('applicant_state.'.$applicant->state)</h2>
                </div>
                @if($applicant->isSelect() || $applicant->isReserve())
                    <div class="col-xs-12">
                        <hr style="margin: 1rem 0; border-width: 3px;" />
                    </div>
                    <div class="col-xs-12">
                        <h2 style="margin-top: 0;">สถานะการส่งหลักฐาน:</b> @lang('evidence_state.'.$evidence_state)</h2>
                    </div>
                    @if($evidence_state != 'NOT_SEND')
                        <div class="col-xs-12" style="margin-bottom: 0.8rem;">
                            <a href="{{ asset('storage/'.$evidence->file) }}" class="btn btn-primary" target="_blank" style="color: white;">ดูไฟล์ที่แนบ</a>
                        </div>
                    @endif
                @endif
                <div class="col-xs-12">
                    @can('update_state', \App\Applicant::class)
                        @if(!$applicant->isChecked())
                            <button class="btn btn-success" data-toggle="modal" data-target="#approveAlert">Approve</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#rejectAlert">Reject</button>
                        @elseif($applicant->isSelect() || $applicant->isReserve())
                            @if($evidence_state == 'PENDING')
                                <button class="btn btn-success" data-toggle="modal" data-target="#approveEvidenceAlert">Approve</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#rejectEvidenceAlert">Reject</button>
                            @endif
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="approveAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    ยืนยันการ Approve ใบสมัครนี้<br>
                    เมื่อยืนยันแล้วจะไม่สามารถแก้ไขได้ โปรดตรวจสอบอีกครั้ง<br>
                    ซึ่งเมื่อใบสมัครนี้ผ่านการยืนยันแล้วจะเข้าสู่ขั้นตอนการตรวจคำถาม
                </div>
                <div class="modal-footer">
                    <form action="{{ route('backend.applicants.update.state', ["id" => $applicant->id]) }}" method="post">
                        {{ csrf_field() }}

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success" name="state" value="CHECKED">ยืนยัน (Approve)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    ยืนยันการ Reject ใบสมัครนี้<br>
                    เมื่อยืนยันแล้วจะไม่สามารถแก้ไขได้ โปรดตรวจสอบอีกครั้ง
                </div>
                <div class="modal-footer">
                    <form action="{{ route('backend.applicants.update.state', ["id" => $applicant->id]) }}" method="post">
                        {{ csrf_field() }}

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger" name="state" value="REJECT">ยืนยัน (Reject)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="approveEvidenceAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    ยืนยันการ Approve หลักฐาน
                </div>
                <div class="modal-footer">
                    <form action="{{ route('backend.applicants.evidence.update.state', ["id" => $applicant->id]) }}" method="post">
                        {{ csrf_field() }}

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success" name="state" value="COMPLETE">ยืนยัน (Approve)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectEvidenceAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    ยืนยันการ Reject หลักฐาน
                </div>
                <div class="modal-footer">
                    <form action="{{ route('backend.applicants.evidence.update.state', ["id" => $applicant->id]) }}" method="post">
                        {{ csrf_field() }}

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger" name="state" value="REJECT">ยืนยัน (Reject)</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <form>
            <div class="box-body">
                <div class="row">
                    @foreach($applicantQuestions as $question)
                        {!! $viewHelper->formBuilder()->buildBackendInputField($question, $applicant, \App\ApplicantDetailKey::class) !!}
                    @endforeach
                </div>
            </div>
        </form>
    </div>

@endsection