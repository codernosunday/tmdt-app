<!DOCTYPE html>
<html lang="en">
@vite(['resources/css/vendor.css', 'resources/css/normalize.css'])

<head>
    <title>@yield('title', 'Shopen')</title>
    @include('layouts.partials.meta')
</head>
</head>

<body>
    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>
    @include('layouts.partials.navigation')
    <div>@yield('content')</div>
    @include('layouts.partials.footer')
</body>

</html>