@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>
            Usuário - {{ $usuario->name }}
            <a href="{{ route('hq.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
        </h1>
        
    </div>
    <hr class="bg-dark mt-0"/>

    <form action="{{ route('usuario.update', $usuario->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $usuario->id }}">
        
        <div class="form-group row">
            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">{{ __('Name') }}:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nome" value="{{ $usuario->name }}" maxlength="255" required autofocus>
            </div>

            <label for="nome" class="col-sm-1 col-form-label text-right font-weight-bold">{{ __('E-Mail Address') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" value="{{ $usuario->email }}" disabled>
            </div>
        </div>

        <div class="col-md-8 offset-md-1 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>
        
    </form>
    
    <hr class="bg-dark mt-2"/>


    <form action="{{ route('atualizarSenha', $usuario->id) }}" method="post">
        @csrf
        {{-- @method('PUT') --}}

        <input type="hidden" name="id" value="{{ $usuario->id }}">
        
        <div class="form-group row">
            <label for="nome" class="col-sm-3 col-form-label text-right font-weight-bold">{{ __('Old Password') }}:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="senha_antiga" maxlength="255" required autofocus>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="nome" class="col-sm-3 col-form-label text-right font-weight-bold">{{ __('New Password') }}:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="nova_senha" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-3 col-form-label text-right font-weight-bold">{{ __('Confirm Password') }}:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="confirmar_senha" required>
            </div>
        </div>

        <div class="col-md-8 offset-md-3 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>
        
    </form>


@endsection