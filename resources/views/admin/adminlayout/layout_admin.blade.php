<!DOCTYPE html>
<html lang="en">
@vite(['resources/scss/app.scss', 'resources/scss/style.scss'])

<head>
    <title>@yield('title', default: 'Shopen')</title>
    @include('admin.adminlayout.meta_admin')
</head>
</head>

<body>
    {{-- <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div> --}}
    @include('admin.adminlayout.navbar_admin')
    <div>@yield('content')</div>
    @include('admin.adminlayout.footer_admin')
</body>

</html>