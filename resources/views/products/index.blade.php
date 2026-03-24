@extends('layouts.dashboard')

@section('title', 'Gestión de Productos')

@section('dashboard_content')
<!-- Controles (Volver y Agregar) dentro de la ventana de contenido -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <a href="{{ route('menu') }}" class="text-slate-500 hover:text-slate-900 transition-colors flex items-center gap-x-1" title="Volver al Menú">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span class="text-sm font-medium">Volver</span>
    </a>

    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <!-- Buscador -->
        <div class="relative w-full sm:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input type="text" id="search-input" value="{{ request('search') }}" placeholder="Buscar por nombre o SKU..." class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-md leading-5 bg-white placeholder-slate-500 focus:outline-none focus:placeholder-slate-400 focus:ring-1 focus:ring-slate-900 focus:border-slate-900 sm:text-sm transition-colors">
        </div>

        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-x-2 justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Agregar
        </a>
    </div>
</div>

<!-- Contenido Principal: Tabla de Productos -->
<div class="bg-white border border-slate-200 rounded-lg overflow-hidden flex flex-col shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-6 py-3 font-semibold text-slate-900">SKU</th>
                    <th scope="col" class="px-6 py-3 font-semibold text-slate-900">
                        <span class="sr-only">Imagen</span>
                    </th>
                    <th scope="col" class="px-6 py-3 font-semibold text-slate-900">Nombre</th>
                    <th scope="col" class="px-6 py-3 font-semibold text-slate-900">Categoría</th>
                    <th scope="col" class="px-6 py-3 text-right font-semibold text-slate-900">Precio</th>
                    <th scope="col" class="px-6 py-3 text-right font-semibold text-slate-900">Stock</th>
                    <th scope="col" class="px-6 py-3 text-center font-semibold text-slate-900">Acciones</th>
                </tr>
            </thead>
            <tbody id="products-table-body" class="divide-y divide-slate-200 bg-white">
                @include('products.partials.table')
            </tbody>
        </table>
    </div>
    
    <!-- Paginación Laravel predeterminada (estilo Tailwind) -->
    <div id="pagination-container">
        @if($products->hasPages())
            <div class="bg-white px-6 py-4 border-t border-slate-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
