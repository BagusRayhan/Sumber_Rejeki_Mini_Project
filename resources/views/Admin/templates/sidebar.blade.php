<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar">
        <a href="/" class="navbar-brand mx-4 mb-3 justify-content-center">
            <h3 class="text-dark" style="font-family: 'Fugaz One">
                <img src="{{ asset('ProjectManagement/dashmin/img/logo.png') }}" class="w-25">
                PROREQ
            </h3>
        </a>
       <!-- Add this HTML code for the navigation bar -->
<div class="navbar-nav w-100">
    <a href="{{ route('admin-dashboard') }}" class="nav-item nav-link {{ Request::routeIs('admin-dashboard') ? 'active' : ''}}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ route('team-management') }}" class="nav-item nav-link {{ Request::routeIs('team-management') ? 'active' : ''}}"><i class="fa fa-people-group me-2"></i>Manajemen Tim</a>
    <a href="{{ route('client-list') }}" class="nav-item nav-link {{ Request::routeIs('client-list') ? 'active' : ''}}"><i class="fa fa-user-alt me-2"></i>Client</a>
    <div class="nav-item dropdown" id="projectDropdown"> <!-- Add an ID to the project dropdown -->
        <a href="#" class="nav-link dropdown-toggle {{ Request::routeIs('project-disetujui-admin', 'detail-disetujui-admin', 'projectreq', 'detailproreq', 'projectselesai', 'revisiproselesai', 'editproselesai') ? 'active' : ''}}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Project</a>
        <div class="dropdown-menu bg-transparent border-0">
            <a href="{{ route('projectreq') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('projectreq', 'detailproreq') ? 'text-primary' : ''}}">Project Masuk</a>
            <a href="{{ route('project-disetujui-admin') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('project-disetujui-admin', 'detail-disetujui-admin') ? 'text-primary' : ''}}">Project Disetujui</a>
            <a href="{{ route('projectselesai') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('projectselesai','revisiproselesai','editproselesai') ? 'text-primary' : ''}}">Project Selesai</a>
        </div>
    </div>
    <div class="nav-item dropdown" id="pembayaranDropdown"> <!-- Add an ID to the pembayaran dropdown -->
        <a href="#" class="nav-link dropdown-toggle {{ Request::routeIs('pending-bayar-admin', 'setuju-bayar-admin', 'refund-admin', 'bayar-digital-admin') ? 'active' : ''}}" data-bs-toggle="dropdown"><i class="fa fa-wallet me-2"></i>Pembayaran</a>
        <div class="dropdown-menu bg-transparent border-0">
            <a href="{{ route('pending-bayar-admin') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('pending-bayar-admin', 'setuju-bayar-admin') ? 'text-primary' : '' }}">Persetujuan</a>
            <a href="{{ route('refund-admin') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('refund-admin') ? 'text-primary' : '' }}">Pengajuan Refund</a>
            <a href="{{ route('bayar-digital-admin') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('bayar-digital-admin') ? 'text-primary' : '' }}">Pembayaran Digital</a>
        </div>
    </div>
    <a href="{{ route('pengaturan') }}" class="nav-item nav-link {{ Request::routeIs('pengaturan') ? 'active' : ''}}"><i class="fa fa-gear me-2"></i>Pengaturan</a>
</div>

<!-- Add this JavaScript code to handle the dropdown toggling -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Wait for the DOM to be ready
    $(document).ready(function () {
        // Check if any of the dropdown items in the project dropdown is active and open the dropdown
        if ($('#projectDropdown .dropdown-item').hasClass('text-primary')) {
            $('#projectDropdown .dropdown-menu').addClass('show');
        }

        // Check if any of the dropdown items in the pembayaran dropdown is active and open the dropdown
        if ($('#pembayaranDropdown .dropdown-item').hasClass('text-primary')) {
            $('#pembayaranDropdown .dropdown-menu').addClass('show');
        }
    });
</script>

    </nav>
</div>
<!-- Sidebar End -->

