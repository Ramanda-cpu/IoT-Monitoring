<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SensorData;
use App\Events\SensorUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SensorController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang masuk dari ESP
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'humidity'    => 'required|numeric',
            'lux'         => 'required|integer',
        ]);

        // Simpan ke database
        $data = SensorData::create($validated);

        event(new SensorUpdated($data));

        return response()->json([
            'status' => 'Success',
            'message' => 'Data berhasil disimpan',
            'data' => $data
        ], 201);
    }
}