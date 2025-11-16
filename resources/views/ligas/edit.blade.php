<x-app-layout>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4"> Editar Liga</h2>

            <form action="{{ route('ligas.update', $liga) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre</label>
                <input type="text" name="nombre" class="w-full border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Descripción</label>
                <textarea name="descripcion" class="w-full border-gray-300 rounded-lg" rows="3" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Temporada</label>
                <select name="id_temporada" class="w-full border-gray-300 rounded-lg">
                    @foreach($temporadas as $temp)
                        <option value="{{ $temp->id_temporada }}">{{ $temp->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
class="block text-center bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-150 text-sm font-medium">                Guardar
            </button>
        </form>
    </div>
</x-app-layout>
