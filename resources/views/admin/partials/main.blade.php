<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LaundryApp | Dashboard Admin</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/plugins/images/favicon.png') }}">
    {{-- Bootstrap Core CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- Menu CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}">
    {{-- toast CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bower_components/toast-master/css/jquery.toast.css') }}">
    {{-- morris CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bower_components/morrisjs/morris.css') }}">
    {{-- chartist CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bower_components/chartist-js/dist/chartist.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}">
    {{-- animation CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    {{-- color CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors/default.css') }}" id="theme">
    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}" />
</head>

<body class="fix-header">

    <div id="wrapper">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')
        <div id="page-wrapper">
            @yield('content')
            <footer class="footer text-center"> 2024 &copy; made with love </footer>
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
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    {{-- Custom Theme JavaScript --}}
    <script src="{{ asset('assets/js/dashboard1.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
    {{-- Custom Script --}}
    <script>
        $('#btn_delete').on('click', () => {
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
            let oldURL = window.location.href;
            let index = 0;
            let newURL = oldURL;
            index = oldURL.indexOf('?');
            if (index == -1) {
                window.location = window.location.href;
            }
            if (index != -1) {
                window.location = oldURL.substring(0, index)
            }
        });
    </script>

    {{-- Alert Message --}}
    @if (session()->has('alert'))
        <script type="text/javascript">
            const title = '{{ session('title') }}';
            const message = '{{ session('message') }}';
            const type = '{{ session('type') }}';

            $.toast({
                heading: title,
                text: message,
                position: 'top-right',
                loaderBg: '#fff',
                icon: type,
                hideAfter: 3500,
                stack: 6
            })
        </script>
    @endif
    
</body>

</html>