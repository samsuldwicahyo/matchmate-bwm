{{-- Daftar rekomendasi calon jodoh dengan tampilan romantis --}}
@extends('layouts.app')

@section('page-title', 'Rekomendasi Jodoh')

@section('content')
    <div class="card-glass p-6 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-2xl font-semibold text-rose-900">Daftar Rekomendasi</h3>
                <p class="text-rose-500">
                    Calon jodoh diurutkan dari skor kecocokan tertinggi berdasarkan preferensi
                    @if ($user && data_get($user, 'name'))
                        <span class="font-semibold text-rose-700">{{ data_get($user, 'name') }}</span>.
                    @else
                        yang telah kamu tentukan.
                    @endif
                </p>
            </div>
            <div class="badge-soft">Skor ≥ {{ number_format($threshold, 2) }}</div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($candidates as $candidate)
                <article class="card-glass hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-2xl border border-rose-200 overflow-hidden shadow heartbeat-tilt">
                            <img src="{{ $candidate['avatar'] }}" alt="Foto {{ $candidate['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-rose-900">{{ $candidate['name'] }}</h4>
                            <p class="text-sm text-rose-500">{{ $candidate['location'] }}</p>
                        </div>
                    </div>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-rose-500">Skor Kecocokan</span>
                            <span class="badge-soft">{{ number_format($candidate['score'], 3) }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-white/70 overflow-hidden border border-rose-100">
                            <div class="h-full bg-gradient-to-r from-rose-200 via-rose-300 to-rose-400" style="width: {{ min(100, $candidate['score'] * 100) }}%;"></div>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($candidate['top_attributes'] as $attribute)
                            <span class="badge-soft">{{ $attribute }}</span>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
