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
        {{-- End Mobiel View --}}
        <ul class="nav" id="side-menu">
            <li style="padding: 70px 0 0;">
                <a href="/admin" class="waves-effect">
                    <i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/outlet" class="waves-effect">
                    <i class="fa fa-suitcase fa-fw" aria-hidden="true"></i>
                    <span>Outlet</span>
                </a>
            </li>
            <li>
                <a href="/admin/user" class="waves-effect">
                    <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                    <span>Pengguna</span>
                </a>
            </li>
            <li>
                <a href="/admin/member" class="waves-effect">
                    <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="/admin/report" class="waves-effect">
                    <i class="fa fa-file-text fa-fw" aria-hidden="true"></i>
                    <span>Laporan</span>
                </a>
            </li>
        </ul>
        <div class="center p-20">
            <form action="/logout" method="post">
                @csrf
                <button class="btn btn-danger btn-block waves-effect waves-light">Logout</button>
            </form>
        </div>
    </div>
</div>