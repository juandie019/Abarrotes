@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class ="col-md-6 ">
                        {{ __('Lista de Empleados') }}
                    </div>
                </div>
                <div class="card-body">
                   <div class = "table-responsive">
                       <table class = "table">
                            <tr>
                                <th>ID empleado</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de nacimiento</th>
                                <th>Celular</th>
                                <th>Sexo</th>
                                <th>Contacto de emergencia</th>
                                <th>Correo electronico</th>
                            </tr>
                            @foreach ($empleados as $empleado)
                                <tr>
                                    <td>{{$empleado->id}}</td>
                                    <td>{{$empleado->last_name}}</td>
                                    <td>{{$empleado->first_name}}</td>
                                    <td>{{$empleado->birthdate}}</td>
                                    <td>{{$empleado->phone_number}}</td>
                                    <td>{{$empleado->sexo}}</td>
                                    <td>{{$empleado->contacto_emergencia}}</td>
                                    <td>{{$empleado->user->email}}</td>
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
