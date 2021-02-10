@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Clientes
            <a class="btn btn-outline-dark ml-1" href="{{ route('cliente.create') }}" target="_parent">
                <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Cliente
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

@endsection
