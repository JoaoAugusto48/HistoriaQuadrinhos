@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Requisitos - {{$software->descricao}}
        </h1>
    </div>
    <div class="row">
        <a href="{{ route('software.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
            <i class="fas fa-home"></i> Inicio
        </a>
        <a href="{{ route('software.edit', $software->id) }}" class="btn btn-outline-dark ml-3" target="_parent">
            <i class="fas fa-edit"></i> Atualizar Software
        </a>
        <a href="{{ route('criarHq', $software->id) }}" class="btn btn-outline-dark ml-3" target="_parent">
            <i class="fas fa-edit"></i> Criar HQ
        </a>
    </div>
    <hr class="bg-dark mt-2"/>

    @if ($hqs->count() > 0)
        <table class="table table-striped text-center" style="border: 3px solid black;">
            <thead class="thead-dark">
            <tr>
                <th scope="col" title="Título do Caso de Uso">
                    Título
                </th>
                <th scope="col" title="Onde a história se passa">
                    Local
                </th>
                <th scope="col" title="Personagens principais">
                    Personagem 1/2
                </th>
                <th scope="col" title="Local onde a história acontece">
                    Ambiente
                </th>
                <th scope="col" title="Manipulações possíveis">
                    Operações
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($hqs as $hq)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle font-weight-bold" scope="row" style="max-width: 35ch;">{{ $hq->tema }}</th>
                    <td class="align-middle" scope="row" style="max-width: 27ch;">{{ $hq->local }}</td>
                    <td class="align-middle">

                        {{-- <img id="teste" src="{{ $caminho_imagem.$hq->personagem1->personagem }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-placement="top" data-html="true" title="<textarea rows='3' cols='13' class='text-center textareaQuadrinho' disabled>{{ $hq->saudacao1 }}</textarea><img class='img-tooltip' src='{{ $caminho_imagem.$hq->personagem1->personagem }}'>"> --}}
                        <img src="{{ $caminho_imagem.$hq->personagem1->personagem }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$hq->personagem1->personagem }}'>">
                        /
                        <img src="{{ $caminho_imagem.$hq->personagem2->personagem }}" class="img-btn ml-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="right" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$hq->personagem2->personagem }}'>">
                    </td>
                    <td class="align-middle"><img src="{{ $caminho_imagem.$hq->ambiente->fundo }}" class="img-btn ml-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$hq->ambiente->fundo }}'>"></td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('hq.show', $hq->id) }}" class="btn btn-outline-info btn-sm border border-dark" role="button">
                                <i class="fa fa-comments" aria-hidden="true"></i> <em>Quadrinhos</em>
                            </a>
                            <form action="{{ route('hq.destroy', $hq->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm border border-dark" onclick="return confirm('{{ $msgExclusao->excluirItemTabela($hq->tema, 'HQ') }}')">
                                    <i class="fas fa-trash"></i> <em>Excluir</em></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        @include('mensagens.cadastrar.hq')
    @endif



@endsection
