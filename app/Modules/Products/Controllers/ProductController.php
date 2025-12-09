<?php

namespace App\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Products\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validar datos
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|integer'
        ]);

        $this->productService->createProduct($data);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function importView()
    {
        return view('products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            $this->productService->importProducts($request->file('file'));
            return redirect()->route('products.index')->with('success', 'Productos importados correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar productos: ' . $e->getMessage());
        }
    }
}
