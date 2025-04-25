<!DOCTYPE html>
<html lang="en">
@vite(['resources/scss/admin.scss', 'resources/js/adminscript/adminpage.js'])

<head>
    <title>@yield('title', default: 'Shopen')</title>
    @include('admin.adminlayout.meta_admin')
</head>
</head>
{{-- <div>@yield('content')</div> --}}

<body>
    @include('admin.adminlayout.navbar_admin')
    <div class="main-content">
        <!-- Header -->

        @include('admin.adminlayout.head')
        <!-- Content -->
        <main class="content">
            <div>@yield('content')</div>
        </main>
        <!-- Footer -->
        @include('admin.adminlayout.footer_admin')
    </div>
</body>

</html>