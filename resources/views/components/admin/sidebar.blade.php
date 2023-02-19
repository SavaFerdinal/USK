<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Request::is('admin/form-dashboard*') ? 'active' : '' }} ">
        <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ Request::is('admin/anggota*', 'admin/penerbit*', 'admin/administrator*', 'admin/data-peminjaman*') ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-incognito"></i>
            <span>Master Data</span>
        </a>
        <ul class="submenu {{ Request::is('admin/anggota*', 'admin/penerbit*', 'admin/administrator*', 'admin/data-peminjaman*') ? 'active' : '' }}">
            <li class="submenu-item {{ Request::is('admin/anggota*') ? 'active' : '' }}">
                <a href="{{ Route('admin.anggota') }}">Data Anggota</a>
            </li>
            <li class="submenu-item {{ Request::is('admin/penerbit*') ? 'active' : '' }}">
                <a href="{{ Route('admin.penerbit') }}">Data Penerbit</a>
            </li>
            <li class="submenu-item {{ Request::is('admin/administrator*') ? 'active' : '' }}">
                <a href="{{ Route('admin.administrator') }}">Data Administrator</a>
            </li>
            <li class="submenu-item {{ Request::is('admin/data-peminjaman*') ? 'active' : '' }}">
                <a href="{{ Route('admin.peminjaman') }}">Data Peminjaman</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ Request::is('admin/buku*', 'admin/kategori*') ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-book-half"></i>
            <span>Katalog Buku</span>
        </a>
        <ul class="submenu {{ Request::is('admin/buku*', 'admin/kategori*') ? 'active' : '' }}">
            <li class="submenu-item {{ Request::is('admin/buku*') ? 'active' : '' }}">
                <a href="{{ Route('admin.buku') }}">Data Buku</a>
            </li>
            <li class="submenu-item {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                <a href="{{ Route('admin.kategori') }}">Kategori Buku</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item  {{ Request::is('admin/laporan*') ? 'active' : '' }}">
        <a href="{{ Route('admin.index') }}" class='sidebar-link'>
            <i class="bi bi-file-earmark-bar-graph-fill"></i>
            <span>Laporan Perpustakaan</span>
        </a>
    </li>

    <li class="sidebar-item  {{ Request::is('admin/identitas*') ? 'active' : '' }}">
        <a href="{{ Route('admin.identitas') }}" class='sidebar-link'>
            <i class="bi bi-newspaper"></i>
            <span>Identitas Aplikasi</span>
        </a>
    </li>


    <li class="sidebar-item {{ Request::is('admin/pesan-terkirim*', 'admin/pesan-masuk*') ? 'active' : '' }} has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-envelope-fill"></i>
            <span>Pesan</span>
        </a>
        <ul class="submenu {{ Request::is('admin/pesan-terkirim*', 'admin/pesan-masuk*') ? 'active' : '' }}">
            <li class="submenu-item {{ Request::is('admin/pesan-masuk*') ? 'active' : '' }}">
                <a href="{{ route('admin.pesan_masuk') }}">Pesan masuk
                    <span class="badge bg-light-danger badge-pill badge-round float-right mt-50">
                        {{ count($pesan) }}
                    </span>
                </a>
            </li>
            <li class="submenu-item {{ Request::is('admin/pesan-terkirim*') ? 'active' : '' }}">
                <a href="{{ route('admin.pesan_terkirim') }}">Pesan terkirim</a>
            </li>
        </ul>
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
