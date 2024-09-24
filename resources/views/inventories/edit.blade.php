@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>

        <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_name">Nombre del Producto</label>
                <input type="text" name="product_name" value="{{ $inventory->product_name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Cantidad</label>
                <input type="number" name="quantity" value="{{ $inventory->quantity }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="text" name="price" value="{{ $inventory->price }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
