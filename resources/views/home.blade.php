<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido a SportBosa') }}
        </h2>
    </x-slot>

    <div class="py-10 px-6 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-lg p-8">

            {{-- Encabezado principal --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-700 mb-2">SportBosa</h1>
                <p class="text-gray-600 text-lg">
                    Tu plataforma para reservar y gestionar complejos deportivos en Bosa
                </p>
            </div>

            {{-- Sección de descripción --}}
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/3845/3845825.png" 
                         alt="Reservas deportivas" 
                         class="w-full max-w-sm mx-auto">
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">¿Qué puedes hacer aquí?</h2>
                    <ul class="space-y-3 text-gray-700">
                        <li>🏟️ <b>Reservar canchas</b> de fútbol, baloncesto o tenis en los complejos deportivos de Bosa.</li>
                        <li>📅 <b>Seleccionar horarios</b> disponibles y gestionar tus reservas fácilmente.</li>
                        <li>🏆 <b>Crear y unirte a ligas deportivas</b> para participar en torneos locales.</li>
                        <li>📲 <b>Administrar tus equipos</b> y recibir notificaciones de tus partidos.</li>
                    </ul>
                </div>
            </div>

            {{-- Beneficios --}}
            <div class="mt-10">
                <h3 class="text-2xl font-semibold text-gray-800 text-center mb-6">¿Por qué usar SportBosa?</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-indigo-50 p-6 rounded-xl text-center shadow-sm">
                        <h4 class="font-bold text-indigo-700 mb-2">Fácil y Rápido</h4>
                        <p class="text-gray-600 text-sm">Haz tus reservas en segundos desde tu celular o computador.</p>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-xl text-center shadow-sm">
                        <h4 class="font-bold text-indigo-700 mb-2">Gestión de Ligas</h4>
                        <p class="text-gray-600 text-sm">Organiza campeonatos y mantén el control de equipos y puntajes.</p>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-xl text-center shadow-sm">
                        <h4 class="font-bold text-indigo-700 mb-2">Todo en un solo lugar</h4>
                        <p class="text-gray-600 text-sm">Accede a tus reservas, ligas y equipos desde un único panel.</p>
                    </div>
                </div>
            </div>

            {{-- Botón para ir al sistema --}}
            <div class="mt-10 text-center">
                <a href="{{ route('reservas.index') }}"
                   class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition">
                   Ir a mis Reservas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
