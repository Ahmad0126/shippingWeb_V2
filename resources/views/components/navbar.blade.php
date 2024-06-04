<div class="nav-header">
    <div class="brand-logo">
        <a href="index.html">
            <b class="logo-abbr"><img src="{{ asset('images/logo.png') }}" alt=""> </b>
            <span class="logo-compact"><img src="{{ asset('images/logo-compact.png') }}" alt=""></span>
            <span class="brand-title">
                <img src="{{ asset('images/logo-text.png') }}" alt="">
            </span>
        </a>
    </div>
</div>
<div class="header">    
    <div class="header-content clearfix">
        
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-left">
            <div class="input-group icons">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                </div>
                <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                <div class="drop-down animated flipInX d-md-none">
                    <form action="#">
                        <input type="text" class="form-control" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown c-pointer d-none d-md-flex" data-toggle="dropdown">
                    <p>{{ Auth::user()->nama }}</p>
                </li>
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="{{ asset('images/user/1.png') }}" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="{{ route('login_kantor') }}"><i class="icon-user"></i> <span>Masuk Kantor</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('password') }}"><i class="icon-settings"></i> <span>Ganti Password</span></a>
                                </li>
                                <hr class="my-2">
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="border-0 p-0 bg-transparent c-pointer">
                                            <i class="icon-key mr-1"></i> <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>