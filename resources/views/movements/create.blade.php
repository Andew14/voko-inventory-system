@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">🔄 Registrar Movimiento</h2>
        <p class="text-gray-500 text-sm">Actualiza el inventario realizando una entrada o salida</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('movements.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Producto</label>
                <select name="product_id" required class="block w-full px-4 py-3 border border-gray-300 bg-gray-50 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800 font-medium cursor-pointer">
                    <option value="">Seleccione un producto del catálogo...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->sku }} | {{ $product->name }} — (Stock actual: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tipo de Movimiento</label>
                    <div class="relative">
                        <select name="type" required class="block w-full px-4 py-3 border border-gray-300 bg-gray-50 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800 font-bold appearance-none cursor-pointer">
                            <option value="entrada" class="text-green-600">Entrada de Stock (+)</option>
                            <option value="salida" class="text-red-600">Salida de Stock (-)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cantidad</label>
                    <input type="number" name="quantity" min="1" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-900 font-black text-lg transition-colors placeholder-gray-400" placeholder="0">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones <span class="text-gray-400 font-normal">(Opcional)</span></label>
                <textarea name="observations" rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-900 transition-colors placeholder-gray-400" placeholder="Motivo de la operación, número de guía, etc..."></textarea>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black py-4 px-4 rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:ring-blue-300 transition duration-300 shadow-md text-lg flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Confirmar Operación
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
