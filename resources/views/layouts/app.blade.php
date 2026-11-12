{{-- Layout utama dengan tema romantis --}}
<!DOCTYPE html>
<html lang="id">
<head>
    {{-- Meta dasar dan font elegan --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim($__env->yieldContent('page-title')) !== '' ? trim($__env->yieldContent('page-title')) : 'Penilaian BWM' }} | MatchMate</title>
    <link rel="icon" type="image/png" href="https://fav.farm/💖">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-rose-50 via-rose-100 to-rose-200 text-rose-900 antialiased">
    {{-- Overlay untuk sidebar mobile --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-rose-900/40 backdrop-blur-sm z-30 hidden md:hidden"></div>

    <div class="min-h-screen md:flex md:items-stretch relative">
        @include('partials.sidebar')

        <div class="flex-1 flex flex-col md:ml-72 transition-all duration-300 ease-in-out md:ml-0">
            @php($pageTitle = trim($__env->yieldContent('page-title')) !== '' ? trim($__env->yieldContent('page-title')) : 'Penilaian BWM')
            @php($activeUser = session('bwm.user'))
            @include('partials.topbar', ['title' => $pageTitle, 'user' => $activeUser])

            <main class="flex-1 p-6 md:p-10 space-y-6 animate-fadeIn">
                @if (session('status'))
                    <div class="card-glass border border-rose-200 text-rose-900">
                        <p class="font-semibold">{{ session('status') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
