{{-- Halaman hasil perhitungan bobot BWM --}}
@extends('layouts.app')

@section('page-title', 'Hasil Analisis BWM')

@section('content')
    @if ($user && data_get($user, 'name'))
        <div class="card-glass p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl overflow-hidden border border-rose-100 shadow bg-rose-50/60 flex items-center justify-center">
                    <img src="{{ data_get($user, 'photo') ?: 'https://i.pravatar.cc/150?img=64' }}" alt="Foto {{ data_get($user, 'name') }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="text-sm uppercase tracking-wider text-rose-400">Preferensi Pengguna</p>
                    <h3 class="text-2xl font-semibold text-rose-900">{{ data_get($user, 'name') }}</h3>
                    <p class="text-sm text-rose-500">Analisis romantis berdasarkan prioritas pribadi.</p>
                </div>
            </div>
            <div class="text-sm text-rose-500 max-w-sm">
                Kriteria terbaik dan terburuk dihitung menggunakan metode Best-Worst Method untuk menjaga konsistensi penilaianmu.
            </div>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="card-glass p-6 space-y-2">
            <h3 class="text-lg font-semibold text-rose-800">Kriteria Terbaik</h3>
            <p class="text-3xl font-bold text-rose-500">{{ $summary['best'] }}</p>
        </div>
        <div class="card-glass p-6 space-y-2">
            <h3 class="text-lg font-semibold text-rose-800">Kriteria Terburuk</h3>
            <p class="text-3xl font-bold text-rose-500">{{ $summary['worst'] }}</p>
        </div>
        <div class="card-glass p-6 space-y-2">
            <h3 class="text-lg font-semibold text-rose-800">Indeks Konsistensi</h3>
            <p class="text-3xl font-bold text-rose-500">{{ number_format($summary['consistency_index'], 3) }}</p>
            <p class="text-xs text-rose-400">Semakin mendekati 0 berarti penilaian semakin konsisten.</p>
        </div>
    </div>

    <div class="card-glass p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-rose-900">Distribusi Bobot Kriteria</h3>
            <span class="badge-soft">Visualisasi</span>
        </div>
        <div class="space-y-4">
            @foreach ($weights as $criterion => $weight)
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm font-medium text-rose-700">
                        <span>{{ $criterion }}</span>
                        <span>{{ number_format($weight * 100, 2) }}%</span>
                    </div>
                    <div class="h-3 rounded-full bg-white/70 overflow-hidden border border-rose-100">
                        <div class="h-full bg-gradient-to-r from-rose-200 via-rose-300 to-rose-400 transition-all duration-500 ease-in-out" style="width: {{ max(8, $weight * 100) }}%;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card-glass p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-rose-900">Peringkat Kandidat</h3>
            <button type="button" onclick="window.print()" class="btn-romantic-secondary">
                Cetak PDF
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-rose-500 uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Nilai Akhir</th>
                        <th class="px-4 py-3">Ranking</th>
                    </tr>
                </thead>
                <tbody class="text-rose-800">
                    @foreach ($ranking as $index => $candidate)
                        <tr class="border-t border-rose-100 hover:bg-white/60 transition-all duration-300 ease-in-out">
                            <td class="px-4 py-3 font-semibold">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $candidate['name'] }}</td>
                            <td class="px-4 py-3">{{ number_format($candidate['score'], 3) }}</td>
                            <td class="px-4 py-3">
                                <span class="badge-soft">{{ $index + 1 }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
