<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="{{ Storage::url('public/'. auth()->user()->image) }}"
                        class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h6">Hi, {{ auth()->user()->name }}</h2>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="btn btn-secondary text-dark btn-xs"><span
                            class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse" data-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
            </div>
        </div>
        <ul class="nav flex-column">

            {{-- Sidebar Admin --}}
            @can('isAdmin')
            <li class="nav-item ">
                <a href="{{ route('dashboard.admin') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-app">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                        Anggota
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (Request::route()->getName() == 'anggota.index') ||
                                        (Request::route()->getName() == 'anggota.create') || 
                                        (Request::route()->getName() == 'anggota.show')  ? 'show' : '' }}" role="list"
                    id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'anggota.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('anggota.index') }}"><span>Data Anggota</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'anggota.create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('anggota.create') }}"><span>Tambah Anggota</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#pinjaman-app">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-table"></span></span>
                        Pinjaman
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (Request::route()->getName() == 'pinjaman.index') ||
                                          (Request::route()->getName() == 'pinjaman.create') || 

                                          (Request::route()->getName() == 'pinjaman.show')  ? 'show' : '' }}"
                    role="list" id="pinjaman-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'pinjaman.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pinjaman.index') }}"><span>Data Pinjaman</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'pinjaman.create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pinjaman.create') }}"><span>Tambah Pinjaman</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#simpanan-app">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                        Simpanan
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (Request::route()->getName() == 'simpanan.index') ||
                                                    (Request::route()->getName() == 'simpanan.create') || 

                                                    (Request::route()->getName() == 'simpanan.show')  ? 'show' : '' }}"
                    role="list" id="simpanan-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'simpanan.create') ? 'active' : '' }}"><a
                                class="nav-link" href="{{ route('simpanan.create') }}"><span>Tambah simpanan</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'simpanan.index') ? 'active' : '' }}"><a
                                class="nav-link" href="/admin/simpanan"><span>Data simpanan</span></a></li>
                        <li class="nav-item {{ (Request::route()->getName() == 'simpanan.anggota') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('simpanan.anggota') }}"><span>Data simpanan per
                                    anggota</span></a></li>
                        <li
                            class="nav-item {{ (Request::route()->getName() == 'simpanan.penarikan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('simpanan.penarikan') }}"><span>Penarikan
                                    simpanan</span></a></li>
                    </ul>
                </div>
            </li>

            {{-- Sidebar Ketua --}}
            @elsecan('isKetua')
            <li class="nav-item {{ (request()->is('ketua') ? 'active' : '') }}">
                <a href="{{ route('dashboard.ketua') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('ketua/user*') ? 'active' : '') }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-app">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                        User
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (Request::route()->getName() == 'user.index') ||
                                        (Request::route()->getName() == 'user.create') || 
                                        (Request::route()->getName() == 'user.show')  ? 'show' : '' }}" role="list"
                    id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'user.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}"><span>Data User</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'user.create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('user.create') }}"><span>Tambah User</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ request()->is('ketua/jenis-simpanan*') ? 'active' : '' }}">
                <a href="{{ route('jenis-simpanan.index') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-book"></span></span>
                    <span>Jenis Simpanan</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('ketua/pinjaman-ketua*') ? 'active' : '' }}">
                <a href="{{ route('pinjaman-ketua.index') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                    <span>Data Pinjaman</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('ketua/pengaturan*') ? 'active' : '' }}">
                <a href="{{ route('pengaturan.index') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-anchor"></span></span>
                    <span>Pengaturan</span>
                </a>
            </li>
            {{--             
            <li class="nav-item {{ (Request::route()->getName() == 'simpanan.index') ? 'active' : '' }}">
            <a href="{{ route('simpanan.index') }}" class="nav-link">
                <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                <span>Data Simpanan</span>
            </a> --}}
            {{-- </li> --}}
            @endcan




        </ul>
    </div>
</nav>
