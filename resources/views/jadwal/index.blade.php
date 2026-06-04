@extends('layouts.app')
@push('css')
@endpush
@section('header')
{{ __('Daftar Jadwal Kuliah') }}
@endsection
@section('content')

<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <form action="{{ url('jadwal') }}" method="GET" class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari mata kuliah atau dosen..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="w-full md:w-64">
            <select name="prodi" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Program Studi --</option>
                @foreach($daftarProdi as $prodi)
                <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>
                    {{ $prodi }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Filter
        </button>
        @if(request('search') || request('prodi'))
        <a href="{{ url('jadwal') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition text-center">
            Reset
        </a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse text-left text-sm text-gray-600">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <th class="px-4 py-3">Hari / Waktu</th>
                    <th class="px-4 py-3">Mata Kuliah</th>
                    <th class="px-4 py-3">SKS</th>
                    <th class="px-4 py-3">Kelas / Ruang</th>
                    <th class="px-4 py-3">Dosen</th>
                    <th class="px-4 py-3">Prodi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($jadwal as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <span class="font-semibold text-gray-900 block">
                            {{ $hariMap[$item['hari']] ?? 'Tidak Diketahui' }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $item['waktu']['mulai'] }} - {{ $item['waktu']['selesai'] }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="font-medium text-blue-600 block">{{ $item['mata_kuliah']['nama'] }}</span>
                        <span class="text-xs text-gray-400">{{ $item['mata_kuliah']['kode'] }}</span>
                    </td>
                    <td class="px-4 py-3 font-semibold">{{ $item['mata_kuliah']['sks'] }}</td>
                    <td class="px-4 py-3">
                        <span class="block">Kelas: {{ $item['kelas'] }}</span>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded">
                            R. {{ $item['ruangan'] }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-900 font-medium">
                        {{ $item['dosen']['nama'] ?: 'Belum Ditentukan' }}
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $item['prodi'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        Tidak ada data jadwal yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
@push('js')
@endpush