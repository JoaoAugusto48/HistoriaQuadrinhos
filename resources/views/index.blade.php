@extends('layouts.app')
{{-- @extends('layouts.layout') --}}

@section('content')
        
    <div class="row">
        <h1>HQs criadas</h1>
    </div>
    <hr class="bg-dark mt-0"/>

    @if ($hqs->count() > 0)
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
                    <th class="align-middle font-weight-bold" scope="row" style="max-width: 35ch;">{{ $hq->tema }}</th>
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
    
    @else
        <div class="card text-center">
            <div class="card-header">
                &nbsp;
            </div>
            <div class="card-body">
                <h5 class="card-title">Você ainda não possui Histórias em Quadrinhos!</h5>
                <p class="card-text">Clique no Botão abaixo para criar uma HQ.</p>
                <a href="{{ route('hq.create') }}" class="btn btn-primary"> 
                    <i class="fa fa-plus" aria-hidden="true"></i> Criar HQ
                </a>
            </div>
            <div class="card-footer text-muted">
                &nbsp;
            </div>
        </div>
        
    @endif

 

@endsection