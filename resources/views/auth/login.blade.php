@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-blue-50 mb-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Acceso a <span class="text-blue-600">VOKO</span></h2>
            <p class="text-gray-500 mt-2 text-sm">Ingresa tus credenciales para continuar</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-900 transition-colors">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-900 transition-colors">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 px-4 rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-300 transition duration-300 shadow-md">
                Ingresar al Sistema
            </button>
        </form>
    </div>
</div>
@endsection
