@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/hq/showHq.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <h1>Quadrinho - {{ $hq->tema }}</h1>
    </div>
    <div class="row">
        <a href="{{ route('software.show', $hq->software_id) }}" class="btn btn-outline-dark ml-1" target="_parent">
            <i class="fa fa-reply" aria-hidden="true"></i> Voltar
        </a>
        <a href="{{ route('hq.edit', $hq->id) }}" class="btn btn-outline-dark ml-3" target="_parent">
            <i class="fas fa-edit"></i> Atualizar HQ
        </a>
    </div>
    <hr class="bg-dark"/>

    <div class="p-0 mb-3" style="border: 3px solid black;">
        <table class="table table-sm table-hover table-striped text-center bg-light m-0">
            <thead class="thead-dark">
            <tr>
                <th scope="col" title="Fase da HQ no projeto">
                    Fase
                </th>
                <th scope="col" title="Possível especificação do quadrinho">
                    Título
                </th>
                <th scope="col" title="Número da página">
                    Página
                </th>
                <th scope="col" title="Manipulações possíveis">
                    Operações
                </th>
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
                                <button disabled="disabled" class="btn btn-sm btn-secondary">Quadrinho estático</button>
                            @elseif($situar->quadrinho->pathImg)
                                <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $situar->quadrinho->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                            @else
                                <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $situar->quadrinho->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Adicionar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @foreach ($problematizars as $indice => $problematizar)
                    <tr style="border-bottom: 2px solid #555;">
                        <th class="align-middle" scope="row" id="tabProblematizar">Problematizar</th>
                        <td class="align-middle">{{ $problematizar->quadrinho->titulo }}</td>
                        <td class="align-middle">{{ $problematizar->quadrinho->pagina }}</td>
                        <td class="align-middle d-inline-flex">
                            @if($problematizar->quadrinho->pathImg) 
                                <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $problematizar->quadrinho->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                            @else
                                <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $problematizar->quadrinho->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Adicionar</a>
                            @endif

                            @if ($indice >= 1) {{-- Evento ocorrente para os valores de a partir do 2º Indice--}} 
                                <form class="ml-1" action="{{ route('problematizar.destroy', $problematizar->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ $msgExclusao->excluirItemTabela('página '.$problematizar->quadrinho->pagina, 'quadrinho', 'o') }}')">
                                        <i class="fas fa-trash"></i> Remover
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr id="linhasProblematizar"></tr>

                <tr class="bg-secondary">  
                    <td colspan="4" class="text-center">
                        <div class="d-inline-flex">
                            <form id="form_adicionarProblematizar" action="{{ route('problematizar.store') }}" method="post">
                                @csrf
                                <input id="hqId" type="hidden" name="hqId" value="{{$hq->id}}">
                                <button type="submit" id="btn_adicionarProblematizar" class="btn btn-sm btn-dark" role="button"><i class="fa fa-plus"></i> Adicionar Problematizar</button>
                            </form>

                            @if ($solucionars->count() == 0)
                                <form action="{{ route('solucionar.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="hqId" value="{{$hq->id}}">
                                    <input type="hidden" name="criarSolucionar" value="valorGeradoEstaticamente">
                                    <button class="btn btn-sm btn-dark ml-1" role="button"><i class="fa fa-plus"></i> Criar Solucionar</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                
                @foreach ($solucionars as $solucionar)
                    <tr style="border-bottom: 2px solid #555;">
                        <th class="align-middle" scope="row" id="tabSolucionar">Solucionar</th>
                        <td class="align-middle">{{ $solucionar->quadrinho->titulo }}</td>
                        <td class="align-middle" id="atualizarNumeroPagina">{{ $solucionar->quadrinho->pagina }}</td>
                        <td class="align-middle">
                            <div class="d-inline-flex">
                                @if($solucionar->quadrinho->pathImg)
                                    <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $solucionar->quadrinho->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                                @else
                                    <a href="{{ route('mostrarQuadrinho', ['hqId' => $hq->id, 'quadrinhoId' => $solucionar->quadrinho->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Adicionar</a>
                                @endif

                                {{-- Formulário de Remoção --}}
                                <form class="ml-1" action="{{ route('solucionar.destroy', $solucionar->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ $msgExclusao->excluirItemTabela('página '.$solucionar->quadrinho->pagina, 'quadrinho', 'o') }}')">
                                        <i class="fas fa-trash"></i> Remover</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr id="linhasSolucionar"></tr>

                @if ($solucionars->count() > 0)
                    <tr class="bg-secondary">
                        <td colspan="4" class="text-center">
                            <form action="{{ route('solucionar.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="hqId" value="{{$hq->id}}">
                                <button id="btn_adicionarSolucionar" class="btn btn-sm btn-dark ml-1" role="button"><i class="fa fa-plus"></i> Adicionar Solucionar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Fim da Tabela - inicio do pre view --}}

    {{-- Botão para Baixar os quadrinhos --}}
    @if ($situarQuadrinho && $problematizarQuadrinho && $solucionarQuadrinho)
        <button class="btn btn-outline-primary mb-3" onclick="baixarHq('{{$hq->software->descricao}}','{{ $hq->tema }}')" ><i class="fas fa-download"></i> Baixar Quadrinho</button>
    @endif


    {{-- Inicio divisão para baixar os quadrinhos --}}
    <div id="baixarQuadrinho">
        <h4 class="text-center border border-dark mb-0 bg-info text-white rounded-top font-weight-bold">Situar</h4>
        <div class="card-group">
            <div class="card bg-dark text-white rounded-top-0">
                <div class="card-body d-flex">
                    <h2 class="card-title m-auto text-center" style="max-width: 25ch;">{{ $situars[0]->quadrinho->titulo }}</h2>
                </div>
                <div class="card-footer bg-transparent border-top-0 numeroPagina"><span style="text-shadow: 0px 0px 10px #cecece; font-weight: bold; color: black; font-size: 20px;">{{ $situars[0]->quadrinho->pagina }}</span></div>
            </div>
            <div class="card text-center bg-dark text-white">
                <div class="card-header">{{ $situars[1]->quadrinho->titulo }}</div>
                <div class="card-body bg-white">
                    <table class="table table-borderless">
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col" class="balaoQuadrinho py-4">
                                    <div style="width: 100px; height: 120px">
                                        <img src="{{$caminho_imagem.$quadrinhoPersonagens->balaoEsq->caminho}}" style="width: 150%; height: 125%; z-index: -10">
                                        <textarea rows="3" style="max-width: 15ch; position: absolute; left: 14%; top: 18%;" cols="13" class="text-center textareaQuadrinho p-1" disabled>{{ $hq->saudacao1 }}</textarea>
                                    </div>
                                </th>
                                <th scope="col" class="balaoQuadrinho py-4">
                                        <div style="margin-left: 5%;width: 100px; height: 120px">
                                            <img src="{{$caminho_imagem.$quadrinhoPersonagens->balaoDir->caminho}}" style="width: 150%; height: 125%; z-index: -10">
                                            <textarea rows="3" style="max-width: 15ch; position: absolute; left: 61%; top: 18%;" cols="13" class="text-center textareaQuadrinho p-1" disabled>{{ $hq->saudacao2 }}</textarea>
                                        </div>
                                    </th>
                            </tr>
                            <tr>
                                <th scope="col"><img src="{{ $caminho_imagem.$hq->personagem1->personagem }}" class="card-img-personagens text-left" draggable="false"></th>
                                <th scope="col"><img src="{{ $caminho_imagem.$hq->personagem2->personagem }}" class="card-img-personagens text-right" draggable="false"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-left bg-secondary border-top-0 numeroPagina">
                    <span style="text-shadow: 0px 0px 10px #cecece; font-weight: bold; color: black; font-size: 20px;">
                        {{ $situars[1]->quadrinho->pagina }}
                    </span>
                </div>
            </div>
            <div class="card text-center bg-dark text-white rounded-top-0">
                <div class="card-header">{{ $situars[2]->quadrinho->titulo }}</div>
                <div class="card-body p-0 d-flex bg-white">
                    <img src="{{ $caminho_imagem.$hq->ambiente->fundo }}" class="card-img-ambiente my-auto w-100" draggable="false">
                </div>
                <div class="card-footer text-left bg-secondary border-top-0 numeroPagina">
                    <span style="text-shadow: 0px 0px 10px #cecece; font-weight: bold; color: black; font-size: 20px;">
                        {{ $situars[2]->quadrinho->pagina }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card-group">
            @if ($situars[3]->quadrinho->pathImg)  
                <div class="card text-center bg-dark text-white rounded-top-0">
                    @if ($situars[3]->quadrinho->titulo)
                        <div class="card-header">{{ $situars[3]->quadrinho->titulo }}</div>
                    @else
                        <div class="card-header">&nbsp;</div>
                    @endif
                    <div class="card-body p-0 bg-white">
                        <img src="{{ $caminho_imagem.$situars[3]->quadrinho->pathImg }}" class="card-img-ambiente my-auto w-75" draggable="false">
                    </div>
                    <div class="card-footer text-left bg-secondary border-top-0 numeroPagina">
                        <span style="text-shadow: 0px 0px 10px #cecece; font-weight: bold; color: black; font-size: 20px;">
                            {{ $situars[3]->quadrinho->pagina }}
                        </span>
                    </div>
                </div>
            @endif
        </div>

        @if ($problematizars[0]->quadrinho->pathImg)
            <h4 class="text-center border border-dark bg-info text-white mt-3 mb-0 rounded-top font-weight-bold">Problematizar</h4>
            <div class="card-group">
                <div class="col-md-12 m-0 p-0">
                    @foreach ($problematizars as $problematizar)
                        @if ($problematizar->quadrinho->pathImg)
                                <div class="card text-center bg-dark text-white rounded-top-0">
                                    @if ($problematizar->quadrinho->titulo)
                                        <div class="card-header">{{ $problematizar->quadrinho->titulo }}</div>
                                    @else
                                        <div class="card-header">&nbsp;</div>
                                    @endif
                                    <div class="card-body p-0 bg-white">
                                        <img src="{{ $caminho_imagem.$problematizar->quadrinho->pathImg }}" class="card-img-ambiente my-auto w-75" draggable="false">
                                    </div>
                                    <div class="card-footer text-left bg-secondary border-top-0 numeroPagina">
                                        <span style="text-shadow: 0px 0px 10px #cecece; font-weight: bold; color: black; font-size: 20px;">
                                            {{ $problematizar->quadrinho->pagina }}
                                        </span>
                                    </div>
                                </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        @if ($solucionars->count() && $solucionars[0]->quadrinho->pathImg)
            <h4 class="text-center border border-dark bg-info text-white mt-3 mb-0 rounded-top font-weight-bold">Solucionar</h4>
            <div class="card-group">
                <div class="col-md-12 m-0 p-0">
                    @foreach ($solucionars as $solucionar)
                        @if ($solucionar->quadrinho->pathImg)
                            <div class="card text-center bg-dark text-white rounded-top-0">
                                @if ($solucionar->quadrinho->titulo)
                                    <div class="card-header">{{ $solucionar->quadrinho->titulo }}</div>
                                @else
                                    <div class="card-header">&nbsp;</div>
                                @endif
                                <div class="card-body p-0 bg-white">
                                    <img src="{{ $caminho_imagem.$solucionar->quadrinho->pathImg }}" class="card-img-ambiente my-auto w-75" draggable="false">
                                </div>
                                <div class="card-footer text-left bg-secondary border-top-0 numeroPagina">
                                    <span style="text-shadow: 0px 0px 10px #cecece; font-weight: bold; color: black; font-size: 20px;">
                                        {{ $solucionar->quadrinho->pagina }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @include('javascript.tabelaHq')

@endsection