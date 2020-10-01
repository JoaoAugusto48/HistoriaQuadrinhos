@extends('layouts.app')

@section('content')

<script>

    function trocarExibicao(){
        // $('#col-adicionar').fadeOut(100);
        setTimeout(function(){
        $('#col-img').fadeIn(100);
        $('#col-descricao').fadeIn(100);
        $('#col-enviar').fadeIn(100);
        $('#col-formImg').show(100);
        $('#col-fechar').show(100);
        }, 50)
    }
</script>
    <div class="row">
        <h1>
            Balão
            <div class="btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-dark" href="{{ route('gerencia.index') }}" role="button">
                    <i class="fas fa-reply"></i> Gerência
                </a>                
                <button id="col-adicionar" onclick="trocarExibicao()" type="button" class="btn btn-dark" role="button" onclick="adicionar()"><i class="fa fa-plus"></i> Adicionar Balão</button>
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
                                    <form enctype="multipart/form-data" action="{{ route('balao.store') }}" method="post">
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
            @foreach ($balaos as $balao)
                <tr class="d-flex align-items-center" style="border-bottom: 2px solid #555;">
                    <th class="col-sm-4 align-middle font-weight-bold border-0" scope="row">{{ $balao->descricao }}</th>
                    <td class="col-sm-4 align-middle border-0"><img src="{{ $caminho_imagem.$balao->caminho }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$balao->caminho }}'>"></td>
                    <td class="col-sm-4 align-middle border-0">
                        <div class="btn-group" role="group">
                            <a href="{{ route('balao.edit', $balao->id) }}" class="btn btn-sm btn-info border border-dark"><i class="fas fa-edit"></i> Editar</a>
                            <form class="ml-1" action="{{ route('balao.destroy', $balao->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $mensagem = '"'.$balao->descricao.'"';
                                @endphp
                                <button type="submit" class="btn btn-sm btn-danger border border-dark" onclick="return confirm('Deseja realmente remover o balão {{ $mensagem }}?')">
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