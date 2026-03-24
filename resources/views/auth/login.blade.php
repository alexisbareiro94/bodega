@extends('layouts.app')

@section('content')
<div class="flex min-h-full items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Iniciar Sesión</h1>
            <p class="text-sm text-slate-500 mt-2">Ingresa tus credenciales para continuar</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Correo Electrónico</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    required 
                    autofocus
                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 @error('email') border-red-500 @enderror"
                    placeholder="tucorreo@ejemplo.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Contraseña</label>
                <div class="relative mt-1">
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 @error('password') border-red-500 @enderror"
                    >
                    <button type="button" id="togglePassword" class="absolute cursor-pointer inset-y-0 right-0 flex items-center pr-3 text-sm font-medium text-slate-500 hover:text-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="mt-6 flex w-full justify-center rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900 transition-colors">
                Entrar
            </button>
        </form>
    </div>
</div>
@endsection
