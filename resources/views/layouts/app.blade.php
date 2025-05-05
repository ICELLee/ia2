<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ILLEGALACT')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('sections.shared.loading')
@include('sections.shared.bg-animation')
@include('sections.shared.navbar')

<main>
    @yield('content')
</main>

@include('sections.shared.contact')
@include('sections.shared.footer')
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- Swiper CSS & JS via CDN -->
@stack('scripts')
@stack('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css"/>
<script src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
