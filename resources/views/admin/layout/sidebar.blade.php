        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('adminlte/dist/img/logouniba.png') }}" alt="Uniba Madura Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Uniba Madura</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        <a href="#" class="d-block" style="text-transform: uppercase">{{ Auth::user()->role }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'admingudang')
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('jenisbarang') ? 'active' : '' || request()->is('satuan') ? 'active' : '' || request()->is('databarang') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Master Barang
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('jenisbarang') }}" class="nav-link {{ request()->is('jenisbarang') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jenis Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('satuan') }}" class="nav-link {{ request()->is('satuan') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Satuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('databarang') }}" class="nav-link {{ request()->is('databarang') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Barang</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier') }}" class="nav-link {{ request()->is('supplier') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>
                                    Supplier
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cek-pengaju') }}" class="nav-link {{ request()->is('cek-pengaju*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Pengajuan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barangmasuk') }}" class="nav-link {{ request()->is('barangmasuk') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                <p>
                                    Barang Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Barang Keluar
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'admingudang' || Auth::user()->role == 'kepalagudang')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Barang Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Barang Keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Stok</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'administrator')
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>
                                    Pengaturan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manajemen User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'pengaju')
                        <li class="nav-item">
                            <a href="{{ route('pengaju') }}" class="nav-link {{ request()->is('pengaju') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cekdatabarang') }}" class="nav-link {{ request()->is('cekdatabarang') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Data Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('datapengaju') }}" class="nav-link {{ request()->is('datapengaju') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paste"></i>
                                <p>
                                    Pengaju
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
