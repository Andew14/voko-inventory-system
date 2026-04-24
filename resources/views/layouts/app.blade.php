<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOKO - Gestión de Inventarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen font-sans">

    @auth
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-4 flex flex-col shadow-xl z-10">
        <h1 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-500 mb-8 tracking-wider flex items-center gap-2">
            📦 VOKO
        </h1>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 hover:bg-gray-800 rounded-lg transition-all duration-200 font-medium">📊 Dashboard</a>
            <a href="{{ route('products.index') }}" class="block px-4 py-3 hover:bg-gray-800 rounded-lg transition-all duration-200 font-medium">🏷️ Productos</a>
            <a href="{{ route('movements.create') }}" class="block px-4 py-3 hover:bg-gray-800 rounded-lg transition-all duration-200 font-medium">🔄 Registrar Movimiento</a>
        </nav>
        <div class="border-t border-gray-700 pt-4 mt-auto">
            <p class="text-sm font-semibold text-gray-300 mb-1 truncate block">👨‍💻 {{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500 mb-4 uppercase tracking-widest">{{ auth()->user()->role }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:text-red-300 hover:bg-red-400 hover:bg-opacity-10 rounded transition">Cerrar Sesión</button>
            </form>
        </div>
    </aside>
    @endauth

    <main class="flex-1 overflow-y-auto p-10 bg-gray-50">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center justify-between animate-pulse">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <ul class="list-disc pl-5 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
