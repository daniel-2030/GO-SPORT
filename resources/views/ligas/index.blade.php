<x-app-layout>
    <br>
    <br>
    <div class="max-w-6xl mx-auto py-8">
        <!-- Header con botón de administración -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">🏆 Ligas Disponibles</h1>
                <!-- Botón para ir al CRUD -->
            <a href="{{ route('ligas.manage') }}" class="btn btn-primary">Gestionar ligas</a>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($ligas as $liga)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $liga->nombre }}</h2>
                        <p class="text-sm text-gray-500 mb-2">Temporada: {{ $liga->temporada->nombre ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($liga->descripcion, 80) }}</p>
                        <a href="{{ route('ligas.show', $liga->id_liga) }}" 
                            class="block text-center bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-150 text-sm font-medium">                           Ver Detalles
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No hay ligas disponibles en este momento.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $ligas->links() }}
        </div>
    </div>

    <style>
        .text-gray-800 {
            color: #1f2937 !important;
        }
    </style>
</x-app-layout>