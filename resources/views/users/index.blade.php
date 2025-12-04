@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

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
                    <th class="px-3 py-2 whitespace-nowrap">Estado</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 *:even:bg-gray-50">
                @foreach ($users as $item)
                    <tr class="*:text-gray-900 *:first:font-medium">
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->email }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->phone }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ $item->address }}</td>
                        <td class="px-3 py-2 whitespace-nowrap"><span class="font-medium p-1 rounded {{ $item->status == 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $item->status }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
