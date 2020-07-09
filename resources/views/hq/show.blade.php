@extends('layout')

@section('content')
    <div class="row">
        <h3>Quadrinho - {{ $hq->tema }}</h3>
        <a href="{{ route('hq.index') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Inicio</button>
        </a>
    </div>
    <hr class="bg-dark"/>

    <table class="table table-striped text-center" style="border: 3px solid black;">
        <thead class="thead-dark">
          <tr>
            <th scope="col">tipo</th>
            <th scope="col">titulo</th>
            <th scope="col">pagina</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($situars as $situar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">Situar</th>
                    <td class="align-middle">{{ $situar->quadrinho->titulo }}</td>
                    <td class="align-middle">{{ $situar->quadrinho->pagina }}</td>
                </tr>
            @endforeach
            @foreach ($problematizars as $problematizar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">Problematizar</th>
                    <td class="align-middle">{{ $problematizar->quadrinho->titulo }}</td>
                    <td class="align-middle">{{ $problematizar->quadrinho->pagina }}</td>
                </tr>
            @endforeach
            @foreach ($solucionars as $solucionar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">Solucionar</th>
                    <td class="align-middle">{{ $solucionar->quadrinho->titulo }}</td>
                    <td class="align-middle">{{ $solucionar->quadrinho->pagina }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="card-group">
        <div class="card bg-dark text-white">
            <div class="card-body d-flex">
                <h2 class="card-title m-auto text-center">{{ $hq->tema }}</h2>
            </div>
            <div class="card-footer bg-transparent border-top-0 numeroPagina">1</div>
        </div>
        <div class="card text-center bg-dark text-white">
            <div class="card-header">Personagens</div>
            <div class="card-body bg-white">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="col"><img src="{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}" class="card-img-personagens text-left"></th>
                            <th scope="col"><img src="{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}" class="card-img-personagens text-right"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-left bg-white border-top-0 numeroPagina">2</div>
        </div>
        <div class="card text-center bg-dark text-white">
            <div class="card-header">Ambiente de Trabalho</div>
            <div class="card-body p-0 d-flex bg-white">
                <img src="{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}" class="card-img-ambiente my-auto">
            </div>
            <div class="card-footer text-left bg-white border-top-0 numeroPagina">3</div>
        </div>
    </div>

    {{-- <div class="card-group">
        <div class="card">
            <div class="card-header">
                
            </div>
        </div>
    </div> --}}
@endsection