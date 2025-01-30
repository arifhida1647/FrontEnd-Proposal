<?php

namespace App\Http\Controllers;

use App\Models\Cam;
use App\Models\Iot;
use App\Models\Image;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari model Cam dan Iot
        $data['cam'] = Cam::orderBy('id', 'asc')->get();
        $data['iot'] = Iot::orderBy('id', 'asc')->get();
        $data['images'] = Image::orderBy('id', 'desc')->first();
        $cams = $data['cam'];
        $iots = $data['iot'];

        // Inisialisasi variabel untuk menghitung jumlah bothStatus yang bernilai 2
        $countBothStatus0 = 0;
        $countBothStatus2 = 0;
        $countBothStatus1 = 0;
        
        // Gabungkan data Cam dan Iot berdasarkan ID
        $data['combinedData'] = $cams->mapWithKeys(function ($cam) use ($iots, &$countBothStatus0,&$countBothStatus1,&$countBothStatus2) {
            $iot = $iots->firstWhere('id', $cam->id);

            // Tentukan both_status berdasarkan kondisi baru
            if ($iot) {
                if ($cam->status == 0 && $iot->status == 0) {
                    $bothStatus = 0;
                } elseif ($cam->status == 0 || $iot->status == 0) {
                    $bothStatus = 2;
                } else {
                    $bothStatus = 1;
                }
            } else {
                // Jika tidak ada data iot, anggap both_status sebagai 0
                $bothStatus = 2;
            }

            // Tambahkan ke counter jika bothStatus adalah 2
            if ($bothStatus == 0) {
                $countBothStatus0++;
            }
            if ($bothStatus == 1) {
                $countBothStatus1++;
            }
            if ($bothStatus == 2) {
                $countBothStatus2++;
            }

            return [
                $cam->id => [
                    'id' => $cam->id,
                    'slot' => $cam->slot,
                    'cam_status' => $cam->status,
                    'iot_status' => $iot ? $iot->status : null,
                    'both_status' => $bothStatus,
                ],
            ];
        });

        // Tambahkan hasil perhitungan ke dalam data yang dikirim ke view
        $data['countBothStatus0'] = $countBothStatus0;
        $data['countBothStatus2'] = $countBothStatus2;
        $data['total'] = $countBothStatus2 + $countBothStatus0 + $countBothStatus1;


        // Kirim data ke view
        return view('app', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatusCam(Request $request, string $id)
    {

    }


    public function updateStatusIot(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
