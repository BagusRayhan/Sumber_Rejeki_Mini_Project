<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="#" class="navbar-brand mx-4 mb-3 justify-content-center">
            <h3 class="text-dark" style="font-family: 'Fugaz One">
                <img src="{{ asset('ProjectManagement/dashmin/img/logo.png') }}" class="w-25">
                PROREQ
            </h3>
        </a>
        <div class="navbar-nav w-100">
            <a href="/admin" class="nav-item nav-link {{ Request::routeIs('admin-dashboard') ? 'active' : ''}}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Project</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item py-2 px-5 fw-medium">Project Masuk</a>
                    <a href="typography.html" class="dropdown-item py-2 px-5 fw-medium">Project Disetujui</a>
                    <a href="element.html" class="dropdown-item py-2 px-5 fw-medium">Project Selesai</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ (Request::routeIs('setuju-bayar-admin') ? 'active' : Request::routeIs('bayar-digital-admin')) ? 'active' : ''}}" data-bs-toggle="dropdown"><i class="fa fa-wallet me-2"></i>Pembayaran</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/persetujuan-pembayaran-pending" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('setuju-bayar-admin') ? 'text-primary' : '' }}">Persetujuan</a>
                    <a href="/pembayaran-digital" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('bayar-digital-admin') ? 'text-primary' : '' }}">Pembayaran Digital</a>
                </div>
            </div>
            <a href="/pengaturan-admin" class="nav-item nav-link {{ Request::routeIs('admin-settings') ? 'active' : ''}}"><i class="fa fa-gear me-2"></i>Pengaturan</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->