<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        {{-- Mobile View --}}
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-close ti-menu"></i>
                </span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <ul class="nav" id="side-menu">
            <li style="padding: 70px 0 0;">
                <a href="{{ route('admin') }}" class="waves-effect">
                    <i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('outlet.index') }}" class="waves-effect">
                    <i class="fa fa-suitcase fa-fw" aria-hidden="true"></i>
                    Outlet
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="waves-effect">
                    <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                    Pengguna
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}" class="waves-effect">
                    <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                    Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('report.index') }}" class="waves-effect">
                    <i class="fa fa-file-text fa-fw" aria-hidden="true"></i>
                    Laporan
                </a>
            </li>
        </ul>
        <div class="center p-20">
            <a href="logout.php" class="btn btn-danger btn-block waves-effect waves-light">Logout</a>
        </div>
    </div>
</div>