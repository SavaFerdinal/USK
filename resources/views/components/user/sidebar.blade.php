<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::is('user/dashboard*') ? 'active' : '' }} ">
        <a href={{ route('user.dashboard') }} class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ Request::is('user/form-peminjaman*', 'user/riwayat-peminjaman*') ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-bookmark-fill"></i>
            <span>Peminjaman Buku</span>
        </a>
        <ul class="submenu {{ Request::is('user/form-peminjaman*', 'user/riwayat-peminjaman*') ? 'active' : '' }}">
            <li class="submenu-item {{ Request::is('user/form-peminjaman*') ? 'active' : '' }}">
                <a href="{{ Route('user.form_peminjaman') }}">Formulir Peminjaman Buku</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ Route('user.riwayat_peminjaman') }}">Riwayat Peminjaman Buku</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ Request::is('user/form-pengembalian*', 'user/riwayat-pengembalian*') ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-arrow-counterclockwise"></i>
            <span>Pengembalian Buku</span>
        </a>
        <ul class="submenu {{ Request::is('user/form-pengembalian*', 'user/riwayat-pengembalian*') ? 'active' : '' }}">
            <li class="submenu-item {{ Request::is('user/form-pengembalian*') ? 'active' : '' }}">
                <a href="{{ Route('user.form_pengembalian') }}">Formulir Pengembalian Buku</a>
            </li>
            <li class="submenu-item {{ Request::is('user/riwayat-pengembalian*') ? 'active' : '' }}">
                <a href="{{ Route('user.riwayat_pengembalian') }}">Riwayat Pengembalian Buku</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ Request::is('user/pesan-masuk*', 'user/pesan-terkirim*') ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-envelope-fill"></i>
            <span>Pesan</span>
        </a>
        <ul class="submenu {{ Request::is('user/pesan-masuk*', 'user/pesan-terkirim*') ? 'active' : '' }}">
            <li class="submenu-item {{ Request::is('user/pesan-masuk*') ? 'active' : '' }}">
                <a href={{ route('user.pesan_masuk') }}>Pesan Masuk
                    <span class="badge bg-light-danger badge-pill badge-round float-right mt-50">
                        {{ count($pesan) }}
                    </span>
                </a>
            </li>

            <li class="submenu-item {{ Request::is('user/pesan-terkirim*') ? 'active' : '' }}">
                <a href="{{ Route('user.pesan_terkirim') }}">Pesan terkirim</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ Request::is('user/profile*') ? 'active' : '' }}">
        <a href="{{ Route('user.profile') }}" class='sidebar-link'>
            <i class="bi bi-person-fill"></i>
            <span>Profile Saya </span>
        </a>
    </li>

    <li class="sidebar-item {{ request()->is('logout*') ? 'active' : '' }} ">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="sidebar-link">
            <i class="bi bi-door-open-fill"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
