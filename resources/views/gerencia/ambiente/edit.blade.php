@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Ambiente - {{ $ambiente->descricao }}
            <img src="{{ $caminho_imagem.$ambiente->fundo }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$ambiente->fundo }}'>">
            <a class="btn btn-outline-dark ml-1" href="{{ route('ambiente.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
        </h1>
    </div>
    <hr class="bg-dark"/>

    @if ($errors->any())
        @include('mensagens.formulario.erro')
    @endif

    <form action="{{ route('ambiente.update', $ambiente->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $ambiente->id }}">

        <div class="form-group row m-0">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Descrição:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="descricao" value="{{ $ambiente->descricao }}" maxlength="100" required autofocus>
            </div>
            <div class="container">
                <div class="form-check form-check-inline offset-md-2">
                    <input type="checkbox" class="form-check-input" name="repeteFundo" {{ ($ambiente->repeteFundo) ? 'checked' : '' }}>
                    <label for="check" class="col-form-label text-right">Permitir a imagem repetir o fundo</label>
                </div>
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>

    </form>

@endsection
