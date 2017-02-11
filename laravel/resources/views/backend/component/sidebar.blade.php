<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <li class="{{ $viewHelper->isActivePath("backend") }}"><a href="{{ route('view.backend.index') }}"><i class="fa fa-book"></i> <span>หน้าแรก</span></a></li>
            <li class="treeview {{ $viewHelper->isActivePath(["backend/dashboard/register", "backend/dashboard/overview"]) }}">
                <a href="{{ route('view.backend.index') }}"><i class="fa fa-book"></i> <span>ภาพรวม</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ $viewHelper->isActivePath(["backend/dashboard/register"]) }}"><a href="{{ route('view.backend.dashboard.register') }}"><i class="fa fa-book"></i> <span>ภาพรวมการสมัคร</span></a></li>
                    <li class="{{ $viewHelper->isActivePath(["backend/dashboard/overview"]) }}"><a href="{{ route('view.backend.dashboard.overview') }}"><i class="fa fa-book"></i> <span>ภาพรวมค่าย</span></a></li>
                </ul>
            </li>
            <li class="{{ $viewHelper->isActivePath(["backend/applicant", "backend/applicant/*"]) }}"><a href="{{ route('view.backend.applicants') }}"><i class="fa fa-book"></i> <span>ตรวจใบสมัคร</span></a></li>
            <li class="{{ $viewHelper->isActivePath(["backend/answer", "backend/answer/*"]) }}"><a href="{{ route('view.backend.answers') }}"><i class="fa fa-book"></i> <span>ตรวจคำตอบ</span></a></li>
            @if(Gate::allows('manage', \App\Question::class))
                <li class="{{ $viewHelper->isActivePath(["backend/question", "backend/question/*"]) }}"><a href="{{ route('view.backend.question') }}"><i class="fa fa-book"></i> <span>ดูคำถาม</span></a></li>
            @endif
            @if(Gate::allows('manage', \App\User::class))
                <li class="treeview {{ $viewHelper->isActivePath(["backend/account/*"]) }}">
                    <a href="{{ route('view.backend.question') }}"><i class="fa fa-book"></i> <span>จัดการบัญชีผู้ใช้</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="{{ $viewHelper->isActivePath(["backend/account/applicant", "backend/account/applicant/*"]) }}"><a href="{{ route('view.backend.account.applicant') }}"><i class="fa fa-book"></i> <span>บัญชีผู้ใช้ Applicant</span></a></li>
                        <li class="{{ $viewHelper->isActivePath(["backend/account/staff", "backend/account/staff/*"]) }}"><a href="{{ route('view.backend.account.staff') }}"><i class="fa fa-book"></i> <span>บัญชีผู้ใช้ Staff</span></a></li>
                    </ul>
                </li>
            @endif
            <li class="header">SYSTEM</li>
            <li><a href="{{ route('backend.auth.logout') }}"><i class="fa fa-circle-o text-red"></i> <span>ออกจากระบบ</span></a></li>
            <li><a href="{{ route('view.frontend.index') }}"><i class="fa fa-circle-o text-blue"></i> <span>กลับหน้าแรก</span></a></li>
        </ul>
    </section>
</aside>