<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link; // tambahkan ini

class videoController extends Controller
{
    public function index()
    {
        $latestLink = Link::orderBy('created_at', 'desc')->first();
        return view('live', compact('latestLink'));
    }
}
