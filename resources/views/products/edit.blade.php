<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk: {{ $product->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-xl bg-white p-6 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" value="Nama Produk" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required />
                    </div>

                    <div>
                        <x-input-label for="price" value="Harga" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $product->price)" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Perbarui Produk</x-primary-button>
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>