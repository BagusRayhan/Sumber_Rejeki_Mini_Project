

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary" style="font-size:150%; margin-top:2%;"><img src="{{ asset('ProjectManagement/dashmin/img/logo.png') }}" style="width: 35%; height:35%; margin-bottom:9%;">PROREQ</h3>
                </a>
                <div class="navbar-nav w-100" >
                    <a href="{{ route('indexclient') }}" class="nav-item nav-link {{ Request::routeIs('indexclient*') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="{{ route('drequestclient') }}" class="nav-link dropdown-toggle {{ Request::routeIs('drequestclient*','setujuclient*','selesaiclient*','ditolakclient*') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Project</a>
                        <div class="dropdown-menu bg-transparent border-0" style="margin-left: 20%;">
                            <a href="{{ route('drequestclient') }}" class="dropdown-item {{ Request::routeIs('drequestclient*') ? 'active' : '' }}">Project Request</a>
                            <a href="{{ route('setujuclient') }}" class="dropdown-item {{ Request::routeIs('setujuclient*') ? 'active' : '' }}">Project Disetujui</a>
                            <a href="element.html" class="dropdown-item {{ Request::routeIs('selesaiclient*') ? 'active' : '' }}">Project Selesai</a>
                            <a href="{{ route('ditolakclient') }}" class="dropdown-item {{ Request::routeIs('ditolakclient*') ? 'active' : '' }}">Project Ditolak</a>
                        </div>
                    </div>
                    <a href="widget.html" class="nav-item nav-link {{ Request::routeIs('bayarclient*') ? 'active' : '' }}"><i class="fa-solid fa-wallet"></i>Transaksi</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
