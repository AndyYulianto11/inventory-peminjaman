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
                        <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
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
                            {{-- <a href="#" class="nav-link {{ request()->is('jenisbarang') ? 'active' : '' || request()->is('satuan') ? 'active' : '' || request()->is('databarang') ? 'active' : '' }}"> --}}
                                <a href="#" class="nav-link ">
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
                                <i class="nav-icon fas fa-dolly-flatbed"></i>
                                <p>
                                    Pengajuan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cek-dataasetunit') }}" class="nav-link {{ request()->is('cek-dataasetunit*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Data Aset Unit
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cek-datapengadaanbarang') }}" class="nav-link {{ request()->is('cek-datapengadaanbarang*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Data Pengadaan Barang
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
                            <a href="{{ route('barang-keluar.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Barang Keluar
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'kepalagudang')
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cek-datapengadaan') }}" class="nav-link {{ request()->is('cek-datapengadaan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Data Pengadaan Barang
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
                                    <a href="{{ route('laporan-barang-masuk') }}" class="nav-link {{ request()->is('laporan-barang-masuk') ? 'active' : '' }}">
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
                                <li class="nav-item">
                                    <a href="{{ route('unit') }}" class="nav-link {{ request()->is('unit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Unit</p>
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
                            <a href="{{ route('datapengaju', ['role' => 'atasan']) }}" class="nav-link {{ request()->is('datapengaju/atasan', 'datapengaju/atasan/disetujui', 'datapengaju/atasan/draft', 'datapengaju/atasan/diajukan', 'datapengaju/atasan/ditangguhkan', 'datapengaju/atasan/ditolak') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paste"></i>
                                <p>
                                    Pengajuan Atasan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('datapengaju', ['role' => 'admin']) }}" class="nav-link {{ request()->is('datapengaju/admin', 'datapengaju/admin/disetujui', 'datapengaju/admin/draft', 'datapengaju/admin/diajukan', 'datapengaju/admin/ditangguhkan', 'datapengaju/admin/ditolak') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paste"></i>
                                <p>
                                    Pengajuan Admin
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'atasan')
                        <li class="nav-item">
                            <a href="{{ route('atasan') }}" class="nav-link {{ request()->is('atasan') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cekdatapengaju') }}" class="nav-link {{ request()->is('cekdatapengaju') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paste"></i>
                                <p>
                                    Cek Data Pengaju
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'keuangan')
                        <li class="nav-item">
                            <a href="{{ route('keuangan') }}" class="nav-link {{ request()->is('keuangan') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cek-datatransaksipengadaan') }}" class="nav-link {{ request()->is('cek-datatransaksipengadaan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Data Pengadaan Barang
                                </p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->role == 'rektor')
                        <li class="nav-item">
                            <a href="{{ route('rektor') }}" class="nav-link {{ request()->is('rektor') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Dashboard
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
