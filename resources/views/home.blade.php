@extends('layout')

@section('content')
        
    <div class="row">
        <h1>
            História em Quadrinhos
            <a href="{{ route('hq.create') }}" target="_parent">
                <button class="btn btn-outline-dark ml-1"><i class="fa fa-plus" aria-hidden="true"></i> Criar HQ</button>
            </a>
        </h1>
        {{-- <a href="{{ route('quadrinho.index') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Teste com Quadrinho</button> --}}
        </a>
        {{-- <a href="{{ route('quadrinhos') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Teste de Imagem HQ</button>
        </a> --}}
    </div>
    <hr class="bg-dark"/>

    <table class="table table-striped text-center" style="border: 3px solid black;">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Local</th>
            <th scope="col">Personagem 1/2</th>
            <th scope="col">Ambiente</th>
            <th scope="col">Operações</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($hqs as $hq)
            <tr style="border-bottom: 2px solid #555;">
                <th class="align-middle" scope="row" style="max-width: 35ch;">{{ $hq->tema }}</th>
                <td class="align-middle" scope="row" style="max-width: 27ch;">{{ $hq->local }}</td>
                <td class="align-middle">

                    {{-- <img id="teste" src="{{ $caminho_imagem.$hq->personagem1->personagem }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-placement="top" data-html="true" title="<textarea rows='3' cols='13' class='text-center textareaQuadrinho' disabled>{{ $hq->saudacao1 }}</textarea><img class='img-tooltip' src='{{ $caminho_imagem.$hq->personagem1->personagem }}'>"> --}}
                    <img src="{{ $caminho_imagem.$hq->personagem1->personagem }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip' src='{{ $caminho_imagem.$hq->personagem1->personagem }}'>">
                    /
                    <img src="{{ $caminho_imagem.$hq->personagem2->personagem }}" class="img-btn ml-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="right" title="<img class='img-tooltip' src='{{ $caminho_imagem.$hq->personagem2->personagem }}'>">
                </td>
                <td class="align-middle"><img src="{{ $caminho_imagem.$hq->ambiente->fundo }}" class="img-btn ml-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip' src='{{ $caminho_imagem.$hq->ambiente->fundo }}'>"></td>
                <td class="align-middle">
                    <div class="btn-group" role="group">
                        <a href="{{ route('hq.show', $hq->id) }}" class="btn btn-outline-info btn-sm border border-dark" role="button">
                            <i class="fa fa-comments" aria-hidden="true"></i> <em>Quadrinhos</em>
                        </a>
                        <form action="{{ route('hq.destroy', $hq->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            @php
                                $mensagem = '"'.$hq->tema.'"';
                            @endphp
                            <button type="submit" class="btn btn-outline-danger btn-sm border border-dark" onclick="return confirm('Deseja realmente excluir a HQ - {{ $mensagem }}?')">
                                <i class="fas fa-trash"></i> <em>Excluir</em></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

 

@endsection