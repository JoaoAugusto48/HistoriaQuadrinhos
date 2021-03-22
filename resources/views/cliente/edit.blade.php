@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Cadastrar Cliente
            <a href="{{ route('cliente.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fa fa-reply" aria-hidden="true"></i> Clientes
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
        @csrf
        @method('PUT')

        @if ($errors->any())
            @include('mensagens.formulario.erro')
        @endif

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Empresa:</label>
            <div class="col-sm-8">
                <input type="text" list="empresa" class="form-control" name="nome" value="{{$cliente->nome}}" maxlength="100" placeholder="Empresa" autocomplete="off" required autofocus>
            </div>
            {{-- datalist de empresa --}}
            <datalist id="empresa">
                @foreach ($listaEmpresas as $empresa)
                    <option value="{{$empresa->nome}}">
                @endforeach
            </datalist>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Responsável:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="responsavel" value="{{ $cliente->responsavel }}" maxlength="100" placeholder="Responsável pela empresa" autocomplete="off" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" value="{{$cliente->email}}" maxlength="255" placeholder="Email" autocomplete="off" required>
            </div>
            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Telefone:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="telefone" value="{{$cliente->telefone}}" maxlength="14" placeholder="Telefone" autocomplete="off" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Cidade:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="cidade" value="{{$cliente->cidade}}" maxlength="50" placeholder="Cidade" autocomplete="off" required>
            </div>

            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Estado:</label>
            <div class="col-sm-2">
                <select class="custom-select" name="estado_id" required>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}" @if ($estado->id == $cliente->estado_id) selected @endif>
                            {{ $estado->uf }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Endereco:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="endereco" value="{{$cliente->endereco}}" maxlength="50" placeholder="Endereco" autocomplete="off" required>
            </div>
            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">Número:</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" name="numero" value="{{$cliente->numero}}" placeholder="Número" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Complemento:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="complemento" value="{{$cliente->complemento}}" placeholder="Complemento" autocomplete="off">
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>
    </form>

@endsection
