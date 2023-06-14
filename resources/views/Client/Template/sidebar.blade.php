

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar  navbar-light" >
                <a href="#" class="navbar-brand mx-4 mb-3 justify-content-center">
                    <h3 class="text-dark" style="font-family: 'Fugaz One">
                        <img src="{{ asset('ProjectManagement/dashmin/img/logo.png') }}" class="w-25">
                        PROREQ
                    </h3>
                </a>
                <div class="navbar-nav w-100" >
                    <a href="{{ route('indexclient') }}" class="nav-item nav-link {{ Request::routeIs('indexclient*') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="{{ route('drequestclient') }}" class="nav-link dropdown-toggle {{ Request::routeIs('drequestclient*','setujuclient*','selesaiclient*','revisiclient*','ditolakclient*','revisibutton*','detail-revisi-client*','*detailsetujui') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Project</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('drequestclient') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('drequestclient*') ? 'text-primary' : '' }}">Project Request</a>
                            <a href="{{ route('setujuclient') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('setujuclient*','detailsetujui*') ? 'text-primary' : '' }}">Project Disetujui</a>
                            <a href="{{ route('selesaiclient') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('selesaiclient*','revisiclient*','revisibutton*','detail-revisi-client*') ? 'text-primary' : '' }}">Project Selesai</a>
                            <a href="{{ route('ditolakclient') }}" class="dropdown-item py-2 px-5 fw-medium {{ Request::routeIs('ditolakclient*') ? 'text-primary' : '' }}">Project Ditolak</a>
                        </div>
                    </div>
                    <a href="{{ route('bayarclient') }}" class="nav-item nav-link {{ Request::routeIs('bayarclient*','bayar2client*') ? 'active' : '' }}"><i class="fa-solid fa-wallet"></i>Transaksi</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
