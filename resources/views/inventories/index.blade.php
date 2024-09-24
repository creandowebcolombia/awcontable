@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Lista de Inventarios</h1>

        <!-- Botones para agregar, exportar e imprimir -->
        <div class="mb-3">
            <a href="{{ route('inventories.create') }}" class="btn btn-primary">Agregar Producto</a>
            <a href="{{ url('inventories/export/excel') }}" class="btn btn-success">Exportar a Excel</a>
            <a href="javascript:window.print()" class="btn btn-secondary">Imprimir</a>
        </div>

        <!-- Mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tabla de inventarios -->
        <table id="inventoryTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->product_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->price }}</td>
                        <td>
                            <a href="{{ route('inventories.edit', $inventory->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Scripts de DataTables para paginación, búsqueda y filtros -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                },
                "pageLength": 5,  // Número de registros por página
            });
        });
    </script>
@endsection
