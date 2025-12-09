<?php

namespace App\Modules\Products\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'     => $row['nombre'] ?? $row['name'],
            'price'    => $row['precio'] ?? $row['price'],
            'stock'    => $row['stock'],
            'category' => $row['categoria'] ?? $row['category'],
        ]);
    }

    public function prepareForValidation($data, $index)
    {
        // Normalización de claves para soportar encabezados en inglés o español
        $data['nombre'] = $data['nombre'] ?? $data['name'] ?? null;
        $data['precio'] = $data['precio'] ?? $data['price'] ?? null;
        $data['categoria'] = $data['categoria'] ?? $data['category'] ?? null;
        
        return $data;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria' => 'required|string',
        ];
    }
}
