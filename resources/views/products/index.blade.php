@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Productos</h2>

        {{-- Mostrar botón SOLO si es admin --}}
        @if(auth()->user()->isAdmin())
            <a 
                href="{{ route('products.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Crear Producto
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div class="border rounded-lg shadow p-4 bg-white">

            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>

            <p class="text-sm text-gray-600">Categoría: {{ $product->category }}</p>

            <p class="text-2xl font-bold mt-2">${{ number_format($product->price, 2) }}</p>

            <p class="mt-1">Stock: {{ $product->stock }}</p>

            {{-- Botón según tipo de usuario --}}
            @if(auth()->user()->isAdmin())

                <a 
                    href="{{ route('products.edit', $product->id) }}"
                    class="mt-4 w-full block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
                    Modificar
                </a>

            @else

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <button 
                        class="mt-4 w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 rounded">
                        Añadir al carrito
                    </button>
                </form>

            @endif

        </div>
        @endforeach
    </div>

</div>
@endsection
