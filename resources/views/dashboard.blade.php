@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Panel de Control General</h2>
    <p class="text-gray-500 text-sm">Resumen en tiempo real del inventario VOKO</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Total de Productos</h3>
            <p class="text-4xl font-black text-gray-800">{{ $totalProducts }}</p>
        </div>
        <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl shadow-inner">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>
    <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Stock Total Acumulado</h3>
            <p class="text-4xl font-black text-gray-800">{{ $totalStock }}</p>
        </div>
        <div class="p-4 bg-green-100 text-green-600 rounded-2xl shadow-inner">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1.5 3 3.5 3h9c2 0 3.5-1 3.5-3V7c0-2-1.5-3-3.5-3h-9C5.5 4 4 5 4 7zM9 11v6m4-6v6"></path></svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Últimos 10 Movimientos
        </h3>
        <a href="{{ route('movements.create') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Ver Todo / Registrar</a>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Cantidad</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Operador</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse($latestMovements as $mov)
            <tr class="hover:bg-blue-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $mov->product->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $mov->type == 'entrada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $mov->type == 'entrada' ? 'Entrada ↗' : 'Salida ↘' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-black">+{{ $mov->quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $mov->user->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-10 text-center text-gray-500 font-medium">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        No hay movimientos registrados.
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
