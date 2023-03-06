<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('/') }}img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>Blank Page | AdminKit Demo</title>

    {{-- Bootstrap 5.2.3 CSS --}}
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">

    {{-- AdminKit CSS --}}
    <link href="{{ asset('/') }}css/app.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- Jquery --}}
    <script src="{{ asset('/') }}js/jquery-3.6.2.min.js"></script>
</head>

<body>
    <div class="wrapper">
        {{-- Nav Sidebar --}}
        @include('dashboard.partials.sidebar')
        {{-- End Nav Sidebar --}}

        <div class="main">
            {{-- Header --}}
            @include('dashboard.partials.header')
            {{-- End Header --}}
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">@yield('title')</h1>
                    {{-- Content --}}
                    @yield('content')
                    {{-- End Content --}}

                </div>
            </main>

            {{-- Footer --}}
            @include('dashboard.partials.footer')
            {{-- End Footer --}}
        </div>
    </div>

    <script src="{{ asset('/') }}js/app.js"></script>

</body>

</html>
