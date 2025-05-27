<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iot;
class iotController extends Controller
{
    //
    public function index()
    {
        // Ambil data dari model Cam dan Iot
        $data['iot'] = Iot::orderBy('id', 'asc')->get();

        // Kirim data ke view
        return view('iotpages', $data);
    }
    public function iot2()
    {
        // Ambil data dari model Cam dan Iot
        $data['iot'] = Iot::orderBy('id', 'asc')->get();

        // Kirim data ke view
        return view('iotpages2', $data);
    }
    public function apiStatistik()
    {
        return response()->json([
            'total' => Iot::count(),
            'tersedia' => Iot::whereIn('status', [0])->count(),
            'update' => now()->addHours(7)->toDateTimeString(),
        ]);
    }
}
