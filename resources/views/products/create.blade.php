@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h2 class="text-xl font-bold mb-4">Crear Producto</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="name" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Precio</label>
            <input type="number" step="0.01" name="price" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Categoría</label>
            <input type="text" name="category" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Stock</label>
            <input type="number" name="stock" class="w-full border p-2 rounded">
        </div>

        <button 
            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Guardar
        </button>

    </form>

</div>
@endsection
