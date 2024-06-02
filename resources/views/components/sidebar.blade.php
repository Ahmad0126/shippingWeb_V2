<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a href="{{ route('base') }}" aria-expanded="false">
                    <i class="icon-home menu-icon"></i><span class="nav-text">Home</span>
                </a>
            </li>
            @can('admin')
            <li>
                <a href="{{ route('user') }}" aria-expanded="false">
                    <i class="icon-user menu-icon"></i><span class="nav-text">User</span>
                </a>
            </li>
            <li class="nav-label">Inventaris</li>
            @endcan
            <li>
                <a href="{{ route('cabang') }}" aria-expanded="false">
                    <i class="icon-share menu-icon"></i><span class="nav-text">Cabang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('layanan') }}" aria-expanded="false">
                    <i class="icon-tag menu-icon"></i><span class="nav-text">Layanan</span>
                </a>
            </li>
            @if(Gate::allows('kasir') || Gate::allows('kurir'))
            <li class="nav-label">Pengiriman</li>
            @endif
            @can('kasir')
            <li>
                <a href="{{ route('pengiriman') }}" aria-expanded="false">
                    <i class="icon-paper-plane menu-icon"></i><span class="nav-text">Pengiriman</span>
                </a>
            </li>
            @endcan
            @can('kurir')
            <li>
                <a href="{{ route('pickup') }}" aria-expanded="false">
                    <i class="icon-basket menu-icon"></i><span class="nav-text">Pickup</span>
                </a>
            </li>
            @endcan

            @can('officer')
            <li class="nav-label">Kantor</li>
            <li>
                <a href="{{ route('sorting') }}" aria-expanded="false">
                    <i class="icon-directions menu-icon"></i><span class="nav-text">Sorting Center</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gateway') }}" aria-expanded="false">
                    <i class="icon-direction menu-icon"></i><span class="nav-text">Gateway</span>
                </a>
            </li>
            <li>
                <a href="{{ route('warehouse') }}" aria-expanded="false">
                    <i class="icon-layers menu-icon"></i><span class="nav-text">Warehouse</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>