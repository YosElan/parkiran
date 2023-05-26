<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}


// Menyimpan data ke cache selama 10 menit
Cache::put('key', 'value', 10);

// Mengambil data dari cache
$value = Cache::get('key');

// Mengambil data dari cache atau memasukkan data baru jika tidak ada di cache
$value = Cache::remember('key', 10, function () {
    // Logika untuk menghasilkan data baru jika tidak ada di cache
    return 'new value';
});

// Menghapus data dari cache
Cache::forget('key');
