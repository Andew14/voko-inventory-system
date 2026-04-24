@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">📋 Catálogo de Productos</h2>
        <p class="text-gray-500 text-sm">Gestiona el inventario central</p>
    </div>
</div>

<div class="flex flex-col lg:flex-row gap-8 items-start">
    <!-- Tabla de Productos -->
    <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden w-full">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Stock</th>
                        @if(auth()->user()->role === 'administrador')
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono bg-gray-50 rounded m-2 inline-block px-2">{{ $product->sku }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center justify-center min-w-[3rem] px-3 py-1 rounded-full text-sm font-black {{ $product->stock == 0 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        @if(auth()->user()->role === 'administrador')
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('ATENCIÓN: Cuidado al eliminar, ¿Seguro que deseas eliminar este producto? Esto eliminará también su historial.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold px-3 py-2 rounded-lg hover:bg-red-50 transition border border-transparent hover:border-red-200">🗑️ Borrar</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulario Agregar Producto (Solo Admin) -->
    @if(auth()->user()->role === 'administrador')
    <div class="w-full lg:w-1/3 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800">Nuevo Producto</h3>
        </div>
        
        <form action="{{ route('products.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nombre del Producto</label>
                <input type="text" name="name" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 text-gray-900 transition-colors placeholder-gray-400" placeholder="Ej. Mouse Logitech G502">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Código SKU</label>
                <input type="text" name="sku" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 text-gray-900 transition-colors uppercase placeholder-gray-400" placeholder="MOU-LOG-G502">
                <p class="text-xs text-gray-500 mt-1">Debe ser único en el sistema.</p>
            </div>
            <button type="submit" class="w-full bg-gray-900 text-white font-bold py-3 px-4 rounded-xl hover:bg-gray-800 transition shadow-md mt-6">
                Guardar Producto
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
