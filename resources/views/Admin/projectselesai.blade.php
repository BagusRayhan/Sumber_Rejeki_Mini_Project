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
                            <th scope="col" class="text-center" style="width: 6em">Aksi</th>
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
                                      <span class="badge text-bg-warning">{{ ($project->status == 'revisi') ? 'menunggu persetujuan' : $project->status }}</span>
                                    @else
                                      <span class="badge">{{ $project->status }}</span>
                                    @endif
                                  </td>
                                <td>Rp.{{ $project->harga + $project->biayatambahan }}</td>
                                <td>
                                    @if ($project->status == 'selesai')
                                      <a type="button" href="{{ route('revisiproselesai',$project->id) }}" class="btn btn-primary btn-sm disabled" style="background-color:border: none"><i class="fa-sharp fa-solid fa-file-pen"></i> Revisi</a>
                                    @elseif ($project->status == 'revisi')
                                      <a type="button" href="{{ route('revisiproselesai',$project->id) }}" class="btn btn-primary btn-sm disabled" style="background-color:border: none"><i class="fa-sharp fa-solid fa-file-pen"></i> Revisi</a>
                                    @elseif ($project->status == 'pengajuan revisi')
                                      <a type="button" href="{{ route('revisiproselesai',$project->id) }}" class="btn btn-primary btn-sm" style="background-color:border: none"><i class="fa-sharp fa-solid fa-file-pen"></i> Revisi</a>
                                    @endif
                                  </td>
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
