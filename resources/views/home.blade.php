@extends('layout')

@section('content')
        
    <div class="row">
        <h1>História em Quadrinhos</h1>
        <a href="{{ route('hq.create') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Criar HQ</button>
        </a>
        <a href="{{ route('quadrinho.index') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Teste com Quadrinho</button>
        </a>
        <a href="{{ route('quadrinhos') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Teste de Imagem HQ</button>
        </a>
    </div>
    <hr class="bg-dark"/>

    <table class="table table-striped text-center" style="border: 3px solid black;">
        <thead class="thead-dark">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Personagem1</th>
            <th scope="col">Personagem2</th>
            <th scope="col">Ambiente</th>
            <th scope="col">Operações</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($hqs as $hq)
            <tr style="border-bottom: 2px solid #555;">
                <th scope="row">{{ $hq->id }}</th>
                <td>{{ $hq->personagem1->descricao }} <img src="{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}" }}" class="img-btn ml-2"></td>
                <td>{{ $hq->personagem2->descricao }} <img src="{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}" }}" class="img-btn ml-2"></td>
                <td>{{ $hq->ambiente->descricao }} <img src="{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}" }}" class="img-btn ml-2"></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('quadrinho.show', $hq->id) }}" class="btn btn-outline-info btn-sm border border-dark" role="button" data-toggle="tooltip" data-placement="top" title="ObservarHQ">
                            <i>Observar HQ</i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection