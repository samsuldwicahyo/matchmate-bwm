{{-- Sidebar romantis dengan menu utama --}}
<aside id="sidebar" class="fixed md:static inset-y-0 left-0 z-40 w-72 bg-white/70 backdrop-blur-xl border-r border-rose-200 shadow-2xl md:shadow-none transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out">
    <div class="h-full flex flex-col">
        <div class="px-6 py-8 border-b border-rose-100">
            <div class="flex items-center space-x-4">
                <div class="heartbeat-logo w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-400 via-pink-400 to-fuchsia-400 flex items-center justify-center text-white text-2xl shadow-lg">
                    💞
                </div>
                <div>
                    <h1 class="text-xl font-semibold tracking-tight text-rose-800">MatchMate</h1>
                    <p class="text-sm text-rose-500">Kecocokan yang hangat & berkesan</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('penilaian.form') }}" class="nav-link {{ request()->routeIs('penilaian.*') ? 'nav-link-active' : '' }}">
                <span class="text-lg">📝</span>
                <span>Form Penilaian</span>
            </a>
            <a href="{{ route('hasil.index') }}" class="nav-link {{ request()->routeIs('hasil.*') ? 'nav-link-active' : '' }}">
                <span class="text-lg">📊</span>
                <span>Hasil BWM</span>
            </a>
            <a href="{{ route('rekomendasi.index') }}" class="nav-link {{ request()->routeIs('rekomendasi.*') ? 'nav-link-active' : '' }}">
                <span class="text-lg">💡</span>
                <span>Rekomendasi</span>
            </a>
        </nav>

        <div class="px-6 py-8 border-t border-rose-100 space-y-4">
            <div class="card-glass text-sm text-rose-500">
                <p>Metode Best-Worst Method membantu menemukan pasangan terbaik dengan mempertimbangkan prioritasmu secara konsisten.</p>
            </div>
            <p class="text-xs text-rose-400">&copy; {{ date('Y') }} MatchMate. Semua hak dilindungi.</p>
        </div>
    </div>
</aside>
