@extends('layouts.dashboard')

@section('title', 'Agregar Producto')

@section('dashboard_content')
<!-- Controles Superiores -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <a href="{{ route('products.index') }}" class="text-slate-500 hover:text-slate-900 transition-colors flex items-center gap-x-1" title="Volver a Productos">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span class="text-sm font-medium">Volver</span>
    </a>
</div>

<!-- Formulario de Creación -->
<div class="bg-white border border-slate-200 rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 rounded-t-lg">
        <h2 class="text-lg font-medium text-slate-900">Detalles del Producto</h2>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Información Básica -->
            <div class="space-y-6">
                <!-- Imagen con Preview -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Imagen del Producto</label>
                    <div class="flex items-center gap-x-6">
                        <div class="relative h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-slate-300 bg-slate-100 flex items-center justify-center">
                            <img id="image_preview" src="#" alt="Vista previa" class="h-full w-full object-cover hidden">
                            <svg id="image_placeholder" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <button type="button" id="remove_image_btn" class="hidden absolute top-0 right-0 rounded-full p-1 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Eliminar imagen">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex flex-col items-start gap-y-2">
                            <div class="flex items-center gap-x-3">
                                <label for="image_input" class="cursor-pointer rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-colors">
                                    Seleccionar archivo
                                </label>
                                <button type="button" id="remove_image_btn" class="hidden rounded-full p-1 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Eliminar imagen">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <input id="image_input" name="image" type="file" class="sr-only" accept="image/*">
                            <p class="text-xs leading-5 text-slate-500">PNG, JPG, GIF hasta 2MB</p>
                        </div>
                    </div>
                    @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Nombre del Producto</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 @error('name') border-red-500 @enderror">
                    @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="barcode" class="block text-sm font-medium text-slate-700">Código de Barras</label>
                    <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}"
                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 @error('barcode') border-red-500 @enderror">
                    @error('barcode') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-700">Categoría</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select id="category_id" name="category_id" class="block w-full rounded-none rounded-l-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                                <option value="">Seleccione...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="btn_add_category" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-colors">
                                <svg class="-ml-0.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                        @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="distributor_id" class="block text-sm font-medium text-slate-700">Distribuidor</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select id="distributor_id" name="distributor_id" class="block w-full rounded-none rounded-l-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                                <option value="">Seleccione...</option>
                                @foreach($distributors as $distributor)
                                    <option value="{{ $distributor->id }}" {{ old('distributor_id') == $distributor->id ? 'selected' : '' }}>{{ $distributor->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="btn_add_distributor" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-colors">
                                <svg class="-ml-0.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                        @error('distributor_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Descripción (Opcional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Precios y Stock -->
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 border border-slate-200 rounded-md">
                    <div>
                        <label for="cost" class="block text-sm font-medium text-slate-700">Costo de Compra</label>
                        <div class="relative mt-1">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-slate-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" step="0.01" name="cost" id="product_cost" value="{{ old('cost', '0.00') }}" required
                                class="block w-full rounded-md border border-slate-300 pl-7 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 @error('cost') border-red-500 @enderror">
                        </div>
                        @error('cost') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700">Precio de Venta</label>
                        <div class="relative mt-1">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-slate-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" step="0.01" name="price" id="product_price" value="{{ old('price', '0.00') }}" required
                                class="block w-full rounded-md border border-slate-300 pl-7 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 @error('price') border-red-500 @enderror">
                        </div>
                        @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Margen Estimado (JS Controlado) -->
                <div>
                    <span class="text-sm text-slate-500">Margen Estimado:</span>
                    <span id="profit_margin" class="ml-2 font-semibold text-emerald-600">0.00%</span>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="stock" class="block text-sm font-medium text-slate-700">Stock Actual</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required
                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                        @error('stock') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="stock_min" class="block text-sm font-medium text-slate-700">Stock Mínimo</label>
                        <input type="number" name="stock_min" id="stock_min" value="{{ old('stock_min', 0) }}"
                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                    </div>
                    <div>
                        <label for="iva" class="block text-sm font-medium text-slate-700">IVA (%)</label>
                        <select name="iva" id="iva"
                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">                            
                            <option selected value="10">10%</option>
                            <option value="5">5%</option>
                        </select>
                        {{-- <input type="number" step="0.1" name="iva" id="iva" value="{{ old('iva', 18.0) }}"
                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900"> --}}
                    </div>
                </div>

                <div class="pt-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                        <span class="ml-2 text-sm text-slate-700">Producto Activo (Visible para ventas)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-x-3">
            <a href="{{ route('products.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-800 transition-colors">
                Guardar Producto
            </button>
        </div>
    </form>
</div>

<!-- Modal Categoría -->
<div id="modal_category" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity opacity-0" id="modal_category_backdrop"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="modal_category_panel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <h3 class="text-base font-semibold leading-6 text-slate-900 mb-4" id="modal-title">Agregar Nueva Categoría</h3>
                    <form id="form_category" data-url="{{ route('categories.api.store') }}">
                        <div>
                            <label for="category_name" class="block text-sm font-medium text-slate-700">Nombre</label>
                            <input type="text" id="category_name" name="name" required class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                            <p id="error_category_name" class="mt-1 text-sm text-red-500 hidden"></p>
                        </div>
                    </form>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" id="btn_save_category" class="inline-flex w-full justify-center rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 sm:ml-3 sm:w-auto transition-colors">Guardar</button>
                    <button type="button" class="close-modal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors" data-target="modal_category">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Distribuidor -->
<div id="modal_distributor" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity opacity-0" id="modal_distributor_backdrop"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div id="modal_distributor_panel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <h3 class="text-base font-semibold leading-6 text-slate-900 mb-4" id="modal-title">Agregar Nuevo Distribuidor</h3>
                    <form id="form_distributor" data-url="{{ route('distributors.api.store') }}">
                        <div class="space-y-4">
                            <div>
                                <label for="distributor_name" class="block text-sm font-medium text-slate-700">Nombre</label>
                                <input type="text" id="distributor_name" name="name" required class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                                <p id="error_distributor_name" class="mt-1 text-sm text-red-500 hidden"></p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="distributor_phone" class="block text-sm font-medium text-slate-700">Teléfono</label>
                                    <input type="number" id="distributor_phone" name="phone" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                                </div>
                                <div>
                                    <label for="distributor_email" class="block text-sm font-medium text-slate-700">Email</label>
                                    <input type="email" id="distributor_email" name="email" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                                </div>
                            </div>
                            <div>
                                <label for="distributor_address" class="block text-sm font-medium text-slate-700">Dirección</label>
                                <input type="text" id="distributor_address" name="address" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" id="btn_save_distributor" class="inline-flex w-full justify-center rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 sm:ml-3 sm:w-auto transition-colors">Guardar</button>
                    <button type="button" class="close-modal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors" data-target="modal_distributor">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
