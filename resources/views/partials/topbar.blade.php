{{-- Topbar dengan tombol sidebar dan profil pengguna --}}
<header class="sticky top-0 z-20 bg-white/70 backdrop-blur-xl border-b border-rose-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 md:px-10 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button type="button" data-toggle-sidebar class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/70 border border-rose-200 shadow transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-0.5">
                <span class="sr-only">Toggle sidebar</span>
                ☰
            </button>
            <div>
                <h2 class="text-2xl font-semibold text-rose-900">{{ $title ?? 'Penilaian BWM' }}</h2>
                <p class="text-sm text-rose-500">Romansa modern dengan analisis objektif</p>
            </div>
        </div>
        @php
            $displayName = data_get($user ?? [], 'name', 'Luna Amara');
            $displayPhoto = data_get($user ?? [], 'photo');
            $avatarFallback = 'https://i.pravatar.cc/150?img=64';
        @endphp
        <div class="flex items-center space-x-3">
            <div class="text-right hidden sm:block">
                <p class="font-semibold text-rose-900">{{ $displayName }}</p>
                <p class="text-xs text-rose-400">{{ $displayPhoto ? 'Profil personal' : 'Love Curator' }}</p>
            </div>
            <div class="w-12 h-12 rounded-full border border-rose-200 shadow heartbeat-tilt overflow-hidden">
                <img src="{{ $displayPhoto ?: $avatarFallback }}" alt="Profil pengguna romantis" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</header>
