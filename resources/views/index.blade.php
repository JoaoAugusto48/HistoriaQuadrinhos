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
        {{-- <table class="table table-sm table-striped text-center " style="border: 3px solid black;"> --}}
        <table class="table table-sm table-borderless table-hover table-striped text-center border border-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="col-2" title="Título do Software">Título</th>
                    <th scope="col" class="col-3" title="Estimativa de Entrega">Est. Entrega</th>
                    <th scope="col" class="col-3" title="Informações de contato">Inf. Contato</th>
                    <th scope="col" class="col-4" title="Manipulações possíveis">Operações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($softwares as $software)
                <tr class="border border-dark">
                    <th class="align-middle" scope="row" style="max-width: 35ch;">
                        <p class="m-0 font-weight-bold">{{ $software->descricao }}</p>
                        <p class="m-0 font-weight-bold font-italic text-muted">
                            {{$software->cliente->nome}}
                        </p>
                    </th>
                    <td class="align-middle">
                        <p class="m-0">{{ $software->prazo }}</p>
                        <p class="m-0 font-italic text-muted">
                            {{-- ( dias que faltam / finalizado ) --}}
                            {{$software->difPrazo}} dias
                        </p>
                    </td>
                    <td class="align-middle">
                        <p class="m-0">{{$software->cliente->email}}</p>
                        <p class="m-0">{{$software->cliente->telefone}}</p>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('software.show', $software->id) }}" class="btn btn-outline-info btn-sm border border-dark" role="button">
                                <i class="fa fa-comments" aria-hidden="true"></i> <em>Requisitos</em>
                            </a>
                            <a href="{{ route('software.edit', $software->id) }}" class="btn btn-outline-secondary btn-sm border border-dark" target="_parent">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                            <form action="{{ route('software.destroy', $software->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $mensagem = '"'.$software->descricao.'"';
                                @endphp
                                <button type="submit" class="btn btn-outline-danger btn-sm border border-dark" onclick="return confirm('{{ $msgExclusao->excluirItemTabela($software->descricao, 'Software', 'o') }}')">
                                    <i class="fas fa-trash"></i> <em>Excluir</em></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        @include('mensagens.cadastrar.software')
    @endif

@endsection
