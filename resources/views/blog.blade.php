<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 13 Relasi Demo</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Sistem Relasi Blog</h1>

            <form action="{{ route('blog.store') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded shadow transition">
                    + Generate Post Baru
                </button>
            </form>
        </div>

        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-6 text-sm shadow">
            {{ session('success') }}
        </div>
        @endif

        <div class="space-y-4">
            @forelse($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h2>
                <p class="text-gray-600 text-sm mb-4">{{ $post->content }}</p>

                <div class="border-t pt-3 flex flex-wrap gap-y-2 justify-between text-xs text-gray-500">
                    <div>
                        <p>Penulis: <span class="font-semibold text-gray-700">{{ $post->user->name }}</span></p>
                        <p>No. Passport: <span class="font-mono bg-gray-200 text-gray-800 px-1.5 py-0.5 rounded">{{ $post->user->passport->passport_number ?? 'Tidak ada' }}</span></p>
                    </div>

                    <div class="flex items-center gap-1">
                        <span class="font-medium text-gray-700">Kategori:</span>
                        @foreach($post->categories as $category)
                        <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full font-medium">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center bg-white p-10 rounded shadow text-gray-400 italic">
                Belum ada data artikel. Klik tombol "+ Generate Post Baru" di atas!
            </div>
            @endforelse
        </div>
    </div>

</body>

</html>