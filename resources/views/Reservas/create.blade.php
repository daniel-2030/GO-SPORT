<x-app-layout>
    <br>
    <br>
    <br>
    <br>
        <div class="py-8 px-6 bg-gray-100 min-h-screen">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow-lg">
                
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('') }}
                </h2>
                <br>
            @if ($errors->any())
                <div class="mb-6 p-4 border border-red-400 bg-red-100 text-red-700 rounded-xl shadow-sm">
                    <p class="font-bold mb-2">Se encontraron los siguientes errores:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(isset($cancha))
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8 p-4 bg-indigo-50 rounded-xl shadow-inner animate-fadeIn">
                <img src="{{ asset($cancha->foto) }}"
                    alt="{{ $cancha->nombre }}"
                    class="w-full md:w-36 h-36 object-cover rounded-lg shadow-md"
                    onerror="this.onerror=null;this.src='https://placehold.co/400x250/374151/FFFFFF?text=Cancha';">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $cancha->nombre }}</h3>
                    {{-- CORRECCIÓN CLAVE AQUÍ: Accediendo a 'calle' en lugar de 'direccion' --}}
                    <p class="text-gray-600 mb-1">
                        📍 Dirección: 
                        **{{ $cancha->direccion->calle ?? 'Dirección no disponible' }}**
                        ({{ $cancha->direccion->barrio ?? 'N/A' }})
                    </p>
                    <p class="text-gray-600 mb-2">🏷️ Deporte: {{ $cancha->deporte->nombre ?? 'N/A' }} | Capacidad: {{ $cancha->capacidad }}</p>
                    <p class="text-xl font-extrabold text-indigo-700">Precio/hora: ${{ number_format($cancha->precio_hora, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <form id="reservaForm" class="space-y-4" action="{{ route('reservas.store') }}" method="POST">
                @csrf
                
                <input type="hidden" name="id_cancha" value="{{ $cancha->id_cancha }}">

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Usuario que Reserva</label>
                    <div class="relative">
                        <input type="text" value="{{ auth()->user()->nombre }}" readonly
                               class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100 cursor-not-allowed pl-10">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V7a2 2 0 014 0v4"></path></svg>
                    </div>
                </div>

@php
    $fechaActual = date('Y-m-d');
    $fechaMaxima = date('Y-m-d', strtotime('+8 days'));
@endphp

<div>
    <label for="fecha_reserva" class="block text-gray-700 font-semibold mb-1">Fecha</label>
    <input type="date" name="fecha_reserva" id="fecha_reserva"
           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
           value="{{ old('fecha_reserva', $fechaActual) }}" 
           min="{{ $fechaActual }}" 
           max="{{ $fechaMaxima }}" 
           required>
    @error('fecha_reserva')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<div class="grid grid-cols-3 gap-4 mt-4">
    <!-- Hora de inicio -->
    <div>
        <label for="hora_inicio" class="block text-gray-700 font-semibold mb-1">Hora inicio</label>
        <select name="hora_inicio" id="hora_inicio"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                required>
            <option value="">-- Seleccionar --</option>
            @foreach ($horarios as $hora)
                @php
                    $isOccupied = in_array($hora, $reservas_hoy);
                @endphp
                <option value="{{ $hora }}" 
                        {{ old('hora_inicio') == $hora ? 'selected' : '' }}
                        {{ $isOccupied ? 'disabled' : '' }}
                        class="{{ $isOccupied ? 'bg-red-100 text-gray-500' : '' }}">
                    {{ $hora }} {{ $isOccupied ? '(OCUPADA HOY)' : '' }}
                </option>
            @endforeach
        </select>
        @error('hora_inicio')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
        <!-- Duración -->
        <div>
            <label for="duracion" class="block text-gray-700 font-semibold mb-1">Duración (horas)</label>
            <select id="duracion" name="duracion"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
            required>
            <option value="">-- Seleccionar --</option>
            <option value="1">1 hora</option>
            <option value="2">2 horas</option>
        </select>
    </div>
<br>
    <!-- Hora de fin -->
    <div>
        <label for="hora_fin" class="block text-gray-700 font-semibold mb-1">Hora fin</label>
        <input type="text" name="hora_fin" id="hora_fin"
               readonly
               class="w-full border-gray-300 bg-gray-100 rounded-lg shadow-sm cursor-not-allowed">
    </div>
</div>

<!-- Script para cálculo automático -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const horaInicio = document.getElementById('hora_inicio');
        const duracion = document.getElementById('duracion');
        const horaFin = document.getElementById('hora_fin');

        function calcularHoraFin() {
            const inicio = horaInicio.value;
            const horas = parseInt(duracion.value);

            if (!inicio || !horas) {
                horaFin.value = '';
                return;
            }

            const [h, m] = inicio.split(':').map(Number);
            const fin = new Date();
            fin.setHours(h + horas, m);

            const hh = String(fin.getHours()).padStart(2, '0');
            const mm = String(fin.getMinutes()).padStart(2, '0');
            horaFin.value = `${hh}:${mm}`;
        }

        horaInicio.addEventListener('change', calcularHoraFin);
        duracion.addEventListener('change', calcularHoraFin);
    });
</script>

                
                @error('reserva')<p class="text-red-600 text-base font-bold text-center pt-2">{{ $message }}</p>@enderror

                <button type="submit" id="submitButton" class="w-full bg-indigo-600 text-white px-4 py-3 rounded-lg hover:bg-indigo-700 transition font-bold shadow-md transform hover:scale-[1.01]">
                    Confirmar Reserva (Pendiente de Pago)
                </button>
            </form>

            @else
            <div class="text-center py-8">
                <p class="text-gray-700 mb-4">La cancha seleccionada no está disponible o no existe.</p>
                <a href="{{ route('reservas.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-500">
                    Ver Canchas Disponibles
                </a>
            </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fadeIn { 0% { opacity: 0; transform: translateY(20px);} 100% {opacity:1; transform: translateY(0);} }
        .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
    </style>
</x-app-layout>