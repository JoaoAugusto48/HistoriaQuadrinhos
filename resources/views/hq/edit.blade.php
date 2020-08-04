@extends('layout')

@section('content')

    <div class="row">
        <h1>
            Editar HQ - {{ $hq->tema }}
            <button class="btn btn-outline-dark ml-1" onclick="javascript:history.back()"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
        </h1>
    </div>
    <hr class="bg-dark"/>

    <form action="{{ route('hq.update', $hq->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $hq->id }}">

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Titulo:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="tema" value="{{ $hq->tema }}" maxlength="100" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Local:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="local" value="{{ $hq->local }}" maxlength="70" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Saudação 1:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="saudacao1" value="{{ $hq->saudacao1 }}" maxlength="70" placeholder="ex: Oi, sou gerente administrativo." autocomplete="off" data-toggle="tooltip" data-placement="top" title="Faça uma saudação com Personagem 1." required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Saudação 2:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="saudacao2" value="{{ $hq->saudacao2 }}" maxlength="70" placeholder="ex: Olá, sou especialista em negócios." autocomplete="off" data-toggle="tooltip" data-placement="top" title="Faça uma saudação com Personagem 2." required>
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>

    </form>

@endsection