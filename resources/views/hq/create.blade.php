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

        {{-- <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 1:</label>
            <div class="col-sm-8">
                <select class="form-control" name="personagem1_id" required>
                    @foreach ($personagems as $personagem)
                        <option value="{{ $personagem->id }}">{{ $personagem->descricao }}</option>
                    @endforeach
                  </select>
            </div>
        </div> --}}

        <!-- Button trigger modal -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 1:</label>
            <div class="col-sm-8">
                <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#staticBackdrop">
                    Selecionar
                </button>
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach ($personagems as $personagem)
                    <div class="col-md-4">
                        <div class="card-group">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ env('APP_URL') }}/storage/{{ $personagem->personagem }}" class="card-img-top">
                                <div class="card-footer text-muted">
                                <h5 class="card-title">{{ $personagem->descricao }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
@endsection
