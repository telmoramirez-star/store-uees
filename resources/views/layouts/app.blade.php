<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Store UEES') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-gray-800">Store UEES</a>
                <div class="flex gap-4">
                    @inject('cartService', 'App\Modules\Carts\Services\CartService')
                    @php
                        $cartCount = 0;
                        if (auth()->check()) {
                            $cartSummary = $cartService->getCartSummary();
                            $cartCount = $cartSummary['count'];
                        }
                    @endphp
                    <a href="/cart" class="text-gray-600 hover:text-gray-900">
                        🛒 Carrito
                        @if($cartCount > 0)
                            <span class="bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @if(auth()->user()?->isAdmin())
                        <a href="/users" class="text-gray-600 hover:text-gray-900">Usuarios</a>
                        <a href="{{ route('logs.index') }}" class="text-gray-600 hover:text-gray-900">Logs</a>
                    @endif
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Cerrar Sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Iniciar Sesión</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>