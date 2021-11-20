@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <form method="POST" action = "/producto/update_stock">
                           @csrf
                           <div class="row">
                                <div class ="col-md-3 ">
                                    {{ __('Lista de Productos') }}
                                </div>

                                <div class="col-md-3">
                                    <select name="id" id="id" class="form-control" required>
                                        @foreach ($productos as $producto)
                                          <option value={{$producto->id}}>{{$producto->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <input id="cantidad" type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="{{ old('cantidad') }}" required autocomplete="cantidad" autofocus placeholder="Cantidad">

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Agregar a stock') }}
                                    </button>
                                </div>
                           </div>
                       </form>
                   </div>
                </div>
                <div class="card-body">
                   <div class = "table-responsive">
                       <table class = "table">
                            <tr>
                                <th>Código de barras</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Precio venta</th>
                                <th>Observaciones</th>
                                <th>Existencia</th>
                            </tr>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{$producto->id}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->costo}}</td>
                                    <td>{{$producto->precio_venta}}</td>
                                    <td>{{$producto->observaciones}}</td>
                                    <td>{{$producto->stock->existencia}}</td>
                                </tr>
                            @endforeach
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
