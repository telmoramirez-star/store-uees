@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h2 class="text-xl font-bold mb-4">Editar Producto</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Nombre</label>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name', $product->name) }}" 
                class="w-full border p-2 rounded"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Precio</label>
            <input 
                type="number" 
                step="0.01" 
                name="price" 
                value="{{ old('price', $product->price) }}" 
                class="w-full border p-2 rounded"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Categoría</label>
            <input 
                type="text" 
                name="category" 
                value="{{ old('category', $product->category) }}" 
                class="w-full border p-2 rounded"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Stock</label>
            <input 
                type="number" 
                name="stock" 
                value="{{ old('stock', $product->stock) }}" 
                class="w-full border p-2 rounded"
                required
            >
        </div>

        <div class="flex gap-3">
            <button 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar
            </button>

            <a 
                href="{{ route('products.index') }}" 
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>

    </form>

</div>
@endsection
