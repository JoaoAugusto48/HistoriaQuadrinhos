@extends('layouts.app')

@section('content')

<script>

    function trocarExibicao(){
        $('#col-adicionar').fadeOut(100);

        setTimeout(function(){
        $('#col-img').fadeIn(100);
        $('#col-descricao').fadeIn(100);
        $('#col-enviar').fadeIn(100);
        }, 50)

    }
</script>
    <div class="row">
        <h1>
            Personagem
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
            @foreach ($personagens as $personagem)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle font-weight-bold" scope="row">{{ $personagem->descricao }}</th>
                    <td class="align-middle"><img src="{{ $caminho_imagem.$personagem->personagem }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$personagem->personagem }}'>"></td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('personagem.show', $personagem->id) }}" class="btn btn-sm btn-info border border-dark"><i class="fas fa-edit"></i> Editar</a>
                            <form class="ml-1" action="{{ route('personagem.destroy', $personagem->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $mensagem = '"'.$personagem->descricao.'"';
                                @endphp
                                <button type="submit" class="btn btn-sm btn-danger border border-dark" onclick="return confirm('Deseja realmente remover o quadrinho {{ $mensagem }}?')">
                                    <i class="fas fa-trash"></i> Remover
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
                <tr class="bg-secondary">  
                    <td colspan="4" class="text-center">
                        <div class="d-inline-flex" id="alterar-texto">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12" id="col-adicionar">
                                        @csrf
                                        <button id="adicionar"  onclick="trocarExibicao()" type="button" class="btn btn-sm btn-dark" role="button" onclick="adicionar()"><i class="fa fa-plus"></i> Adicionar Personagem</button>
                                    </div>

                                    <form enctype="multipart/form-data" action="{{ route('personagem.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row" id="col-descricao" style="display: none">
                                            <label for="nome" class="col-form-label text-right font-weight-bold">Descrição:</label>
                                            <div class="col-sm-8">
                                                <input id="txt-titulo" type="text" class="form-control" name="descricao" maxlength="70" value="{{ old('descricao') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class=" form-group row" id="col-img" style="display: none">
                                            <label for="img" class="text-right font-weight-bold">Select image:</label>
                                            <div class="col-sm-8">
                                                <input type="file" id="img" name="img" accept="image/x-png">
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2 pl-1 text-left" id="col-enviar" style="display: none">
                                            <button type="submit" class="btn btn-primary font-weight-bold border border-dark">Enviar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection