<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>

    @include('partials.link_dashboard')
</head>

<body>
    @include('partials.alert')
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('partials.navbar_dashboard')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            @include('partials.setting_dashboard')
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('partials.sidebar_dashboard')
            <!-- partial -->
            <div class="main-panel">
                <div class="card p-3 d-flex justify-content-between">
                    <h2>@yield('title')</h2>
                    <div>
                        @yield('breadcrumb')
                    </div>
                </div>
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('partials.footer_dashboard')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    @include('partials.script_dashboard')
</body>

</html>
