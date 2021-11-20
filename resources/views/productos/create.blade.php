@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar producto') }}</div>

                <div class="card-body">
                    <form method="POST" action = "/producto">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Código de barras') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="costo" class="col-md-4 col-form-label text-md-right">{{ __('Costo') }}</label>

                            <div class="col-md-6">
                                <input id="costo" type="number" class="form-control @error('costo') is-invalid @enderror" name="costo" value="{{ old('costo') }}" required autocomplete="costo" autofocus>

                                @error('costo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="precio_venta" class="col-md-4 col-form-label text-md-right">{{ __('Precio de venta') }}</label>

                            <div class="col-md-6">
                                <input id="precio_venta" type="number" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" value="{{ old('precio_venta') }}" autocomplete="precio_venta" autofocus>

                                @error('precio_venta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="observaciones" class="col-md-4 col-form-label text-md-right">{{ __('Observaciones') }}</label>

                            <div class="col-md-6">
                                <input id="observaciones" type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" value="{{ old('observaciones') }}"  autocomplete="observaciones" autofocus>

                                @error('observaciones')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="existencia_min" class="col-md-4 col-form-label text-md-right">{{ __('Existencia mínima') }}</label>

                            <div class="col-md-6">
                                <input id="existencia_min" type="text" class="form-control @error('existencia_min') is-invalid @enderror" name="existencia_min" value="{{ old('existencia_min') }}"  autocomplete="existencia_min" autofocus>

                                @error('existencia_min')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="existencia_max" class="col-md-4 col-form-label text-md-right">{{ __('Existencia máxima') }}</label>

                            <div class="col-md-6">
                                <input id="existencia_max" type="text" class="form-control @error('existencia_max') is-invalid @enderror" name="existencia_max" value="{{ old('existencia_max') }}"  autocomplete="existencia_max" autofocus>

                                @error('existencia_max')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="existencia" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad Inicial') }}</label>

                            <div class="col-md-6">
                                <input id="existencia" type="text" class="form-control @error('existencia') is-invalid @enderror" name="existencia" value="{{ old('existencia') }}"  autocomplete="existencia" autofocus>

                                @error('existencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
