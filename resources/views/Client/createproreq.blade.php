<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themewagon.github.io/dashmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 May 2023 04:44:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
@include('Client.Template.head')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        @include('Client.Template.sidebar')

        <!-- Content Start -->
        <div class="content">
      @include('Client.Template.navbar')
      <style>
        .td-spacing {
            margin-right: 20px;
        }
        td {
        margin-top: 20px;
    }
    </style>
     <table>
        <tr>
            <td style="padding-right: 25px;"></td>
            <td width="50%">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Project</h5>
                        <form>
                            <div class="form-group">
                                <label for="input1">Nama Client</label>
                                <input type="text" class="form-control" id="input1" placeholder="Ahmad" disabled>
                            </div><br>
                            <div class="form-group">
                                <label for="input2">Nama Project</label>
                                <input type="text" class="form-control" id="input2" placeholder="Masukkan nama project anda">
                            </div><br>
                            <div class="form-group">
                                <label for="input3">Dokumen Pendukung</label>
                                <input type="file" class="form-control" id="input3">
                            </div><br>
                            <div class="form-group">
                                <label for="input4">Deadline</label>
                                <input type="datetime-local" class="form-control" id="input4" placeholder="Input 4">
                            </div><br>
                            <button type="submit" class="btn btn-primary">Kirim Request</button>
                        </form>
                    </div>
                </div>
            </td>

            <td style="padding-right: 25px; margin-top: 20px;"></td>
            <td width="50%">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Fitur Fitur</h5>
                        <form>
                            <div class="form-group">
                                <label for="input1">Fitur</label>
                                <input type="text" class="form-control" id="input1" placeholder="masukkan fitur yang anda inginkan">
                            </div><br><br>
                            <div class="form-group">
                                <input type="text" class="form-control" id="input2" placeholder="Masukkan fitur">
                            </div><br><br>
                            <div class="form-group">
                                <input type="text" class="form-control" id="input3" placeholder="masukkan fitur">
                            </div><br><br>
                            <div class="form-group">
                                <input type="te" class="form-control" id="input4" placeholder="masukkan fitur">
                            </div>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
     </table>




@include('Client.Template.footer')
@include('Client.Template.script')
