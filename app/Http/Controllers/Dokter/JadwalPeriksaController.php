<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('dokter.jadwal-periksa.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
            $data = $request->validate([
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ]);

            $data['id_dokter'] = Auth::id();
            $data['status'] = true;

            JadwalPeriksa::create($data);

            return redirect()->route('jadwal-periksa.index')
                ->with('message', 'Jadwal periksa berhasil ditambahkan')
                ->with('type', 'success');
    }

    public function edit(JadwalPeriksa $jadwal_periksa)
    {
        $this->authorizeJadwal($jadwal_periksa);

        return view(
            'dokter.jadwal-periksa.edit',
            ['jadwal' => $jadwal_periksa]
        );
    }

    public function update(Request $request, JadwalPeriksa $jadwal_periksa)
    {
        $this->authorizeJadwal($jadwal_periksa);

        $data = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal_periksa->update($data);

        return redirect()->route('jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy(JadwalPeriksa $jadwal_periksa)
    {
        $this->authorizeJadwal($jadwal_periksa);

        $jadwal_periksa->delete();

        return redirect()->route('jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil dihapus')
            ->with('type', 'success');
    }

    private function authorizeJadwal(JadwalPeriksa $jadwal)
    {
        abort_unless(
            $jadwal->id_dokter == Auth::id(),
            403,
            'Kamu tidak memiliki akses ke jadwal ini.'
        );
    }
}