<?php
use App\Http\Controllers\homeController;
use App\Http\Controllers\iotController;
use App\Http\Controllers\camController;
use App\Http\Controllers\videoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index']);
Route::get('/iot', [iotController::class, 'index']);
Route::get('/cam', [camController::class, 'index']);
Route::get('/live', [videoController::class, 'index']);
// Route::get('/live', function () {
//     return view('live');
// });
// routes/web.php
Route::get('/api/iot-data', function () {
    $iot = \App\Models\Iot::all(); // sesuaikan model kamu
    return response()->json($iot);
});
Route::get('/api/cam-data', function () {
    $cam = \App\Models\Cam::all(); // sesuaikan model kamu
    return response()->json($cam);
});
Route::get('/api/komparasi-data', function () {
    $komparasi = \App\Models\Komparasi::all(); // sesuaikan model kamu
    return response()->json($komparasi);
});

Route::get('/api/statistik-parkir', [homeController::class, 'apiStatistik']);
