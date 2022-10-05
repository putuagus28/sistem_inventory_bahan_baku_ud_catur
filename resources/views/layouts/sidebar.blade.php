<aside class="main-sidebar sidebar-dark-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url(auth()->user()->role == 'mahasiswa' ? 'setprivilege' : '') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/favicon-32x32.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">UD. CATUR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image my-auto">
                <img src="{{ asset('assets/dist/img/' . auth()->user()->jenis_kelamin . '.jpg') }}"
                    class="brand-image img-circle">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold">
                    @auth
                        {{ strtoupper(auth()->user()->role == 'mahasiswa' ? auth()->user()->mhs->name : auth()->user()->name) }}
                    @endauth
                </a>
                <span class="badge badge-pill badge-info">
                    {{ auth()->user()->role == 'mahasiswa' ? Session::get('jabatan') : auth()->user()->role }}
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview {{ request()->is('dashboard') ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (in_array(auth()->user()->role, ['admin']))
                    <li class="nav-item {{ request()->is('general/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('general/*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                User
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('general/admin') }}"
                                    class="nav-link {{ request()->is('general/admin') ? 'active' : '' }}">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('general/pegawai') }}"
                                    class="nav-link {{ request()->is('general/pegawai') ? 'active' : '' }}">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Pegawai</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('supplier') ? 'menu-open' : '' }}">
                        <a href="{{ route('supplier') }}"
                            class="nav-link {{ request()->is('supplier') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Supplier
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('periode') ? 'menu-open' : '' }}">
                        <a href="{{ route('periode') }}"
                            class="nav-link {{ request()->is('periode') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Periode
                            </p>
                        </a>
                    </li>


                    <li class="nav-item has-treeview {{ request()->is('produksi') ? 'menu-open' : '' }}">
                        <a href="{{ route('produksi') }}"
                            class="nav-link {{ request()->is('produksi') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Produksi
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('bahanbaku') ? 'menu-open' : '' }}">
                        <a href="{{ route('bahanbaku') }}"
                            class="nav-link {{ request()->is('bahanbaku') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Bahan Baku
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('bbm') ? 'menu-open' : '' }}">
                        <a href="{{ route('bbm') }}" class="nav-link {{ request()->is('bbm') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Bahan Baku Masuk
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('bbk') ? 'menu-open' : '' }}">
                        <a href="{{ route('bbk') }}" class="nav-link {{ request()->is('bbk') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                Bahan Baku Keluar
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('bbs') ? 'menu-open' : '' }}">
                        <a href="{{ route('bbs') }}" class="nav-link {{ request()->is('bbs') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Bahan Baku Sisa
                            </p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->is('laporan/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('laporan/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-print"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('laporan/bbm') }}"
                                    class="nav-link {{ request()->is('laporan/bbm') ? 'active' : '' }}">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Bahan Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('laporan/bbk') }}"
                                    class="nav-link {{ request()->is('laporan/bbk') ? 'active' : '' }}">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Bahan Keluar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('laporan/bbs') }}"
                                    class="nav-link {{ request()->is('laporan/bbs') ? 'active' : '' }}">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Bahan Sisa </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role, ['pegawai']))
                    <li class="nav-item has-treeview {{ request()->is('produksi') ? 'menu-open' : '' }}">
                        <a href="{{ route('produksi') }}"
                            class="nav-link {{ request()->is('produksi') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Produksi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('bbs') ? 'menu-open' : '' }}">
                        <a href="{{ route('bbs') }}" class="nav-link {{ request()->is('bbs') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>
                                Bahan Baku Sisa
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
