<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-3">
            <a href="">Latihan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
        </div>
        <ul class="sidebar-menu">
            @if (Auth::check() && Auth::user()->roles == 'admin')
            <li class="{{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Data Master</li>

            <li class="{{ request()->routeIs('produk.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('produk.index') }}"><i class="fas fa-book"></i> <span>Produk</span></a></li>

            <li class="{{ request()->routeIs('pelayanan.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pelayanan.index') }}"><i class="fas fa-book"></i> <span>Pelayanan</span></a></li>

            <li class="{{ request()->routeIs('customer.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer.index') }}"><i class="fas fa-user"></i> <span>Customer</span></a></li>

            <li class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.index') }}"><i class="far fa-building"></i> <span>Laporan</span></a></li>

            <li class="{{ request()->routeIs('kapster.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kapster.index') }}"><i class="fas fa-users"></i> <span>Kapster</span></a></li>

            <li class="{{ request()->routeIs('barang.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('barang.index') }}"><i class="fas fa-calendar"></i> <span>Barang</span></a></li>

            <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i> <span>User</span></a></li>

   
            @endif

        </ul>
    </aside>
</div>
    