<?php

// Controller untuk menampilkan rekomendasi calon jodoh
namespace App\Http\Controllers;

class RekomendasiController extends Controller
{
    // Menampilkan kartu rekomendasi calon jodoh
    public function index()
    {
        $summary = session('bwm');

        if (!$summary) {
            return redirect()->route('penilaian.form')->with('status', 'Silakan isi formulir penilaian terlebih dahulu.');
        }

        $candidates = $summary['candidates'];
        $threshold = collect($candidates)->take(1)->value('score') ?? 0;

        return view('bwm.rekomendasi', [
            'candidates' => $candidates,
            'threshold' => $threshold,
            'user' => data_get($summary, 'user'),
        ]);
    }
}
