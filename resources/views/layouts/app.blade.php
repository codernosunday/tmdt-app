<!DOCTYPE html>
<html lang="en">
@vite(['resources/scss/app.scss', 'resources/scss/style.scss'])

<head>
    <title>@yield('title', default: 'Shopen')</title>
    @include('layouts.partials.meta')
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