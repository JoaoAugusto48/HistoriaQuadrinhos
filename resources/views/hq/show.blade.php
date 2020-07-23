@extends('layout')

@section('content')
    <div class="row">
        <h3>Quadrinho - {{ $hq->tema }}</h3>
        <a href="{{ route('hq.index') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Inicio</button>
        </a>
    </div>
    <hr class="bg-dark"/>

    <table class="table table-sm table-hover table-striped text-center" style="border: 3px solid black;">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Tipo</th>
            <th scope="col">Título</th>
            <th scope="col">Página</th>
            <th scope="col">Operações</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($situars as $indice => $situar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">Situar</th>
                    <td class="align-middle">{{ $situar->quadrinho->titulo }}</td>
                    <td class="align-middle">{{ $situar->quadrinho->pagina }}</td>
                    <td class="align-middle">
                        @if ($indice < 3) {{-- 3 é o valor correspondente as Hqs que não podem ser alteradas --}}
                            <button disabled="disabled" class="btn btn-sm btn-info">Quadrinho estático</button>
                        @elseif($situar->quadrinho->pathImg)
                            <button class="btn btn-sm btn-info">Editar</button>
                        @else
                            <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $situar->quadrinho->id]) }}" class="btn btn-sm btn-info">Adicionar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            @foreach ($problematizars as $problematizar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">Problematizar</th>
                    <td class="align-middle">{{ $problematizar->quadrinho->titulo }}</td>
                    <td class="align-middle">{{ $problematizar->quadrinho->pagina }}</td>
                    <td class="align-middle">
                            
                    </td>
                </tr>
            @endforeach
            @foreach ($solucionars as $solucionar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">Solucionar</th>
                    <td class="align-middle">{{ $solucionar->quadrinho->titulo }}</td>
                    <td class="align-middle">{{ $solucionar->quadrinho->pagina }}</td>
                    <td class="align-middle">
                            
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-center border border-dark mb-0 rounded-top font-weight-bold">Situar</h4>
    <div class="card-group">
        <div class="card bg-dark text-white rounded-top-0">
            <div class="card-body d-flex">
                <h2 class="card-title m-auto text-center">{{ $situars[0]->quadrinho->titulo }}</h2>
            </div>
            <div class="card-footer bg-transparent border-top-0 numeroPagina">{{ $situars[0]->quadrinho->pagina }}</div>
        </div>
        <div class="card text-center bg-dark text-white">
            <div class="card-header">{{ $situars[1]->quadrinho->titulo }}</div>
            <div class="card-body bg-white">
                <table class="table table-borderless">
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col" class="balaoQuadrinho py-4" style="background-image: url('{{ env('APP_URL') }}/storage/balao/balaoEsquerda2.png')">
                                <textarea rows="3" cols="13" class="text-center textareaQuadrinho" disabled>{{ $hq->saudacao1 }}</textarea>
                            </th>
                            <th scope="col" class="balaoQuadrinho py-4" style="background-image: url('{{ env('APP_URL') }}/storage/balao/balaoDireita1.png')">
                                <textarea rows="3" cols="13" class="text-center textareaQuadrinho" disabled>{{ $hq->saudacao2 }}</textarea>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col"><img src="{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}" class="card-img-personagens text-left"></th>
                            <th scope="col"><img src="{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}" class="card-img-personagens text-right"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-left bg-white border-top-0 numeroPagina">2</div>
        </div>
        <div class="card text-center bg-dark text-white rounded-top-0">
            <div class="card-header">{{ $situars[2]->quadrinho->titulo }}</div>
            <div class="card-body p-0 d-flex bg-white">
                <img src="{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}" class="card-img-ambiente my-auto">
            </div>
            <div class="card-footer text-left bg-white border-top-0 numeroPagina">{{ $situars[2]->quadrinho->pagina }}</div>
        </div>

        @if ($situars[3]->quadrinho->pathImg)    
            <div class="card text-center bg-dark text-white rounded-top-0">
                @if ($situars[3]->quadrinho->titulo)
                    <div class="card-header">{{ $situars[3]->quadrinho->titulo }}</div>
                @endif
                <div class="card-body p-0 d-flex bg-white">
                    {{-- <img src="{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}" class="card-img-ambiente my-auto"> --}}
                </div>
                <div class="card-footer text-left bg-white border-top-0 numeroPagina">{{ $situars[3]->quadrinho->pagina }}</div>
            </div>
        @endif
        
    </div>

    @if ($problematizars[0]->quadrinho->pathImg)
        <h4 class="text-center border border-dark mt-3 mb-0 rounded-top font-weight-bold">Problematizar</h4>
        <div class="card-group">
            @foreach ($problematizars as $problematizar)
                <div class="card text-center bg-dark text-white rounded-top-0">
                    @if ($problematizar->quadrinho->titulo)
                        <div class="card-header">{{ $problematizar->quadrinho->titulo }}</div>
                    @endif
                    <div class="card-body p-0 d-flex bg-white">
                        <img src="{{ env('APP_URL') }}/storage/{{ $problematizar->quadrinho->pathImg }}" class="card-img-ambiente my-auto">
                    </div>
                    <div class="card-footer text-left bg-white border-top-0 numeroPagina">{{ $problematizar->quadrinho->pagina }}</div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($solucionars->count())
        <h4 class="text-center border border-dark mt-3 mb-0 rounded-top font-weight-bold">Solucionar</h4>
        <div class="card-group">
            @foreach ($solucionars as $solucionar)
                <div class="card text-center bg-dark text-white rounded-top-0">
                    @if ($solucionar->quadrinho->titulo)
                        <div class="card-header">{{ $solucionar->quadrinho->titulo }}</div>
                    @endif
                    <div class="card-body p-0 d-flex bg-white">
                        <img src="{{ env('APP_URL') }}/storage/{{ $solucionar->quadrinho->pathImg }}" class="card-img-ambiente my-auto">
                    </div>
                    <div class="card-footer text-left bg-white border-top-0 numeroPagina">{{ $solucionar->quadrinho->pagina }}</div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- <div class="card-group">
        <div class="card">
            <div class="card-header">
                
            </div>
        </div>
    </div> --}}
@endsection