@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-7xl">
        <h1 class="text-3xl font-bold mb-6">Registros del Sistema</h1>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="p-4 font-semibold text-gray-600">ID</th>
                            <th class="p-4 font-semibold text-gray-600">Usuario</th>
                            <th class="p-4 font-semibold text-gray-600">Acción</th>
                            <th class="p-4 font-semibold text-gray-600">Descripción</th>
                            <th class="p-4 font-semibold text-gray-600">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($logs as $log)
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-4 text-gray-500">#{{ $log->id }}</td>
                                            <td class="p-4">
                                                <div class="font-medium text-gray-900">{{ $log->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $log->user->email }}</div>
                                            </td>
                                            <td class="p-4">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded-full 
                                                    {{ $log->action === 'ADD_TO_CART' ? 'bg-green-100 text-green-800' :
                            ($log->action === 'REMOVE_FROM_CART' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $log->action }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-sm text-gray-600 font-mono">
                                                {{ Str::limit(json_encode($log->description), 50) }}
                                            </td>
                                            <td class="p-4 text-sm text-gray-500">
                                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    No hay registros disponibles.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
                <div class="p-4 border-t">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection