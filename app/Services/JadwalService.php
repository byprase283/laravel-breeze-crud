<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JadwalService
{
    protected $baseUrl = 'https://simak.wastu.digital/api/v1/jadwal';
    protected $apiKey = 'pwl20252';

    public function getJadwal($smt = '20252')
    {
        try {
            $response = Http::get($this->baseUrl, [
                'id_smt' => $smt,
                'X-API-KEY' => $this->apiKey
            ]);

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            // Log error jika diperlukan
            return [];
        }
    }
}
