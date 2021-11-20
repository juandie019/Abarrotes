@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class ="col-md-6 ">
                        {{ __('Lista de Ventas') }}
                    </div>
                </div>
                <div class="card-body">
                   <div class = "table-responsive">
                       <table class = "table">
                            <tr>
                                <th>Folio</th>
                                <th>Empleado</th>
                                <th>Sub Total</th>
                                <th>Total</th>
                                <th>Artículos</th>
                                <th>Fecha</th>
                            </tr>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{$venta->id}}</td>
                                    <td>{{$venta->empleado->last_name . ' ' . $venta->empleado->first_name }}</td>
                                    <td>
                                        {{$venta->subTotal()}}
                                    </td>
                                    <td>
                                        {{$venta->total()}}
                                    </td>
                                    <td>
                                        {{count($venta->detalleVentas)}}
                                    </td>
                                    <td>{{$venta->created_at}}</td>
                                </tr>
                            @endforeach
                       </table>
                   </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
