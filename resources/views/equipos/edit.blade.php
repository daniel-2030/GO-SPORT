<x-app-layout>
    <br>
    <br>
        
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Editar Equipo') }}
                    </h2>
                    <form action="{{ route('equipos.update', $equipo->id_equipo) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nombre del Equipo -->
                    <div class="mb-4">
                        <label for="nombre_equipo" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre del Equipo <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nombre_equipo" 
                               name="nombre_equipo" 
                               value="{{ old('nombre_equipo', $equipo->nombre_equipo) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               required>
                        @error('nombre_equipo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fundación -->
                    <div class="mb-4">
                        <label for="fundacion" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha de Fundación
                        </label>
                        <input type="date" 
                               id="fundacion" 
                               name="fundacion" 
                               value="{{ old('fundacion', $equipo->fundacion) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('fundacion')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Escudo Actual -->
                    @if($equipo->escudo_url)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Escudo Actual
                            </label>
                            <img src="{{ asset('storage/' . $equipo->escudo_url) }}" 
                                 alt="{{ $equipo->nombre_equipo }}" 
                                 class="h-24 w-24 object-contain border rounded">
                        </div>
                    @endif

                    <!-- Nuevo Escudo -->
                    <div class="mb-4">
                        <label for="escudo" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $equipo->escudo_url ? 'Cambiar Escudo' : 'Subir Escudo' }}
                        </label>
                        <input type="file" 
                               id="escudo" 
                               name="escudo" 
                               accept="image/*"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Formatos: JPG, PNG, GIF (Máx. 2MB)</p>
                        @error('escudo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div class="mb-4">
                        <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">
                            Categoría
                        </label>
                        <select id="categoria" 
                                name="categoria"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccione...</option>
                            <option value="Profesional" {{ old('categoria', $equipo->categoria) == 'Profesional' ? 'selected' : '' }}>Profesional</option>
                            <option value="Amateur" {{ old('categoria', $equipo->categoria) == 'Amateur' ? 'selected' : '' }}>Amateur</option>
                            <option value="Juvenil" {{ old('categoria', $equipo->categoria) == 'Juvenil' ? 'selected' : '' }}>Juvenil</option>
                            <option value="Infantil" {{ old('categoria', $equipo->categoria) == 'Infantil' ? 'selected' : '' }}>Infantil</option>
                        </select>
                        @error('categoria')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="mb-6">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select id="estado" 
                                name="estado"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="Activo" {{ old('estado', $equipo->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado', $equipo->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('equipos.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                            Actualizar Equipo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>