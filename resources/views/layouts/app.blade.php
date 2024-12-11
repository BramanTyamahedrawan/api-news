<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/skydash/vendors/feather/feather.css">
    <link rel="stylesheet" href="/skydash/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/skydash/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/skydash/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="/skydash/text/css" href="/skydash/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/skydash/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/skydash/images/favicon.png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div id="app" class="container-scroller">

        @include('layouts.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.components.sidebar')

            @yield('content')
        </div>
    </div>
    <!-- plugins:js -->
    <script src="/skydash/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/skydash/vendors/chart.js/Chart.min.js"></script>
    <script src="/skydash/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="/skydash/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/skydash/js/off-canvas.js"></script>
    <script src="/skydash/js/hoverable-collapse.js"></script>
    <script src="/skydash/js/template.js"></script>
    <script src="/skydash/js/settings.js"></script>
    <script src="/skydash/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/skydash/js/dashboard.js"></script>
    <script src="/skydash/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
