@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Clientes
            <a href="{{ route('software.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
            <a class="btn btn-outline-dark ml-1" href="{{ route('cliente.create') }}" target="_parent">
                <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Cliente
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    @if ($clientes->count() > 0)
        <table class="table table-sm table-striped text-center" style="border: 3px solid black;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" title="Empresa">Empresa</th>
                    <th scope="col" title="Localização">Localização</th>
                    <th scope="col" title="Informações de contato">Inf. Contato</th>
                    <th scope="col" title="Manipulações possíveis">Operações</th>
                </tr>
            </thead>
            @foreach ($clientes as $cliente)
                <tbody style="border-bottom: 2px solid #555;">
                    <th class="align-middle" scope="row" style="max-width: 35ch;">
                        <span class="font-weight-bold">{{$cliente->nome}}</span>
                        <br>
                        <span class="font-italic">
                            {{$cliente->responsavel}}
                        </span>
                    </th>
                    <td class="align-middle">
                        {{$cliente->endereco}}, {{$cliente->numero}} @if($cliente->complemento) - {{$cliente->complemento}} @endif
                        <br>
                        <span class="font-italic">
                            {{$cliente->cidade}}-{{$cliente->estado->uf}}
                        </span>
                    </td>
                    <td class="align-middle">
                        {{$cliente->email}}
                        <br>
                        {{$cliente->telefone}}
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-outline-info btn-sm border border-dark" target="_parent">
                                <i class="fas fa-edit"></i> Atualizar
                            </a>

                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @php
                                    $mensagem = '"'.$cliente->descricao.'"';
                                @endphp
                                <button type="submit" class="btn btn-outline-danger btn-sm border border-dark" onclick="return confirm('Deseja realmente excluir a Empresa - {{ $mensagem }}?')">
                                    <i class="fas fa-trash"></i> <em>Excluir</em></button>
                            </form>
                        </div>
                    </td>
                </tbody>
            @endforeach
        </table>
    @else
        @include('mensagens.cadastrar.cliente')
    @endif


@endsection
