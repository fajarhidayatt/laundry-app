<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/plugins/images/favicon.png') }}">
    <title>Aplikasi Pengelolaan Laundry</title>

    {{-- Bootstrap Core CSS --}}
    <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Menu CSS --}}
    <link href="{{ asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    {{-- toast CSS --}}
    <link href="{{ asset('assets/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    {{-- morris CSS --}}
    <link href="{{ asset('assets/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    {{-- chartist CSS --}}
    <link href="{{ asset('assets/plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    {{-- animation CSS --}}
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    {{-- Custom CSS --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    {{-- color CSS --}}
    <link href="{{ asset('assets/css/colors/default.css') }}" id="theme" rel="stylesheet">
    {{-- DataTables --}}
    <link href="{{ asset('assets/DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="fix-header">
    {{-- Preloader --}}
    {{-- @if ($title == 'dashboard')
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    @endif --}}

    <div id="wrapper">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')
        <div id="page-wrapper">
            @yield('content')
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by wrappixel.com </footer>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    {{-- Bootstrap Core JavaScript --}}
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- Menu Plugin JavaScript --}}
    <script src="{{ asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    {{-- slimscroll JavaScript --}}
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    {{-- Wave Effects --}}
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    {{-- Counter js --}}
    <script src="{{ asset('assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
    {{-- chartist chart --}}
    <script src="{{ asset('assets/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    {{-- Sparkline chart JavaScript --}}
    <script src="{{ asset('assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}" type="text/javascript"></script>
    {{-- Custom Theme JavaScript --}}
    <script src="{{ asset('assets/js/dashboard1.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
    <script>
        $('#btn_hapus').on('click', () => {
            return confirm('Yakin Menghapus data ?');
        });

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            var t = $('#table').DataTable({
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "language": {
                    "sProcessing": "Sedang memproses ...",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecord": "Maaf data tidak tersedia",
                    "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "sSearch": "Cari",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                }
            });
            t.on('order.dt search.dt', function() {
                t.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });

        $('#btn-refresh').on('click', () => {
            $('#ic-refresh').addClass('fa-spin');
            var oldURL = window.location.href;
            var index = 0;
            var newURL = oldURL;
            index = oldURL.indexOf('?');
            if (index == -1) {
                window.location = window.location.href;

            }
            if (index != -1) {
                window.location = oldURL.substring(0, index)
            }
        });
    </script>

    {{-- Toast --}}
    @if (session()->has('success'))
        <script type="text/javascript">
            // var title = "Berhasil";
            // var msg = "Berhasil menambahkan data";
            // var type = "success";

            $.toast({
                heading: 'Berhasil',
                text: "Berhasil menambahkan data",
                position: 'top-right',
                loaderBg: '#fff',
                icon: "success",
                hideAfter: 3500,
                stack: 6
            })
        </script>
    @endif
    
</body>

</html>