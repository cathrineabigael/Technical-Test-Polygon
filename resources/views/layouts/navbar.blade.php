{{-- <div class="sidebar-user text-center"><img class="img-80 rounded-circle" src="../assets/images/dashboard/1.png"
        alt="">
    <div class="badge-bottom"></div><a href="">
        <h6 class="mt-3 f-14 f-w-600" style="text-transform: ">
            {{ Auth::user()->name }}
        </h6>
        @if (Auth::user()->role_system_id != null)
            <p class="mb-0 font-roboto">{{ Auth::user()->get_rolesystem()[0]->name }}</p>
        @endif
    </a>
</div> --}}

<nav>
    <div class="main-navbar" style="margin-top:20px;">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">
            <ul class="nav-menu custom-scrollbar" style="height:calc(100vh - 100px);">

                <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="sidebar-main-title">
                    {{-- <div>
                <h6>General </h6>
            </div> --}}
                </li>
                @if (Auth::user()->role_id == 1)
                    <li class="dropdown"><a
                            class="nav-link menu-title link-nav  {{ Request::is('*dasbor') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>Dasbor</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                    </li>
                    <li class="dropdown"><a
                            class="nav-link menu-title link-nav  {{ Request::is('*catat') ? 'active' : '' }}"
                            href="{{ route('formcatat') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>Catat Transaksi</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title {{ Request::is('*daftar*') ? 'active' : '' }}"
                            href="javascript:void(0)"><i data-feather="archive"></i><span>Daftar Transaksi</span></a>
                        <ul class="nav-submenu menu-content"
                            style='{{ Request::is('*daftar/pemasukan*') ? 'display:block;' : '' }}'>
                            <li><a href="{{ route('transaction.income') }}"
                                    class='{{ Request::is('*daftar/pemasukan*') ? 'active' : '' }}'>Pemasukan</a></li>
                            <li><a href="{{ route('transaction.expense') }}"
                                    class='{{ Request::is('*daftar/pengeluaran*') ? 'active' : '' }}'>Pengeluaran</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="dropdown"><a class="nav-link menu-title {{ Request::is('*pos/lib*') ? 'active' : '' }}"
                            href="javascript:void(0)"><i data-feather="archive"></i><span>Library</span></a>
                        <ul class="nav-submenu menu-content"
                            style='{{ Request::is('*pos/lib*') ? 'display:block;' : '' }}'>
                            <li><a href="{{ route('product.index') }}"
                                    class='{{ Request::is('*pos/lib/produk*') ? 'active' : '' }}'>Produk Biasa</a></li>
                            <li><a href="{{ route('consignmentproduct.index') }}"
                                    class='{{ Request::is('*pos/lib/konsinyasi*') ? 'active' : '' }}'>Produk
                                    Konsinyasi</a></li>
                            <li><a href="{{ route('category.index') }}"
                                    class='{{ Request::is('*pos/lib/kategori') ? 'active' : '' }}'>Kategori</a></li>
                            <li><a href="{{ route('brand.index') }}"
                                    class='{{ Request::is('*pos/lib/brand') ? 'active' : '' }}'>Brand</a></li>
                            <li><a href="{{ route('promotion.index') }}"
                                    class='{{ Request::is('*pos/lib/promosi*') ? 'active' : '' }}'>Promosi</a></li>
                            <li><a href="{{ route('supplier.index') }}"
                                    class='{{ Request::is('*pos/lib/supplier') ? 'active' : '' }}'>Supplier</a>
                            </li>
                            <li><a href="{{ route('customer.index') }}"
                                    class='{{ Request::is('*pos/lib/customer') ? 'active' : '' }}'>Customer</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a
                            class="nav-link menu-title {{ Request::is('*pos/transaksi/*') ? 'active' : '' }}"
                            href="javascript:void(0)"><i data-feather="dollar-sign"></i><span>Transaksi</span></a>
                        <ul class="nav-submenu menu-content"
                            style='{{ Request::is('*pos/transaksi*') ? 'display:block;' : '' }}'>
                            <li><a href="{{ route('purchase.formtambah') }}"
                                    class='{{ Request::is('*pos/transaksi/pembelian*') ? 'active' : '' }}'>Pembelian</a>
                            </li>
                            <li><a href="{{ route('sale.index') }}"
                                    class='{{ Request::is('*pos/transaksi/penjualan*') ? 'active' : '' }}'>Penjualan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a
                            class="nav-link menu-title {{ Request::is('*pos/transaksi-konsinyasi*') ? 'active' : '' }}"
                            href="javascript:void(0)"><i
                                class="fa fa-exchange"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Konsinyasi</span></a>
                        <ul class="nav-submenu menu-content"
                            style='{{ Request::is('*pos/transaksi-konsinyasi/penjualan*') ? 'display:block;' : '' }}'>
                            <li><a href="{{ route('consignment.formtambah') }}"
                                    class='{{ Request::is('*pos/transaksi-konsinyasi/pembelian*') ? 'active' : '' }}'>Pembelian</a>
                            </li>
                            <li><a href="{{ route('consignmentjual.index') }}"
                                    class='{{ Request::is('*pos/transaksi-konsinyasi/penjualan*') ? 'active' : '' }}'>Penjualan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a
                            class="nav-link menu-title {{ Request::is('*pos/laporan*') ? 'active' : '' }}"
                            href="javascript:void(0)"><i data-feather="book"></i><span>Laporan</span></a>
                        <ul class="nav-submenu menu-content"
                            style='{{ Request::is('*pos/laporan*') ? 'display:block;' : '' }}'>
                            <li><a href="{{ route('report.kedaluwarsa') }}"
                                    class='{{ Request::is('*pos/laporan/kedaluwarsa*') ? 'active' : '' }}'>Barang
                                    Kedaluwarsa</a>
                            </li>
                            <li><a href="{{ route('report.kartustok') }}"
                                    class='{{ Request::is('*pos/laporan/kartustok*') ? 'active' : '' }}'>Kartu Stok</a>
                            </li>
                            <li><a href="{{ route('purchase.index') }}"
                                    class='{{ Request::is('*pos/laporan/daftarpembelian*') ? 'active' : '' }}'>Pembelian</a>
                            </li>
                            <li><a href="{{ route('sale.daftarpenjualan') }}"
                                    class='{{ Request::is('*pos/laporan/daftarpenjualan*') ? 'active' : '' }}'>Penjualan</a>
                            </li>
                            <li><a href="{{ route('consignment.index') }}"
                                    class='{{ Request::is('*pos/laporan/konsinyasi/daftarpembelian*') ? 'active' : '' }}'>Pembelian
                                    Konsinyasi</a>
                            </li>
                            <li><a href="{{ route('consignmentjual.daftarpenjualan') }}"
                                    class='{{ Request::is('*pos/laporan/konsinyasi/daftarpenjualan*') ? 'active' : '' }}'>Penjualan
                                    Konsinyasi</a>
                            </li>
                            <li><a href="{{ route('report.formperiode') }}"
                                    class='{{ Request::is('*pos/laporan/buatlaporan*') ? 'active' : '' }}'>Buat
                                    Laporan</a>
                            </li>
                            <li><a href="{{ route('report.terlaris') }}"
                                    class='{{ Request::is('*pos/laporan/terlaris*') ? 'active' : '' }}'>Produk
                                    Terlaris</a>
                            </li>
                            <li><a href="{{ route('report.stokterendah') }}"
                                    class='{{ Request::is('*pos/laporan/stokterendah*') ? 'active' : '' }}'>Stok
                                    Terendah</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="nav-link menu-title link-nav  {{ Request::is('*pos/konfigurasi') ? 'active' : '' }} "
                            href="{{ route('setting.index') }}"><i
                                data-feather="settings"></i><span>Konfigurasi</span></a></li> --}}
                @endif

            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
</nav>
