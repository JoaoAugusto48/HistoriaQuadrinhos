@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Utensilio - {{ $utensilio->descricao }}
            <img src="{{ $caminho_imagem.$utensilio->caminho }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$utensilio->utensilio }}'>">
            <a class="btn btn-outline-dark ml-1" href="{{ route('utensilio.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
        </h1>
    </div>
    <hr class="bg-dark"/>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif

    <form action="{{ route('utensilio.update', $utensilio->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $utensilio->id }}">

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Descrição:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="descricao" value="{{ $utensilio->descricao }}" maxlength="100" required autofocus>
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>

    </form>
@endsection