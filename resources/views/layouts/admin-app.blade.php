<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Shopen')</title>
    @include('layouts.partials-admin.meta')
    @vite(['resources/css/admin/layout-admin.css', 'resources/css/app.css'])
</head>

<body>
    {{-- <div class="preloader-wrapper">
        <div class="preloader"></div>
    </div> --}}
    
    @include('layouts.partials-admin.menu')
    <div>@yield('content')</div>
</body>

</html>
