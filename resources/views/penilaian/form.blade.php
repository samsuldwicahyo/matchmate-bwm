{{-- Formulir penilaian kriteria dengan slider gradasi --}}
@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('page-title', 'Form Penilaian BWM')

@section('content')
    @php
        $defaults = $defaults ?? [
            'Penampilan' => 3,
            'Agama' => 3,
            'Fisik' => 3,
            'Domisili' => 3,
            'Pendidikan' => 3,
        ];
        $userProfile = $userProfile ?? ['name' => '', 'photo' => ''];
    @endphp

    <div class="card-glass p-6 md:p-10 space-y-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-2xl font-semibold text-rose-900">Tentukan Prioritas Kriteria</h3>
                <p class="text-rose-500">Gunakan slider untuk menilai pentingnya setiap kriteria bagi pasangan idealmu (1 = paling tidak penting, 5 = sangat penting).</p>
            </div>
            <div class="badge-soft">Metode BWM</div>
        </div>

        <form action="{{ route('penilaian.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-2">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="input-romantic"
                        placeholder="Misal: Amara Lestari"
                        value="{{ old('nama', $userProfile['name']) }}"
                        required
                    >
                    @error('nama')
                        <p class="text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="foto" class="form-label">Foto Profil (URL, opsional)</label>
                    <input
                        type="url"
                        id="foto"
                        name="foto"
                        class="input-romantic"
                        placeholder="https://contoh.com/foto-romantis.jpg"
                        value="{{ old('foto', $userProfile['photo']) }}"
                    >
                    @error('foto')
                        <p class="text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($defaults as $label => $value)
                    @php
                        $fieldId = 'range-' . Str::slug($label);
                        $fieldName = Str::lower($label);
                    @endphp
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label for="{{ $fieldId }}" class="font-semibold text-rose-800">{{ $label }}</label>
                            <span data-range-value="{{ $fieldId }}" class="badge-soft">{{ old("kriteria.$fieldName", $defaults[$label]) }}</span>
                        </div>
                        <input
                            type="range"
                            id="{{ $fieldId }}"
                            name="kriteria[{{ $fieldName }}]"
                            class="range-romantic"
                            min="1"
                            max="5"
                            step="1"
                            value="{{ old("kriteria.$fieldName", $defaults[$label]) }}"
                            data-range
                        >
                        @error("kriteria.$fieldName")
                            <p class="text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pt-4 border-t border-rose-100">
                <p class="text-sm text-rose-500">Nilai tertinggi akan menjadi kriteria terbaik (Best), sedangkan nilai terendah menjadi kriteria terburuk (Worst).</p>
                <button type="submit" class="btn-romantic">
                    Hitung BWM
                </button>
            </div>
        </form>
    </div>
@endsection
