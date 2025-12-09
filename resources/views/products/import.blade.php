@extends('layouts.app')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Importar Productos</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Sube un archivo Excel (.xlsx, .xls) o CSV con las columnas: <strong>Nombre, Precio, Stock,
                    Categoria</strong>.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('products.import.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div>
                    <label for="file" class="block text-sm/6 font-medium text-gray-900">Archivo Excel</label>
                    <div class="mt-2">
                        <input id="file" type="file" name="file" required accept=".xlsx, .xls, .csv"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Importar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection