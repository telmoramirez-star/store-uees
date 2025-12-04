@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>
    <div>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </div>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold mb-6">Lista de Usuarios</h1>
        <a href="{{ route('users.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear Nuevo Usuario</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200">
            <thead class="ltr:text-left rtl:text-right">
                <tr class="*:font-medium *:text-gray-900">
                    <th class="px-3 py-2 whitespace-nowrap">Nombre</th>
                    <th class="px-3 py-2 whitespace-nowrap">Correo</th>
                    <th class="px-3 py-2 whitespace-nowrap">Telefono</th>
                    <th class="px-3 py-2 whitespace-nowrap">Dirección</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 *:even:bg-gray-50">
                @foreach ($users as $item)
                    <tr class="*:text-gray-900 *:first:font-medium">
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->email }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->phone }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->address }}</td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>
@endsection
