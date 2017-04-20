<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <li class="{{ $viewHelper->isActivePath("backend") }}"><a href="{{ route('view.backend.index') }}"><i class="fa fa-book"></i> <span>หน้าแรก</span></a></li>
            <li class="treeview {{ $viewHelper->isActivePath(["backend/stats", "backend/stats/*"]) }}">
                <a href="{{ route('view.backend.index') }}"><i class="fa fa-book"></i> <span>สถิติการเข้าชม</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ $viewHelper->isActivePath(["backend/stats"]) }}"><a href="{{ route('view.backend.stats') }}"><i class="fa fa-book"></i> <span>ภาพรวม</span></a></li>
                    <li class="{{ $viewHelper->isActivePath(["backend/stats/view"]) }}"><a href="{{ route('view.backend.stats.view') }}"><i class="fa fa-book"></i> <span>จำนวนการเข้าชม</span></a></li>
                    <li class="{{ $viewHelper->isActivePath(["backend/stats/error"]) }}"><a href="{{ route('view.backend.stats.error') }}"><i class="fa fa-book"></i> <span>ข้อผิดพลาด</span></a></li>
                </ul>
            </li>
            <li class="treeview {{ $viewHelper->isActivePath(["backend/dashboard/register", "backend/dashboard/overview"]) }}">
                <a href="{{ route('view.backend.index') }}"><i class="fa fa-book"></i> <span>ภาพรวม</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ $viewHelper->isActivePath(["backend/dashboard/register"]) }}"><a href="{{ route('view.backend.dashboard.register') }}"><i class="fa fa-book"></i> <span>ภาพรวมการสมัคร</span></a></li>
                    <li class="{{ $viewHelper->isActivePath(["backend/dashboard/overview"]) }}"><a href="{{ route('view.backend.dashboard.overview') }}"><i class="fa fa-book"></i> <span>ภาพรวมค่าย</span></a></li>
                </ul>
            </li>
            <li class="{{ $viewHelper->isActivePath(["backend/applicant", "backend/applicant/*"]) }}"><a href="{{ route('view.backend.applicants') }}"><i class="fa fa-book"></i> <span>ตรวจใบสมัคร</span></a></li>
            <li class="{{ $viewHelper->isActivePath(["backend/answer", "backend/answer/*"]) }}"><a href="{{ route('view.backend.answers') }}"><i class="fa fa-book"></i> <span>ตรวจคำตอบ</span></a></li>
            @can('view', \App\ApplicantDetailKey::class)
            <li class="{{ $viewHelper->isActivePath(["backend/question/applicant", "backend/question/applicant/*"]) }}"><a href="{{ route('view.backend.question.applicant') }}"><i class="fa fa-book"></i> <span>ดูคำถามผู้สมัคร</span></a></li>
            @endcan
            @can('view', \App\Question::class)
                <li class="{{ $viewHelper->isActivePath(["backend/question/camp", "backend/question/camp/*"]) }}"><a href="{{ route('view.backend.question.camp') }}"><i class="fa fa-book"></i> <span>ดูคำถามค่าย</span></a></li>
            @endcan
            @can('view_applicant_account', \App\User::class)
                <li class="treeview {{ $viewHelper->isActivePath(["backend/account/*"]) }}">
                    <a href="#"><i class="fa fa-book"></i> <span>จัดการบัญชีผู้ใช้</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="{{ $viewHelper->isActivePath(["backend/account/applicant", "backend/account/applicant/*"]) }}"><a href="{{ route('view.backend.account.applicant') }}"><i class="fa fa-book"></i> <span>บัญชีผู้ใช้ Applicant</span></a></li>
                        @can('view_staff_account', \App\User::class)
                            <li class="{{ $viewHelper->isActivePath(["backend/account/staff", "backend/account/staff/*"]) }}"><a href="{{ route('view.backend.account.staff') }}"><i class="fa fa-book"></i> <span>บัญชีผู้ใช้ Staff</span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class="header">SYSTEM</li>
            <li><a href="{{ route('backend.auth.logout') }}"><i class="fa fa-circle-o text-red"></i> <span>ออกจากระบบ</span></a></li>
            <li><a href="{{ route('view.frontend.index') }}"><i class="fa fa-circle-o text-blue"></i> <span>กลับหน้าแรก</span></a></li>
        </ul>
    </section>
</aside>