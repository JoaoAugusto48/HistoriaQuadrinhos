@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Softwares 
            <a class="btn btn-outline-dark ml-1" href="{{ route('software.create') }}" target="_parent">
                <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Software
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    @if ($softwares->count() > 0)
        <table class="table table-striped text-center" style="border: 3px solid black;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($softwares as $software)
                <tr style="border-bottom: 2px solid #555;">
                    <th class="align-middle font-weight-bold" scope="row" style="max-width: 35ch;">{{ $software->descricao }}</th>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('software.show', $software->id) }}" class="btn btn-outline-info btn-sm border border-dark" role="button">
                                <i class="fa fa-comments" aria-hidden="true"></i> <em>Requisitos</em>
                            </a>
                            <form action="{{ route('software.destroy', $software->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $mensagem = '"'.$software->descricao.'"';
                                @endphp
                                <button type="submit" class="btn btn-outline-danger btn-sm border border-dark" onclick="return confirm('Deseja realmente excluir o Software - {{ $mensagem }}?')">
                                    <i class="fas fa-trash"></i> <em>Excluir</em></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <div class="card text-center border border-dark shadow">
            <div class="card-header">
                &nbsp;
            </div>
            <div class="card-body">
                <h5 class="card-title">Você ainda não possui Softwares cadastrados!</h5>
                <p class="card-text">Clique no Botão abaixo para cadastrá-lo.</p>
                <a href="{{ route('software.create') }}" class="btn btn-primary"> 
                    <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Software
                </a>
            </div>
            <div class="card-footer text-muted">
                &nbsp;
            </div>
        </div>
        
    @endif

@endsection