@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/gerencia/trocarExibicao.js') }}"></script>
@endsection

@section('content')

    <div class="row">
        <h1>
            Personagem
            <div class="btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-dark" href="{{ route('gerencia.index') }}" role="button">
                    <i class="fas fa-reply"></i> Gerência
                </a>                
                <button id="col-adicionar"  onclick="trocarExibicao()" type="button" class="btn btn-dark" role="button" onclick="adicionar()"><i class="fa fa-plus"></i> Adicionar Personagem</button>
            </div>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <div class="p-0 mb-3" style="border: 3px solid black;">
        <table class="table table-sm table-striped text-center m-0">
            <thead class="thead-dark">
            <tr class="d-flex align-items-center">
                <th class="col-md-4" scope="col">Descrição</th>
                <th class="col-md-4" scope="col">Imagem</th>
                <th class="col-md-4" scope="col">Operações</th>
            </tr>
            </thead>
            <tbody>

                <tr id="col-formImg" class="bg-secondary text-white" style="display: none">  
                    <td colspan="4" class="text-center">
                        <div class="d-inline-flex" id="alterar-texto">
                            <div class="container-fluid">
                                <div class="row">
                                    <form enctype="multipart/form-data" action="{{ route('personagem.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row" id="col-descricao" style="display: none">
                                            <label for="nome" class="col-form-label text-right font-weight-bold">Descrição:</label>
                                            <div class="col-sm-8">
                                                <input id="txt-titulo" type="text" class="form-control" name="descricao" maxlength="70" value="{{ old('descricao') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class=" form-group row" id="col-img" style="display: none" required>
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
            @foreach ($personagens as $personagem)
                <tr class="d-flex align-items-center" style="border-bottom: 2px solid #555;">
                    <th class="col-sm-4 align-middle font-weight-bold border-0" scope="row">{{ $personagem->descricao }}</th>
                    <td class="col-sm-4 align-middle border-0"><img src="{{ $caminho_imagem.$personagem->personagem }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$personagem->personagem }}'>"></td>
                    <td class="col-sm-4 align-middle border-0">
                        <div class="btn-group" role="group">
                            <a href="{{ route('personagem.edit', $personagem->id) }}" class="btn btn-sm btn-info border border-dark"><i class="fas fa-edit"></i> Editar</a>
                            <form class="ml-1" action="{{ route('personagem.destroy', $personagem->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger border border-dark" onclick="return confirm('{{ $msgExclusao->excluirItemTabela($personagem->descricao, 'personagem', 'o') }}')">
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