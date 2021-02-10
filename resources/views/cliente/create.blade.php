@extends('layouts.app')

@section('content')

    <form action="{{ route('cliente.store') }}" method="post">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Empresa:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="nome" value="{{old('nome')}}" maxlength="100" placeholder="Empresa" autocomplete="off" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Responsável:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="responsavel" value="{{ old('responsavel') }}" maxlength="100" placeholder="Responsável pela empresa" autocomplete="off" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" value="{{old('email')}}" maxlength="255" placeholder="Email" autocomplete="off" required>
            </div>
            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Telefone:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="telefone" value="{{old('telefone')}}" maxlength="14" placeholder="Telefone" autocomplete="off" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Cidade:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="cidade" value="{{old('cidade')}}" maxlength="50" placeholder="Cidade" autocomplete="off" required>
            </div>

            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Estado:</label>
            <div class="col-sm-2">
                <select class="custom-select" name="balao_direita" required>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}"
                            @if ($estado->id == $saoPaulo->id)
                                selected
                            @endif>
                            {{ $estado->uf }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Endereco:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="endereco" value="{{old('endereco')}}" maxlength="50" placeholder="Endereco" autocomplete="off" required>
            </div>
            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Número:</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="numero" value="{{old('numero')}}" placeholder="Número" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Complemento:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="complemento" value="{{old('complemento')}}" placeholder="Complemento" autocomplete="off">
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>
    </form>

@endsection
