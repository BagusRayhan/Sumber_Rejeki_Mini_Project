<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

@include('Client.Template.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->
        @include('Client.Template.sidebar')

        <!-- Content Start -->
        <div class="content">

            @include('Client.Template.navbar')

<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<br>

<table class="table table-bordered">
    <thead>
  <tr>
    <th scope="col">Nama Client</th>
    <th scope="col">Nama Project</th>
    <th scope="col">Deadline</th>
    <th scope="col">AKSI</th>
  </tr>
  <tr>
    <td>Dicky</td>
    <td>Website Sekolah</td>
    <td>12-02-2023</td>
    <td></td>
  </tr>
  <tr>
    <td>Ahmad </td>
    <td>website Toko</td>
    <td>22-06-2023</td>
    <td></td>
  </tr>
  <tr>
    <td>Rizky</td>
    <td>Website Pertanian</td>
    <td>19-04-2023</td>
    <td></td>
  </tr>
</thead>
{{-- <tbody>
    @forelse ($clientproreqs as $clientproreq)
    <tr>
        <td>{{ $clientproreq-> }}</td>
        <td>{{ $clientproreq-> }}</td>
        <td>{{ $clientproreq-> }}</td>
        <td>
            <form action=""></form>
        </td>
    </tr>

    @empty

    @endforelse
</tbody> --}}
</table>

</body>
</html>

