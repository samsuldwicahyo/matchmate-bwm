<?php

// Controller untuk mengelola penilaian dan perhitungan bobot BWM
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenilaianController extends Controller
{
    // Menampilkan formulir penilaian utama
    public function index()
    {
        $session = session('bwm');

        $defaults = data_get($session, 'inputs', [
            'Penampilan' => 3,
            'Agama' => 3,
            'Fisik' => 3,
            'Domisili' => 3,
            'Pendidikan' => 3,
        ]);

        $userProfile = [
            'name' => data_get($session, 'user.name', ''),
            'photo' => data_get($session, 'user.photo'),
        ];

        return view('penilaian.form', compact('defaults', 'userProfile'));
    }

    // Memproses penilaian dan menghitung bobot BWM sederhana
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'foto' => 'nullable|url',
            'kriteria.penampilan' => 'required|integer|min:1|max:5',
            'kriteria.agama' => 'required|integer|min:1|max:5',
            'kriteria.fisik' => 'required|integer|min:1|max:5',
            'kriteria.domisili' => 'required|integer|min:1|max:5',
            'kriteria.pendidikan' => 'required|integer|min:1|max:5',
        ]);

        $criteriaValues = [
            'Penampilan' => (int) $validated['kriteria']['penampilan'],
            'Agama' => (int) $validated['kriteria']['agama'],
            'Fisik' => (int) $validated['kriteria']['fisik'],
            'Domisili' => (int) $validated['kriteria']['domisili'],
            'Pendidikan' => (int) $validated['kriteria']['pendidikan'],
        ];

        $bestValue = max($criteriaValues);
        $worstValue = min($criteriaValues);
        $bestCriteria = array_keys($criteriaValues, $bestValue)[0];
        $worstCriteria = array_keys($criteriaValues, $worstValue)[0];

        $total = array_sum($criteriaValues) > 0 ? array_sum($criteriaValues) : 1;
        $weights = [];

        foreach ($criteriaValues as $name => $value) {
            $weights[$name] = round($value / $total, 4);
        }

        $consistencyIndex = $bestValue > 0 ? round(1 - ($worstValue / max($bestValue, 1)), 4) : 0.0;

        $userProfile = [
            'name' => $validated['nama'],
            'photo' => $validated['foto'] ?? null,
        ];

        $rankedCandidates = $this->rankCandidates($weights);

        session([
            'bwm' => [
                'user' => $userProfile,
                'inputs' => $criteriaValues,
                'weights' => $weights,
                'best' => $bestCriteria,
                'worst' => $worstCriteria,
                'consistency_index' => $consistencyIndex,
                'candidates' => $rankedCandidates,
            ],
        ]);

        return redirect()->route('hasil.index')->with('status', 'Perhitungan BWM berhasil diperbarui.');
    }

    // Menghasilkan skor kandidat dan mengurutkannya berdasarkan bobot
    protected function rankCandidates(array $weights): array
    {
        $candidates = [
            [
                'name' => 'Aisyah Rahma',
                'location' => 'Bandung',
                'avatar' => 'https://i.pravatar.cc/150?img=47',
                'attributes' => [
                    'Penampilan' => 4.5,
                    'Agama' => 4.8,
                    'Fisik' => 4.2,
                    'Domisili' => 4.0,
                    'Pendidikan' => 4.6,
                ],
            ],
            [
                'name' => 'Nadia Salsabila',
                'location' => 'Jakarta',
                'avatar' => 'https://i.pravatar.cc/150?img=32',
                'attributes' => [
                    'Penampilan' => 4.7,
                    'Agama' => 4.1,
                    'Fisik' => 4.4,
                    'Domisili' => 3.8,
                    'Pendidikan' => 4.9,
                ],
            ],
            [
                'name' => 'Raina Putri',
                'location' => 'Surabaya',
                'avatar' => 'https://i.pravatar.cc/150?img=56',
                'attributes' => [
                    'Penampilan' => 4.4,
                    'Agama' => 4.5,
                    'Fisik' => 4.3,
                    'Domisili' => 4.6,
                    'Pendidikan' => 4.1,
                ],
            ],
            [
                'name' => 'Adinda Maharani',
                'location' => 'Yogyakarta',
                'avatar' => 'https://i.pravatar.cc/150?img=15',
                'attributes' => [
                    'Penampilan' => 4.2,
                    'Agama' => 4.9,
                    'Fisik' => 3.9,
                    'Domisili' => 4.4,
                    'Pendidikan' => 4.8,
                ],
            ],
            [
                'name' => 'Saskia Lestari',
                'location' => 'Bandar Lampung',
                'avatar' => 'https://i.pravatar.cc/150?img=21',
                'attributes' => [
                    'Penampilan' => 4.0,
                    'Agama' => 4.2,
                    'Fisik' => 4.5,
                    'Domisili' => 4.7,
                    'Pendidikan' => 4.3,
                ],
            ],
        ];

        foreach ($candidates as &$candidate) {
            $score = 0;
            foreach ($weights as $criterion => $weight) {
                $score += $weight * ($candidate['attributes'][$criterion] ?? 0);
            }

            $candidate['score'] = round($score, 4);
            $candidate['top_attributes'] = collect($candidate['attributes'])
                ->sortDesc()
                ->keys()
                ->take(2)
                ->map(fn ($item) => Str::headline($item))
                ->all();
        }
        unset($candidate);

        usort($candidates, fn ($a, $b) => $b['score'] <=> $a['score']);

        return $candidates;
    }
}
