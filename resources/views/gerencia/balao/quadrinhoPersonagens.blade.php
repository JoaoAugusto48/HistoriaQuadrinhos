@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Quadrinho Personagens
            <a href="{{ route('gerencia.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-reply"></i> Gerência
            </a>
            <a href="{{ route('balao.index') }}" target="_blank" class="btn btn-outline-dark ml-1">
                <i class="fa fa-comments" aria-hidden="true"></i> Visualizar Balões
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <div class=" col-sm-8 offset-sm-2 p-0 mb-3" style="border: 3px solid black;">
        <table class="table table-striped text-center m-0">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Balão Esquerda</th>
                <th scope="col">Balão Direita</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="align-middle font-weight-bold" scope="row">{{ $quadPer->balaoEsq->descricao }} <img src="{{ $caminho_imagem.$quadPer->balaoEsq->caminho }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$quadPer->balaoEsq->caminho }}'>"></th>
                <td class="align-middle font-weight-bold">{{ $quadPer->balaoDir->descricao }} <img src="{{ $caminho_imagem.$quadPer->balaoDir->caminho }}" class="img-btn mr-2" draggable="false" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-tooltip mw-100' src='{{ $caminho_imagem.$quadPer->balaoDir->caminho }}'>"></td>
            </tr>
            </tbody>
        </table>
    </div>
    

    <hr class="bg-dark mt-0"/>

    <form action="{{ route('quadrinhoPersonagem.update', $quadPer->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $quadPer->id }}">
        
        <div class="form-group row">
            <label for="balaoEsquerda" class="col-sm-2 col-form-label text-right font-weight-bold">Balão Esquerda:</label>
            <div class="col-sm-10">
                
                <select class="custom-select" name="balao_esquerda" required>
                    @foreach ($balaos as $balao)
                        @php
                            $selecionar = ($balao->id == $quadPer->balao_esquerda) ? 'selected' : '';
                        @endphp

                        <option value="{{ $balao->id }}" {{ $selecionar }}>
                            {{ $balao->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="balaoDireita" class="col-sm-2 col-form-label text-right font-weight-bold">Balão Direita:</label>
            <div class="col-sm-10">
                {{-- <input type="text" class="form-control" name="email" value="{{ $quadPer->balao2_id }}" disabled> --}}
                <select class="custom-select" name="balao_direita" required>
                    @foreach ($balaos as $balao)
                        @if ($balao->id == $quadPer->balao_direita)
                            <option value="{{ $balao->id }}" selected>{{ $balao->descricao }}</option>
                        @else
                            <option value="{{ $balao->id }}">{{ $balao->descricao }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Atualizar</button>
        </div>
        
    </form>


@endsection