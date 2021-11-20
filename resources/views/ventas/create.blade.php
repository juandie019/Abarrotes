@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <hacer-venta folio-aux="{{ $last_id }}" empleado-id = {{Auth()->User()->empleado->id}}></hacer-venta>
        </div>
    </div>
</div>
@endsection
