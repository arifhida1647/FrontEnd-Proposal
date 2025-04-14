<?php

namespace App\Http\Controllers;

use App\Models\Komparasi;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari database lokal
        $data['combinedData'] = Komparasi::orderBy('id', 'asc')->get();
        $data['total'] = Komparasi::count();
    
        // Hitung jumlah status berdasarkan kategori
        $data['tersedia'] = Komparasi::whereIn('status', [0, 2, 6])->count();
        $data['kemungkinanTersedia'] = Komparasi::whereIn('status', [1, 3])->count();
        $data['tidakTersedia'] = Komparasi::whereIn('status', [4, 5, 7, 8])->count();
    
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
