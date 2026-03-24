@extends('layouts.dashboard')

@section('title', 'Panel Principal')

@section('dashboard_content')
<div class="mb-6">
    <h2 class="text-lg font-medium text-slate-900">Resumen General</h2>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Ingresos del Día -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col">
        <div class="flex items-center gap-x-3 mb-2">
            <div class="p-2 bg-slate-50 rounded-md text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <h3 class="text-sm font-medium text-slate-500">Ingresos del Día</h3>
        </div>
        <p class="text-2xl font-semibold text-slate-900 mt-1">$450.00</p>
        <p class="text-xs text-emerald-600 mt-2 font-medium">+12% respecto a ayer</p>
    </div>

    <!-- Ingresos del Mes -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col">
        <div class="flex items-center gap-x-3 mb-2">
            <div class="p-2 bg-slate-50 rounded-md text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </div>
            <h3 class="text-sm font-medium text-slate-500">Ingresos del Mes</h3>
        </div>
        <p class="text-2xl font-semibold text-slate-900 mt-1">$12,450.50</p>
        <p class="text-xs text-emerald-600 mt-2 font-medium">+5% este mes</p>
    </div>

    <!-- Ganancias -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col">
        <div class="flex items-center gap-x-3 mb-2">
            <div class="p-2 bg-slate-50 rounded-md text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                </svg>
            </div>
            <h3 class="text-sm font-medium text-slate-500">Ganancias Mes</h3>
        </div>
        <p class="text-2xl font-semibold text-slate-900 mt-1">$3,120.00</p>
        <p class="text-xs text-slate-500 mt-2 font-medium">Margen estimado 25%</p>
    </div>

    <!-- Productos Más Vendidos -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col">
        <div class="flex items-center gap-x-3 mb-2">
            <div class="p-2 bg-slate-50 rounded-md text-slate-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
            <h3 class="text-sm font-medium text-slate-500">Más Vendidos</h3>
        </div>
        <div class="mt-2 space-y-2">
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-700">Coca Cola 3L</span>
                <span class="font-medium text-slate-900">120 und.</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-700">Cerveza Cristal</span>
                <span class="font-medium text-slate-900">85 und.</span>
            </div>
        </div>
    </div>

</div>
@endsection
