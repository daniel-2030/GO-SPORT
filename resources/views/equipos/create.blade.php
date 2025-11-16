<x-app-layout>
    <br>
    <br>
    <br>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl mb-4">Crear Nuevo Equipo</h1>
                
                <form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">Nombre del Equipo *</label>
                        <input type="text" name="nombre_equipo" class="w-full border rounded px-3 py-2" required>
                    </div>

                        <!-- Escudo -->
    <div class="mb-4">
        <label for="escudo" class="block text-sm font-medium text-gray-700 mb-2">
            Subir Escudo
        </label>
        <input type="file" id="escudo" name="escudo" accept="image/*"
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <p class="text-sm text-gray-500 mt-1">Formatos: JPG, PNG, GIF (Máx. 2MB)</p>
        @error('escudo')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

                    <div class="mb-4">
                        <label for="fundacion" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha de Fundación
                        </label>
                        <input type="date" 
                            id="fundacion" 
                            name="fundacion" 
                            value="{{ date('Y-m-d') }}"
                            readonly
                            class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed">
                        <p class="text-sm text-gray-500 mt-1">Se asignará automáticamente la fecha actual</p>
                        @error('fundacion')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Categoría</label>
                        <select name="categoria" class="w-full border rounded px-3 py-2">
                            <option value="">Seleccione...</option>
                            <option value="Profesional">Profesional</option>
                            <option value="Amateur">Amateur</option>
                            <option value="Juvenil">Juvenil</option>
                            <option value="Infantil">Infantil</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Estado *</label>
                        <select name="estado" class="w-full border rounded px-3 py-2" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('equipos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Guardar Equipo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>