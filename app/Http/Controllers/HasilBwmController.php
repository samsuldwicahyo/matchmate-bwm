<?php

// Controller untuk menampilkan hasil bobot dan ranking BWM
namespace App\Http\Controllers;

class HasilBwmController extends Controller
{
    // Menampilkan hasil bobot dan ranking kandidat
    public function index()
    {
        $summary = session('bwm');

        if (!$summary) {
            return redirect()->route('penilaian.form')->with('status', 'Silakan isi formulir penilaian terlebih dahulu.');
        }

        return view('bwm.hasil', [
            'summary' => $summary,
            'weights' => $summary['weights'],
            'ranking' => $summary['candidates'],
            'user' => data_get($summary, 'user'),
        ]);
    }
}
