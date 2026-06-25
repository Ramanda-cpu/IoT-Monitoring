<?php

namespace App\Http\Controllers;

use App\Models\SensorData;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data terbaru dari sensor
        $latestData = SensorData::latest()->first();
        
        // Ambil 10 data terakhir untuk riwayat/grafik
        $historyData = SensorData::latest()->take(10)->get()->reverse();

        return view('dashboard', compact('latestData', 'historyData'));
    }
}