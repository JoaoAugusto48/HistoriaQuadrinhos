@extends('layouts.app')

@section('content')
        
    <div class="row">
        <h1>
            Editar Software - {{ $software->descricao }}
            <a href="{{ route('software.update', $software->id) }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fa fa-reply" aria-hidden="true"></i> Voltar
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <form action="{{ route('software.update', $software->id) }}" method="post">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Titulo:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="descricao" maxlength="70" value="{{ $software->descricao }}" autocomplete="off" placeholder="Insira o nome do software criado" required autofocus>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>
    </form>

@endsection