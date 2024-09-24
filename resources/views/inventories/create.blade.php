@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Producto</h1>

        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product_name">Nombre del Producto</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Cantidad</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="text" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
