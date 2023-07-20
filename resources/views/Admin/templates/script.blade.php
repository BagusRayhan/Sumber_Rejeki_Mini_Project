    <!-- JavaScript Libraries -->
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
            info: false,
            language: {
                emptyTable: "Tidak ada data"
            }
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

        function statusFitur(checkbox) {
            var fiturId = $(checkbox).data('fiturid');
            var status = checkbox.checked ? 'selesai' : 'belum selesai';

            $.ajax({
                url: "{{ route('status-fitur') }}",
                type: 'POST',
                data: {
                    fitur_id: fiturId,
                    status: status
                },
                success: function(response) {
                    console.log(response.status);
                }
            });
        }

        function doneAllFeatures(id) {
            var doneBtn = document.getElementById('projectDoneBtn');
            var fitur = document.getElementById('masterCheckbox');
            if (fitur.checked) {
                doneBtn.disabled = false;
            } else {
                doneBtn.disabled = true;
            }

            var checkboxes = document.getElementsByClassName('child-checkbox');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = fitur.checked;
            }

            var status = fitur.checked ? 'selesai' : 'belum selesai';
            $.ajax({
                url: "{{ route('all-status-fitur') }}",
                type: 'POST',
                data: {
                    project_id: id,
                    status: status
                },
                success: function(response) {
                    console.log(response.status);
                }
            });
        }
    </script>

