<?php

namespace App\Modules\Products\Services;

use App\Modules\Products\Repositories\ProductRepository;
use App\Modules\Products\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\UploadedFile;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function importProducts(UploadedFile $file)
    {
        Excel::import(new ProductsImport, $file);
    }
}
