@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Ambiente
            <a href="{{ route('gerencia.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-reply"></i> Gerência
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <div class="p-0 mb-3" style="border: 3px solid black;">
        <table class="table table-sm table-striped text-center m-0">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">Imagem</th>
                <th scope="col">Operações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($ambientes as $ambiente)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle font-weight-bold" scope="row">{{ $ambiente->descricao }}</th>
                    <td class="align-middle"><img src="{{ $caminho_imagem.$ambiente->fundo }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$ambiente->fundo }}'>"></td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('ambiente.show', $ambiente->id) }}" class="btn btn-sm btn-info border border-dark"><i class="fas fa-edit"></i> Editar</a>
                            <form class="ml-1" action="{{ route('ambiente.destroy', $ambiente->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $mensagem = '"'.$ambiente->descricao.'"';
                                @endphp
                                <button type="submit" class="btn btn-sm btn-danger border border-dark" onclick="return confirm('Deseja realmente remover o quadrinho {{ $mensagem }}?')">
                                    <i class="fas fa-trash"></i> Remover
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection