a<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="../../assets/img/team/profile-picture-3.jpg"
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
                        <span class="sidebar-icon"><span class="fas fa-table"></span></span>
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

            {{-- Sidebar Ketua --}}
            @elsecan('isKetua')
            <li class="nav-item ">
                <a href="{{ route('dashboard.ketua') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('jenis-simpanan.index') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                    <span>Jenis Simpanan</span>
                </a>
            </li>
            @endcan




        </ul>
    </div>
</nav>
