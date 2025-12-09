@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-7xl">
        <h1 class="text-3xl font-bold mb-6">Carrito de compras</h1>

        @if($cart && count($cart) > 0)
            <div class="flex gap-6">
                <!-- Cart Items -->
                <div class="flex-1">
                    <div class="bg-white rounded-lg">
                        <!-- Header -->
                        <div class="border-b p-4">
                            <span class="float-right text-sm font-semibold">Precio</span>
                        </div>

                        <!-- Cart Items -->
                        @foreach($cart as $item)
                            <div class="border-b p-4" data-cart-item="{{ $item->id }}">
                                <div class="flex gap-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                                class="w-32 h-32 object-contain">
                                        @else
                                            <div class="w-32 h-32 bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">No image</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <h3 class="text-base font-normal mb-1">
                                            <a href="#"
                                                class="text-blue-600 hover:text-orange-600 hover:underline">{{ $item->product->name }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-700 mb-2">{{ $item->product->description ?? '' }}</p>

                                        @if($item->product->stock > 0)
                                            <p class="text-sm text-green-700 font-semibold mb-1">Disponible</p>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="flex items-center gap-3 text-sm">
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center bg-gray-100 rounded-lg border border-gray-300 shadow-sm">
                                                <button class="btn-decrease px-3 py-1 hover:bg-gray-200 rounded-l-lg"
                                                    data-item-id="{{ $item->id }}" data-unit-price="{{ $item->unit_price }}">
                                                    <span class="text-base">−</span>
                                                </button>
                                                <span
                                                    class="quantity px-4 py-1 bg-white border-x border-gray-300 min-w-[40px] text-center">{{ $item->amount }}</span>
                                                <button class="btn-increase px-3 py-1 hover:bg-gray-200 rounded-r-lg"
                                                    data-item-id="{{ $item->id }}" data-unit-price="{{ $item->unit_price }}">
                                                    <span class="text-base">+</span>
                                                </button>
                                            </div>
                                            <span class="text-gray-300">|</span>

                                            <!-- Delete Button -->
                                            <button class="btn-remove text-blue-600 hover:text-orange-600 hover:underline"
                                                data-item-id="{{ $item->id }}">
                                                Eliminar
                                            </button>

                                            <span class="text-gray-300">|</span>

                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="flex-shrink-0 text-right pt-2">
                                        <p class="text-2xl font-bold">${{ number_format($item->unit_price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Subtotal -->
                        <div class="p-4 text-right">
                            <p class="text-lg">
                                Subtotal ({{ $itemCount }} item{{ $itemCount > 1 ? 's' : '' }}):
                                <span class="font-bold text-xl">${{ number_format($total, 2) }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Checkout Sidebar -->
                <div class="w-80 flex-shrink-0">
                    <div class="bg-white rounded-lg p-4 sticky top-4">
                        <p class="text-lg mb-4">
                            Subtotal ({{ $itemCount }} item{{ $itemCount > 1 ? 's' : '' }}):
                            <span class="font-bold text-xl">${{ number_format($total, 2) }}</span>
                        </p>
                        <div class="flex items-start gap-2 mb-4">
                            <input type="checkbox" id="gift" class="mt-1">
                            <label for="gift" class="text-sm">This order contains a gift</label>
                        </div>
                        <button
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-normal py-2 px-4 rounded-lg shadow-sm">
                            Proceed to checkout
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-xl text-gray-600 mb-4">Your cart is empty</p>
                <a href="/" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Increase quantity
                document.querySelectorAll('.btn-increase').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const itemId = this.dataset.itemId;
                        const unitPrice = this.dataset.unitPrice;
                        const quantitySpan = this.parentElement.querySelector('.quantity');
                        const currentQty = parseInt(quantitySpan.textContent);

                        updateQuantity(itemId, currentQty + 1, unitPrice);
                    });
                });

                // Decrease quantity
                document.querySelectorAll('.btn-decrease').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const itemId = this.dataset.itemId;
                        const unitPrice = this.dataset.unitPrice;
                        const quantitySpan = this.parentElement.querySelector('.quantity');
                        const currentQty = parseInt(quantitySpan.textContent);

                        if (currentQty > 1) {
                            updateQuantity(itemId, currentQty - 1, unitPrice);
                        }
                    });
                });

                // Remove item
                document.querySelectorAll('.btn-remove').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const itemId = this.dataset.itemId;
                        removeItem(itemId);
                    });
                });

                function updateQuantity(itemId, quantity, unitPrice) {
                    fetch(`/cart/${itemId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ quantity, unit_price: unitPrice })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                }

                function removeItem(itemId) {
                    if (confirm('Are you sure you want to remove this item?')) {
                        fetch(`/cart/${itemId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                }
                            });
                    }
                }
            });
        </script>
    @endpush
@endsection