<h3 style="margin-bottom: 1rem;"><b>การส่งหลักฐาน</b></h3>
<p>หลังจากที่น้องแนบเอกสารมาเรียบร้อยแล้ว ให้น้องรอประมาณ 3 - 5 วัน เพื่อให้พี่ๆ ทีมงานได้ทำการตรวจสอบเอกสารนะครับ ในระหว่างนี้น้องสามารถเข้ามาร่วมพูดคุยกับเพื่อนๆ ที่สมัคร ITCAMP ครั้งที่ 13 และเพื่อนๆ ที่เคยมาค่ายไอทีแคมป์ปีก่อนๆ ได้ในกรุ๊ป <a href="https://www.facebook.com/groups/ITCampSociety/" target="_blank">ITCAMP Society @ ITKMITL</a></p>

<h5 style="margin-bottom: 0.75rem;"><b>หลักฐานยืนยันระดับชั้นที่เรียนในปัจจุบัน</b></h5>
<b>สถานะการส่งหลักฐาน:</b> เสร็จสิ้น<br />
<a href="{{ asset('storage/'.$applicant->getDetailValue('a_confirmcurrentgrade')) }}" class="btn btn-primary" target="_blank" style="color: white;">ดูไฟล์ที่แนบ</a><span class="break"></span>

<h5 style="margin-bottom: 0.75rem;"><b>หลักฐานการโอนเงิน</b></h5>
<b>สถานะการส่งหลักฐาน:</b> @lang('evidence_state.'.$evidence_state)<br />
@if($evidence_state == "NOT_SEND")
    <form action="{{ route('frontend.applicant.upload_evidence') }}" id="evidence_slip_form" method="POST" enctype="multipart/form-data" novalidate>
        {{ csrf_field() }}

        <div class="form-group">
            <input type="file" class="form-control-file" id="evidence_slip" name="evidence_slip" style="font-size: 16px;" required>
            <small class="form-text text-muted">(เฉพาะไฟล์รูปภาพเท่านั้น ขนาดไม่เกิน 2MB | ต้องเห็นรายละเอียดชัดเจน)</small>
        </div>
        <button type="submit" class="btn btn-success">อัพโหลด</button>

        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">ยืนยันการส่งหลักฐาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="text-bold" style="font-size: 1.4rem;">ข้อมูลจะไม่สามารถทำการแก้ไขได้ <br/> ให้น้องๆตรวจสอบข้อมูลก่อนการยืนยันอีกครั้ง</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="formAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">Error</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    กรุณาเลือกไฟล์ก่อนทำการอัพโหลด
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="savingModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                    <h3>กำลังบันทึกข้อมูล</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fileAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">Error</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    เลือกไฟล์ผิดประเภท
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fileSizeAlert" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">Error</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ไฟล์มีขนาดใหญ่เกินไป (ขนาดไม่เกิน 2MB)
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
@else
    <a href="{{ asset('storage/'.$evidence->file) }}" class="btn btn-primary" target="_blank" style="color: white;">ดูไฟล์ที่แนบ</a>
@endif