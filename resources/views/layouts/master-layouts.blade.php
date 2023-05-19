<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

@section('body')

    <body data-layout="horizontal" data-topbar="colored" data-layout-mode="{{ Session::get('layout') }}">
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.horizontal')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- content -->
            </div>
            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="false">
            <div class="toast-header">
                <img src="http://127.0.0.1:8000/assets/images/logo-sm.png" alt="" class="me-2" height="18">
                <strong class="me-auto">SIMRS</strong>
                <small class="text-muted">now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <span id="detail-toastr"></span>
            </div>
        </div>
    </div>


    <!-- Right Sidebar -->
    @include('layouts.right-sidebar')
    <!-- END Right Sidebar -->

    @include('layouts.vendor-scripts')

    <script>
        let user = {!! auth()->user()->toJson() !!}
    </script>
    <script src="{{ mix('js/websocket.js') }}"></script>
</body>

</html>
