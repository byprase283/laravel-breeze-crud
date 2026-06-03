<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Gempa
{
    /**
     * Mengambil data gempa terkini dari API BMKG
     */
    public static function getTerkini()
    {
        $url = 'https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json';

        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                // Mengambil isi data di dalam objek Infogempa -> gempa
                return $response->json()['Infogempa']['gempa'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            // Jika API BMKG down atau timeout, return array kosong
            return [];
        }
    }
}
