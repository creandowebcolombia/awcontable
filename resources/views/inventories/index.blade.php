@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Inventarios</h1>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Agregar Producto</a>

        @if ($inventories->isEmpty())
            <p>No hay productos en inventario.</p>
        @else
            <table class="table">
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
        @endif
    </div>
@endsection
