<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('superadmin.dashboard') }}">
                <i class="mdi mdi-trending-up menu-icon"></i>
                <span class="menu-title">Dasbor</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#master-data" aria-expanded="false"
                aria-controls="master-data">
                <i class="mdi mdi-database menu-icon"></i>
                <span class="menu-title">Data Master</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="master-data">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.index') }}">Kategori Produk</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('merk.index') }}">Merk</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Produk</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaction.index') }}">
                <i class="mdi mdi-credit-card menu-icon"></i>
                <span class="menu-title">Transaksi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="mdi mdi-file-chart menu-icon"></i>
                <span class="menu-title">Laporan</span>
            </a>
        </li>
    </ul>
</nav>
