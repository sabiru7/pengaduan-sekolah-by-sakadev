<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Laporan;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary (untuk chart / card)
        $summary = [
    'aktivitas_user' => Activity::count(),
    'total_user' => User::count(),
    'total_tanggapan' => Tanggapan::count(),
    'total_pengaduan' => Pengaduan::count(),
];

        // Chart tambahan (opsional: laporan per bulan)
        $laporanPerBulan = Pengaduan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $data = [
            'title' => 'Dashboard',
            'activities' => Activity::latest()->limit(5)->get(), // biar gak berat
            'summary' => $summary,
            'laporanPerBulan' => $laporanPerBulan,
        ];

        return view('backend.pages.dashboard', $data);
    }
}