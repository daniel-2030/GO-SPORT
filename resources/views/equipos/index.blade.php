<x-app-layout>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div style="padding:16px">
                    <div class="flex items-center justify-center gap-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                            Tabla Equipos
                        </h2>
                    </div>
                    <br>
                    <p>
                        <a href="{{ route('equipos.create') }}">➕ Nuevo Equipo</a>
                    </p>

                    @if(session('success'))
                        <p style="color:green">{{ session('success') }}</p>
                    @endif

                    <table id="equipos" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Escudo</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipos as $equipo)
                                <tr>
                                    <td>
                                        @if($equipo->escudo_url)
                                            <img src="{{ asset('storage/' . $equipo->escudo_url) }}" 
                                                 alt="{{ $equipo->nombre_equipo }}">
                                        @else
                                            <div style="width:50px;height:50px;background:#4a5568;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                                <span style="font-size:10px;color:#e5e7eb;">Sin escudo</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $equipo->nombre_equipo }}</td>
                                    <td>{{ $equipo->categoria ?? 'N/A' }}</td>
                                    <td>
                                        <span style="padding:4px 8px;font-size:12px;border-radius:9999px;{{ $equipo->estado == 'Activo' ? 'background:#10b981;color:#fff;' : 'background:#ef4444;color:#fff;' }}">
                                            {{ $equipo->estado }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('equipos.edit', $equipo->id_equipo) }}">✏️ Editar</a>
                                        <form action="{{ route('equipos.destroy', $equipo->id_equipo) }}" 
                                              method="POST" 
                                              style="display:inline" 
                                              onsubmit="return confirm('¿Eliminar este equipo?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit">🗑️ Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    {{-- jQuery + DataTables (CDN) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(function() {
            $('#equipos').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>

<style>
    body {
        background-color: #32373dff !important; /* negro absoluto */
        color: white; /* texto blanco para contraste */
    }
    
    img{
        width: 50px;
        height: 50px;
    }
    /* Opcional: Cambiar fondo de los contenedores a negro */
    .bg-white {
        background-color: #32373dff !important;
    }

    .text-gray-800 {
        color: #fff !important;
    }

    /* Quitar el hover/resaltado de las filas */
    table.dataTable tbody tr:hover {
        background-color: transparent !important;
    }

    table.dataTable.hover tbody tr:hover,
    table.dataTable.display tbody tr:hover {
        background-color: transparent !important;
    }

    /* Quitar el resaltado de las filas seleccionadas */
    table.dataTable tbody tr.selected,
    table.dataTable tbody tr.selected:hover {
        background-color: transparent !important;
    }

    </style>

</x-app-layout>