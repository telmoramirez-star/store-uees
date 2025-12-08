<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'amount',
        'unit_price',
        'subtotal'
    ];

    protected $casts = [
        'amount' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    /**
     * Relación con el carrito
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Relación con el producto
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
