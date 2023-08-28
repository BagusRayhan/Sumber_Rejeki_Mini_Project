<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

@include('Admin.templates.head')
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('Admin.templates.sidebar')

        <!-- Content Start -->
        <div class="content">

            @include('Admin.templates.navbar')

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
              <div class="search-form w-25">
                <form action="{{ route('projectselesai') }}" method="get">
                  @csrf
                    <div class="input-group rounded-pill" style="background: #E9EEF5">
                        <input type="text" name="query" value="{{ request('query') }}" class="form-control rounded-pill position-relative" style="background: #E9EEF5" placeholder="Search ...">
                        <button type="submit" class="btn btn-primary rounded-circle position-absolute end-0" style="z-index: 5"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </div>
                <div class="container-fluid">
                    <div class="row">
                    <table class="table table-striped table-hover mt-4">
                        <thead>
                          <tr>
                            <th scope="col">Nama Client</th>
                            <th scope="col">Nama Project</th>
                            <th scope="col">Status</th>
                            <th scope="col">Harga Project</th>
                            <th scope="col" class="text-center" style="width: 7em">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($selesai as $project )
                            <tr>
                                <td>{{ $project->nama }}</td>
                                <td>{{ $project->napro }}</td>
                                <td>
                                    @if ($project->status == 'selesai')
                                      <span class="badge text-bg-success">{{ $project->status }}</span>
                                    @elseif ($project->status == 'pengajuan revisi' || 'revisi')
                                      <span class="badge bg-warning">{{ ($project->status == 'revisi') ? 'menunggu persetujuan' : $project->status }}</span>
                                    @else
                                      <span class="badge">{{ $project->status }}</span>
                                    @endif
                                  </td>
                                <td>Rp.{{ number_format($project->harga, 0, ',', '.') ?? number_format($project->biayatambahan, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if ($project->status == 'selesai')
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#webSetting{{ $project->id }}" class="btn btn-primary btn-sm" style="background-color:border: none"><i class="fa-solid fa-gear"></i> Settings</a>
                                    @elseif ($project->status == 'revisi')
                                        <i class="fa-solid fa-hourglass-start text-warning fw-bold fs-5"></i>
                                    @elseif ($project->status == 'pengajuan revisi')
                                        <a type="button" href="{{ route('revisiproselesai',$project->id) }}" class="btn btn-primary btn-sm" style="background-color:border: none"><i class="fa-sharp fa-solid fa-file-pen"></i> Revisi</a>
                                    @endif
                                </td>
                                <div class="modal fade" id="webSetting{{ $project->id }}" aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">Website Configuration</h5>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('send-config') }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                    <div class="row"><h6>Website Settings</h6></div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <label for="webaddress" class="form-label mb-1 mx-1">Website Address</label>
                                                            <input type="text" class="form-control" name="webaddress" id="webaddress" placeholder="https://proreq.com" value="{{ $project->webaddress }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="ipaddress" class="form-label mb-1 mx-1">IP Address</label>
                                                            <input type="text" class="form-control" name="ipaddress" id="ipaddress" placeholder="127.0.0.0" value="{{ $project->ipaddress }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <label for="repository" class="form-label mb-1 mx-1">Repository <small class=" fw-light fst-italic text-secondary">(Opsional)</small></label>
                                                            <input type="text" class="form-control" name="repository" id="repository" placeholder="via Github, etc." value="{{ $project->repository }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4"><h6>Admin Account</h6></div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <label for="adminemail" class="form-label mb-1 mx-1">Email</label>
                                                            <input type="text" name="adminemail" id="adminemail" class="form-control" placeholder="admin@example.com" value="{{ $project->adminemail }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="adminpassword" class="form-label mb-1 mx-1">Password</label>
                                                            <input type="password" name="adminpassword" id="adminpassword" class="form-control" placeholder="Default password" value="{{ $project->adminpassword }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4"><h6>Database Access <small class="fst-italic text-secondary fw-light">(Opsional)</small></h6></div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <label for="cpanelusername" class="form-label mb-1 mx-1">Username</label>
                                                            <input type="text" name="cpanelusername" id="cpanelusername" class="form-control" placeholder="CPanel Username">
                                                        </div>
                                                        <div class="col">
                                                            <label for="cpanelpassword" class="form-label mb-1 mx-1">Password</label>
                                                            <input type="password" name="cpanelpassword" id="cpanelpassword" class="form-control" placeholder="CPanel Password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Optional: Place to the bottom of scripts -->
                                <script>
                                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

                                </script>
                              </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5"><i class="fa-solid fa-empty"></i> Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                      </table>
                  </div>
                </div>
                <div style="float: right;">
                {{$selesai->links()}}
                </div>
                </div>
            </div>
          </div>
        </div>
        <!-- Content End -->
        <div class="wrapper w-100 d-flex justify-content-end">
        </div>

    </div>

    @include('Admin.templates.script')
</body>
