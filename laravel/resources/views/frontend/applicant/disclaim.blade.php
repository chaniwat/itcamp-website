<h3><b>การสละสิทธิ์</b></h3>

หากน้องไม่สามารถเข้าร่วมค่าย ITCAMP ครั้งที่ 13 และต้องการสละสิทธิ์ ให้น้องคลิกที่ปุ่มสละสิทธิ์ด้านล่างนี้ ขอให้น้องคิดให้ดีก่อนการสละสิทธิ์ เพราะหากน้องสละสิทธิ์แล้วทางพี่ๆ ทีมงานจะเรียกเพื่อนลำดับสำรองขึ้นมาแทนน้อง และน้องจะไม่มีสิทธิ์เข้าร่วมค่าย ITCAMP ครั้งที่ 13 ไม่ว่ากรณีใดๆ ก็ตาม <span class="break"></span>
<button type="button" class="btn btn-danger" style="font-size:18px;" data-toggle="modal" data-target="#disclaimFormModal"><i class="fa fa-sign-out"></i> สละสิทธิ์</button>

<div class="modal fade" id="disclaimFormModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <form action="{{ route('frontend.applicant.disclaim') }}" method="POST" id="disclaimForm" novalidate>
        {{ csrf_field() }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><b class="text-danger">ยืนยันการสละสิทธิ์</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    โปรดใส่รหัสผ่านเพื่อยืนยันการสละสิทธิ์
                    <div class="form-group" style="margin-bottom: 0;">
                        <input type="password" class="form-control form-control-sm" id="d_password" name="d_password" required>
                    </div>
                </div>
                </button>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" onclick="return "><i class="fa fa-sign-out"></i> ยืนยันการสละสิทธิ์</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </form>
</div>