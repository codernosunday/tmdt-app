<!DOCTYPE html>
<html lang="en">
@vite(['resources/scss/app.scss', 'resources/scss/style.scss', 'resources/css/home/home.css', 'resources/js/search.js'])

<head>
    <title>@yield('title', default: 'Shopen')</title>
    @include('layouts.partials.meta')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>
</head>

<body>
    {{-- <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div> --}}
    @include('layouts.partials.navigation')
    <div>@yield('content')</div>
    @include('layouts.partials.footer')
</body>

</html>