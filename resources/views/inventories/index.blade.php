<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Estilo Excel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Estilos personalizados -->
    <style>
        /* Estilos para el segundo menú */
        .menu-excel {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #e0e0e0;
            padding: 15px;
            margin-bottom: 20px; /* Espacio adicional debajo */
        }

        /* Botones del segundo menú con espaciado uniforme */
        .menu-excel .btn {
            margin-right: 10px;
            flex: 1; /* Cada botón ocupará el mismo espacio */
            text-align: center; /* Centrado de texto en los botones */
        }

        /* Tabla ajustada con espacio adicional */
        .table-inventory-container {
            width: 90%; /* Margen lateral para la tabla */
            margin: 0 auto;
            padding-top: 20px;
        }

        /* Espaciado adicional en la tabla */
        .table-inventory th, .table-inventory td {
            padding: 12px;
            text-align: left;
        }

        .table-inventory th {
            background-color: #f2f2f2;
        }

        /* Estilos generales */
        .container {
            margin-top: 20px;
            padding-left: 10%;
            padding-right: 10%;
        }

        .nav-tabs {
            padding-left: 10%;
            padding-right: 10%;
        }

        /* Ajuste general para el diseño */
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            margin-left: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de título -->
    <nav class="navbar navbar-dark bg-success">
        <span class="navbar-brand mb-0 h1">Mi Software de Inventario</span>
    </nav>

    <!-- Barra de menú -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Insertar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Formato</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Datos</a>
        </li>
    </ul>

    <!-- Segundo menú (Botones de acción alineados en una sola fila) -->
    <div class="menu-excel">
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Agregar Producto</a>
        <a href="{{ route('inventories.export') }}" class="btn btn-success">Exportar a Excel</a>
        <button class="btn btn-secondary" onclick="window.print()">Imprimir</button>
        <form action="{{ route('inventories.import') }}" method="POST" enctype="multipart/form-data" style="display:inline-block;">
            @csrf
            <input type="file" name="file" accept=".xlsx,.csv" required style="margin-right: 10px;">
            <button type="submit" class="btn btn-primary">Importar Productos</button>
        </form>
    </div>

    <!-- Tabla de inventarios -->
    <div class="table-inventory-container">
        <table id="inventory-table" class="table table-striped table-bordered table-inventory mt-3">
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

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#inventory-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                },
                "autoWidth": false,
                "columnDefs": [
                    { "width": "20%", "targets": 0 }, // Ajustamos un 20% más de ancho
                    { "width": "20%", "targets": 1 }
                ]
            });
        });
    </script>
</body>
</html>
