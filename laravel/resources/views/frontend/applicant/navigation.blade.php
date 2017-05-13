<nav class="navbar fixed-top navbar-inverse bg-inverse navbar-applicant">
    <div class="logo">
        <img src="{{ asset('/assets/frontend/images/logo-only-text.png') }}" />
    </div>
    <div class="nav-menu">
        <div class="nav-linker active">รายละเอียด</div>
        <div class="nav-linker">ส่งหลักฐาน</div>
        <div class="nav-linker">ดาวน์โหลดเอกสาร</div>
        <div class="nav-linker">เตรียมพร้อมพจญภัย</div>
        <div class="nav-linker">สละสิทธิ์</div>
    </div>
    <div class="nav-control">
        <a href="{{ route('frontend.applicant.auth.logout') }}" class="btn btn-danger" style="padding: 0.35rem 0.5rem;"><i class="fa fa-sign-out"></i> ออกจากระบบ</a>
    </div>
</nav>