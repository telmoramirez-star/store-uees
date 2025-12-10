@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestión de Pedidos Pendientes</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                @if($orders->isEmpty())
                    <p>No hay pedidos pendientes.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                                    </td>
                                    <td>
                                        <!-- Future: Add View Details or Update Status buttons -->
                                        <button class="btn btn-sm btn-info" disabled>Ver Detalles</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection