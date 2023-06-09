    <!-- JavaScript Libraries -->
    <script src="{{ asset('ProjectManagement/code.jquery.com/jquery-3.4.1.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('ProjectManagement/dashmin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    @include('sweetalert::alert')

    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.5/datatables.min.js"></script>                        
    <script>
    $(function () {
        $('#data-table').DataTable({
            paging: false,
            searching: false,
            lengthChange: false,
            processing: false,
            serverSide: false,
            info: false
        });
    });
    </script>

    <!-- Template Javascript -->
    <script src="{{ asset('ProjectManagement/dashmin/js/main.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function statusFitur(id) {
            let fitur = document.getElementById('checkFitur');
            if (fitur.checked) {
                $.ajax({
                    url: "{{route('status-fitur')}}",
                    type: 'POST',
                    data: {
                        fitur_id: id,
                        status: 'selesai'
                    },
                    success: function(response) {
                        console.log(response.status);
                    }
                })
            } else {
                $.ajax({
                    url: "{{route('status-fitur')}}",
                    type: 'POST',
                    data: {
                        fitur_id: id,
                        status: 'belum selesai'
                    },
                    success: function(response) {
                        console.log(response.status);
                    }
                })
            }
        }
        function doneAllFeatures(id) {
            let doneBtn = document.getElementById('projectDoneBtn');
            let fitur = document.getElementById('masterCheckbox');
            if (fitur.checked) {
                doneBtn.disabled = false;
                $.ajax({
                    url: "{{ route('all-status-fitur') }}",
                    type: 'POST',
                    data: {
                        project_id: id,
                        status: 'selesai'
                    },
                    success: function(response) {
                        console.log(response.status);
                    }
                })
            } else {
                doneBtn.disabled = true;
                $.ajax({
                    url: "{{ route('all-status-fitur') }}",
                    type: 'POST',
                    data: {
                        project_id: id,
                        status: 'belum selesai'
                    },
                    success: function(response) {
                        console.log(response.status);
                    }
                })
            }
            let masterCheckbox = document.getElementById('masterCheckbox');
            let checkboxes = document.getElementsByClassName('child-checkbox');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = masterCheckbox.checked;
            }
        }
    </script>
