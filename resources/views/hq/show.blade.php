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
            <th scope="col">titulo</th>
            <th scope="col">pagina</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($situars as $situar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">{{ $situar->quadrinho->titulo }}</th>
                    <td class="align-middle">{{ $situar->quadrinho->pagina }}</td>
                </tr>
            @endforeach
            @foreach ($problematizars as $problematizar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">{{ $problematizar->quadrinho->titulo }}</th>
                    <td class="align-middle">{{ $problematizar->quadrinho->pagina }}</td>
                </tr>
            @endforeach
            @foreach ($solucionars as $solucionar)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row">{{ $solucionar->quadrinho->titulo }}</th>
                    <td class="align-middle">{{ $solucionar->quadrinho->pagina }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection