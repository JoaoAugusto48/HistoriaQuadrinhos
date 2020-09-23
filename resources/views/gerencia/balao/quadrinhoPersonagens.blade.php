@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Quadrinho Personagens
            <a href="{{ route('gerencia.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-reply"></i> Gerência
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <div class="row">
        <table class="table table-striped text-center col-sm-8" style="border: 3px solid black;">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Balão Esquerda</th>
                <th scope="col">Balão Direita</th>
            </tr>
            </thead>
            <tbody>
            <tr style="border-bottom: 2px solid #555;">
                <th class="align-middle font-weight-bold" scope="row">{{ $quadPer->balao1->descricao }} <img src="{{ $caminho_imagem.$quadPer->balao1->caminho }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$quadPer->balao1->caminho }}'>"></th>
                <td class="align-middle font-weight-bold">{{ $quadPer->balao2->descricao }} <img src="{{ $caminho_imagem.$quadPer->balao2->caminho }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$quadPer->balao2->caminho }}'>"></td>
            </tr>
            </tbody>
        </table>
    </div>

    <hr class="bg-dark mt-0"/>

    <form action="{{ route('atualizarUsuario') }}" method="post">
        @csrf

        <input type="hidden" name="id" value="{{ $quadPer->id }}">
        
        <div class="form-group row">
            <label for="balaoEsquerda" class="col-sm-2 col-form-label text-right font-weight-bold">Balão Esquerda:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nome" value="{{ $quadPer->balao1 }}" maxlength="255" autocomplete="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="balaoDireita" class="col-sm-2 col-form-label text-right font-weight-bold">Balão Direita:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{ $quadPer->balao2 }}" disabled>
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Atualizar</button>
        </div>
        
    </form>


@endsection