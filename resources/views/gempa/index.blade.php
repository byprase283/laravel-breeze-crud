@extends('layouts.app')
@push('css')
@endpush
@section('header')
{{ __('Daftar Gempa Bumi Terkini') }}
@endsection
@section('content')

@if(empty($daftarGempa))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
    Gagal memuat data dari BMKG atau data sedang kosong.
</div>
@else
<div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Waktu / Jam</th>
                <th class="px-4 py-3 text-left">Lintang / Bujur</th>
                <th class="px-4 py-3 text-left">Magnitude</th>
                <th class="px-4 py-3 text-left">Kedalaman</th>
                <th class="px-4 py-3 text-left">Wilayah</th>
                <th class="px-4 py-3 text-left">Potensi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($daftarGempa as $gempa)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3 text-sm">
                    <span class="font-semibold block text-gray-700">{{ $gempa['Tanggal'] }}</span>
                    <span class="text-gray-500 text-xs">{{ $gempa['Jam'] }}</span>
                </td>
                <td class="px-4 py-3 text-sm text-gray-600">
                    {{ $gempa['Coordinates'] }}<br>
                    <span class="text-xs text-gray-400">({{ $gempa['Lintang'] }}, {{ $gempa['Bujur'] }})</span>
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="px-2 py-1 rounded text-white font-bold bg-amber-500">
                        {{ $gempa['Magnitude'] }} M
                    </span>
                </td>
                <td class="px-4 py-3 text-sm text-gray-600 font-medium">
                    {{ $gempa['Kedalaman'] }}
                </td>
                <td class="px-4 py-3 text-sm text-gray-800 font-medium">
                    {{ $gempa['Wilayah'] }}
                </td>
                <td class="px-4 py-3 text-sm">
                    <span class="text-xs font-semibold px-2 py-1 rounded {{ str_contains($gempa['Potensi'], 'tidak') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $gempa['Potensi'] }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
@push('js')
@endpush