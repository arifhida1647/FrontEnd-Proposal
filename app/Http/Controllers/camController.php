<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cam;
use App\Models\Image;
class camController extends Controller
{
    public function index()
    {
        // Ambil data dari model Cam dan Iot
        $data['cam'] = Cam::orderBy('id', 'asc')->get();

        // Kirim data ke view
        return view('campages', $data);
    }
    public function apiStatistik()
    {
        return response()->json([
            'total' => Cam::count(),
            'tersedia' => Cam::whereIn('status', [0])->count(),
            'update' => now()->addHours(7)->toDateTimeString(),
        ]);
    }
}
