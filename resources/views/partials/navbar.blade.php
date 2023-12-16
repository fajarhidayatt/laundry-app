<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <a class="logo" href="index.php">
                <b style="color:black">
                    LAUNDRY
                </b>
                <span class="hidden-xs text-dark">
                    APP
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
            <li>
                <a class="profile-pic" href="#" style="pointer-events: none;">
                    <img src="{{ asset('assets/plugins/images/users/varun.jpg') }}" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs">{{ Auth::user()->name . " | " . ucfirst(Auth::user()->role) }}</b>
                </a>
            </li>
        </ul>
    </div>
</nav>