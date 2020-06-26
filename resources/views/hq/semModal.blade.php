@extends('layout')

@section('content')
        
    <div class="row">
        <h1>Criar História em Quadrinho</h1>
        <a href="{{ route('hq.store') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Inicio</button>
        </a>
    </div>
    <hr class="bg-dark"/>

    <form action="{{ route('hq.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Titulo:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="tema" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Local:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="local" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 1:</label>
            <div class="col-sm-8">
                <select class="form-control" name="personagem1_id" required>
                    @foreach ($personagems as $personagem)
                        <option value="{{ $personagem->id }}">{{ $personagem->descricao }}</option>
                    @endforeach
                  </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 2:</label>
            <div class="col-sm-8">
                <select class="form-control" name="personagem2_id" required>
                    @foreach ($personagems as $personagem)
                        <option value="{{ $personagem->id }}">{{ $personagem->descricao }}</option>
                    @endforeach
                  </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Ambiente:</label>
            <div class="col-sm-8">
                <select class="form-control" name="ambiente_id" required>
                    @foreach ($ambientes as $ambiente)
                        <option value="{{ $ambiente->id }}">{{ $ambiente->descricao }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>
    </form>


@endsection
