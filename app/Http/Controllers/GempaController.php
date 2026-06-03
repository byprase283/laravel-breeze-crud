<?php

namespace App\Http\Controllers;

use App\Models\Gempa;
use Illuminate\Http\Request;

class GempaController extends Controller
{
    /**
     * Menampilkan daftar gempa terkini
     */
    public function index()
    {
        // Panggil data dari Model
        $daftarGempa = Gempa::getTerkini();

        // Kirim data ke view 'gempa.index'
        return view('gempa.index', compact('daftarGempa'));
    }
}
